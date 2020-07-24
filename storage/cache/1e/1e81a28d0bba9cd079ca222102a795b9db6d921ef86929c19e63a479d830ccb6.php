<?php

/* default/template/blog/menu.twig */
class __TwigTemplate_1c3624d5fe59c22c52506c28fb77c3a5e7a895838d6a0d2d6a5873fdf46ed418 extends Twig_Template
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
        echo "\t<div class=\"pull-left\">
\t<div class=\"btn-group\">
    <button class=\"btn btn-link dropdown-toggle\" data-toggle=\"dropdown\">
\t<i class=\"fa fa-book\"></i> <span class=\"hidden-xs hidden-sm hidden-md\">";
        // line 4
        echo (isset($context["text_blog"]) ? $context["text_blog"] : null);
        echo "</span> <i class=\"fa fa-caret-down\"></i>
\t</button>
\t<ul class=\"dropdown-menu\">
\t";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["categories"]) ? $context["categories"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 8
            echo "        ";
            if ($this->getAttribute($context["category"], "children", array())) {
                // line 9
                echo "        <li><a href=\"";
                echo $this->getAttribute($context["category"], "href", array());
                echo "\">";
                echo $this->getAttribute($context["category"], "name", array());
                echo "</a></li>
            ";
                // line 10
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_array_batch($this->getAttribute($context["category"], "children", array()), (twig_length_filter($this->env, $this->getAttribute($context["category"], "children", array())) / twig_round($this->getAttribute($context["category"], "column", array()), 1, "ceil"))));
                foreach ($context['_seq'] as $context["_key"] => $context["children"]) {
                    echo "   
\t\t\t\t";
                    // line 11
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["children"]);
                    foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                        // line 12
                        echo "                <li><a href=\"";
                        echo $this->getAttribute($context["child"], "href", array());
                        echo "\"><i class=\"fa fa-angle-right\"></i> ";
                        echo $this->getAttribute($context["child"], "name", array());
                        echo "</a></li>
\t\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 14
                    echo "\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['children'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 15
                echo "\t\t";
            } else {
                // line 16
                echo "        <li><a href=\"";
                echo $this->getAttribute($context["category"], "href", array());
                echo "\">";
                echo $this->getAttribute($context["category"], "name", array());
                echo "</a></li>
        ";
            }
            // line 18
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "\t<li><a href=\"";
        echo (isset($context["blog"]) ? $context["blog"] : null);
        echo "\" class=\"see-all\">";
        echo (isset($context["text_all"]) ? $context["text_all"] : null);
        echo " ";
        echo (isset($context["text_blog"]) ? $context["text_blog"] : null);
        echo "</a></li>
\t</ul>
\t</div>
\t</div>";
    }

    public function getTemplateName()
    {
        return "default/template/blog/menu.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 19,  82 => 18,  74 => 16,  71 => 15,  65 => 14,  54 => 12,  50 => 11,  44 => 10,  37 => 9,  34 => 8,  30 => 7,  24 => 4,  19 => 1,);
    }
}
/* 	<div class="pull-left">*/
/* 	<div class="btn-group">*/
/*     <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">*/
/* 	<i class="fa fa-book"></i> <span class="hidden-xs hidden-sm hidden-md">{{ text_blog }}</span> <i class="fa fa-caret-down"></i>*/
/* 	</button>*/
/* 	<ul class="dropdown-menu">*/
/* 	{% for category in categories %}*/
/*         {% if category.children %}*/
/*         <li><a href="{{ category.href }}">{{ category.name }}</a></li>*/
/*             {% for children in category.children|batch(category.children|length / category.column|round(1, 'ceil')) %}   */
/* 				{% for child in children %}*/
/*                 <li><a href="{{ child.href }}"><i class="fa fa-angle-right"></i> {{ child.name }}</a></li>*/
/* 				{% endfor %}*/
/* 			{% endfor %}*/
/* 		{% else %}*/
/*         <li><a href="{{ category.href }}">{{ category.name }}</a></li>*/
/*         {% endif %}*/
/* 	{% endfor %}*/
/* 	<li><a href="{{ blog }}" class="see-all">{{ text_all }} {{ text_blog }}</a></li>*/
/* 	</ul>*/
/* 	</div>*/
/* 	</div>*/
