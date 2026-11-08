<?php
/*
 * Created on 12 Sep 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

//function simpledu_theme() {
//	print_r (drupal_find_theme_templates($existing, ".tpl.php", "themes/simpledu/custompages"));
//}

/**
 * Returns HTML for a node preview for display during node creation and editing.
 *
 * @param $variables
 *   An associative array containing:
 *   - node: The node object which is being previewed.
 *
 * @ingroup themeable
 */
function simpledu_node_preview($variables) {
  $node = $variables['node'];

  $output = '<div class="preview">';

  $preview_trimmed_version = FALSE;

  $elements = node_view(clone $node, 'teaser');
  $trimmed = drupal_render($elements);
  $elements = node_view($node, 'full');
  $full = drupal_render($elements);

  // Do we need to preview trimmed version of post as well as full version?
  if ($trimmed != $full) {
    drupal_set_message(t('The trimmed version of your post shows what your post looks like when promoted to the main page or when exported for syndication.<span class="no-js"> You can insert the delimiter "&lt;!--break--&gt;" (without the quotes) to fine-tune where your post gets split.</span>'));
	$preview_trimmed_version = t('Preview trimmed version');
	$output .= <<< EOT
<div class="art-box art-post">
        <div class="art-box-body art-post-body">
    <div class="art-post-inner art-article">
    
<div class="art-postcontent">
    
      <h3>
	  $preview_trimmed_version
	  </h3>

    </div>
    <div class="cleared"></div>
    

    </div>
    
    		<div class="cleared"></div>
        </div>
    </div>
    
EOT;
	$output .= $trimmed;
    
	$preview_full_version = t('Preview full version');
	$output .= <<< EOT
<div class="art-box art-post">
        <div class="art-box-body art-post-body">
    <div class="art-post-inner art-article">
    
<div class="art-postcontent">
    
      <h3>
	  $preview_full_version
	  </h3>

    </div>
    <div class="cleared"></div>
    

    </div>
    
    		<div class="cleared"></div>
        </div>
    </div>
    
EOT;

    $output .= $full;
  }
  else {
    $output .= $full;
  }
  $output .= "</div>\n";

  return $output;
}

/**
 * Return a Artisteer themed set of links.
 *
 * @param $content
 *   An object with node content.
 * @return
 *   A string containing an unordered list of links.
 */
function art_links_woker_D7($content) {
  $result = '';
  if (!isset($content['links'])) return $result;
  foreach (array_keys($content['links']) as $name) {
	$$name = & $content['links'][$name];
	if (isset($content['links'][$name]['#links'])) {
	  $links = $content['links'][$name]['#links'];
	  if (is_array($links)) {
		$output = get_links_html_output_D7($links);
		if (!empty($output)) {
			$result .= (empty($result)) ? $output : '&nbsp;|&nbsp;' . $output;
		}
	  }
    }
  }

$terms = get_terms_D7($content);
  if (!empty($terms)) {
  ob_start();?>
  <span class="art-posttagicon"><?php
  $result .= ($result == '') ? ob_get_clean() : '&nbsp;|&nbsp;' . ob_get_clean();
  $result .= '<div class="art-tags">' . render($terms) . '</div>';
  ob_start();?>
  </span><?php
  $result .= ob_get_clean();
  }
  

  return $result;  
}

function get_terms_D7($content) {
	$result = NULL;
	foreach (array_keys($content) as $name)	{
		$$name = & $content[$name];
		$field_type = NULL;
		if (is_array($content[$name])) {
			if (isset($content[$name]['#field_type']))
				$field_type = $content[$name]['#field_type'];
		} else if (is_object($content[$name])) {
			if (isset($content[$name]->field_type))
				$field_type = $content[$name]->field_type;
		}
	    if ($field_type == NULL || $field_type != "taxonomy_term_reference") continue;
	    $result = $content[$name];
	}
	return $result;
}

function get_links_html_output_D7($links) {
	$output = '';
	$num_links = count($links);
    $index = 0;

	foreach ($links as $key => $link) {
	  $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($index == 0) {
        $class[] = 'first';
      }
      if ($index == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))
          && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      
	  $link_output = '';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $link_output = l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $link_output = '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }
		
if (strpos ($key, "comment") !== FALSE) {
		
		  if ($index > 0 && !empty($link_output) && !empty($output)) {
		  $output .= '&nbsp;|&nbsp;';
		}
		ob_start();?>
		<span class="art-postcommentsicon"><?php
		$output .= ob_get_clean();
		$output .= $link_output;
		$index++;
		ob_start();?>
		</span><?php
		$output .= ob_get_clean();
		continue;
		}
		
if ($index > 0 && !empty($link_output) && !empty($output)) {
          $output .= '&nbsp|&nbsp';
        }
        ob_start();?>
        <span class="art-postcategoryicon"><?php
        $output .= ob_get_clean();
        $output .= $link_output;
        $index++;
        ob_start();?>
        </span><?php
        $output .= ob_get_clean();
        

	}
	return $output;
}

?>