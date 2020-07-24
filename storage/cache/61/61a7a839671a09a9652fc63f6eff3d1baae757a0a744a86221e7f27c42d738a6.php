<?php

/* common/header.twig */
class __TwigTemplate_2535c2ad3d201f92e849f7eeeb3ffc1b633540befed2c662ab58c0bdb1c60088 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html dir=\"";
        // line 2
        echo (isset($context["direction"]) ? $context["direction"] : null);
        echo "\" lang=\"";
        echo (isset($context["lang"]) ? $context["lang"] : null);
        echo "\">
<head>
<meta charset=\"UTF-8\" />
<title>";
        // line 5
        echo (isset($context["title"]) ? $context["title"] : null);
        echo "</title>
<base href=\"";
        // line 6
        echo (isset($context["base"]) ? $context["base"] : null);
        echo "\" />
";
        // line 7
        if ((isset($context["description"]) ? $context["description"] : null)) {
            // line 8
            echo "<meta name=\"description\" content=\"";
            echo (isset($context["description"]) ? $context["description"] : null);
            echo "\" />
";
        }
        // line 10
        if ((isset($context["keywords"]) ? $context["keywords"] : null)) {
            // line 11
            echo "<meta name=\"keywords\" content=\"";
            echo (isset($context["keywords"]) ? $context["keywords"] : null);
            echo "\" />
";
        }
        // line 13
        echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0\" />
<script type=\"text/javascript\" src=\"view/javascript/jquery/jquery-2.1.1.min.js\"></script>
<script type=\"text/javascript\" src=\"view/javascript/bootstrap/js/bootstrap.min.js\"></script>
<link href=\"view/stylesheet/bootstrap.css\" type=\"text/css\" rel=\"stylesheet\" />
<link href=\"view/javascript/font-awesome/css/font-awesome.min.css\" type=\"text/css\" rel=\"stylesheet\" />
<script src=\"view/javascript/jquery/datetimepicker/moment/moment.min.js\" type=\"text/javascript\"></script>
<script src=\"view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js\" type=\"text/javascript\"></script>
<script src=\"view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js\" type=\"text/javascript\"></script>
<link href=\"view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\" />
<link type=\"text/css\" href=\"view/stylesheet/stylesheet.css\" rel=\"stylesheet\" media=\"screen\" />
";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["styles"]) ? $context["styles"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 24
            echo "<link type=\"text/css\" href=\"";
            echo $this->getAttribute($context["style"], "href", array());
            echo "\" rel=\"";
            echo $this->getAttribute($context["style"], "rel", array());
            echo "\" media=\"";
            echo $this->getAttribute($context["style"], "media", array());
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['style'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["links"]) ? $context["links"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 27
            echo "<link href=\"";
            echo $this->getAttribute($context["link"], "href", array());
            echo "\" rel=\"";
            echo $this->getAttribute($context["link"], "rel", array());
            echo "\" />
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "<script src=\"view/javascript/common.js\" type=\"text/javascript\"></script>
";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["scripts"]) ? $context["scripts"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 31
            echo "<script type=\"text/javascript\" src=\"";
            echo $context["script"];
            echo "\"></script>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "</head>
<body>
<div id=\"container\">
<header id=\"header\" class=\"navbar navbar-static-top\">
  <div class=\"container-fluid\">

  
    <div id=\"header-logo\" class=\"navbar-header\"><a href=\"";
        // line 40
        echo (isset($context["home"]) ? $context["home"] : null);
        echo "\" class=\"navbar-brand\"><img src=\"view/image/logo.png\" alt=\"";
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "\" title=\"";
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "\" /></a></div>
    <a href=\"#\" id=\"button-menu\" class=\"hidden-md hidden-lg\"><span class=\"fa fa-bars\"></span></a>";
        // line 41
        if ((isset($context["logged"]) ? $context["logged"] : null)) {
            // line 42
            echo "    
    
\t<ul class=\"nav pull-left\">
      <li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\"  title=\"";
            // line 45
            echo (isset($context["text_new"]) ? $context["text_new"] : null);
            echo "\"><i class=\"fa fa-plus fa-lg\"></i> <span class=\"header-item\">";
            echo (isset($context["text_new"]) ? $context["text_new"] : null);
            echo "</span></a>
      <ul class=\"dropdown-menu dropdown-menu-left alerts-dropdown\">
        <li><a href=\"";
            // line 47
            echo (isset($context["new_product"]) ? $context["new_product"] : null);
            echo "\" style=\"display: block; overflow: auto;\">";
            echo (isset($context["text_new_product"]) ? $context["text_new_product"] : null);
            echo "</a></li>
        <li><a href=\"";
            // line 48
            echo (isset($context["new_category"]) ? $context["new_category"] : null);
            echo "\" style=\"display: block; overflow: auto;\">";
            echo (isset($context["text_new_category"]) ? $context["text_new_category"] : null);
            echo "</a></li>
        <li><a href=\"";
            // line 49
            echo (isset($context["new_manufacturer"]) ? $context["new_manufacturer"] : null);
            echo "\" style=\"display: block; overflow: auto;\">";
            echo (isset($context["text_new_manufacturer"]) ? $context["text_new_manufacturer"] : null);
            echo "</a></li>
        <li><a href=\"";
            // line 50
            echo (isset($context["new_customer"]) ? $context["new_customer"] : null);
            echo "\" style=\"display: block; overflow: auto;\">";
            echo (isset($context["text_new_customer"]) ? $context["text_new_customer"] : null);
            echo "</a></li>
        <li><a href=\"";
            // line 51
            echo (isset($context["new_download"]) ? $context["new_download"] : null);
            echo "\" style=\"display: block; overflow: auto;\">";
            echo (isset($context["text_new_download"]) ? $context["text_new_download"] : null);
            echo "</a></li>
      </ul>
    </li> 
    </ul>
\t
\t<div id=\"oc-search-div\" class=\"col-sm-3 col-md-3 pull-left\">
    ";
            // line 57
            echo (isset($context["search"]) ? $context["search"] : null);
            echo "
\t</div>
    
    <ul class=\"nav navbar-nav navbar-right\">
      <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><img src=\"";
            // line 61
            echo (isset($context["image"]) ? $context["image"] : null);
            echo "\" alt=\"";
            echo (isset($context["firstname"]) ? $context["firstname"] : null);
            echo " ";
            echo (isset($context["lastname"]) ? $context["lastname"] : null);
            echo "\" title=\"";
            echo (isset($context["username"]) ? $context["username"] : null);
            echo "\" id=\"user-profile\" class=\"img-circle\" />";
            echo (isset($context["firstname"]) ? $context["firstname"] : null);
            echo " ";
            echo (isset($context["lastname"]) ? $context["lastname"] : null);
            echo " <i class=\"fa fa-caret-down fa-fw\"></i></a>
        <ul class=\"dropdown-menu dropdown-menu-right\">
          <li><a href=\"";
            // line 63
            echo (isset($context["profile"]) ? $context["profile"] : null);
            echo "\"><i class=\"fa fa-user-circle-o fa-fw\"></i> ";
            echo (isset($context["text_profile"]) ? $context["text_profile"] : null);
            echo "</a></li>
          <li role=\"separator\" class=\"divider\"></li>
          <li class=\"dropdown-header\">";
            // line 65
            echo (isset($context["text_store"]) ? $context["text_store"] : null);
            echo "</li>
          ";
            // line 66
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["stores"]) ? $context["stores"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 67
                echo "          <li><a href=\"";
                echo $this->getAttribute($context["store"], "href", array());
                echo "\" target=\"_blank\">";
                echo $this->getAttribute($context["store"], "name", array());
                echo "</a></li>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 69
            echo "          <li role=\"separator\" class=\"divider\"></li>
          <li class=\"dropdown-header\">";
            // line 70
            echo (isset($context["text_help"]) ? $context["text_help"] : null);
            echo "</li>
          <li><a href=\"https://ocstore.com\" target=\"_blank\"><i class=\"fa fa-opencart fa-fw\"></i> ";
            // line 71
            echo (isset($context["text_homepage"]) ? $context["text_homepage"] : null);
            echo "</a></li>
          <li><a href=\"https://docs.ocstore.com\" target=\"_blank\"><i class=\"fa fa-file-text-o fa-fw\"></i> ";
            // line 72
            echo (isset($context["text_documentation"]) ? $context["text_documentation"] : null);
            echo "</a></li>
          <li><a href=\"https://opencartforum.com\" target=\"_blank\"><i class=\"fa fa-comments-o fa-fw\"></i> ";
            // line 73
            echo (isset($context["text_support"]) ? $context["text_support"] : null);
            echo "</a></li>
        </ul>
      </li>
      <li><a href=\"";
            // line 76
            echo (isset($context["logout"]) ? $context["logout"] : null);
            echo "\"><i class=\"fa fa-sign-out\"></i> <span class=\"hidden-xs hidden-sm hidden-md\">";
            echo (isset($context["text_logout"]) ? $context["text_logout"] : null);
            echo "</span></a></li>
    </ul>
    ";
        }
        // line 78
        echo " </div>
</header>
";
    }

    public function getTemplateName()
    {
        return "common/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 78,  249 => 76,  243 => 73,  239 => 72,  235 => 71,  231 => 70,  228 => 69,  217 => 67,  213 => 66,  209 => 65,  202 => 63,  187 => 61,  180 => 57,  169 => 51,  163 => 50,  157 => 49,  151 => 48,  145 => 47,  138 => 45,  133 => 42,  131 => 41,  123 => 40,  114 => 33,  105 => 31,  101 => 30,  98 => 29,  87 => 27,  83 => 26,  70 => 24,  66 => 23,  54 => 13,  48 => 11,  46 => 10,  40 => 8,  38 => 7,  34 => 6,  30 => 5,  22 => 2,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html dir="{{ direction }}" lang="{{ lang }}">*/
/* <head>*/
/* <meta charset="UTF-8" />*/
/* <title>{{ title }}</title>*/
/* <base href="{{ base }}" />*/
/* {% if description %}*/
/* <meta name="description" content="{{ description }}" />*/
/* {% endif %}*/
/* {% if keywords %}*/
/* <meta name="keywords" content="{{ keywords }}" />*/
/* {% endif %}*/
/* <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />*/
/* <script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>*/
/* <script type="text/javascript" src="view/javascript/bootstrap/js/bootstrap.min.js"></script>*/
/* <link href="view/stylesheet/bootstrap.css" type="text/css" rel="stylesheet" />*/
/* <link href="view/javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />*/
/* <script src="view/javascript/jquery/datetimepicker/moment/moment.min.js" type="text/javascript"></script>*/
/* <script src="view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js" type="text/javascript"></script>*/
/* <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>*/
/* <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />*/
/* <link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />*/
/* {% for style in styles %}*/
/* <link type="text/css" href="{{ style.href }}" rel="{{ style.rel }}" media="{{ style.media }}" />*/
/* {% endfor %}*/
/* {% for link in links %}*/
/* <link href="{{ link.href }}" rel="{{ link.rel }}" />*/
/* {% endfor %}*/
/* <script src="view/javascript/common.js" type="text/javascript"></script>*/
/* {% for script in scripts %}*/
/* <script type="text/javascript" src="{{ script }}"></script>*/
/* {% endfor %}*/
/* </head>*/
/* <body>*/
/* <div id="container">*/
/* <header id="header" class="navbar navbar-static-top">*/
/*   <div class="container-fluid">*/
/* */
/*   */
/*     <div id="header-logo" class="navbar-header"><a href="{{ home }}" class="navbar-brand"><img src="view/image/logo.png" alt="{{ heading_title }}" title="{{ heading_title }}" /></a></div>*/
/*     <a href="#" id="button-menu" class="hidden-md hidden-lg"><span class="fa fa-bars"></span></a>{% if logged %}*/
/*     */
/*     */
/* 	<ul class="nav pull-left">*/
/*       <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"  title="{{ text_new }}"><i class="fa fa-plus fa-lg"></i> <span class="header-item">{{ text_new }}</span></a>*/
/*       <ul class="dropdown-menu dropdown-menu-left alerts-dropdown">*/
/*         <li><a href="{{ new_product }}" style="display: block; overflow: auto;">{{ text_new_product }}</a></li>*/
/*         <li><a href="{{ new_category }}" style="display: block; overflow: auto;">{{ text_new_category }}</a></li>*/
/*         <li><a href="{{ new_manufacturer }}" style="display: block; overflow: auto;">{{ text_new_manufacturer }}</a></li>*/
/*         <li><a href="{{ new_customer }}" style="display: block; overflow: auto;">{{ text_new_customer }}</a></li>*/
/*         <li><a href="{{ new_download }}" style="display: block; overflow: auto;">{{ text_new_download }}</a></li>*/
/*       </ul>*/
/*     </li> */
/*     </ul>*/
/* 	*/
/* 	<div id="oc-search-div" class="col-sm-3 col-md-3 pull-left">*/
/*     {{ search }}*/
/* 	</div>*/
/*     */
/*     <ul class="nav navbar-nav navbar-right">*/
/*       <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ image }}" alt="{{ firstname }} {{ lastname }}" title="{{ username }}" id="user-profile" class="img-circle" />{{ firstname }} {{ lastname }} <i class="fa fa-caret-down fa-fw"></i></a>*/
/*         <ul class="dropdown-menu dropdown-menu-right">*/
/*           <li><a href="{{ profile }}"><i class="fa fa-user-circle-o fa-fw"></i> {{ text_profile }}</a></li>*/
/*           <li role="separator" class="divider"></li>*/
/*           <li class="dropdown-header">{{ text_store }}</li>*/
/*           {% for store in stores %}*/
/*           <li><a href="{{ store.href }}" target="_blank">{{ store.name }}</a></li>*/
/*           {% endfor %}*/
/*           <li role="separator" class="divider"></li>*/
/*           <li class="dropdown-header">{{ text_help }}</li>*/
/*           <li><a href="https://ocstore.com" target="_blank"><i class="fa fa-opencart fa-fw"></i> {{ text_homepage }}</a></li>*/
/*           <li><a href="https://docs.ocstore.com" target="_blank"><i class="fa fa-file-text-o fa-fw"></i> {{ text_documentation }}</a></li>*/
/*           <li><a href="https://opencartforum.com" target="_blank"><i class="fa fa-comments-o fa-fw"></i> {{ text_support }}</a></li>*/
/*         </ul>*/
/*       </li>*/
/*       <li><a href="{{ logout }}"><i class="fa fa-sign-out"></i> <span class="hidden-xs hidden-sm hidden-md">{{ text_logout }}</span></a></li>*/
/*     </ul>*/
/*     {% endif %} </div>*/
/* </header>*/
/* */
