<?php
/*
 * Created on 31 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
function fetchCourseDescriptionAndStudyTime($term_id) {
	$taxonomy_term = taxonomy_term_load($term_id);
	return array("course_desc" => render(field_view_field('taxonomy_term', $taxonomy_term, "field_course_description", array('label' => 'hidden'))), 
	"study_time" => render(field_view_field('taxonomy_term', $taxonomy_term, "field_course_study_time", array('label' => 'hidden'))));
}

function fetchExamDescription($exam_name) {
	return '<h5 class="info-title">'.$exam_name.'</h5>'.db_select("taxonomy_term_data", "ttd")->fields("ttd", array("description"))->condition("name", $exam_name)->execute()->fetch()->description;
}

$query = db_query("SELECT ttd.tid from {taxonomy_term_data} ttd INNER JOIN {field_data_field_exam_pre} fep ON fep.entity_id = ttd.tid WHERE (fep.field_exam_pre_value = 'ECT' OR fep.field_exam_pre_value='PUG' OR fep.field_exam_pre_value='FIN') AND ttd.name='".$_POST['course_name']."'");
$term_id_design = $query->fetch()->tid;

$vid = db_select("taxonomy_vocabulary", "tv")->fields("tv", array("vid"))->condition("machine_name", "exam_layout")->execute()->fetch()->vid;
$term_id_combo = db_query("SELECT ttd.tid FROM {taxonomy_term_data} ttd WHERE ttd.vid='".$vid."' AND ttd.name='".$_POST['course_name']."'")->fetch()->tid;

function taxonomy_name($term_id) {
	return db_select("taxonomy_term_data", "ttd")->fields("ttd", array("name"))->condition("tid", $term_id)->execute()->fetch()->name;
}

function fetchPreRequisitesAndAssessments($term_id, $node) {
	$parent = taxonomy_get_parents($term_id);
	$pre_name = array(); $exam_name = array();
	foreach($parent as $single_item) { $parent_tid = $single_item->tid; break; }
	$children = taxonomy_get_children($parent_tid);
	foreach($children as $single_item) { 
		if($single_item->field_exam_pre[$node->language][0]['value'] === "PRE") {
			$pre_name[] = $single_item->name;
		}
		else {
			$exam_name[] = $single_item->name;
		}
		if($single_item->tid === $term_id) { break; }
	}
	return array("pre_requisites" => $pre_name, "assessment_exams" => $exam_name);
}

function fetchTrainingFormatAndCourseWork($term_id, $node) {
	$taxonomy_term = taxonomy_term_load($term_id);
	$training_format = array(); $course_work = array();
	if(!empty($taxonomy_term->field_training_format)) {
		foreach($taxonomy_term->field_training_format[$node->language] as $single_item) { 
			$training_format[] = taxonomy_name($single_item['tid']);
		 }
	}
	if(!empty($taxonomy_term->field_course_work)) {
		foreach($taxonomy_term->field_course_work[$node->language] as $single_item) {
			$course_work[] = taxonomy_name($single_item['tid']);
		}
	}
	return array("training_format" => $training_format, "course_work" => $course_work);
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Information about the course | TSM</title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main_new.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#pre_requisites_tabs a, #assessment_tabs a").click(function(e) {
					e.preventDefault();
					$("#tabbed-info").fadeIn(400);
					$(this).tab('show');
				});
			});
		</script>
	</head>
	<body>
		<div class="row-fluid simpledu">
			<div id="topbandholder" class="row-fluid">
				<div class="top-band">
					<table id="logoholder">
						<tbody>
							<tr>
								<td><a class="logo">
									<img width="123" height="50" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/logo.png'; ?>" />
								</a></td>
								<td class="navigation"><?php if(!empty($main_menu)) {
									print tsm_render_navigation($main_menu, 'navigation', array('nav', 'nav-pills'));
								} ?></td>
							</tr>
							<tr>
								<td colspan="2" ><p class="logo">Consultants UK Ltd</p></td>
							</tr>
							<tr>
								<td colspan="2" class="slogan"><span>IT Trainning | IT Support | IT Solutions</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row-fluid columns-wrapper">
			<?php if($_POST['course_name']) { ?>
				<div id="individualcourses" class="columns-holder">
					<h3 class="page-title">Information about the Course</h3>
					<div class="course-assessment">
						<div class="row-custom">
							<h5 class="info-title">Course Title</h5>
							<ul class="list-column">
								<li><span class="display-item"><?php echo $_POST['course_title']; ?></span></li>
							</ul>
						</div>
						<?php $EXAMS = fetchPreRequisitesAndAssessments($term_id_design, $node); $count = 0; ?>
						<?php if(!empty($EXAMS["pre_requisites"])) { ?>
						<div class="row-custom">
							<h5 class="info-title">Pre-requisites for the course</h5>
							<ul id="pre_requisites_tabs" class="list-column">
							<?php foreach($EXAMS["pre_requisites"] as $single_item) { $count++; ?>
								<li><a class="display-item" href="#pre_requisites_<?php echo $count; ?>"><?php print $single_item; ?></a></li>
								<li class="divider">|</li>
							<?php } $count = 0; ?>
							</ul>
						</div>
						<?php } ?>
						<?php if(!empty($EXAMS["assessment_exams"])) { ?>
						<div class="row-custom">
							<h5 class="info-title">Assessment</h5>
							<ul id="assessment_tabs" class="list-column">
							<?php foreach($EXAMS["assessment_exams"] as $single_item) { $count++; ?>
								<li><a class="display-item" href="#assessment_exams_<?php echo $count; ?>"><?php echo $single_item; ?></a></li>
								<li class="divider">|</li>
							<?php } $count = 0;?>
							</ul>
						</div>
						<?php } ?>
						<?php $SUPPORT = fetchTrainingFormatAndCourseWork($term_id_combo, $node_language); ?>
						<?php if(!empty($SUPPORT["training_format"])) { ?>
						<div class="row-custom">
							<h5 class="info-title">Training Format</h5>
							<ul class="list-column">
							<?php foreach($SUPPORT["training_format"] as $single_item) { ?>
								<li><a class="display-item" href="#"><?php echo $single_item; ?></a></li>
								<li class="divider">|</li>
							<?php } ?>
							</ul>
						</div>
						<?php } ?>
						<?php if(!empty($SUPPORT["course_work"])) { ?>
						<div class="row-custom">
							<h5 class="info-title">Course Work</h5>
							<ul class="list-column">
							<?php foreach($SUPPORT["course_work"] as $single_item) { ?>
								<li><a class="display-item" href="#"><?php echo $single_item; ?></a></li>
								<li class="divider">|</li>
							<?php } ?>
							</ul>
						</div>
						<?php } ?>
					</div>
					<div id="tabbed-info">
						<div class="tab-content" id="tabsContent">
							<?php foreach($EXAMS["pre_requisites"] as $single_item) { $count++; ?>
								<div class="tab-pane" id="pre_requisites_<?php echo $count; ?>"><?php echo fetchExamDescription($single_item, $node); ?></div>
							<?php } $count = 0; ?>
							<?php foreach($EXAMS["assessment_exams"] as $single_item) { $count++; ?> 
								<div class="tab-pane" id="assessment_exams_<?php echo $count; ?>"><?php echo fetchExamDescription($single_item, $node); ?></div>
							<?php } $count = 0; ?>
						</div>
					</div>
					<?php $course = fetchCourseDescriptionAndStudyTime($term_id_combo); ?>
					<div class="course-content">
						<h5 class="info-title">Course Details</h5>
						<p><?php print $course["course_desc"]; ?></p>
					</div>
					<table class="course-delivery table-bordered">
						<tbody>
							<tr>
								<td>
									<h5 class="info-title">Study Time</h5>
									<div class="display-item"><?php print $course["study_time"]; ?></div>
								</td>
								<td>
									<h5 class="info-title">Student Support</h5>
									<span class="display-item">VLE Support by expert mentors</span>
								</td>
								<td>
									<h5 class="info-title">Start of Course</h5>
									<span class="display-item">1st week of every Month</span>
								</td>
								<td>
									<h5 class="info-title">Resourses for the Course</h5>
									<span class="display-item">Books &amp; equipment will be provided</span>
								</td>
								<td>
									<h5 class="info-title">Delivered By</h5>
									<span class="display-item">TSM Consultants UK Ltd</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php }  ?>
			</div>
			<div id="footer" class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<h4 class="column-heading align-center">Our partners are</h4>
					<ul class="list-column">
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Prometric_Logo.png'; ?>"/></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Vue.png'; ?>"/></a></li>
					</ul>
					<ul class="list-column">
						<li><a href="terms-and-conditions">Terms and Conditions</a></li>
						<li class="divider">|</li>
						<li><a href="privacy">Privacy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>