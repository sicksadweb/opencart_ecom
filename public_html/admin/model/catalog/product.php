<?php
// *	@source		See SOURCE.txt for source and other copyright.
// *	@license	GNU General Public License version 3; see LICENSE.txt

class ModelCatalogProduct extends Model {

	//Product from 1c
	public function addProduct($data) {

		$checkQuery = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE sku = '" . $data['sku'] . "'");

		if ($checkQuery->row) return;

		$this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['data_location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = NOW() , manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW(), date_modified = NOW()");

		$product_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
		}

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "' AND language_id = '" . (int)$language_id . "'");

						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "product_recurring` SET `product_id` = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", `recurring_id` = " . (int)$recurring['recurring_id']);
			}
		}
		
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "', name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "' , name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image_aditional SET product_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
				} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_to_category SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}

		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related_article WHERE product_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related_article SET product_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
				if ((int)$product_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
				}
			}
		}
		
		// SEO URL
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		//SEO Description-patterns
		if (isset($data['description_pattern'])) {

			$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");
		}

		//Locations data
		if (isset($data['locations'])) {
			foreach ($data['locations'] as $location) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_location_price SET product_id = '" . $product_id ."', price = '". $location['price'] ."', location_id = '" . $location['location_id']  . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_warehouse SET product_id = '" . $product_id ."', location_id = '" . $location['location_id']  . "', quantity = '" . $location['quantity']  . "', stock_status_id = '" . $location['stock_status']  . "'");
			}
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		return $product_id;
	}

	//Offer
	public function addOffer($data) {

		$checkQuery = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer WHERE sku = '" . $data['sku'] . "'");

		if ($checkQuery->row) return;

		$this->db->query("INSERT INTO " . DB_PREFIX . "offer SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = NOW() , manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW(), date_modified = NOW()");

		$product_id = $this->db->getLastId();		

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer SET image = '" . $this->db->escape($data['image']) . "' WHERE offer_id = '" . (int)$product_id . "'");
		}

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_description SET offer_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_store SET offer_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "' AND language_id = '" . (int)$language_id . "'");

						$this->db->query("INSERT INTO " . DB_PREFIX . "offer_attribute SET offer_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option SET offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option_value SET offer_option_id = '" . (int)$product_option_id . "', offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option SET offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "offer_recurring` SET `offer_id` = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", `recurring_id` = " . (int)$recurring['recurring_id']);
			}
		}
		
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_discount SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_special SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image SET offer_id = '" . (int)$product_id . "', name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "' , name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image_aditional SET offer_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_download SET offer_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
				} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer_to_category SET main_category = 1 WHERE offer_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}

		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_filter SET offer_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related_article WHERE offer_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related_article SET offer_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
				if ((int)$product_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_reward SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
				}
			}
		}
		
		// SEO URL
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_layout SET offer_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		//SEO Description-patterns
		if (isset($data['description_pattern'])) {

			$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		if (isset($data['product_link'])) {

			foreach ($data['product_link'] as $key => $product_id_for_link) {

				$this->db->query("INSERT INTO ". DB_PREFIX ."variants SET offer_id = '". $product_id ."', product_id = '". $product_id_for_link ."'");
			}
		}
		
		return $product_id;
	}

	//View
	public function addView($data) {

		$checkQuery = $this->db->query("SELECT * FROM " . DB_PREFIX . "view WHERE sku = '" . $data['sku'] . "'");

		if ($checkQuery->row) return;

		$this->db->query("INSERT INTO " . DB_PREFIX . "view SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = NOW() , manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW(), date_modified = NOW()");

		$product_id = $this->db->getLastId();		

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "view SET image = '" . $this->db->escape($data['image']) . "' WHERE view_id = '" . (int)$product_id . "'");
		}

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "view_description SET view_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_store SET view_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "view_attribute WHERE view_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("DELETE FROM " . DB_PREFIX . "view_attribute WHERE view_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "' AND language_id = '" . (int)$language_id . "'");

						$this->db->query("INSERT INTO " . DB_PREFIX . "view_attribute SET view_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "view_option SET view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "view_option_value SET view_option_id = '" . (int)$product_option_id . "', view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "view_option SET view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "view_recurring` SET `view_id` = " . (int)$product_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", `recurring_id` = " . (int)$recurring['recurring_id']);
			}
		}
		
		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_discount SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_special SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_image SET view_id = '" . (int)$product_id . "', name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "' , name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "', image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_image_aditional SET view_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_download SET view_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_category SET view_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}
		
		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_category WHERE view_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_category SET view_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
				} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "view_to_category SET main_category = 1 WHERE view_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}

		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_filter SET view_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related SET view_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related SET view_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related_article WHERE view_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related_article SET view_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $product_reward) {
				if ((int)$product_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "view_reward SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$product_reward['points'] . "'");
				}
			}
		}
		
		// SEO URL
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url'] as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_layout SET view_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		//SEO Description-patterns
		if (isset($data['description_pattern'])) {

			$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		if (isset($data['product_link'])) {

			foreach ($data['product_link'] as $key => $offer_id_for_link) {

				$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."variants WHERE offer_id = '". $offer_id_for_link ."' AND view_id is null");

				if ($query->rows) {

					$this->db->query("UPDATE ". DB_PREFIX ."variants SET view_id = '". $product_id ."' WHERE offer_id = '". $offer_id_for_link ."' AND view_id is null");
				}
				else {

					$this->db->query("INSERT INTO ". DB_PREFIX ."variants SET view_id = '". $product_id ."', offer_id = '". $offer_id_for_link ."'");
				}
			}
		}
		
		return $product_id;
	}
	
	public function addThePackage($data){	

		$this->db->query("INSERT INTO " . DB_PREFIX . "package_product SET
						  product_id='" . $this->db->escape($data['product_id']) . "',
						  package_id='" . $this->db->escape($data['package_id']) . "',
						  parent_package_id='" . $this->db->escape($data['parent_package_id']) . "',
						  quantity='" . $this->db->escape($data['quantity']) . "',
						  volume='" . $this->db->escape($data['volume']) . "',
						  package_name_id='" . $this->db->escape($data['package_name_id']) . "',
						  product_type=NULL
						  ");
	}

	public function getProductsWithoutPackage() {
		$query = "SELECT p.product_id 'id', p.sku, pd.name, pp.product_id FROM " . DB_PREFIX . "product p 
				  LEFT JOIN " . DB_PREFIX . "product_description pd ON p.product_id = pd.product_id 
				  LEFT JOIN " . DB_PREFIX . "package_product pp ON p.product_id = pp.product_id WHERE pp.product_id is NULL ORDER BY id ASC";

		$result = $this->db->query($query);

		return $result->rows;
	}

	public function getNameOfPackages() {	
		$query = $this->db->query(
			"SELECT name FROM " . DB_PREFIX . "package_description" 
		);
		return $query->rows;
	}

	public function updateDataForConfigurator() {

		$query = $this->db->query("SELECT * FROM ". DB_PREFIX ."view WHERE status = 0");

		foreach($query->rows as $key => $value) {
			$this->db->query("UPDATE collestion SET activ = 0 WHERE product_id= '". $value['view_id']. "'");
		}
	}

	public function sendInfoAboutMissingViewInConfigurator() {

		$categories_in_collestion = $this->db->query(

			"SELECT DISTINCT vc.category_id FROM collestion c
			LEFT JOIN ". DB_PREFIX ."view_to_category vc ON c.product_id = vc.view_id ORDER BY category_id DESC"
		);

		foreach ($categories_in_collestion->rows as $key => $value) {

			if ($value['category_id'] != null) {
			
				$query = $this->db->query(
					
					"SELECT DISTINCT vc.category_id, vc.view_id, c.product_id, vd.name as category_name, v.model as view_name FROM ". DB_PREFIX ."view_to_category vc 
					LEFT JOIN collestion c ON c.product_id = vc.view_id 
					LEFT JOIN ". DB_PREFIX ."category_views_description vd ON vc.category_id = vd.views_id 
					LEFT JOIN ". DB_PREFIX ."view v ON vc.view_id = v.view_id
					WHERE vc.category_id = '". $value['category_id'] ."' AND product_id is NULL"
				);

				foreach ($query->rows as $index => $data) {
					$result[] = array(
						'category_id'  => $data['category_id'],
						'view_id' 	   => $data['view_id'],
						'category_name'=> $data['category_name'],
						'view_name'	   => $data['view_name']
					);
				}
			}
		}
		//return $categories_in_collestion->rows;
		return $result;
		//Категории, которые есть у товаров в collestion
		//SELECT DISTINCT vc.category_id FROM collestion c LEFT JOIN ckf_view_to_category vc ON c.product_id = vc.view_id ORDER BY category_id DESC
		
		// Выборка view из таблиц collestion и category_to_view
		//SELECT DISTINCT  vc.category_id, vc.view_id, c.product_id FROM ckf_view_to_category vc LEFT JOIN collestion c ON c.product_id = vc.view_id WHERE vc.category_id = 
	}	

	//Edit product from 1c
	public function editProduct($product_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape($data['image']) . "' WHERE product_id = '" . (int)$product_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "'");

		if (!empty($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int)$product_option['product_option_id'] . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = " . (int)$product_id);

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $product_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "product_recurring` SET `product_id` = " . (int)$product_id . ", customer_group_id = " . (int)$product_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$product_recurring['recurring_id']);
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_discount SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "',  image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image_aditional WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_image_aditional SET product_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}
		


		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
		} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "product_to_category SET main_category = 1 WHERE product_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}
		
		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int)$product_id . "'");

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related_article WHERE product_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "product_related_article WHERE product_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_related_article SET product_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}
		
		// SEO URL
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url']as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_layout SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		//SEO Description-patterns
		if (isset($data['description_pattern'])) {

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '". $product_id ."'");

			if ($query->row) {

				$this->db->query("UPDATE ". DB_PREFIX ."seo_url_patterns SET pattern = '". $data['description_pattern'] ."' WHERE product_id = '" . $product_id ."'");

			}
			else {

				$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");

			}
			
		}

		//Locations data
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_location_price WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_warehouse WHERE product_id = '" . (int)$product_id . "'");

		if (isset($data['locations'])) {
			foreach ($data['locations'] as $location) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_location_price SET product_id = '" . $product_id ."', price = '". $location['price'] ."', location_id = '" . $location['location_id']  . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_warehouse SET product_id = '" . $product_id ."', location_id = '" . $location['location_id']  . "', quantity = '" . $location['quantity']  . "', stock_status_id = '" . $location['stock_status']  . "'");
			}
		}
	}

	//Edit offer
	public function editOffer($product_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "offer SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer SET image = '" . $this->db->escape($data['image']) . "' WHERE offer_id = '" . (int)$product_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$product_id . "'");

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_description SET offer_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_store WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_store SET offer_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$product_id . "'");

		if (!empty($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "offer_attribute SET offer_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option_value WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option SET offer_option_id = '" . (int)$product_option['product_option_id'] . "', offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option_value SET offer_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', offer_option_id = '" . (int)$product_option_id . "', offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_option SET offer_option_id = '" . (int)$product_option['product_option_id'] . "', offer_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "offer_recurring` WHERE offer_id = " . (int)$product_id);

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $product_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "offer_recurring` SET `offer_id` = " . (int)$product_id . ", customer_group_id = " . (int)$product_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$product_recurring['recurring_id']);
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_discount SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_special WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_special SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image SET offer_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "',  image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_image_aditional WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_image_aditional SET offer_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_download WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_download SET offer_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_filter WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_category SET offer_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
		} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "offer_to_category SET main_category = 1 WHERE offer_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}
		
		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_filter SET offer_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE related_id = '" . (int)$product_id . "'");

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related SET offer_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related_article WHERE offer_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related_article WHERE offer_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_related_article SET offer_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_reward WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "offer_reward SET offer_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}
		
		// SEO URL
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url']as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$product_id . "'");

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "offer_to_layout SET offer_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		//SEO Description-patterns
		/* if (isset($data['description_pattern'])) {

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '". $product_id ."'");

			if ($query->row) {

				$this->db->query("UPDATE ". DB_PREFIX ."seo_url_patterns SET pattern = '". $data['description_pattern'] ."' WHERE product_id = '" . $product_id ."'");

			}
			else {

				$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");

			}
			
		} */

		if (isset($data['product_link'])) {
			
			$this->db->query("DELETE FROM ". DB_PREFIX ."variants WHERE offer_id = '". $product_id ."'");

			foreach ($data['product_link'] as $key => $product_id_for_link) {

				$this->db->query("INSERT INTO ". DB_PREFIX ."variants SET offer_id = '". $product_id ."', product_id = '". $product_id_for_link ."'");
			}
		}
		else $this->db->query("DELETE FROM ". DB_PREFIX ."variants WHERE offer_id = '". $product_id ."'");
	}

	//Edit view
	public function editView($product_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "view SET model = '" . $this->db->escape($data['model']) . "', sku = '" . $this->db->escape($data['sku']) . "', upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', noindex = '" . (int)$data['noindex'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "view SET image = '" . $this->db->escape($data['image']) . "' WHERE view_id = '" . (int)$product_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_description WHERE view_id = '" . (int)$product_id . "'");

		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "view_description SET view_id = '" . (int)$product_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_h1 = '" . $this->db->escape($value['meta_h1']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_store WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_store'])) {
			foreach ($data['product_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_store SET view_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_attribute WHERE view_id = '" . (int)$product_id . "'");

		if (!empty($data['product_attribute'])) {
			foreach ($data['product_attribute'] as $product_attribute) {
				if ($product_attribute['attribute_id']) {
					// Removes duplicates
					$this->db->query("DELETE FROM " . DB_PREFIX . "view_attribute WHERE view_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

					foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "view_attribute SET view_id = '" . (int)$product_id . "', attribute_id = '" . (int)$product_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($product_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_option WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_option_value WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_option'])) {
			foreach ($data['product_option'] as $product_option) {
				if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
					if (isset($product_option['product_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "view_option SET view_option_id = '" . (int)$product_option['product_option_id'] . "', view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', required = '" . (int)$product_option['required'] . "'");

						$product_option_id = $this->db->getLastId();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "view_option_value SET view_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', view_option_id = '" . (int)$product_option_id . "', view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "view_option SET view_option_id = '" . (int)$product_option['product_option_id'] . "', view_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', value = '" . $this->db->escape($product_option['value']) . "', required = '" . (int)$product_option['required'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "view_recurring` WHERE view_id = " . (int)$product_id);

		if (isset($data['product_recurring'])) {
			foreach ($data['product_recurring'] as $product_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "view_recurring` SET `view_id` = " . (int)$product_id . ", customer_group_id = " . (int)$product_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$product_recurring['recurring_id']);
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_discount WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_discount'])) {
			foreach ($data['product_discount'] as $product_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_discount SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_discount['customer_group_id'] . "', quantity = '" . (int)$product_discount['quantity'] . "', priority = '" . (int)$product_discount['priority'] . "', price = '" . (float)$product_discount['price'] . "', date_start = '" . $this->db->escape($product_discount['date_start']) . "', date_end = '" . $this->db->escape($product_discount['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_special WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_special'])) {
			foreach ($data['product_special'] as $product_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_special SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$product_special['customer_group_id'] . "', priority = '" . (int)$product_special['priority'] . "', price = '" . (float)$product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_image WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $product_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_image SET view_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_image['name']) . "', alt = '" . $this->db->escape($product_image['alt']) . "',  image = '" . $this->db->escape($product_image['image']) . "', sort_order = '" . (int)$product_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_image_aditional WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_image_aditional'])) {
			foreach ($data['product_image_aditional'] as $product_aditional_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_image_aditional SET view_id = '" . (int)$product_id . "',  name = '" . $this->db->escape($product_aditional_image['name']) . "', alt = '" . $this->db->escape($product_aditional_image['alt']) . "', image = '" . $this->db->escape($product_aditional_image['image']) . "', sort_order = '" . (int)$product_aditional_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_download WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_download'])) {
			foreach ($data['product_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_download SET view_id = '" . (int)$product_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_category WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_category'])) {
			foreach ($data['product_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_category SET view_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_filter WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['main_category_id']) && $data['main_category_id'] > 0) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_category WHERE view_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['main_category_id'] . "'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_category SET view_id = '" . (int)$product_id . "', category_id = '" . (int)$data['main_category_id'] . "', main_category = 1");
		} elseif (isset($data['product_category'][0])) {
			$this->db->query("UPDATE " . DB_PREFIX . "view_to_category SET main_category = 1 WHERE view_id = '" . (int)$product_id . "' AND category_id = '" . (int)$data['product_category'][0] . "'");
		}
		
		if (isset($data['product_filter'])) {
			foreach ($data['product_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_filter SET view_id = '" . (int)$product_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE related_id = '" . (int)$product_id . "'");

		if (isset($data['product_related'])) {
			foreach ($data['product_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$product_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related SET view_id = '" . (int)$product_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$related_id . "' AND related_id = '" . (int)$product_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related SET view_id = '" . (int)$related_id . "', related_id = '" . (int)$product_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related_article WHERE view_id = '" . (int)$product_id . "'");
		
		if (isset($data['product_related_article'])) {
			foreach ($data['product_related_article'] as $article_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "view_related_article WHERE view_id = '" . (int)$product_id . "' AND article_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_related_article SET view_id = '" . (int)$product_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "view_reward WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_reward'])) {
			foreach ($data['product_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "view_reward SET view_id = '" . (int)$product_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}
		
		// SEO URL
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		
		if (isset($data['product_seo_url'])) {
			foreach ($data['product_seo_url']as $store_id => $language) {
				foreach ($language as $language_id => $keyword) {
					if (!empty($keyword)) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'product_id=" . (int)$product_id . "', keyword = '" . $this->db->escape($keyword) . "'");
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_layout WHERE view_id = '" . (int)$product_id . "'");

		if (isset($data['product_layout'])) {
			foreach ($data['product_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "view_to_layout SET view_id = '" . (int)$product_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}

		//SEO Description-patterns
		/* if (isset($data['description_pattern'])) {

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '". $product_id ."'");

			if ($query->row) {

				$this->db->query("UPDATE ". DB_PREFIX ."seo_url_patterns SET pattern = '". $data['description_pattern'] ."' WHERE product_id = '" . $product_id ."'");

			}
			else {

				$this->db->query("INSERT INTO ". DB_PREFIX ."seo_url_patterns SET product_id = '" . $product_id ."', pattern= '" . $data['description_pattern'] . "'");

			}
			
		} */
		//Все offer c view_id = $product_id
		$check_query_view = $this->db->query("SELECT * FROM ". DB_PREFIX ."variants WHERE view_id = '". $product_id ."'");
		foreach ($check_query_view->rows as $key => $value) $busy_offer[] = $value['offer_id'];

		//Все offer c view_id = null
		$check_query_offer = $this->db->query("SELECT offer_id FROM ". DB_PREFIX ."variants WHERE view_id is null");	
		foreach ($check_query_offer->rows as $key => $value) $free_offer[] = $value['offer_id'];
		
		foreach ($data['product_link'] as $key => $value) $product_link[] = $value;
				
		if (isset($data['product_link'])) {

			if ($check_query_view->rows) {	

				foreach ($data['product_link'] as $key => $offer_id_for_link) {
					
					if ($check_query_offer->rows && in_array($offer_id_for_link, $free_offer)) {

						$this->db->query("UPDATE " . DB_PREFIX . "variants SET view_id = '" . (int)$product_id . "' WHERE offer_id = '" . (int)$offer_id_for_link . "'");

					}
					else if (!in_array($offer_id_for_link, $busy_offer)) {

						$this->db->query("INSERT INTO ". DB_PREFIX ."variants SET view_id = '". $product_id ."', offer_id = '". $offer_id_for_link ."'");
						
					}
				}

				foreach ($busy_offer as $offer_id) {

					if (!in_array($offer_id, $product_link)) {

						$this->db->query("UPDATE ". DB_PREFIX ."variants SET view_id = NULL WHERE offer_id = '". $offer_id ."'");
					}
				}

			}
			else {

				foreach ($data['product_link'] as $key => $offer_id_for_link) {

					if (in_array($offer_id_for_link, $free_offer)) {

						$this->db->query("UPDATE " . DB_PREFIX . "variants SET view_id = '" . (int)$product_id . "' WHERE offer_id = '" . (int)$offer_id_for_link . "'");
					}
					else {

						$this->db->query("INSERT INTO ". DB_PREFIX ."variants SET view_id = '". $product_id ."', offer_id = '". $offer_id_for_link ."'");
					}
	
				}
			}
		}
		else {
			
			$this->db->query("UPDATE ". DB_PREFIX ."variants SET view_id = NULL WHERE view_id = '". $product_id ."'");
		}
		
	}
	
	public function editProductStatus($product_id, $status) {
        $this->db->query("UPDATE " . DB_PREFIX . "product SET status = '" . (int)$status . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");
        
		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}
		
		return $product_id;
    }

	public function copyProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p WHERE p.product_id = '" . (int)$product_id . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';
			$data['noindex'] = '0';

			$data['product_attribute'] = $this->getProductAttributes($product_id);
			$data['product_description'] = $this->getProductDescriptions($product_id);
			$data['product_discount'] = $this->getProductDiscounts($product_id);
			$data['product_filter'] = $this->getProductFilters($product_id);
			$data['product_image'] = $this->getProductImages($product_id);
			$data['product_image'] = $this->getProductAditionalImages($product_id);
			
			$data['product_option'] = $this->getProductOptions($product_id);
			$data['product_related'] = $this->getProductRelated($product_id);
			$data['product_related_article'] = $this->getArticleRelated($product_id);
			$data['product_reward'] = $this->getProductRewards($product_id);
			$data['product_special'] = $this->getProductSpecials($product_id);
			$data['product_category'] = $this->getProductCategories($product_id);
			$data['product_download'] = $this->getProductDownloads($product_id);
			$data['product_layout'] = $this->getProductLayouts($product_id);
			$data['product_store'] = $this->getProductStores($product_id);
			$data['product_recurrings'] = $this->getRecurrings($product_id);

			$this->addProduct($data);
		}
	}

	//Product from 1c
	public function deleteProduct($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . 			   	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" .   	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_discount WHERE product_id = '" .    	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . 	   	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . 	   	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . 	   	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" .    (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . 	       (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . 		   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_related_article WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . 		   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" .  	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" .     (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_recurring WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . 				   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . 		   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_product WHERE product_id = '" . 		   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '" . 	   (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_location_price WHERE product_id = '" .  (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_warehouse WHERE product_id = '" .    (int)$product_id . "'");

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}
	}

	//Offer
	public function deleteOffer($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_attribute WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_discount WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_filter WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_image WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_option_value WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related WHERE related_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_related_article WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_reward WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_special WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_category WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_download WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_layout WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_to_store WHERE offer_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "offer_recurring WHERE offer_id = " . (int)$product_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "variants WHERE offer_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_offer WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '" . (int)$product_id . "'");

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}
	}

	//View
	public function deleteView($product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "view WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_attribute WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_description WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_discount WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_filter WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_image WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_option WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_option_value WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related WHERE related_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_related_article WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_reward WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_special WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_category WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_download WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_layout WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_to_store WHERE view_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "view_recurring WHERE view_id = " . (int)$product_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int)$product_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");
		$this->db->query("UPDATE ". DB_PREFIX ."variants SET view_id = NULL WHERE view_id = '". $product_id ."'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "coupon_offer WHERE product_id = '" . (int)$product_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "seo_url_patterns WHERE product_id = '" . (int)$product_id . "'");

		$this->cache->delete('product');
		
		if($this->config->get('config_seo_pro')){		
		$this->cache->delete('seopro');
		}
	}

	//Products from 1c
	public function getProduct($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, p.product_id as product_id, pd.name as name, s.name as store_name FROM " . DB_PREFIX . "product p 
		
		LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
		LEFT JOIN " . DB_PREFIX . "product_to_store ps ON (p.product_id = ps.product_id)
		LEFT JOIN " . DB_PREFIX . "store s ON (s.store_id = ps.store_id)
		LEFT JOIN " . DB_PREFIX . "seo_url_patterns up ON (p.product_id = up.product_id)
		WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	//Offer
	public function getOffer($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, o.offer_id as product_id, od.name as name, s.name as store_name FROM " . DB_PREFIX . "offer o 
		
		LEFT JOIN " . DB_PREFIX . "offer_description od ON (o.offer_id = od.offer_id) 
		LEFT JOIN " . DB_PREFIX . "offer_to_store os ON (o.offer_id = os.offer_id)
		LEFT JOIN " . DB_PREFIX . "store s ON (s.store_id = os.store_id)
		LEFT JOIN " . DB_PREFIX . "seo_url_patterns up ON (o.offer_id = up.product_id)
		WHERE o.offer_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	//View
	public function getView($product_id) {
		$query = $this->db->query("SELECT DISTINCT *, v.view_id as product_id, vd.name as name, s.name as store_name FROM " . DB_PREFIX . "view v 
		
		LEFT JOIN " . DB_PREFIX . "view_description vd ON (v.view_id = vd.view_id) 
		LEFT JOIN " . DB_PREFIX . "view_to_store vs ON (v.view_id = vs.view_id)
		LEFT JOIN " . DB_PREFIX . "store s ON (s.store_id = vs.store_id)
		LEFT JOIN " . DB_PREFIX . "seo_url_patterns up ON (v.view_id = up.product_id)
		WHERE v.view_id = '" . (int)$product_id . "' AND vd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}


	//Products from 1c
	public function getProducts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			preg_match('/(.*)(WHERE pd\.language_id.*)/', $sql, $sql_crutch_matches);
		if (isset($sql_crutch_matches[2])) {
		$sql = $sql_crutch_matches[1] . " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)" . $sql_crutch_matches[2];
		} else {
			$data['filter_category'] = null;
			}
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND p2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND p2c.category_id IS NULL";
				}
			}
		}
	
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (!empty($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND p.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND p.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND p.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND p.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND p.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$sql .= " GROUP BY p.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.noindex',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}	

	//Offer
	public function getProductsOffer($data = array()) {
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "offer o LEFT JOIN " . DB_PREFIX . "offer_description od ON (o.offer_id = od.offer_id) WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			preg_match('/(.*)(WHERE pd\.language_id.*)/', $sql, $sql_crutch_matches);
		if (isset($sql_crutch_matches[2])) {
		$sql = $sql_crutch_matches[1] . " LEFT JOIN " . DB_PREFIX . "offer_to_category o2c ON (o.offer_id = o2c.offer_id)" . $sql_crutch_matches[2];
		} else {
			$data['filter_category'] = null;
			}
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND o.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "o2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND o2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND o2c.category_id IS NULL";
				}
			}
		}
	
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND o.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (!empty($data['filter_price'])) {
			$sql .= " AND o.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND o.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND o.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND o.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND o.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND o.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND o.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND o.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$sql .= " GROUP BY o.offer_id";

		$sort_data = array(
			'od.name',
			'o.model',
			'o.price',
			'o.quantity',
			'o.status',
			'o.noindex',
			'o.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	//View
	public function getProductsView($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "view v LEFT JOIN " . DB_PREFIX . "view_description vd ON (v.view_id = vd.view_id) WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			preg_match('/(.*)(WHERE pd\.language_id.*)/', $sql, $sql_crutch_matches);
		if (isset($sql_crutch_matches[2])) {
		$sql = $sql_crutch_matches[1] . " LEFT JOIN " . DB_PREFIX . "v_to_category v2c ON (v.view_id = v2c.view_id)" . $sql_crutch_matches[2];
		} else {
			$data['filter_category'] = null;
			}
		}
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND vd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND v.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "v2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND v2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND v2c.category_id IS NULL";
				}
			}
		}
	
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND v.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (!empty($data['filter_price'])) {
			$sql .= " AND v.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND v.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND v.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND v.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND v.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND v.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND v.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND v.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$sql .= " GROUP BY v.view_id";

		$sort_data = array(
			'vd.name',
			'v.model',
			'v.price',
			'v.quantity',
			'v.status',
			'v.noindex',
			'v.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY vd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getProductsByCategoryId($category_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.category_id = '" . (int)$category_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	//Products from 1c
	public function getProductDescriptions($product_id) {
		$product_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'product_id'	   => $result['product_id'],
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'	       => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $product_description_data;
	}


	//Offer
	public function getOfferDescriptions($product_id) {
		$product_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "offer_description WHERE offer_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'product_id'	   => $result['offer_id'],
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'	       => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $product_description_data;
	}

	//View
	public function getViewDescriptions($product_id) {
		$product_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "view_description WHERE view_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_description_data[$result['language_id']] = array(
				'product_id'	   => $result['view_id'],
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_title'       => $result['meta_title'],
				'meta_h1'	       => $result['meta_h1'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $product_description_data;
	}

	public function getProductCategories($product_id) {
		$product_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_category_data[] = $result['category_id'];
		}

		return $product_category_data;
	}
	
	public function getProductMainCategoryId($product_id) {
		$query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "' AND main_category = '1' LIMIT 1");
		
		return ($query->num_rows ? (int)$query->row['category_id'] : 0);
	}

	public function getProductFilters($product_id) {
		$product_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_filter_data[] = $result['filter_id'];
		}

		return $product_filter_data;
	}

	public function getProductAttributes($product_id) {
		$product_attribute_data = array();

		$product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' GROUP BY attribute_id");

		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_description_data = array();

			$product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int)$product_id . "' AND attribute_id = '" . (int)$product_attribute['attribute_id'] . "'");

			foreach ($product_attribute_description_query->rows as $product_attribute_description) {
				$product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
			}

			$product_attribute_data[] = array(
				'attribute_id'                  => $product_attribute['attribute_id'],
				'product_attribute_description' => $product_attribute_description_data
			);
		}

		return $product_attribute_data;
	}

	public function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		foreach ($product_option_query->rows as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' ORDER BY ov.sort_order ASC");

			foreach ($product_option_value_query->rows as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'points'                  => $product_option_value['points'],
					'points_prefix'           => $product_option_value['points_prefix'],
					'weight'                  => $product_option_value['weight'],
					'weight_prefix'           => $product_option_value['weight_prefix']
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => $product_option['value'],
				'required'             => $product_option['required']
			);
		}

		return $product_option_data;
	}

	public function getProductOptionValue($product_id, $product_option_value_id) {
		$query = $this->db->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getProductImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductAditionalImages($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image_aditional WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getProductDiscounts($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}

	public function getProductSpecials($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int)$product_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getProductRewards($product_id) {
		$product_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $product_reward_data;
	}

	public function getProductDownloads($product_id) {
		$product_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_download_data[] = $result['download_id'];
		}

		return $product_download_data;
	}

	public function getProductStores($product_id) {
		$product_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_store_data[] = $result['store_id'];
		}

		return $product_store_data;
	}
	
	public function getProductSeoUrls($product_id) {
		$product_seo_url_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'product_id=" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
		}

		return $product_seo_url_data;
	}
	
	public function getProductLayouts($product_id) {
		$product_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $product_layout_data;
	}

	public function getProductRelated($product_id) {
		$product_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int)$product_id . "'");

		foreach ($query->rows as $result) {
			$product_related_data[] = $result['related_id'];
		}

		return $product_related_data;
	}
	
	public function getArticleRelated($product_id) {
		$article_related_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related_article WHERE product_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$article_related_data[] = $result['article_id'];
		}
		
		return $article_related_data;
	}

	//Data for display products linking with offer
	public function getProductsLinks($product_id) {
		$product_links_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "variants WHERE offer_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_links_data[] = $result['product_id'];
		}
		
		return $product_links_data;
	}

	//Data for display offers linking with view
	public function getProductsOfferLinks($product_id) {
		$product_links_data = array();
		
		$query = $this->db->query("SELECT DISTINCT offer_id FROM " . DB_PREFIX . "variants WHERE view_id = '" . (int)$product_id . "'");
		
		foreach ($query->rows as $result) {
			$product_links_data[] = $result['offer_id'];
		}
		
		return $product_links_data;
	}

	public function getRecurrings($product_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_recurring` WHERE product_id = '" . (int)$product_id . "'");

		return $query->rows;
	}

	//Product from 1c
	public function getTotalProducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
		}
		
		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND p2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND p2c.category_id IS NULL";
				}
			}
		}
		
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND p.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND p.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND p.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND p.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND p.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	//Offer
	public function getTotalProductsOffer($data = array()) {
		$sql = "SELECT COUNT(DISTINCT o.offer_id) AS total FROM " . DB_PREFIX . "offer o LEFT JOIN " . DB_PREFIX . "offer_description od ON (o.offer_id = od.offer_id)";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "offer_to_category o2c ON (o.offer_id = o2c.offer_id)";
		}
		
		$sql .= " WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND o.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "o2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND o2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND o2c.category_id IS NULL";
				}
			}
		}
		
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND o.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND o.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND o.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND o.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND o.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND o.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND o.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND o.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND o.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	//View
	public function getTotalProductsView($data = array()) {
		$sql = "SELECT COUNT(DISTINCT v.view_id) AS total FROM " . DB_PREFIX . "view v LEFT JOIN " . DB_PREFIX . "view_description vd ON (v.view_id = vd.view_id)";

		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "view_to_category v2c ON (v.view_id = v2c.view_id)";
		}
		
		$sql .= " WHERE vd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND vd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND v.model LIKE '%" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
			if (!empty($data['filter_category']) && !empty($data['filter_sub_category'])) {
				$implode_data = array();
				
				$this->load->model('catalog/category');
				
				$categories = $this->model_catalog_category->getCategoriesChildren($data['filter_category']);
				
				foreach ($categories as $category) {
					$implode_data[] = "v2c.category_id = '" . (int)$category['category_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				if ((int)$data['filter_category'] > 0) {
					$sql .= " AND v2c.category_id = '" . (int)$data['filter_category'] . "'";
				} else {
					$sql .= " AND v2c.category_id IS NULL";
				}
			}
		}
		
		if (isset($data['filter_manufacturer_id']) && !is_null($data['filter_manufacturer_id'])) {
			$sql .= " AND v.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND v.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_price_min']) && !is_null($data['filter_price_min'])) {
			$sql .= " AND v.price >= '" . (float)$data['filter_price_min'] . "'";
		}
		
		if (isset($data['filter_price_max']) && !is_null($data['filter_price_max'])) {
			$sql .= " AND v.price <= '" . (float)$data['filter_price_max'] . "'";
		}

		if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
			$sql .= " AND v.quantity = '" . (int)$data['filter_quantity'] . "'";
		}
		
		if (isset($data['filter_quantity_min']) && !is_null($data['filter_quantity_min'])) {
			$sql .= " AND v.quantity >= '" . (int)$data['filter_quantity_min'] . "'";
		}
		
		if (isset($data['filter_quantity_max']) && !is_null($data['filter_quantity_max'])) {
			$sql .= " AND v.quantity <= '" . (int)$data['filter_quantity_max'] . "'";
		}

		if (isset($data['filter_status']) && $data['filter_status'] !== '') {
			$sql .= " AND v.status = '" . (int)$data['filter_status'] . "'";
		}
		
		if (isset($data['filter_noindex']) && $data['filter_noindex'] !== '') {
			$sql .= " AND v.noindex = '" . (int)$data['filter_noindex'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalProductsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByProfileId($recurring_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_recurring WHERE recurring_id = '" . (int)$recurring_id . "'");

		return $query->row['total'];
	}

	public function getTotalProductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

	public function addFilterForProduct($data) {

		foreach($data['selected'] as $key => $value) {

			$query = $this->db->query("SELECT * FROM ". DB_PREFIX . "product_filter WHERE product_id='". $value ."' AND filter_id='". $data['filter'] ."'");

			if(!$query->rows) $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id='". $value ."', filter_id='". $data['filter'] ."'");
			
		}


	}

	public function getProductBySku($sku) {

		/* $this->db->query("
			
			UPDATE " . DB_PREFIX . "product SET 

			quantity = '" . $product[2] . "', 
			price = '" . $product[3] . "'

			WHERE sku = '" . $product[0] . "'
		
		"); */

		$query =	$this->db->query("
			
		SELECT * FROM ckf_product 

		WHERE sku = '" . $sku . "'
	
	");
		

		return $query->row;
	}

	public function getProductExchange($products) {		

		$deleted_product_id = null;
		foreach ($products as $key => $values) {
			
			if ($deleted_product_id != $values['product_id']){

			
				$query = $this->db->query("
		
					SELECT * FROM ". DB_PREFIX ."product_location 
					WHERE product_id = '" . $values['product_id'] . "'
				
				");

				$deleted_product_id = $values['product_id'];
			}			

			if ($query) {

				$this->db->query("
				DELETE FROM ". DB_PREFIX ."product_location 
				WHERE product_id = '" .  $values['product_id'] . "'
				");	

				$this->db->query("
				INSERT INTO ". DB_PREFIX ."product_location SET product_id = '". $values['product_id'] ."', 
																location_id = '". $values['location_id'] ."',
																quantity = '". $values['quantity'] ."',
																price = '". $values['price'] ."'
				");
			} else {				

				$this->db->query("
				INSERT INTO ". DB_PREFIX ."product_location SET product_id = '". $values['product_id'] ."', 
																location_id = '". $values['location_id'] ."',
																quantity = '". $values['quantity'] ."',
																price = '". $values['price'] ."'
				");				
			}
			$query = null;
		}
	}

	public function getProductLocationsData($product_id) {

		$query = $this->db->query("SELECT plp.price, p2w.location_id, p2w.quantity, p2w.stock_status_id FROM ". DB_PREFIX ."product_location_price plp 
								   LEFT JOIN ". DB_PREFIX ."product_to_warehouse p2w ON plp.product_id = p2w.product_id and plp.location_id = p2w.location_id
								   WHERE plp.product_id = '". $product_id ."'");

		return $query->rows;
	}
}
