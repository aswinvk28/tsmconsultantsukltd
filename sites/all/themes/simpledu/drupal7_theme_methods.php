<?php

//$vars = get_defined_vars();
//
//var_dump($vars);

/* Drupal 7 methods definitons */

require_once("PageJson.php");

function simpledu_preprocess_html(&$vars) {
	$vars['site_bool'] = !path_is_admin(request_path()) && strpos($_GET['q'], "user") !== 0;
	if($vars['site_bool']) { unset($vars['classes_array']); unset($vars['attributes_array']); }
}

/**
 * Override or insert variables into the page template.
 */
function simpledu_preprocess_page(&$vars) {
  
  $query = drupal_get_path_alias() ? drupal_get_path_alias() : $_REQUEST['q'];
  
  $vars['identity'] = array();
  $vars['site_bool'] = !path_is_admin(request_path()) && strpos($_GET['q'], "user") !== 0;
  if($vars['site_bool']) { 
  	$vars['JSON'] = new JsonService();
  	$vars['classes_array'] = array();
  	$vars['attributes_array'] = array();
  }
  
	switch ($query) {
		case "courses-info":
			$vars['identity'] = array("#identity" => "course-detail", "#is_custom_page" => true); break;
			
		case "career-path":
			$vars['identity'] = array("#identity" => "flow-diagram", "#is_custom_page" => true); break;
			
		case "contact-us":
			$vars['identity'] = array("#identity" => "contact", "#is_custom_page" => true); break;
		
		default: break;
	}
  
  if (isset($vars['identity']['#is_custom_page']) && $vars['identity']['#is_custom_page']) {
	$page_path = "custompages/page-".$vars['identity']['#identity'].".tpl.php";
	unset($vars['identity']);
	print theme_render_template("sites/all/themes/simpledu/".$page_path, $vars);
	drupal_exit();
  }
  
}

