<?php
/*
 * Created on 31 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */





//echo "<pre>";
//var_dump($tree[13]);var_dump($pre_requisites);var_dump($assessment_exams);var_dump($training_format);var_dump($course_work);var_dump($course);
//echo "</pre>";

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>TSM</title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main.css'; ?>" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    	<script type="text/javascript">
      		google.load('visualization', '1', {packages: ['corechart']});
    	</script>
		<script type="text/javascript">
			function LoadChartData() {
				
    			var data2 = google.visualization.arrayToDataTable([['Exam', 'Weightage'], ['Yellow', 0.25], ['70-290', 0.35], ['70-640', 0.15], ['70-642', 0.15], ['White', 0.1]]);
    			var data = google.visualization.arrayToDataTable([['Exam', 'Weightage'], ['70-620 TS OR 70-680 TS', 0.25], ['70-620 TS OR 70-680 TS', 0.35], ['70-620 TS OR 70-680 TS', 0.3], ['70-270', 0.1] ]);
    			
    			return {0: data, 1: data2};
			}
		</script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/chart.js'; ?>"></script>
	</head>
	<body>
		<div class="row-fluid simpledu">
			<div id="topbandholder" class="row-fluid">
				<div class="top-band">
					<table id="logoholder">
						<tbody>
							<tr>
								<td><a class="logo">
									<img height="40" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/test_image.png'; ?>" />
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
			<div id="chartwrapper" class="row-fluid columns-wrapper">
				<div id="chart" class="columns-holder">
					<div class="pies" id="visualization" style="position: absolute; width: 210px; height: 210px; top: 0; margin-left: -100px"></div>
    				<div class="pies" id="visualization2" style="position: absolute; width: 110px; height: 110px; top: 50px; margin-left: -50px"></div>
				</div>
			</div>
			<div id="footer" class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<ul class="list-column">
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/microsoft_header.png'; ?>" /></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Prometric_Logo.png'; ?>"/></a></li>
						<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Vue.png'; ?>"/></a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>