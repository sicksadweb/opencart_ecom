<?php

class SeoPattern {

    private $description_preview;
    private $config;
	private $db;

    public function __construct($registry)
    {
        $this->config = $registry->get('config');
        $this->db = $registry->get('db');
    }

    public function getDescriptionPreview() {
        
        return $this->description_preview;
    
    }

    public function setPatternToConfigForProduct() {

        $description_pattern_elements = array(
            "{название товара}" 	  => '$product_info[\'name\']',
            "{цена}" 				  => 'round($product_info[\'price\'], 2)',
            "{наименование магазина}" => '$product_info[\'store_name\']',
            "{Абакан}" 				  => "'Абакан'",
            "{Саяногорск}" 			  => "'Саяногорск'",
            "{Минусинск}" 			  => "'Минусинск'");

        $config_description_pattern = addslashes(json_encode($description_pattern_elements, JSON_UNESCAPED_UNICODE));
        $this->db->query("UPDATE `ckf_setting` SET `value` = '$config_description_pattern' WHERE `key` = 'config_product_description_pattern'");
    }

    public function setPatternToConfigForCategory() {

        $description_pattern_elements = array(
            "{название категории}" 	  => '$category_info[\'name\']');

        $config_description_pattern = addslashes(json_encode($description_pattern_elements, JSON_UNESCAPED_UNICODE));
        $this->db->query("UPDATE `ckf_setting` SET `value` = '$config_description_pattern' WHERE `key` = 'config_category_description_pattern'");
    }

    public function setDescriptionPreviewForProduct($pattern, $product_info) {

        //$description_pattern_elements = json_decode($config_description_pattern, true);						
        $description_pattern_elements = json_decode($this->config->get('config_product_description_pattern'), true);						
        
        $temp_arr = array();
        foreach ($description_pattern_elements as $element => $value) {
            if ($element == "{цена}") {
                
                $temp_arr[$element] = eval('return ' . $value . ';') . ' ' . eval('return $this->config->get(\'config_currency\');');
                continue;
            }
            $temp_arr[$element] = eval('return ' . $value . ';');
        }
        
        $this->description_preview = strtr($pattern, $temp_arr);
    }

    public function setDescriptionPreviewForCategory($pattern, $category_info) {

        //$description_pattern_elements = json_decode($config_description_pattern, true);						
        $description_pattern_elements = json_decode($this->config->get('config_category_description_pattern'), true);						
        
        $temp_arr = array();
        foreach ($description_pattern_elements as $element => $value) {

            $temp_arr[$element] = eval('return ' . $value . ';');
        }
        
        $this->description_preview = strtr($pattern, $temp_arr);
    }
}