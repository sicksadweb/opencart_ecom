<?php

/* default/template/extension/module/featured_article.twig */
class __TwigTemplate_90eb30ff76e36e647839b96104a046cc0ff6ed7398eb2c285374418b8f8d8ce5 extends Twig_Template
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
        if ((isset($context["articles"]) ? $context["articles"] : null)) {
            // line 2
            echo "<h3>";
            echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
            echo "</h3>
<div class=\"row\">
 ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) ? $context["articles"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
                // line 5
                echo "  <div class=\"product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12\">
    <div class=\"product-thumb transition\">
      <div class=\"image\"><a href=\"";
                // line 7
                echo $this->getAttribute($context["article"], "href", array());
                echo "\"><img src=\"";
                echo $this->getAttribute($context["article"], "thumb", array());
                echo "\" alt=\"";
                echo $this->getAttribute($context["article"], "name", array());
                echo "\" title=\"";
                echo $this->getAttribute($context["article"], "name", array());
                echo "\" class=\"img-responsive\" /></a></div>
      <div class=\"caption\">
        <h4><a href=\"";
                // line 9
                echo $this->getAttribute($context["article"], "href", array());
                echo "\">";
                echo $this->getAttribute($context["article"], "name", array());
                echo "</a></h4>
        <p>";
                // line 10
                echo $this->getAttribute($context["article"], "description", array());
                echo "</p>
        ";
                // line 11
                if ($this->getAttribute($context["article"], "rating", array())) {
                    // line 12
                    echo "        <div class=\"rating\">
          ";
                    // line 13
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(5);
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 14
                        echo "          ";
                        if (($this->getAttribute($context["article"], "rating", array()) < $context["i"])) {
                            // line 15
                            echo "          <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
          ";
                        } else {
                            // line 17
                            echo "          <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-2x\"></i><i class=\"fa fa-star-o fa-stack-2x\"></i></span>
          ";
                        }
                        // line 19
                        echo "          ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 20
                    echo "        </div>
        ";
                }
                // line 22
                echo "      </div>
\t  <div class=\"button-group\">
        <button type=\"button\" onclick=\"location.href = ('";
                // line 24
                echo $this->getAttribute($context["article"], "href", array());
                echo "');\"><i class=\"fa fa-share\"></i> <span class=\"hidden-xs hidden-sm hidden-md\">";
                echo (isset($context["button_more"]) ? $context["button_more"] : null);
                echo "</span></button>
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
                // line 25
                echo $this->getAttribute($context["article"], "date_added", array());
                echo "\" \"><i class=\"fa fa-clock-o\"></i></button>
        <button type=\"button\" data-toggle=\"tooltip\" title=\"";
                // line 26
                echo (isset($context["text_views"]) ? $context["text_views"] : null);
                echo " ";
                echo $this->getAttribute($context["article"], "viewed", array());
                echo "\" \"><i class=\"fa fa-eye\"></i></button>
     </div>
    </div>
  </div>
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "</div>
  ";
        }
    }

    public function getTemplateName()
    {
        return "default/template/extension/module/featured_article.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 31,  100 => 26,  96 => 25,  90 => 24,  86 => 22,  82 => 20,  76 => 19,  72 => 17,  68 => 15,  65 => 14,  61 => 13,  58 => 12,  56 => 11,  52 => 10,  46 => 9,  35 => 7,  31 => 5,  27 => 4,  21 => 2,  19 => 1,);
    }
}
/* {% if articles %}*/
/* <h3>{{ heading_title }}</h3>*/
/* <div class="row">*/
/*  {% for article in articles %}*/
/*   <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">*/
/*     <div class="product-thumb transition">*/
/*       <div class="image"><a href="{{ article.href }}"><img src="{{ article.thumb }}" alt="{{ article.name }}" title="{{ article.name }}" class="img-responsive" /></a></div>*/
/*       <div class="caption">*/
/*         <h4><a href="{{ article.href }}">{{ article.name }}</a></h4>*/
/*         <p>{{ article.description }}</p>*/
/*         {% if article.rating %}*/
/*         <div class="rating">*/
/*           {% for i in 5 %}*/
/*           {% if article.rating < i %}*/
/*           <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>*/
/*           {% else %}*/
/*           <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>*/
/*           {% endif %}*/
/*           {% endfor %}*/
/*         </div>*/
/*         {% endif %}*/
/*       </div>*/
/* 	  <div class="button-group">*/
/*         <button type="button" onclick="location.href = ('{{ article.href }}');"><i class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">{{ button_more }}</span></button>*/
/*         <button type="button" data-toggle="tooltip" title="{{ article.date_added }}" "><i class="fa fa-clock-o"></i></button>*/
/*         <button type="button" data-toggle="tooltip" title="{{ text_views }} {{ article.viewed }}" "><i class="fa fa-eye"></i></button>*/
/*      </div>*/
/*     </div>*/
/*   </div>*/
/*   {% endfor %}*/
/* </div>*/
/*   {% endif %}*/
