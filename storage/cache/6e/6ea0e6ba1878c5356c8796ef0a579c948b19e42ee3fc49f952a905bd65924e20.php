<?php

/* search/search.twig */
class __TwigTemplate_813677447b751ccc5cda21fed9eeb177ef12cf8599b168edbf85ea0bfc088319 extends Twig_Template
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
        echo "<form id=\"oc-search\" class=\"navbar-form\" role=\"search\">
  <div class=\"input-group\">
    <div class=\"input-group-btn\">
      <a class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"fa fa-search\"></i>
        <span class=\"caret\"></span>
      </a>
      <ul class=\"dropdown-menu dropdown-menu-left alerts-dropdown\">
        <li class=\"dropdown-header\">";
        // line 9
        echo (isset($context["text_search_options"]) ? $context["text_search_options"] : null);
        echo "</li>
        <li><a onclick=\"setOption('catalog', '";
        // line 10
        echo (isset($context["text_catalog_placeholder"]) ? $context["text_catalog_placeholder"] : null);
        echo "'); return false;\"><i class=\"fa fa-book\"></i><span>";
        echo (isset($context["text_catalog"]) ? $context["text_catalog"] : null);
        echo "</span></a></li>
        <li><a onclick=\"setOption('customers', '";
        // line 11
        echo (isset($context["text_customers_placeholder"]) ? $context["text_customers_placeholder"] : null);
        echo "'); return false;\"><i class=\"fa fa-group\"></i><span>";
        echo (isset($context["text_customers"]) ? $context["text_customers"] : null);
        echo "</span></a></li>
        <li><a onclick=\"setOption('orders', '";
        // line 12
        echo (isset($context["text_orders_placeholder"]) ? $context["text_orders_placeholder"] : null);
        echo "'); return false;\"><i class=\"fa fa-credit-card\"></i><span>";
        echo (isset($context["text_orders"]) ? $context["text_orders"] : null);
        echo "</span></a></li>
      </ul>
    </div>
    <input id=\"oc-search-input\" type=\"text\" class=\"form-control\" placeholder=\"";
        // line 15
        echo (isset($context["text_search_placeholder"]) ? $context["text_search_placeholder"] : null);
        echo "\" name=\"query\" autocomplete=\"off\" />
    <input id=\"oc-search-option\" type=\"hidden\" name=\"search-option\" value=\"catalog\" />
    <div id=\"loader-search\"><img src=\"view/image/loader-search.gif\" alt=\"\" /></div>
  </div>
</form>
<div id=\"oc-search-result\"></div>
<script type=\"text/javascript\">
    function setOption(option, text) {
        jQuery('#oc-search-option').val(option);
        jQuery('#oc-search-input').attr('placeholder', text);
    }

    jQuery('#oc-search-input').keyup(function(){
        var option = jQuery('#oc-search-option').val();
        var length = 3;

        if(option == 'orders') {
            length = 1;
        }

        if(this.value.length < length) {
            return false;
        }

        if(jQuery.support.leadingWhitespace == false) {
              return false;
        }

        jQuery('#loader-search').css('display', 'block');

        jQuery.ajax({
            type: 'get',
            url: 'index.php?route=search/search/search' + '&user_token=";
        // line 47
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "',\t\t
\t\t\tdata: jQuery('#oc-search').serialize(),
            dataType: 'json',
            success:function(json){
                jQuery('#oc-search-result').css('display', 'block');
                jQuery('#loader-search').css('display', 'none');

                if(json['error']) {
                    jQuery('#oc-search-result').html(json['error'])
                    return;
                }

                jQuery('#oc-search-result').html(json['result'])
            }
        });
    });

    jQuery(document).mouseup(function (e) {
        var container = jQuery('#oc-search-result');

        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });

    jQuery('#oc-search').submit(function(e) {
        e.preventDefault();
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "search/search.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 47,  53 => 15,  45 => 12,  39 => 11,  33 => 10,  29 => 9,  19 => 1,);
    }
}
/* <form id="oc-search" class="navbar-form" role="search">*/
/*   <div class="input-group">*/
/*     <div class="input-group-btn">*/
/*       <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">*/
/*         <i class="fa fa-search"></i>*/
/*         <span class="caret"></span>*/
/*       </a>*/
/*       <ul class="dropdown-menu dropdown-menu-left alerts-dropdown">*/
/*         <li class="dropdown-header">{{ text_search_options }}</li>*/
/*         <li><a onclick="setOption('catalog', '{{ text_catalog_placeholder }}'); return false;"><i class="fa fa-book"></i><span>{{ text_catalog }}</span></a></li>*/
/*         <li><a onclick="setOption('customers', '{{ text_customers_placeholder }}'); return false;"><i class="fa fa-group"></i><span>{{ text_customers }}</span></a></li>*/
/*         <li><a onclick="setOption('orders', '{{ text_orders_placeholder }}'); return false;"><i class="fa fa-credit-card"></i><span>{{ text_orders }}</span></a></li>*/
/*       </ul>*/
/*     </div>*/
/*     <input id="oc-search-input" type="text" class="form-control" placeholder="{{ text_search_placeholder }}" name="query" autocomplete="off" />*/
/*     <input id="oc-search-option" type="hidden" name="search-option" value="catalog" />*/
/*     <div id="loader-search"><img src="view/image/loader-search.gif" alt="" /></div>*/
/*   </div>*/
/* </form>*/
/* <div id="oc-search-result"></div>*/
/* <script type="text/javascript">*/
/*     function setOption(option, text) {*/
/*         jQuery('#oc-search-option').val(option);*/
/*         jQuery('#oc-search-input').attr('placeholder', text);*/
/*     }*/
/* */
/*     jQuery('#oc-search-input').keyup(function(){*/
/*         var option = jQuery('#oc-search-option').val();*/
/*         var length = 3;*/
/* */
/*         if(option == 'orders') {*/
/*             length = 1;*/
/*         }*/
/* */
/*         if(this.value.length < length) {*/
/*             return false;*/
/*         }*/
/* */
/*         if(jQuery.support.leadingWhitespace == false) {*/
/*               return false;*/
/*         }*/
/* */
/*         jQuery('#loader-search').css('display', 'block');*/
/* */
/*         jQuery.ajax({*/
/*             type: 'get',*/
/*             url: 'index.php?route=search/search/search' + '&user_token={{ user_token }}',		*/
/* 			data: jQuery('#oc-search').serialize(),*/
/*             dataType: 'json',*/
/*             success:function(json){*/
/*                 jQuery('#oc-search-result').css('display', 'block');*/
/*                 jQuery('#loader-search').css('display', 'none');*/
/* */
/*                 if(json['error']) {*/
/*                     jQuery('#oc-search-result').html(json['error'])*/
/*                     return;*/
/*                 }*/
/* */
/*                 jQuery('#oc-search-result').html(json['result'])*/
/*             }*/
/*         });*/
/*     });*/
/* */
/*     jQuery(document).mouseup(function (e) {*/
/*         var container = jQuery('#oc-search-result');*/
/* */
/*         if (!container.is(e.target) && container.has(e.target).length === 0) {*/
/*             container.hide();*/
/*         }*/
/*     });*/
/* */
/*     jQuery('#oc-search').submit(function(e) {*/
/*         e.preventDefault();*/
/*     });*/
/* </script>*/
/* */
