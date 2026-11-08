<?php

/*
 * Created on 24 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
// $vars = get_defined_vars();

/*
 * Function to Return Course names from taxonomy for Tiles
 */
function tsm_fetch_courses($vocabulary) {
	$query = db_query("SELECT tv.vid from {taxonomy_vocabulary} tv where tv.machine_name='".$vocabulary."'");
	$vocabulary_id = $query->fetch()->vid;
	$courses = db_query("SELECT fec.field_exam_cert_value, ttd.name AS exam, ttd.description, from_ecat.name as exam_category, from_ecert.name as exam_cert, from_eprov.name as exam_provider 
			from field_data_field_exam_cert fec 
			INNER JOIN {taxonomy_term_data} ttd ON fec.entity_id = ttd.tid 
            INNER JOIN {taxonomy_term_hierarchy} tth ON ttd.tid = tth.tid
			INNER JOIN {taxonomy_term_data} from_ecat ON from_ecat.tid = tth.parent 
			INNER JOIN {taxonomy_term_hierarchy} tth_cert ON from_ecat.tid = tth_cert.tid 
			INNER JOIN {taxonomy_term_data} from_ecert ON from_ecert.tid = tth_cert.parent 
			INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = from_ecert.tid 
			INNER JOIN {taxonomy_term_data} from_eprov ON from_eprov.tid = tth_prov.parent 
			WHERE fec.field_exam_cert_value='ECO' OR fec.field_exam_cert_value='EST'");
	return $courses->fetchAll();
}

function tsm_fetch_combo_exam_names() {
	$query = db_query("SELECT ttd.name AS exam, fecourse.field_exam_course_value AS exam_title, ttd_cert.name AS exam_cert, ttd_prov.name AS exam_certified_by
				FROM {taxonomy_term_data} ttd
				INNER JOIN {taxonomy_term_hierarchy} tth ON tth.tid = ttd.tid
				INNER JOIN {taxonomy_term_data} ttd_cat ON tth.parent = ttd_cat.tid
				INNER JOIN {taxonomy_term_hierarchy} tth_cert ON tth_cert.tid = ttd_cat.tid
				INNER JOIN {taxonomy_term_data} ttd_cert ON ttd_cert.tid = tth_cert.parent
				INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = ttd_cert.tid
				INNER JOIN {taxonomy_term_data} ttd_prov ON ttd_prov.tid = tth_prov.parent
				LEFT JOIN {field_data_field_exam_cert} fec ON ttd.tid = fec.entity_id
				LEFT JOIN {field_data_field_exam_course} fecourse ON ttd.tid = fecourse.entity_id
				WHERE fec.field_exam_cert_value = 'ECO'
			OR fec.field_exam_cert_value = 'EST'");
	return $query->fetchAll();
}

function tsm_fetch_course_design_exam_names() {
	$query = db_query("SELECT ttd.name AS exam, from_ecat.name as course_title, from_eprov.name as exam_certified_by " .
				"FROM {field_data_field_exam_pre} fep " .
				"INNER JOIN {taxonomy_term_data} ttd ON fep.entity_id = ttd.tid " .
				"INNER JOIN {taxonomy_term_hierarchy} tth ON tth.tid = ttd.tid " .
				"INNER JOIN {taxonomy_term_data} from_ecat ON from_ecat.tid = tth.parent " .
				"INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = from_ecat.tid " .
			"INNER JOIN {taxonomy_term_data} from_eprov ON from_eprov.tid = tth_prov.parent WHERE fep.field_exam_pre_value='FIN'");
	return $query->fetchAll();
}

/*
 * Function to Return Tiles from user defined content
 */
function tsm_fetch_tiles() {
	$jsenabled_tiles = db_query("SELECT fdb.body_value, fdb.body_summary, ftb.field_tile_bool_value, node.title
			FROM {field_data_body} fdb LEFT JOIN node ON node.nid = fdb.entity_id
			LEFT JOIN {field_data_field_tile_bool} ftb ON fdb.entity_id = ftb.entity_id
			WHERE node.status='1' AND node.promote='1' AND (node.type='courses' OR node.type='certificates')
			AND ftb.field_tile_bool_value = '1' order by node.changed LIMIT 0,36");
 	return $jsenabled_tiles->fetchAll();
}

//$vars = get_defined_vars();
//echo "<pre>"; var_dump($vars['page']); echo "</pre>";
//var_dump($variables['page']);

$color_array = array("blue", "green", "orange", "light-green", "dark-blue", "yellow", "gray", "dark-green", "orange");

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TSM</title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#slider").find(".item").first().addClass("active");
				$("#slider").carousel();
			});
		</script>
		<script type="text/javascript">
			function LoadCourses() {
				var EXAMS_APPEND_JSON = <?php echo drupal_json_encode(tsm_fetch_combo_exam_names()); ?>;
				var EXAMS_JSON = <?php echo drupal_json_encode(tsm_fetch_course_design_exam_names()); ?>;
				
				return { appended : EXAMS_APPEND_JSON, main: EXAMS_JSON };
			}
			
			function LoadEssentials() {
				var ESSENTIALS = <?php echo drupal_json_encode(tsm_fetch_tiles()); ?>;
				
				return { essential: ESSENTIALS };
			}
		</script>
	</head>
	<body class="front">
		<div class="row-fluid simpledu">
			<div id="topBandHolder" class="row-fluid">
				<div class="top-band">
					<table id="logoHolder">
						<tbody>
							<tr>
								<td><a class="logo">
									<img height="53" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/test_image.png'; ?>" />
								</a></td>
								<td class="slogan"><span>IT Trainning | IT Support | IT Solutions</span></td>
							</tr>
							<tr>
								<td><p class="logo">Consultants UK Ltd</p></td>
							</tr>
						</tbody>
					</table>
					<table id="navigationHolder">
						<tbody>
							<tr>
								<td>
									<img height="53" width="0" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/blank.gif'; ?>"
								</td>
								<td class="navigation"><?php if(!empty($main_menu)) {
									print tsm_generate_menu($main_menu, 'navigation', array('nav', 'nav-pills'));
								} ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row-fluid columns-wrapper">
				<div id="slider" class="carousel slide columns-holder">
	    			<div id="sliderInner" class="carousel-inner">
	    			<?php $fetched_tiles = array_merge(tsm_fetch_courses("exam_layout"), tsm_fetch_tiles());
//	    			var_dump($fetched_tiles);
	    			$tile_count = 0; ?>
	    			<!-- Carousel items -->
	    				<div class="item">
	    					<ul>
	    					<?php foreach($fetched_tiles as $single_item) {
	    						if (empty($single_item->body_summary) && isset($single_item->body_value)) {
	    							$tile_content = substr(trim(strip_tags($single_item->body_value)), 0, 80)."...";
	    						} else if (isset($single_item->body_summary)){
	    							$tile_content = substr(trim(strip_tags($single_item->body_summary)), 0, 80)."...";
	    						} else if (isset($single_item->exam)) {
	    							$tile_content = substr(trim(strip_tags($single_item->description)), 0, 80)."...";
	    						}
	    					 ?>
	    					<!--<pre>UNDER CONSTRUCTION</pre>-->
	    					<li class="tile <?php echo $color_array[$tile_count % 9]; ?>">
	    						<table class="tile-bg">
	    							<tbody>
	    								<tr>
	    									<td colspan="2">
	    										<?php if (isset($single_item->exam)) { ?>
	    										<h3 class="tile-heading" onclick="$(this).parents('.tile-bg').next().submit()"><?php print substr($single_item->exam_cert.": ".$single_item->exam_category, 0, 30)."..."; ?></h3><!--<%= tileHeading %>-->
	    										<?php } else { ?>
	    										<h3 class="tile-heading" onclick="$(this).parents('.tile-bg').next().submit()"><?php print substr($single_item->title, 0, 30)."..."; ?></h3><!--<%= tileHeading %>-->
	    										<?php } ?>
	    									</td>
	    								</tr>
	    								<tr>
	    									<td class="image-tile">
	    										<img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/jsenabled/Money Bag.png';?>" />
	    									</td>
	    									<td class="tile-content">
	    										<p class="tile-content"><?php print $tile_content." "; ?><a class="read-more" href="javascript:void(0)" onclick="$(this).parents('.tile-bg').next().submit()">read more</a></p><!--<%= reducedBodyValue %>-->
		    								</td>
		    							</tr>
		    						</tbody>
		    					</table>
		    					<form method="POST" class="tile-form" action="<?php print base_path().'?q=courses-info'; ?>">
		    						<input type="hidden" name="course_name" value="<?php echo $single_item->exam; ?>" />
		    					</form>
		    				</li>
	    				
	    					<?php if (($tile_count + 1) % 12 == 0 && $tile_count < 36) { ?>
	    					</ul>
	    				</div>
	    				<div class="item">
	    					<ul>
	    				<?php } $tile_count++; }?>
	    					</ul>
	    				</div>
	    			</div>
	    				
	    			<!-- Carousel nav -->
	    			<div class="carousel-navigation">
	    				<a id="slider_prev" class="carousel-nav btn-slider" href="#slider" data-slide="prev"><i class="icon-chevron-left icon-white"></i></a>
	    				<a id="slider_0" class="carousel-nav btn-slider"><i class="icon-certificate icon-white"></i></a>
	    				<a id="slider_1" class="carousel-nav btn-slider"><i class="icon-certificate icon-white"></i></a>
	    				<a id="slider_2" class="carousel-nav btn-slider"><i class="icon-certificate icon-white"></i></a>
	    				<a id="slider_next" class="carousel-nav btn-slider" href="#slider" data-slide="next"><i class="icon-chevron-right icon-white"></i></a>
	    			</div>
	    		</div>
			</div>
			<div class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<table id="columns">
						<thead>
							<tr>
								<th></th>
								<th class="col-separator"></th>
								<th></th>
								<th class="col-separator"></th>
								<th></th>
								<th class="zero-width"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<?php $fetched_columns = tsm_fetch_columns(); $count = 0;
							foreach ($fetched_columns as $single_item) { $count++;?> <!-- $banner_array and $banner_item -->
								<td class="table-column">
									<h3 class="column-table-heading"><?php print $single_item->title; ?></h3>
									<p></p>
									<p>
										<?php print $single_item->body_value; ?>
									</p>
								</td>
								<td></td>
							<?php } ?>
							</tr>
						<tbody>
					</table>
				</div>
			</div>
			<div id="footer" class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<ul class="list-column">
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/microsoft_header.png'; ?>" /></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/cisco-crop.png'; ?>"/></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Prometric_Logo.png'; ?>"/></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/comptia-crop.png'; ?>"/></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Vue.png'; ?>"/></a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<script type="text/template" id="tpl-tile-heading">
			<h3 class="tile-heading"><%= heading %></h3>
		</script>
		
		<script type="text/template" id="tpl-tile-pic">
			<img src="<%= imageSource %>" />
		</script>
		
		<script type="text/template" id="tpl-tile-content">
			<p class="tile-content"><%= tileContent %></p>
		</script>
		
		<script type="text/template" id="tpl-course-form">
			<form method="GET" class="tile-form" action="<?php print base_path().'?q=courses-info'; ?>">
				<input type="hidden" name="course_name" value="<%= exam %>" />
			</form>
		</script>
		
		<script type="text/template" id="tpl-tile-form">
			<form method="GET" class="tile-form" action="<?php print base_path(); ?>">
				<input type="hidden" name="q" value="<%= path %>" />
			</form>
		</script>
		
		<script type="text/template" id="tpl-carousel-nav">
			<a id="<%= id %>" class="carousel-navigation btn-slider"><i class="<%= ClassNames %>"></i></a>
		</script>
		
	</body>
</html>