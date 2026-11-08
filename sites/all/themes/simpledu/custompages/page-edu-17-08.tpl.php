<?php
/*
 * Created on 31 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
/*
 * Function to Return Provider names from taxonomy
 */
function tsm_fetch_providers() {
	$query = db_query("SELECT ttd.name as exam_certified_by FROM {taxonomy_term_data} ttd
				LEFT JOIN {taxonomy_vocabulary} tv ON ttd.vid = tv.vid
				LEFT JOIN {taxonomy_term_hierarchy} tth ON ttd.tid = tth.tid
				WHERE tv.machine_name = 'exam_layout'
				AND tth.parent = '0'
			ORDER BY ttd.weight");
	return $query->fetchAll();
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

function tsm_fetch_course_design_exam_names($provider_name) {
	$query = db_query("SELECT ttd.name AS exam, from_ecat.name as course_title, from_eprov.name as exam_certified_by " .
				"FROM {field_data_field_exam_pre} fep " .
				"INNER JOIN {taxonomy_term_data} ttd ON fep.entity_id = ttd.tid " .
				"INNER JOIN {taxonomy_term_hierarchy} tth ON tth.tid = ttd.tid " .
				"INNER JOIN {taxonomy_term_data} from_ecat ON from_ecat.tid = tth.parent " .
				"INNER JOIN {taxonomy_term_hierarchy} tth_prov ON tth_prov.tid = from_ecat.tid " .
			"INNER JOIN {taxonomy_term_data} from_eprov ON from_eprov.tid = tth_prov.parent WHERE fep.field_exam_pre_value='FIN' AND from_eprov.name='".$provider_name."'");
	return $query->fetchAll();
}

// Temporary

$courses = tsm_fetch_providers();

$microsoft_courses = tsm_fetch_course_design_exam_names("Microsoft");
$cisco_courses = tsm_fetch_course_design_exam_names("Cisco");
$comptia_courses = tsm_fetch_course_design_exam_names("CompTIA");

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TSM</title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
	</head>
	<body>
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
			<?php //$providers = tsm_fetch_courses_fromtaxonomy("exam_layout", true); ?>
			<div class="row-fluid columns-wrapper">
				<div id="coursesWeOffer" class="columns-holder">
					<h2 class="node-title"><?php echo $node->title; ?></h2>
					<form id="tableWrapper" method="POST" action="<?php print base_path().'?q=courses-info'; ?>">
						<table class="columnsBorderSpacing">
							<tbody>
								<tr>
									<td class="column-half">
										<h3 class="column-heading gray align-center">Cisco</h3>
										<p>The widely respected IT certification programs available through Cisco Career Certifications bring valuable, 
										measurable rewards to network professionals, their managers, and the organizations that employ them.</p>
										<p>Cisco certification is the key to a successful career in IT Security and Network Management and the continuously growing field of Information Technology. 
										Security Specialist jobs, including network security and network management are expected to be one of the fastest growing occupations through 2016. Employment of Security Professional jobs are 
										expected to increase much faster than average as Information Technology becomes more sophisticated and organizations continue to adopt and integrate these technologies.</p>
										<ul class="list-column">
										<?php foreach($cisco_courses as $single_course) { ?>
											<li>
												<button type="submit" value="<?php print $single_course->exam; ?>" name="course_name" class="badge badge-info"><?php echo $single_course->course_title; ?></button>
											</li>
										<?php } ?>
										</ul>
									</td>
									<td class="job-lists">
										<h5>CCNP</h5>
										<ul class="list-row">
											<li class="label">Network Security Engineer</li>
											<li class="label">Infrastructure Engineer</li>
											<li class="label">Network Engineer</li>
											<li class="label">Design Consultant</li>
											<li class="label">Technical Project Manager</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td class="column-half">
										<h3 class="column-heading gray align-center">CompTIA</h3>
										<p>CompTIA is the IT industry’s largest developer of vendor-neutral IT certification exams. 
										Our certifications are recognized worldwide as a trusted indicator of qualified and competent professionals in the IT industry.</p>
										<p>For individuals, attaining certifications means increased job security, additional career opportunities and increased credibility in the workplace. 
										For businesses, hiring certified workers means higher customer satisfaction, increased productivity and lower employee turnover.</p>
										<ul class="list-column">
										<?php foreach($comptia_courses as $single_course) { ?>
											<li>
												<button class="badge badge-info" type="button" value="<?php print $single_course->exam; ?>" name="course_name"><?php echo $single_course->course_title; ?></button>
											</li>
										<?php } ?>
										</ul>
									</td>
									<td class="job-lists">
										<h5>Comptia Server+</h5>
										<ul class="list-row">
											<li class="label">Server Technician</li>
											<li class="label">System Administrator</li>
											<li class="label">Server Installation Technician</li>
											<li class="label">IT Consultant</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td class="column-half">
										<h3 class="column-heading gray align-center">Microsoft</h3>
										<p>Certifications are available for most Microsoft technologies and skill levels from business workers to IT professionals, developers, 
										technology trainers, and system architects. Pursuing a certification, provides you with up-to-date, relevant skills that can not only lead to a more fulfilling career, 
										but offer valuable Microsoft Certified Professional (MCP) benefits, including access to the MCP member site and a vast, global network of other certified professionals.</p>
										<ul class="list-column">
										<?php foreach($microsoft_courses as $single_course) { ?>
											<li>
												<button class="badge badge-info" type="button" value="<?php print $single_course->exam; ?>" name="course_name"><?php echo $single_course->course_title; ?></button>
											</li>
										<?php } ?>
										</ul>
									</td>
									<td class="job-lists">
										<h5>MCITP: Enterprise Administrator 2008</h5>
										<ul class="list-row">
											<li class="label">System / Network Engineer</li>
											<li class="label">System / Network Administrator</li>
											<li class="label">System / Network Architect</li>
											<li class="label">Technical Consultant</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
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
		
		<script type="text/template" id="tpl-table-cell">
			<h3 class="<%= ClassNames_h3 %>"><%= certifier %></h3>
			<p><%= certifier_description %></p>
		</script>
		
		<script type="text/template" id="tpl-table-cell-courses-list">
			<button type="button" value="<%= exam %>" name="<%= button_param %>" class="<%= ClassNames %>"><%= course_title %></button>
		</script>
		
	</body>
</html>