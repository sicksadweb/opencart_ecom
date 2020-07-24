<?php

/* catalog/product_list.twig */
class __TwigTemplate_2046960dc646543675cad8d849c247f54e2bb6a70cc6b69b8f9e69599811ce1d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo (isset($context["header"]) ? $context["header"] : null);
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_filter"]) ? $context["button_filter"] : null);
        echo "\" onclick=\"\$('#filter-product').toggleClass('hidden-sm hidden-xs');\" class=\"btn btn-default hidden-md hidden-lg\"><i class=\"fa fa-filter\"></i></button>
        <a href=\"";
        // line 7
        echo (isset($context["add"]) ? $context["add"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_add"]) ? $context["button_add"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a>
        <button type=\"submit\" form=\"form-product\" formaction=\"";
        // line 8
        echo (isset($context["copy"]) ? $context["copy"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_copy"]) ? $context["button_copy"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-copy\"></i></button>
        <button type=\"submit\" form=\"form-product\" formaction=\"";
        // line 9
        echo (isset($context["enabled"]) ? $context["enabled"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_enable"]) ? $context["button_enable"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-play\"></i></button>
\t\t<button type=\"submit\" form=\"form-product\" formaction=\"";
        // line 10
        echo (isset($context["disabled"]) ? $context["disabled"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_disable"]) ? $context["button_disable"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-pause\"></i></button>
\t\t<button type=\"button\" form=\"form-product\" formaction=\"";
        // line 11
        echo (isset($context["delete"]) ? $context["delete"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_delete"]) ? $context["button_delete"] : null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo (isset($context["text_confirm"]) ? $context["text_confirm"] : null);
        echo "') ? \$('#form-product').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
      <h1>";
        // line 13
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 16
            echo "        <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">";
        // line 21
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 22
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 26
        echo "    ";
        if ((isset($context["success"]) ? $context["success"] : null)) {
            // line 27
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo (isset($context["success"]) ? $context["success"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 31
        echo "    <div class=\"row\">
      <div id=\"filter-product\" class=\"col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs\">
        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><i class=\"fa fa-filter\"></i> ";
        // line 35
        echo (isset($context["text_filter"]) ? $context["text_filter"] : null);
        echo "</h3>
          </div>
          <div class=\"panel-body\">
            <div class=\"form-group\">
              <label class=\"control-label\" for=\"input-name\">";
        // line 39
        echo (isset($context["entry_name"]) ? $context["entry_name"] : null);
        echo "</label>
\t\t\t  <div class=\"input-group\">
              <input type=\"text\" name=\"filter_name\" value=\"";
        // line 41
        echo (isset($context["filter_name"]) ? $context["filter_name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_name"]) ? $context["entry_name"] : null);
        echo "\" id=\"input-name\" class=\"form-control\" />
\t\t\t  <div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-name\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
\t\t\t</div>
\t\t\t</div>
\t\t\t</div>
            <div class=\"form-group\">
              <label class=\"control-label\" for=\"input-model\">";
        // line 48
        echo (isset($context["entry_model"]) ? $context["entry_model"] : null);
        echo "</label>
\t\t\t  <div class=\"input-group\">
              <input type=\"text\" name=\"filter_model\" value=\"";
        // line 50
        echo (isset($context["filter_model"]) ? $context["filter_model"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_model"]) ? $context["entry_model"] : null);
        echo "\" id=\"input-model\" class=\"form-control\" />
            <div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-model\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                  </div>
\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t<div class=\"form-group\">
                 <label class=\"control-label\" for=\"input-category-name\">";
        // line 57
        echo (isset($context["entry_category"]) ? $context["entry_category"] : null);
        echo "</label> <label class=\"control-label pull-right\" for=\"input-sub-category\">";
        echo (isset($context["entry_sub_category"]) ? $context["entry_sub_category"] : null);
        echo " <input type=\"checkbox\" class=\"checkbox-inline\" name=\"filter_sub_category\" id=\"input-sub-category\" class=\"form-control\"";
        echo (isset($context["filter_sub_category"]) ? $context["filter_sub_category"] : null);
        echo "    ";
        if ((isset($context["filter_sub_category"]) ? $context["filter_sub_category"] : null)) {
            echo " checked=\"checked\" ";
        }
        echo " /></label>
                <div class=\"clearfix\"></div>
\t\t\t\t<div class=\"input-group\">
                  <input type=\"text\" name=\"filter_category_name\" value=\"";
        // line 60
        echo (isset($context["filter_category_name"]) ? $context["filter_category_name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_category"]) ? $context["entry_category"] : null);
        echo "\" id=\"input-category-name\" class=\"form-control\" />
                  <div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-category-name\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                  </div>
                </div>
                <input type=\"hidden\" name=\"filter_category\" value=\"";
        // line 65
        echo (isset($context["filter_category"]) ? $context["filter_category"] : null);
        echo "\" id=\"input-category\" class=\"form-control\" />
              </div>
\t\t\t  
\t\t\t<div class=\"form-group\">
              <label class=\"control-label\" for=\"input-manufacturer-name\">";
        // line 69
        echo (isset($context["entry_manufacturer"]) ? $context["entry_manufacturer"] : null);
        echo "</label>
\t\t\t  <div class=\"input-group\">
\t\t\t\t<input type=\"text\" name=\"filter_manufacturer_name\" value=\"";
        // line 71
        echo (isset($context["filter_manufacturer_name"]) ? $context["filter_manufacturer_name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_manufacturer"]) ? $context["entry_manufacturer"] : null);
        echo "\" id=\"input-manufacturer\" class=\"form-control\" />
\t\t\t\t
\t\t\t\t<div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-manufacturer\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
\t\t\t\t</div>
\t\t\t\t  <input type=\"hidden\" name=\"filter_manufacturer_id\" value=\"";
        // line 76
        echo (isset($context["filter_manufacturer_id"]) ? $context["filter_manufacturer_id"] : null);
        echo "\" id=\"input-manufacturer-id\" class=\"form-control\" />
\t\t\t\t</div>
\t\t\t</div>
\t\t\t\t
\t\t\t<!--
\t\t\t<div class=\"form-group\">
                <label class=\"control-label\" for=\"input-manufacturer-name\">";
        // line 82
        echo (isset($context["entry_manufacturer"]) ? $context["entry_manufacturer"] : null);
        echo "</label>
                <div class=\"input-group\">
                  <input type=\"text\" name=\"filter_manufacturer_name\" value=\"";
        // line 84
        echo (isset($context["filter_manufacturer_name"]) ? $context["filter_manufacturer_name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_manufacturer"]) ? $context["entry_manufacturer"] : null);
        echo "\" id=\"input-manufacturer-name\" class=\"form-control\" />
                  <div class=\"input-group-btn\">
                    <button type=\"button\" id=\"button-clear-input-manufacturer-name\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                  </div>
                </div>
                <input type=\"hidden\" name=\"filter_manufacturer\" value=\"";
        // line 89
        echo (isset($context["filter_manufacturer_name"]) ? $context["filter_manufacturer_name"] : null);
        echo "\" id=\"input-manufacturer\" class=\"form-control\" />
              </div>
\t\t\t  -->
\t\t\t<div class=\"form-group\">
                <label class=\"control-label\" for=\"input-price\">";
        // line 93
        echo (isset($context["entry_price"]) ? $context["entry_price"] : null);
        echo "</label>
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"filter_price_min\" value=\"";
        // line 97
        echo (isset($context["filter_price_min"]) ? $context["filter_price_min"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_min"]) ? $context["entry_min"] : null);
        echo "\" id=\"input-price-min\" class=\"form-control\" />
                      <div class=\"input-group-btn\">
                        <button type=\"button\" id=\"button-clear-input-price-min\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class=\"col-sm-6 pull-right\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"filter_price_max\" value=\"";
        // line 105
        echo (isset($context["filter_price_max"]) ? $context["filter_price_max"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_max"]) ? $context["entry_max"] : null);
        echo "\" id=\"input-price-max\" class=\"form-control\" />
                      <div class=\"input-group-btn\">
                        <button type=\"button\" id=\"button-clear-input-price-max\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
\t\t\t</div>
\t\t\t<div class=\"form-group\">
                <label class=\"control-label\" for=\"input-quantity\">";
        // line 114
        echo (isset($context["entry_quantity"]) ? $context["entry_quantity"] : null);
        echo "</label>
                <div class=\"row\">
                  <div class=\"col-sm-6\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"filter_quantity_min\" value=\"";
        // line 118
        echo (isset($context["filter_quantity_min"]) ? $context["filter_quantity_min"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_min"]) ? $context["entry_min"] : null);
        echo "\" id=\"input-quantity-min\" class=\"form-control\" />
                      <div class=\"input-group-btn\">
                        <button type=\"button\" id=\"button-clear-input-quantity-min\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class=\"col-sm-6 pull-right\">
                    <div class=\"input-group\">
                      <input type=\"text\" name=\"filter_quantity_max\" value=\"";
        // line 126
        echo (isset($context["filter_quantity_max"]) ? $context["filter_quantity_max"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_max"]) ? $context["entry_max"] : null);
        echo "\" id=\"input-quantity-max\" class=\"form-control\" />
                      <div class=\"input-group-btn\">
                        <button type=\"button\" id=\"button-clear-input-quantity-max\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
\t\t\t</div>
            <div class=\"form-group\">
              <label class=\"control-label\" for=\"input-status\">";
        // line 135
        echo (isset($context["entry_status"]) ? $context["entry_status"] : null);
        echo "</label>
              <select name=\"filter_status\" id=\"input-status\" class=\"form-control\">
                <option value=\"\"></option>
                
                
                
                  
                

                  ";
        // line 144
        if (((isset($context["filter_status"]) ? $context["filter_status"] : null) == "1")) {
            // line 145
            echo "
                
                
                  
                
                
                <option value=\"1\" selected=\"selected\">";
            // line 151
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                
                
                
                  
                

                  ";
        } else {
            // line 159
            echo "
                
                
                  
                
                
                <option value=\"1\">";
            // line 165
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                
                
                
                  
                

                  ";
        }
        // line 173
        echo "                  ";
        if (((isset($context["filter_status"]) ? $context["filter_status"] : null) == "0")) {
            // line 174
            echo "
                
                
                  
                
                
                <option value=\"0\" selected=\"selected\">";
            // line 180
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                
                
                
                  
                

                  ";
        } else {
            // line 188
            echo "
                
                
                  
                
                
                <option value=\"0\">";
            // line 194
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                
                
                
                  
                

                  ";
        }
        // line 202
        echo "

              
              
                
              
              
              </select>
            </div>
\t\t\t<div class=\"form-group\">
              <label class=\"control-label\" for=\"input-noindex\">";
        // line 212
        echo (isset($context["entry_noindex"]) ? $context["entry_noindex"] : null);
        echo "</label>
              <select name=\"filter_noindex\" id=\"input-noindex\" class=\"form-control\">
                <option value=\"\"></option>
                  ";
        // line 215
        if (((isset($context["filter_noindex"]) ? $context["filter_noindex"] : null) == "1")) {
            // line 216
            echo "                <option value=\"1\" selected=\"selected\">";
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                  ";
        } else {
            // line 218
            echo "                <option value=\"1\">";
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                  ";
        }
        // line 220
        echo "                  ";
        if (((isset($context["filter_noindex"]) ? $context["filter_noindex"] : null) == "0")) {
            // line 221
            echo "                <option value=\"0\" selected=\"selected\">";
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                  ";
        } else {
            // line 223
            echo "                <option value=\"0\">";
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                  ";
        }
        // line 225
        echo "              </select>
\t\t\t</div>
            <div class=\"form-group text-right\">
              <button type=\"button\" id=\"button-filter\" class=\"btn btn-default\"><i class=\"fa fa-filter\"></i> ";
        // line 228
        echo (isset($context["button_filter"]) ? $context["button_filter"] : null);
        echo "</button>
\t\t\t  <button type=\"button\" id=\"button-clear-filter\" class=\"btn btn-default\"><i class=\"fa fa-times\"></i><span class=\"hidden-sm\"> ";
        // line 229
        echo (isset($context["button_clear"]) ? $context["button_clear"] : null);
        echo "</span></button>
            </div>
          </div>
        </div>
      </div>
      <div class=\"col-md-9 col-md-pull-3 col-sm-12\">
        <div class=\"panel panel-default\">
          <div class=\"panel-heading\">
            <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 237
        echo (isset($context["text_list"]) ? $context["text_list"] : null);
        echo "</h3>
          </div>
          <div class=\"panel-body\">
            <form action=\"";
        // line 240
        echo (isset($context["delete"]) ? $context["delete"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-product\">
              <div class=\"table-responsive\">
                <table class=\"table table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                      <td class=\"text-center\">";
        // line 246
        echo (isset($context["column_image"]) ? $context["column_image"] : null);
        echo "</td>
                      <td class=\"text-left\">";
        // line 247
        if (((isset($context["sort"]) ? $context["sort"] : null) == "pd.name")) {
            echo " <a href=\"";
            echo (isset($context["sort_name"]) ? $context["sort_name"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_name"]) ? $context["column_name"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_name"]) ? $context["sort_name"] : null);
            echo "\">";
            echo (isset($context["column_name"]) ? $context["column_name"] : null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-left\">";
        // line 248
        if (((isset($context["sort"]) ? $context["sort"] : null) == "p.model")) {
            echo " <a href=\"";
            echo (isset($context["sort_model"]) ? $context["sort_model"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_model"]) ? $context["column_model"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_model"]) ? $context["sort_model"] : null);
            echo "\">";
            echo (isset($context["column_model"]) ? $context["column_model"] : null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-right\">";
        // line 249
        if (((isset($context["sort"]) ? $context["sort"] : null) == "p.price")) {
            echo " <a href=\"";
            echo (isset($context["sort_price"]) ? $context["sort_price"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_price"]) ? $context["column_price"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_price"]) ? $context["sort_price"] : null);
            echo "\">";
            echo (isset($context["column_price"]) ? $context["column_price"] : null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-right\">";
        // line 250
        if (((isset($context["sort"]) ? $context["sort"] : null) == "p.quantity")) {
            echo " <a href=\"";
            echo (isset($context["sort_quantity"]) ? $context["sort_quantity"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_quantity"]) ? $context["column_quantity"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_quantity"]) ? $context["sort_quantity"] : null);
            echo "\">";
            echo (isset($context["column_quantity"]) ? $context["column_quantity"] : null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-left\">";
        // line 251
        if (((isset($context["sort"]) ? $context["sort"] : null) == "p.status")) {
            echo " <a href=\"";
            echo (isset($context["sort_status"]) ? $context["sort_status"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_status"]) ? $context["column_status"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_status"]) ? $context["sort_status"] : null);
            echo "\">";
            echo (isset($context["column_status"]) ? $context["column_status"] : null);
            echo "</a> ";
        }
        echo "</td>
                      <td class=\"text-left\">";
        // line 252
        if (((isset($context["sort"]) ? $context["sort"] : null) == "p.noindex")) {
            echo " <a href=\"";
            echo (isset($context["sort_noindex"]) ? $context["sort_noindex"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_noindex"]) ? $context["column_noindex"] : null);
            echo "</a> ";
        } else {
            echo " <a href=\"";
            echo (isset($context["sort_noindex"]) ? $context["sort_noindex"] : null);
            echo "\">";
            echo (isset($context["column_noindex"]) ? $context["column_noindex"] : null);
            echo "</a> ";
        }
        echo "</td>
\t\t\t\t\t  <td class=\"text-right\">";
        // line 253
        echo (isset($context["column_action"]) ? $context["column_action"] : null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>
                  
                  ";
        // line 258
        if ((isset($context["products"]) ? $context["products"] : null)) {
            // line 259
            echo "                  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["products"]) ? $context["products"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 260
                echo "                  <tr>
                    <td class=\"text-center\">";
                // line 261
                if (twig_in_filter($this->getAttribute($context["product"], "product_id", array()), (isset($context["selected"]) ? $context["selected"] : null))) {
                    // line 262
                    echo "                      <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo $this->getAttribute($context["product"], "product_id", array());
                    echo "\" checked=\"checked\" />
                      ";
                } else {
                    // line 264
                    echo "                      <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo $this->getAttribute($context["product"], "product_id", array());
                    echo "\" />
                      ";
                }
                // line 265
                echo "</td>
                    <td class=\"text-center\">";
                // line 266
                if ($this->getAttribute($context["product"], "image", array())) {
                    echo " <img src=\"";
                    echo $this->getAttribute($context["product"], "image", array());
                    echo "\" alt=\"";
                    echo $this->getAttribute($context["product"], "name", array());
                    echo "\" class=\"img-thumbnail\" /> ";
                } else {
                    echo " <span class=\"img-thumbnail list\"><i class=\"fa fa-camera fa-2x\"></i></span> ";
                }
                echo "</td>
                    <td class=\"text-left\">";
                // line 267
                echo $this->getAttribute($context["product"], "name", array());
                echo "</td>
                    <td class=\"text-left\">";
                // line 268
                echo $this->getAttribute($context["product"], "model", array());
                echo "</td>
                    <td class=\"text-right\">";
                // line 269
                if ($this->getAttribute($context["product"], "special", array())) {
                    echo " <span style=\"text-decoration: line-through;\">";
                    echo $this->getAttribute($context["product"], "price", array());
                    echo "</span><br/>
                      <div class=\"text-danger\">";
                    // line 270
                    echo $this->getAttribute($context["product"], "special", array());
                    echo "</div>
                      ";
                } else {
                    // line 272
                    echo "                      ";
                    echo $this->getAttribute($context["product"], "price", array());
                    echo "
                      ";
                }
                // line 273
                echo "</td>
                    <td class=\"text-right\">";
                // line 274
                if (($this->getAttribute($context["product"], "quantity", array()) <= 0)) {
                    echo " <span class=\"label label-warning\">";
                    echo $this->getAttribute($context["product"], "quantity", array());
                    echo "</span> ";
                } elseif (($this->getAttribute($context["product"], "quantity", array()) <= 5)) {
                    echo " <span class=\"label label-danger\">";
                    echo $this->getAttribute($context["product"], "quantity", array());
                    echo "</span> ";
                } else {
                    echo " <span class=\"label label-success\">";
                    echo $this->getAttribute($context["product"], "quantity", array());
                    echo "</span> ";
                }
                echo "</td>
                    <td class=\"text-left\">";
                // line 275
                echo $this->getAttribute($context["product"], "status", array());
                echo "</td>
\t\t\t\t\t<td class=\"text-left\">";
                // line 276
                echo $this->getAttribute($context["product"], "noindex", array());
                echo "</td>
                    <td class=\"text-right\">
\t\t\t\t\t\t<a target=\"_blank\" href=\"";
                // line 278
                echo $this->getAttribute($context["product"], "href_shop", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_shop"]) ? $context["button_shop"] : null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-eye\"></i></a>
\t\t\t\t\t\t<a href=\"";
                // line 279
                echo $this->getAttribute($context["product"], "edit", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
\t\t\t\t\t</td>
                  </tr>
                  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 283
            echo "                  ";
        } else {
            // line 284
            echo "                  <tr>
                    <td class=\"text-center\" colspan=\"9\">";
            // line 285
            echo (isset($context["text_no_results"]) ? $context["text_no_results"] : null);
            echo "</td>
                  </tr>
                  ";
        }
        // line 288
        echo "                    </tbody>
                  
                </table>
              </div>
            </form>
            <div class=\"row\">
              <div class=\"col-sm-6 text-left\">";
        // line 294
        echo (isset($context["pagination"]) ? $context["pagination"] : null);
        echo "</div>
              <div class=\"col-sm-6 text-right\">";
        // line 295
        echo (isset($context["results"]) ? $context["results"] : null);
        echo "</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
\$('#button-filter').on('click', function() {
\tvar url = '';

\tvar filter_name = \$('input[name=\\'filter_name\\']').val();

\tif (filter_name) {
\t\turl += '&filter_name=' + encodeURIComponent(filter_name);
\t}

\tvar filter_model = \$('input[name=\\'filter_model\\']').val();

\tif (filter_model) {
\t\turl += '&filter_model=' + encodeURIComponent(filter_model);
\t}

\tvar filter_price_min = \$('input[name=\\'filter_price_min\\']').val();
\tif (filter_price_min) {
\t\turl += '&filter_price_min=' + encodeURIComponent(filter_price_min);
\t}
\t
\tvar filter_price_max = \$('input[name=\\'filter_price_max\\']').val();
\tif (filter_price_max) {
\t\turl += '&filter_price_max=' + encodeURIComponent(filter_price_max);
\t}

\tvar filter_quantity_min = \$('input[name=\\'filter_quantity_min\\']').val();
\tif (filter_quantity_min) {
\t\turl += '&filter_quantity_min=' + encodeURIComponent(filter_quantity_min);
\t}
\t
\tvar filter_quantity_max = \$('input[name=\\'filter_quantity_max\\']').val();
\tif (filter_quantity_max) {
\t\turl += '&filter_quantity_max=' + encodeURIComponent(filter_quantity_max);
\t}

\tvar filter_status = \$('select[name=\\'filter_status\\']').val();

\tif (filter_status !== '') {
\t\turl += '&filter_status=' + encodeURIComponent(filter_status);
\t}
\t
\tvar filter_category = \$('input[name=\\'filter_category\\']').val();
\tif (filter_category) {
\t\turl += '&filter_category=' + encodeURIComponent(filter_category);
\t}
\t
\tvar filter_sub_category = \$('input[name=\\'filter_sub_category\\']');
\tif (filter_sub_category.prop('checked')) {
\t\turl += '&filter_sub_category';
\t}
\t
\tvar filter_manufacturer_id = \$('input[name=\\'filter_manufacturer_id\\']').val();
\tif (filter_manufacturer_id) {
\t\turl += '&filter_manufacturer_id=' + encodeURIComponent(filter_manufacturer_id);
\t}
\t
\tvar filter_noindex = \$('select[name=\\'filter_noindex\\']').val();
\tif (filter_noindex !== '') {
\t\turl += '&filter_noindex=' + encodeURIComponent(filter_noindex);
\t}

\tlocation = 'index.php?route=catalog/product&user_token=";
        // line 364
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "' + url;
});
\$('#button-clear-filter').on('click', function() {
\tlocation = 'index.php?route=catalog/product&user_token=";
        // line 367
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "';
});
//--></script> 
  <script type=\"text/javascript\"><!--
// IE and Edge fix!
\$('button[form=\\'form-product\\']').on('click', function(e) {
\t\$('#form-product').attr('action', \$(this).attr('formaction'));
});
  
\$('input[name=\\'filter_name\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 379
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['product_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'filter_name\\']').val(item['label']);
\t}
});
\$('#button-clear-input-name').on('click',function(){
\t\$('input[name=\\'filter_name\\']').val('');
\t\$('#button-filter').trigger('click');
});

\$('input[name=\\'filter_model\\']').autocomplete({
\t'source': function(request, response) {
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/product/autocomplete&user_token=";
        // line 403
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&filter_model=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['model'],
\t\t\t\t\t\tvalue: item['product_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'filter_model\\']').val(item['label']);
\t}
});
\$('#button-clear-input-model').on('click',function(){
\t\$('input[name=\\'filter_model\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('input[name=\\'filter_category_name\\']').autocomplete({
\t'source': function(request, response) {
\t\tif (\$('input[name=\\'filter_category_name\\']').val().length==0) {
\t\t\t\$('input[name=\\'filter_category\\']').val(null);
\t\t}
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/category/autocomplete&user_token=";
        // line 429
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tif (json.length>0) {
\t\t\t\t\tjson.unshift({'category_id':null,'name':'";
        // line 433
        echo (isset($context["text_all"]) ? $context["text_all"] : null);
        echo "'},{'category_id':0,'name':'";
        echo (isset($context["text_none_category"]) ? $context["text_none_category"] : null);
        echo "'});
\t\t\t\t}
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['category_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\tif (item['label']!='";
        // line 445
        echo (isset($context["text_all"]) ? $context["text_all"] : null);
        echo "') {
\t\t\t\$('input[name=\\'filter_category_name\\']').val(item['label']);
\t\t} else {
\t\t\t\$('input[name=\\'filter_category_name\\']').val('');
\t\t}
\t\t\$('input[name=\\'filter_category\\']').val(item['value']);
\t}
});
\$('#button-clear-input-category-name').on('click',function(){
\t\$('input[name=\\'filter_category_name\\']').val('');
\t\$('input[name=\\'filter_category\\']').val(null);
\t\$('#button-filter').trigger('click');
});

// Manufacturer
\$('input[name=\\'filter_manufacturer_name\\']').autocomplete({
\t'source': function(request, response) {
\t\tif (\$('input[name=\\'filter_manufacturer_name\\']').val().length==0) {
\t\t\t\$('input[name=\\'filter_manufacturer_id\\']').val(null);
\t\t}
\t\t\$.ajax({
\t\t\turl: 'index.php?route=catalog/manufacturer/autocomplete&user_token=";
        // line 466
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&filter_name=' +  encodeURIComponent(request),
\t\t\tdataType: 'json',
\t\t\tsuccess: function(json) {
\t\t\t\tif (json.length>0) {
\t\t\t\t\tjson.unshift({'manufacturer_id':null,'name':'";
        // line 470
        echo (isset($context["text_all"]) ? $context["text_all"] : null);
        echo "'},{'manufacturer_id':0,'name':'";
        echo (isset($context["text_none_manufacturer"]) ? $context["text_none_manufacturer"] : null);
        echo "'});
\t\t\t\t}
\t\t\t\tresponse(\$.map(json, function(item) {
\t\t\t\t\treturn {
\t\t\t\t\t\tlabel: item['name'],
\t\t\t\t\t\tvalue: item['manufacturer_id']
\t\t\t\t\t}
\t\t\t\t}));
\t\t\t}
\t\t});
\t},
\t'select': function(item) {
\t\t\$('input[name=\\'filter_manufacturer_name\\']').val(item['label']);
\t\t\$('input[name=\\'filter_manufacturer_id\\']').val(item['value']);
\t}
});

\$('#button-clear-input-manufacturer').on('click',function(){
\t\$('input[name=\\'filter_manufacturer_name\\']').val('');
\t\$('input[name=\\'filter_manufacturer_id\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('#button-clear-input-price-min').on('click',function(){
\t\$('input[name=\\'filter_price_min\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('#button-clear-input-price-max').on('click',function(){
\t\$('input[name=\\'filter_price_max\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('#button-clear-input-quantity-min').on('click',function(){
\t\$('input[name=\\'filter_quantity_min\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('#button-clear-input-quantity-max').on('click',function(){
\t\$('input[name=\\'filter_quantity_max\\']').val('');
\t\$('#button-filter').trigger('click');
});
\$('input[name=\\'filter_name\\'], input[name=\\'filter_model\\'], input[name=\\'filter_category_name\\'], input[name=\\'filter_manufacturer_id\\'], input[name=\\'filter_price_min\\'], input[name=\\'filter_price_max\\'], input[name=\\'filter_quantity_min\\'], input[name=\\'filter_quantity_max\\']').keypress(function (e) {
\tif (e.which == 13) {
\t\t\$('#button-filter').trigger('click');
\t\treturn false;
\t}
});
//--></script></div>
";
        // line 515
        echo (isset($context["footer"]) ? $context["footer"] : null);
        echo " ";
    }

    public function getTemplateName()
    {
        return "catalog/product_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  986 => 515,  936 => 470,  929 => 466,  905 => 445,  888 => 433,  881 => 429,  852 => 403,  825 => 379,  810 => 367,  804 => 364,  732 => 295,  728 => 294,  720 => 288,  714 => 285,  711 => 284,  708 => 283,  696 => 279,  690 => 278,  685 => 276,  681 => 275,  665 => 274,  662 => 273,  656 => 272,  651 => 270,  645 => 269,  641 => 268,  637 => 267,  625 => 266,  622 => 265,  616 => 264,  610 => 262,  608 => 261,  605 => 260,  600 => 259,  598 => 258,  590 => 253,  572 => 252,  554 => 251,  536 => 250,  518 => 249,  500 => 248,  482 => 247,  478 => 246,  469 => 240,  463 => 237,  452 => 229,  448 => 228,  443 => 225,  437 => 223,  431 => 221,  428 => 220,  422 => 218,  416 => 216,  414 => 215,  408 => 212,  396 => 202,  385 => 194,  377 => 188,  366 => 180,  358 => 174,  355 => 173,  344 => 165,  336 => 159,  325 => 151,  317 => 145,  315 => 144,  303 => 135,  289 => 126,  276 => 118,  269 => 114,  255 => 105,  242 => 97,  235 => 93,  228 => 89,  218 => 84,  213 => 82,  204 => 76,  194 => 71,  189 => 69,  182 => 65,  172 => 60,  158 => 57,  146 => 50,  141 => 48,  129 => 41,  124 => 39,  117 => 35,  111 => 31,  103 => 27,  100 => 26,  92 => 22,  90 => 21,  85 => 18,  74 => 16,  70 => 15,  65 => 13,  56 => 11,  50 => 10,  44 => 9,  38 => 8,  32 => 7,  28 => 6,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right">*/
/*         <button type="button" data-toggle="tooltip" title="{{ button_filter }}" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg"><i class="fa fa-filter"></i></button>*/
/*         <a href="{{ add }}" data-toggle="tooltip" title="{{ button_add }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>*/
/*         <button type="submit" form="form-product" formaction="{{ copy }}" data-toggle="tooltip" title="{{ button_copy }}" class="btn btn-default"><i class="fa fa-copy"></i></button>*/
/*         <button type="submit" form="form-product" formaction="{{ enabled }}" data-toggle="tooltip" title="{{ button_enable }}" class="btn btn-default"><i class="fa fa-play"></i></button>*/
/* 		<button type="submit" form="form-product" formaction="{{ disabled }}" data-toggle="tooltip" title="{{ button_disable }}" class="btn btn-default"><i class="fa fa-pause"></i></button>*/
/* 		<button type="button" form="form-product" formaction="{{ delete }}" data-toggle="tooltip" title="{{ button_delete }}" class="btn btn-danger" onclick="confirm('{{ text_confirm }}') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>*/
/*       </div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid">{% if error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     {% if success %}*/
/*     <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> {{ success }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="row">*/
/*       <div id="filter-product" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-heading">*/
/*             <h3 class="panel-title"><i class="fa fa-filter"></i> {{ text_filter }}</h3>*/
/*           </div>*/
/*           <div class="panel-body">*/
/*             <div class="form-group">*/
/*               <label class="control-label" for="input-name">{{ entry_name }}</label>*/
/* 			  <div class="input-group">*/
/*               <input type="text" name="filter_name" value="{{ filter_name }}" placeholder="{{ entry_name }}" id="input-name" class="form-control" />*/
/* 			  <div class="input-group-btn">*/
/*                     <button type="button" id="button-clear-input-name" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/* 			</div>*/
/* 			</div>*/
/* 			</div>*/
/*             <div class="form-group">*/
/*               <label class="control-label" for="input-model">{{ entry_model }}</label>*/
/* 			  <div class="input-group">*/
/*               <input type="text" name="filter_model" value="{{ filter_model }}" placeholder="{{ entry_model }}" id="input-model" class="form-control" />*/
/*             <div class="input-group-btn">*/
/*                     <button type="button" id="button-clear-input-model" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                   </div>*/
/* 				</div>*/
/* 				</div>*/
/* 			<div class="form-group">*/
/*                  <label class="control-label" for="input-category-name">{{ entry_category }}</label> <label class="control-label pull-right" for="input-sub-category">{{ entry_sub_category }} <input type="checkbox" class="checkbox-inline" name="filter_sub_category" id="input-sub-category" class="form-control"{{ filter_sub_category}}    {% if filter_sub_category %} checked="checked" {% endif %} /></label>*/
/*                 <div class="clearfix"></div>*/
/* 				<div class="input-group">*/
/*                   <input type="text" name="filter_category_name" value="{{ filter_category_name }}" placeholder="{{ entry_category }}" id="input-category-name" class="form-control" />*/
/*                   <div class="input-group-btn">*/
/*                     <button type="button" id="button-clear-input-category-name" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                   </div>*/
/*                 </div>*/
/*                 <input type="hidden" name="filter_category" value="{{ filter_category }}" id="input-category" class="form-control" />*/
/*               </div>*/
/* 			  */
/* 			<div class="form-group">*/
/*               <label class="control-label" for="input-manufacturer-name">{{ entry_manufacturer }}</label>*/
/* 			  <div class="input-group">*/
/* 				<input type="text" name="filter_manufacturer_name" value="{{ filter_manufacturer_name }}" placeholder="{{ entry_manufacturer }}" id="input-manufacturer" class="form-control" />*/
/* 				*/
/* 				<div class="input-group-btn">*/
/*                     <button type="button" id="button-clear-input-manufacturer" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/* 				</div>*/
/* 				  <input type="hidden" name="filter_manufacturer_id" value="{{ filter_manufacturer_id }}" id="input-manufacturer-id" class="form-control" />*/
/* 				</div>*/
/* 			</div>*/
/* 				*/
/* 			<!--*/
/* 			<div class="form-group">*/
/*                 <label class="control-label" for="input-manufacturer-name">{{ entry_manufacturer }}</label>*/
/*                 <div class="input-group">*/
/*                   <input type="text" name="filter_manufacturer_name" value="{{ filter_manufacturer_name }}" placeholder="{{ entry_manufacturer }}" id="input-manufacturer-name" class="form-control" />*/
/*                   <div class="input-group-btn">*/
/*                     <button type="button" id="button-clear-input-manufacturer-name" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                   </div>*/
/*                 </div>*/
/*                 <input type="hidden" name="filter_manufacturer" value="{{ filter_manufacturer_name }}" id="input-manufacturer" class="form-control" />*/
/*               </div>*/
/* 			  -->*/
/* 			<div class="form-group">*/
/*                 <label class="control-label" for="input-price">{{ entry_price }}</label>*/
/*                 <div class="row">*/
/*                   <div class="col-sm-6">*/
/*                     <div class="input-group">*/
/*                       <input type="text" name="filter_price_min" value="{{ filter_price_min }}" placeholder="{{ entry_min }}" id="input-price-min" class="form-control" />*/
/*                       <div class="input-group-btn">*/
/*                         <button type="button" id="button-clear-input-price-min" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                       </div>*/
/*                     </div>*/
/*                   </div>*/
/*                   <div class="col-sm-6 pull-right">*/
/*                     <div class="input-group">*/
/*                       <input type="text" name="filter_price_max" value="{{ filter_price_max }}" placeholder="{{ entry_max }}" id="input-price-max" class="form-control" />*/
/*                       <div class="input-group-btn">*/
/*                         <button type="button" id="button-clear-input-price-max" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                       </div>*/
/*                     </div>*/
/*                   </div>*/
/*                 </div>*/
/* 			</div>*/
/* 			<div class="form-group">*/
/*                 <label class="control-label" for="input-quantity">{{ entry_quantity }}</label>*/
/*                 <div class="row">*/
/*                   <div class="col-sm-6">*/
/*                     <div class="input-group">*/
/*                       <input type="text" name="filter_quantity_min" value="{{ filter_quantity_min }}" placeholder="{{ entry_min }}" id="input-quantity-min" class="form-control" />*/
/*                       <div class="input-group-btn">*/
/*                         <button type="button" id="button-clear-input-quantity-min" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                       </div>*/
/*                     </div>*/
/*                   </div>*/
/*                   <div class="col-sm-6 pull-right">*/
/*                     <div class="input-group">*/
/*                       <input type="text" name="filter_quantity_max" value="{{ filter_quantity_max }}" placeholder="{{ entry_max }}" id="input-quantity-max" class="form-control" />*/
/*                       <div class="input-group-btn">*/
/*                         <button type="button" id="button-clear-input-quantity-max" class="btn btn-default"><i class="fa fa-times"></i></button>*/
/*                       </div>*/
/*                     </div>*/
/*                   </div>*/
/*                 </div>*/
/* 			</div>*/
/*             <div class="form-group">*/
/*               <label class="control-label" for="input-status">{{ entry_status }}</label>*/
/*               <select name="filter_status" id="input-status" class="form-control">*/
/*                 <option value=""></option>*/
/*                 */
/*                 */
/*                 */
/*                   */
/*                 */
/* */
/*                   {% if filter_status == '1' %}*/
/* */
/*                 */
/*                 */
/*                   */
/*                 */
/*                 */
/*                 <option value="1" selected="selected">{{ text_enabled }}</option>*/
/*                 */
/*                 */
/*                 */
/*                   */
/*                 */
/* */
/*                   {% else %}*/
/* */
/*                 */
/*                 */
/*                   */
/*                 */
/*                 */
/*                 <option value="1">{{ text_enabled }}</option>*/
/*                 */
/*                 */
/*                 */
/*                   */
/*                 */
/* */
/*                   {% endif %}*/
/*                   {% if filter_status == '0' %}*/
/* */
/*                 */
/*                 */
/*                   */
/*                 */
/*                 */
/*                 <option value="0" selected="selected">{{ text_disabled }}</option>*/
/*                 */
/*                 */
/*                 */
/*                   */
/*                 */
/* */
/*                   {% else %}*/
/* */
/*                 */
/*                 */
/*                   */
/*                 */
/*                 */
/*                 <option value="0">{{ text_disabled }}</option>*/
/*                 */
/*                 */
/*                 */
/*                   */
/*                 */
/* */
/*                   {% endif %}*/
/* */
/* */
/*               */
/*               */
/*                 */
/*               */
/*               */
/*               </select>*/
/*             </div>*/
/* 			<div class="form-group">*/
/*               <label class="control-label" for="input-noindex">{{ entry_noindex }}</label>*/
/*               <select name="filter_noindex" id="input-noindex" class="form-control">*/
/*                 <option value=""></option>*/
/*                   {% if filter_noindex == '1' %}*/
/*                 <option value="1" selected="selected">{{ text_enabled }}</option>*/
/*                   {% else %}*/
/*                 <option value="1">{{ text_enabled }}</option>*/
/*                   {% endif %}*/
/*                   {% if filter_noindex == '0' %}*/
/*                 <option value="0" selected="selected">{{ text_disabled }}</option>*/
/*                   {% else %}*/
/*                 <option value="0">{{ text_disabled }}</option>*/
/*                   {% endif %}*/
/*               </select>*/
/* 			</div>*/
/*             <div class="form-group text-right">*/
/*               <button type="button" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i> {{ button_filter }}</button>*/
/* 			  <button type="button" id="button-clear-filter" class="btn btn-default"><i class="fa fa-times"></i><span class="hidden-sm"> {{ button_clear }}</span></button>*/
/*             </div>*/
/*           </div>*/
/*         </div>*/
/*       </div>*/
/*       <div class="col-md-9 col-md-pull-3 col-sm-12">*/
/*         <div class="panel panel-default">*/
/*           <div class="panel-heading">*/
/*             <h3 class="panel-title"><i class="fa fa-list"></i> {{ text_list }}</h3>*/
/*           </div>*/
/*           <div class="panel-body">*/
/*             <form action="{{ delete }}" method="post" enctype="multipart/form-data" id="form-product">*/
/*               <div class="table-responsive">*/
/*                 <table class="table table-bordered table-hover">*/
/*                   <thead>*/
/*                     <tr>*/
/*                       <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>*/
/*                       <td class="text-center">{{ column_image }}</td>*/
/*                       <td class="text-left">{% if sort == 'pd.name' %} <a href="{{ sort_name }}" class="{{ order|lower }}">{{ column_name }}</a> {% else %} <a href="{{ sort_name }}">{{ column_name }}</a> {% endif %}</td>*/
/*                       <td class="text-left">{% if sort == 'p.model' %} <a href="{{ sort_model }}" class="{{ order|lower }}">{{ column_model }}</a> {% else %} <a href="{{ sort_model }}">{{ column_model }}</a> {% endif %}</td>*/
/*                       <td class="text-right">{% if sort == 'p.price' %} <a href="{{ sort_price }}" class="{{ order|lower }}">{{ column_price }}</a> {% else %} <a href="{{ sort_price }}">{{ column_price }}</a> {% endif %}</td>*/
/*                       <td class="text-right">{% if sort == 'p.quantity' %} <a href="{{ sort_quantity }}" class="{{ order|lower }}">{{ column_quantity }}</a> {% else %} <a href="{{ sort_quantity }}">{{ column_quantity }}</a> {% endif %}</td>*/
/*                       <td class="text-left">{% if sort == 'p.status' %} <a href="{{ sort_status }}" class="{{ order|lower }}">{{ column_status }}</a> {% else %} <a href="{{ sort_status }}">{{ column_status }}</a> {% endif %}</td>*/
/*                       <td class="text-left">{% if sort == 'p.noindex' %} <a href="{{ sort_noindex }}" class="{{ order|lower }}">{{ column_noindex }}</a> {% else %} <a href="{{ sort_noindex }}">{{ column_noindex }}</a> {% endif %}</td>*/
/* 					  <td class="text-right">{{ column_action }}</td>*/
/*                     </tr>*/
/*                   </thead>*/
/*                   <tbody>*/
/*                   */
/*                   {% if products %}*/
/*                   {% for product in products %}*/
/*                   <tr>*/
/*                     <td class="text-center">{% if product.product_id in selected %}*/
/*                       <input type="checkbox" name="selected[]" value="{{ product.product_id }}" checked="checked" />*/
/*                       {% else %}*/
/*                       <input type="checkbox" name="selected[]" value="{{ product.product_id }}" />*/
/*                       {% endif %}</td>*/
/*                     <td class="text-center">{% if product.image %} <img src="{{ product.image }}" alt="{{ product.name }}" class="img-thumbnail" /> {% else %} <span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span> {% endif %}</td>*/
/*                     <td class="text-left">{{ product.name }}</td>*/
/*                     <td class="text-left">{{ product.model }}</td>*/
/*                     <td class="text-right">{% if product.special %} <span style="text-decoration: line-through;">{{ product.price }}</span><br/>*/
/*                       <div class="text-danger">{{ product.special }}</div>*/
/*                       {% else %}*/
/*                       {{ product.price }}*/
/*                       {% endif %}</td>*/
/*                     <td class="text-right">{% if product.quantity <= 0 %} <span class="label label-warning">{{ product.quantity }}</span> {% elseif product.quantity <= 5 %} <span class="label label-danger">{{ product.quantity }}</span> {% else %} <span class="label label-success">{{ product.quantity }}</span> {% endif %}</td>*/
/*                     <td class="text-left">{{ product.status }}</td>*/
/* 					<td class="text-left">{{ product.noindex }}</td>*/
/*                     <td class="text-right">*/
/* 						<a target="_blank" href="{{ product.href_shop }}" data-toggle="tooltip" title="{{ button_shop }}" class="btn btn-success"><i class="fa fa-eye"></i></a>*/
/* 						<a href="{{ product.edit }}" data-toggle="tooltip" title="{{ button_edit }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>*/
/* 					</td>*/
/*                   </tr>*/
/*                   {% endfor %}*/
/*                   {% else %}*/
/*                   <tr>*/
/*                     <td class="text-center" colspan="9">{{ text_no_results }}</td>*/
/*                   </tr>*/
/*                   {% endif %}*/
/*                     </tbody>*/
/*                   */
/*                 </table>*/
/*               </div>*/
/*             </form>*/
/*             <div class="row">*/
/*               <div class="col-sm-6 text-left">{{ pagination }}</div>*/
/*               <div class="col-sm-6 text-right">{{ results }}</div>*/
/*             </div>*/
/*           </div>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/*   <script type="text/javascript"><!--*/
/* $('#button-filter').on('click', function() {*/
/* 	var url = '';*/
/* */
/* 	var filter_name = $('input[name=\'filter_name\']').val();*/
/* */
/* 	if (filter_name) {*/
/* 		url += '&filter_name=' + encodeURIComponent(filter_name);*/
/* 	}*/
/* */
/* 	var filter_model = $('input[name=\'filter_model\']').val();*/
/* */
/* 	if (filter_model) {*/
/* 		url += '&filter_model=' + encodeURIComponent(filter_model);*/
/* 	}*/
/* */
/* 	var filter_price_min = $('input[name=\'filter_price_min\']').val();*/
/* 	if (filter_price_min) {*/
/* 		url += '&filter_price_min=' + encodeURIComponent(filter_price_min);*/
/* 	}*/
/* 	*/
/* 	var filter_price_max = $('input[name=\'filter_price_max\']').val();*/
/* 	if (filter_price_max) {*/
/* 		url += '&filter_price_max=' + encodeURIComponent(filter_price_max);*/
/* 	}*/
/* */
/* 	var filter_quantity_min = $('input[name=\'filter_quantity_min\']').val();*/
/* 	if (filter_quantity_min) {*/
/* 		url += '&filter_quantity_min=' + encodeURIComponent(filter_quantity_min);*/
/* 	}*/
/* 	*/
/* 	var filter_quantity_max = $('input[name=\'filter_quantity_max\']').val();*/
/* 	if (filter_quantity_max) {*/
/* 		url += '&filter_quantity_max=' + encodeURIComponent(filter_quantity_max);*/
/* 	}*/
/* */
/* 	var filter_status = $('select[name=\'filter_status\']').val();*/
/* */
/* 	if (filter_status !== '') {*/
/* 		url += '&filter_status=' + encodeURIComponent(filter_status);*/
/* 	}*/
/* 	*/
/* 	var filter_category = $('input[name=\'filter_category\']').val();*/
/* 	if (filter_category) {*/
/* 		url += '&filter_category=' + encodeURIComponent(filter_category);*/
/* 	}*/
/* 	*/
/* 	var filter_sub_category = $('input[name=\'filter_sub_category\']');*/
/* 	if (filter_sub_category.prop('checked')) {*/
/* 		url += '&filter_sub_category';*/
/* 	}*/
/* 	*/
/* 	var filter_manufacturer_id = $('input[name=\'filter_manufacturer_id\']').val();*/
/* 	if (filter_manufacturer_id) {*/
/* 		url += '&filter_manufacturer_id=' + encodeURIComponent(filter_manufacturer_id);*/
/* 	}*/
/* 	*/
/* 	var filter_noindex = $('select[name=\'filter_noindex\']').val();*/
/* 	if (filter_noindex !== '') {*/
/* 		url += '&filter_noindex=' + encodeURIComponent(filter_noindex);*/
/* 	}*/
/* */
/* 	location = 'index.php?route=catalog/product&user_token={{ user_token }}' + url;*/
/* });*/
/* $('#button-clear-filter').on('click', function() {*/
/* 	location = 'index.php?route=catalog/product&user_token={{ user_token }}';*/
/* });*/
/* //--></script> */
/*   <script type="text/javascript"><!--*/
/* // IE and Edge fix!*/
/* $('button[form=\'form-product\']').on('click', function(e) {*/
/* 	$('#form-product').attr('action', $(this).attr('formaction'));*/
/* });*/
/*   */
/* $('input[name=\'filter_name\']').autocomplete({*/
/* 	'source': function(request, response) {*/
/* 		$.ajax({*/
/* 			url: 'index.php?route=catalog/product/autocomplete&user_token={{ user_token }}&filter_name=' +  encodeURIComponent(request),*/
/* 			dataType: 'json',*/
/* 			success: function(json) {*/
/* 				response($.map(json, function(item) {*/
/* 					return {*/
/* 						label: item['name'],*/
/* 						value: item['product_id']*/
/* 					}*/
/* 				}));*/
/* 			}*/
/* 		});*/
/* 	},*/
/* 	'select': function(item) {*/
/* 		$('input[name=\'filter_name\']').val(item['label']);*/
/* 	}*/
/* });*/
/* $('#button-clear-input-name').on('click',function(){*/
/* 	$('input[name=\'filter_name\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* */
/* $('input[name=\'filter_model\']').autocomplete({*/
/* 	'source': function(request, response) {*/
/* 		$.ajax({*/
/* 			url: 'index.php?route=catalog/product/autocomplete&user_token={{ user_token }}&filter_model=' +  encodeURIComponent(request),*/
/* 			dataType: 'json',*/
/* 			success: function(json) {*/
/* 				response($.map(json, function(item) {*/
/* 					return {*/
/* 						label: item['model'],*/
/* 						value: item['product_id']*/
/* 					}*/
/* 				}));*/
/* 			}*/
/* 		});*/
/* 	},*/
/* 	'select': function(item) {*/
/* 		$('input[name=\'filter_model\']').val(item['label']);*/
/* 	}*/
/* });*/
/* $('#button-clear-input-model').on('click',function(){*/
/* 	$('input[name=\'filter_model\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('input[name=\'filter_category_name\']').autocomplete({*/
/* 	'source': function(request, response) {*/
/* 		if ($('input[name=\'filter_category_name\']').val().length==0) {*/
/* 			$('input[name=\'filter_category\']').val(null);*/
/* 		}*/
/* 		$.ajax({*/
/* 			url: 'index.php?route=catalog/category/autocomplete&user_token={{ user_token }}&filter_name=' +  encodeURIComponent(request),*/
/* 			dataType: 'json',*/
/* 			success: function(json) {*/
/* 				if (json.length>0) {*/
/* 					json.unshift({'category_id':null,'name':'{{ text_all }}'},{'category_id':0,'name':'{{ text_none_category }}'});*/
/* 				}*/
/* 				response($.map(json, function(item) {*/
/* 					return {*/
/* 						label: item['name'],*/
/* 						value: item['category_id']*/
/* 					}*/
/* 				}));*/
/* 			}*/
/* 		});*/
/* 	},*/
/* 	'select': function(item) {*/
/* 		if (item['label']!='{{ text_all }}') {*/
/* 			$('input[name=\'filter_category_name\']').val(item['label']);*/
/* 		} else {*/
/* 			$('input[name=\'filter_category_name\']').val('');*/
/* 		}*/
/* 		$('input[name=\'filter_category\']').val(item['value']);*/
/* 	}*/
/* });*/
/* $('#button-clear-input-category-name').on('click',function(){*/
/* 	$('input[name=\'filter_category_name\']').val('');*/
/* 	$('input[name=\'filter_category\']').val(null);*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* */
/* // Manufacturer*/
/* $('input[name=\'filter_manufacturer_name\']').autocomplete({*/
/* 	'source': function(request, response) {*/
/* 		if ($('input[name=\'filter_manufacturer_name\']').val().length==0) {*/
/* 			$('input[name=\'filter_manufacturer_id\']').val(null);*/
/* 		}*/
/* 		$.ajax({*/
/* 			url: 'index.php?route=catalog/manufacturer/autocomplete&user_token={{ user_token }}&filter_name=' +  encodeURIComponent(request),*/
/* 			dataType: 'json',*/
/* 			success: function(json) {*/
/* 				if (json.length>0) {*/
/* 					json.unshift({'manufacturer_id':null,'name':'{{ text_all }}'},{'manufacturer_id':0,'name':'{{ text_none_manufacturer }}'});*/
/* 				}*/
/* 				response($.map(json, function(item) {*/
/* 					return {*/
/* 						label: item['name'],*/
/* 						value: item['manufacturer_id']*/
/* 					}*/
/* 				}));*/
/* 			}*/
/* 		});*/
/* 	},*/
/* 	'select': function(item) {*/
/* 		$('input[name=\'filter_manufacturer_name\']').val(item['label']);*/
/* 		$('input[name=\'filter_manufacturer_id\']').val(item['value']);*/
/* 	}*/
/* });*/
/* */
/* $('#button-clear-input-manufacturer').on('click',function(){*/
/* 	$('input[name=\'filter_manufacturer_name\']').val('');*/
/* 	$('input[name=\'filter_manufacturer_id\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('#button-clear-input-price-min').on('click',function(){*/
/* 	$('input[name=\'filter_price_min\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('#button-clear-input-price-max').on('click',function(){*/
/* 	$('input[name=\'filter_price_max\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('#button-clear-input-quantity-min').on('click',function(){*/
/* 	$('input[name=\'filter_quantity_min\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('#button-clear-input-quantity-max').on('click',function(){*/
/* 	$('input[name=\'filter_quantity_max\']').val('');*/
/* 	$('#button-filter').trigger('click');*/
/* });*/
/* $('input[name=\'filter_name\'], input[name=\'filter_model\'], input[name=\'filter_category_name\'], input[name=\'filter_manufacturer_id\'], input[name=\'filter_price_min\'], input[name=\'filter_price_max\'], input[name=\'filter_quantity_min\'], input[name=\'filter_quantity_max\']').keypress(function (e) {*/
/* 	if (e.which == 13) {*/
/* 		$('#button-filter').trigger('click');*/
/* 		return false;*/
/* 	}*/
/* });*/
/* //--></script></div>*/
/* {{ footer }} */
