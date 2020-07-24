<?php

/* catalog/category_list.twig */
class __TwigTemplate_ceabb70584c6fb420481ebbf89953fda8a1e7e7a4e60fc02b81d09d0fa4b5fb6 extends Twig_Template
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
      <div class=\"pull-right\"><a href=\"";
        // line 5
        echo (isset($context["add"]) ? $context["add"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_add"]) ? $context["button_add"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></a> 
\t  <a href=\"";
        // line 6
        echo (isset($context["repair"]) ? $context["repair"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_rebuild"]) ? $context["button_rebuild"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-refresh\"></i></a>
\t\t<button type=\"submit\" form=\"form-category\" formaction=\"";
        // line 7
        echo (isset($context["enabled"]) ? $context["enabled"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_enable"]) ? $context["button_enable"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-play\"></i></button>
\t\t<button type=\"submit\" form=\"form-category\" formaction=\"";
        // line 8
        echo (isset($context["disabled"]) ? $context["disabled"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_disable"]) ? $context["button_disable"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-pause\"></i></button>
\t\t<button type=\"button\" form=\"form-category\" formaction=\"";
        // line 9
        echo (isset($context["delete"]) ? $context["delete"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_delete"]) ? $context["button_delete"] : null);
        echo "\" class=\"btn btn-danger\" onclick=\"confirm('";
        echo (isset($context["text_confirm"]) ? $context["text_confirm"] : null);
        echo "') ? \$('#form-category').submit() : false;\"><i class=\"fa fa-trash-o\"></i></button>
      </div>
      <h1>";
        // line 11
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 14
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
        // line 16
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 20
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 21
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 25
        echo "    ";
        if ((isset($context["success"]) ? $context["success"] : null)) {
            // line 26
            echo "    <div class=\"alert alert-success alert-dismissible\"><i class=\"fa fa-check-circle\"></i> ";
            echo (isset($context["success"]) ? $context["success"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 30
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-list\"></i> ";
        // line 32
        echo (isset($context["text_list"]) ? $context["text_list"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 35
        echo (isset($context["delete"]) ? $context["delete"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-category\">
          <div class=\"table-responsive\">
            <table class=\"table table-bordered table-hover\">
              <thead>
                <tr>
                  <td style=\"width: 1px;\" class=\"text-center\"><input type=\"checkbox\" onclick=\"\$('input[name*=\\'selected\\']').prop('checked', this.checked);\" /></td>
                  <td class=\"text-left\">";
        // line 41
        echo (isset($context["column_name"]) ? $context["column_name"] : null);
        echo "</td>
                  <td class=\"text-right\">";
        // line 42
        echo (isset($context["column_sort_order"]) ? $context["column_sort_order"] : null);
        echo "</td>
\t\t\t\t  <td class=\"text-right\">";
        // line 43
        if (((isset($context["sort"]) ? $context["sort"] : null) == "noindex")) {
            // line 44
            echo "                    <a href=\"";
            echo (isset($context["sort_noindex"]) ? $context["sort_noindex"] : null);
            echo "\" class=\"";
            echo twig_lower_filter($this->env, (isset($context["order"]) ? $context["order"] : null));
            echo "\">";
            echo (isset($context["column_noindex"]) ? $context["column_noindex"] : null);
            echo "</a>
                    ";
        } else {
            // line 46
            echo "                    <a href=\"";
            echo (isset($context["sort_noindex"]) ? $context["sort_noindex"] : null);
            echo "\">";
            echo (isset($context["column_noindex"]) ? $context["column_noindex"] : null);
            echo "</a>
\t\t\t\t\t";
        }
        // line 47
        echo "</td>
                  <td class=\"text-right\">";
        // line 48
        echo (isset($context["column_action"]) ? $context["column_action"] : null);
        echo "</td>
                </tr>
              </thead>
              <tbody>
                ";
        // line 52
        if ((isset($context["categories"]) ? $context["categories"] : null)) {
            // line 53
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                // line 54
                echo "                <tr>
                  <td class=\"text-center\">";
                // line 55
                if (twig_in_filter($this->getAttribute($context["category"], "category_id", array()), (isset($context["selected"]) ? $context["selected"] : null))) {
                    // line 56
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo $this->getAttribute($context["category"], "category_id", array());
                    echo "\" checked=\"checked\" />
                    ";
                } else {
                    // line 58
                    echo "                    <input type=\"checkbox\" name=\"selected[]\" value=\"";
                    echo $this->getAttribute($context["category"], "category_id", array());
                    echo "\" />
                    ";
                }
                // line 59
                echo "</td>
\t\t\t\t  ";
                // line 60
                if ($this->getAttribute($context["category"], "href", array())) {
                    // line 61
                    echo "                  <td class=\"left\">";
                    echo $this->getAttribute($context["category"], "indent", array());
                    echo "<a href=\"";
                    echo $this->getAttribute($context["category"], "href", array());
                    echo "\">";
                    echo $this->getAttribute($context["category"], "name", array());
                    echo "</a>&nbsp;<i class=\"fa fa-sort-desc\"></i></td>
\t\t\t\t\t";
                } else {
                    // line 63
                    echo "                  <td class=\"left\">";
                    echo $this->getAttribute($context["category"], "indent", array());
                    echo $this->getAttribute($context["category"], "name", array());
                    echo "</td>
                  ";
                }
                // line 65
                echo "                  <td class=\"text-right\">";
                echo $this->getAttribute($context["category"], "sort_order", array());
                echo "</td>
\t\t\t\t  <td class=\"text-right\">";
                // line 66
                echo $this->getAttribute($context["category"], "noindex", array());
                echo "</td>
                  <td class=\"text-right\">
\t\t\t\t\t<a target=\"_blank\" href=\"";
                // line 68
                echo $this->getAttribute($context["category"], "href_shop", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_shop"]) ? $context["button_shop"] : null);
                echo "\" class=\"btn btn-success\"><i class=\"fa fa-eye\"></i></a>
\t\t\t\t\t<a href=\"";
                // line 69
                echo $this->getAttribute($context["category"], "edit", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" class=\"btn btn-primary\"><i class=\"fa fa-pencil\"></i></a>
\t\t\t\t  </td>
                </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "                ";
        } else {
            // line 74
            echo "                <tr>
                  <td class=\"text-center\" colspan=\"4\">";
            // line 75
            echo (isset($context["text_no_results"]) ? $context["text_no_results"] : null);
            echo "</td>
                </tr>
                ";
        }
        // line 78
        echo "              </tbody>
            </table>
          </div>
        </form>
        <div class=\"row\">
          <div class=\"col-sm-12 text-right\">";
        // line 83
        echo (isset($context["results"]) ? $context["results"] : null);
        echo "</div>
        </div>
      </div>
    </div>
  </div>
  
    <script type=\"text/javascript\"><!--
// IE and Edge fix!
\$('button[form=\\'form-category\\']').on('click', function(e) {
\t\$('#form-category').attr('action', \$(this).attr('formaction'));
});
 //--></script> 
</div>
";
        // line 96
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "catalog/category_list.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 96,  257 => 83,  250 => 78,  244 => 75,  241 => 74,  238 => 73,  226 => 69,  220 => 68,  215 => 66,  210 => 65,  203 => 63,  193 => 61,  191 => 60,  188 => 59,  182 => 58,  176 => 56,  174 => 55,  171 => 54,  166 => 53,  164 => 52,  157 => 48,  154 => 47,  146 => 46,  136 => 44,  134 => 43,  130 => 42,  126 => 41,  117 => 35,  111 => 32,  107 => 30,  99 => 26,  96 => 25,  88 => 21,  86 => 20,  80 => 16,  69 => 14,  65 => 13,  60 => 11,  51 => 9,  45 => 8,  39 => 7,  33 => 6,  27 => 5,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right"><a href="{{ add }}" data-toggle="tooltip" title="{{ button_add }}" class="btn btn-primary"><i class="fa fa-plus"></i></a> */
/* 	  <a href="{{ repair }}" data-toggle="tooltip" title="{{ button_rebuild }}" class="btn btn-default"><i class="fa fa-refresh"></i></a>*/
/* 		<button type="submit" form="form-category" formaction="{{ enabled }}" data-toggle="tooltip" title="{{ button_enable }}" class="btn btn-default"><i class="fa fa-play"></i></button>*/
/* 		<button type="submit" form="form-category" formaction="{{ disabled }}" data-toggle="tooltip" title="{{ button_disable }}" class="btn btn-default"><i class="fa fa-pause"></i></button>*/
/* 		<button type="button" form="form-category" formaction="{{ delete }}" data-toggle="tooltip" title="{{ button_delete }}" class="btn btn-danger" onclick="confirm('{{ text_confirm }}') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>*/
/*       </div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid">*/
/*     {% if error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     {% if success %}*/
/*     <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> {{ success }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-list"></i> {{ text_list }}</h3>*/
/*       </div>*/
/*       <div class="panel-body">*/
/*         <form action="{{ delete }}" method="post" enctype="multipart/form-data" id="form-category">*/
/*           <div class="table-responsive">*/
/*             <table class="table table-bordered table-hover">*/
/*               <thead>*/
/*                 <tr>*/
/*                   <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>*/
/*                   <td class="text-left">{{ column_name }}</td>*/
/*                   <td class="text-right">{{ column_sort_order }}</td>*/
/* 				  <td class="text-right">{% if sort == 'noindex' %}*/
/*                     <a href="{{ sort_noindex }}" class="{{ order|lower }}">{{ column_noindex }}</a>*/
/*                     {% else %}*/
/*                     <a href="{{ sort_noindex }}">{{ column_noindex }}</a>*/
/* 					{% endif %}</td>*/
/*                   <td class="text-right">{{ column_action }}</td>*/
/*                 </tr>*/
/*               </thead>*/
/*               <tbody>*/
/*                 {% if categories %}*/
/*                 {% for category in categories %}*/
/*                 <tr>*/
/*                   <td class="text-center">{% if category.category_id in selected %}*/
/*                     <input type="checkbox" name="selected[]" value="{{ category.category_id }}" checked="checked" />*/
/*                     {% else %}*/
/*                     <input type="checkbox" name="selected[]" value="{{ category.category_id }}" />*/
/*                     {% endif %}</td>*/
/* 				  {% if category.href %}*/
/*                   <td class="left">{{ category.indent }}<a href="{{ category.href }}">{{ category.name }}</a>&nbsp;<i class="fa fa-sort-desc"></i></td>*/
/* 					{% else %}*/
/*                   <td class="left">{{ category.indent }}{{ category.name }}</td>*/
/*                   {% endif %}*/
/*                   <td class="text-right">{{ category.sort_order }}</td>*/
/* 				  <td class="text-right">{{ category.noindex }}</td>*/
/*                   <td class="text-right">*/
/* 					<a target="_blank" href="{{ category.href_shop }}" data-toggle="tooltip" title="{{ button_shop }}" class="btn btn-success"><i class="fa fa-eye"></i></a>*/
/* 					<a href="{{ category.edit }}" data-toggle="tooltip" title="{{ button_edit }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>*/
/* 				  </td>*/
/*                 </tr>*/
/*                 {% endfor %}*/
/*                 {% else %}*/
/*                 <tr>*/
/*                   <td class="text-center" colspan="4">{{ text_no_results }}</td>*/
/*                 </tr>*/
/*                 {% endif %}*/
/*               </tbody>*/
/*             </table>*/
/*           </div>*/
/*         </form>*/
/*         <div class="row">*/
/*           <div class="col-sm-12 text-right">{{ results }}</div>*/
/*         </div>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/*   */
/*     <script type="text/javascript"><!--*/
/* // IE and Edge fix!*/
/* $('button[form=\'form-category\']').on('click', function(e) {*/
/* 	$('#form-category').attr('action', $(this).attr('formaction'));*/
/* });*/
/*  //--></script> */
/* </div>*/
/* {{ footer }}*/
