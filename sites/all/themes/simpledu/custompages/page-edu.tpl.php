<!DOCTYPE html>
<html>
	<head>
		<title>TSM</title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/underscore.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/backbone.js'; ?>"></script>
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
			
			<div id="coursesweoffer" class="row-fluid columns-wrapper"></div>
			
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
<script type="text/template" id="tpl-table-cell">
	<h4 class="column-heading gray"><%= certifier %></h4>
	<div class="tab-content-details"><%= certifier_details %></div>
	<p>The list of courses that <%= certifier %> offer are:</p>
</script>
<script type="text/template" id="tpl-table-cell-courses-list">
	<a class="label label-info course-info-link" onclick="<%= onclick %>"><%= course_title %></a>
	<form method="POST" action="courses-info">
		<input type="hidden" name="course_name" value="<%= exam %>" />
		<input type="hidden" name="course_title" value="<%= course_title %>" />
	</form>
</script>
<script type="text/template" id="tpl-table-row-course">
	<td class="first-item">
		<a class="course-info-link" onclick="<%= onclick %>"><%= course_title %></a>
		<form method="POST" action="courses-info">
			<input type="hidden" name="course_name" value="<%= exam %>" />
			<input type="hidden" name="course_title" value="<%= course_title %>" />
		</form>
	</td>
	<td class="last-item"><%= tab_level %></td>
</script>

<script type="text/template" id="tpl-tab-content">
	<h4 class="column-heading gray"><%= tab %></h4>
	<div class="tab-content-details"><%= tab_details %></div>
	<p>The courses are distributed into sub-categories and levels under the <%= tab %> category as:</p>
</script>
<script type="text/template" id="tpl-tabs-list">
	<a href="<%= id %>"><i class="<%= ClassNames %>"></i><%= tab_name %></a>
</script>

<script type="text/javascript">
	var TSM = TSM || {};

	function LoadCourses() {
		var EXAMS_APPEND_JSON = <?php print $JSON->fetchCourses("COMBO"); ?>;
		var EXAMS_JSON = <?php print $JSON->fetchCourses("DESIGN"); ?>;
		
		return { appended : EXAMS_APPEND_JSON, main: EXAMS_JSON };
	}
	
	function LoadCertifiers() {
		var CERTIFIERS = <?php print $JSON->fetchProviders(); ?>;
		
		return CERTIFIERS;
	}
	
	function LoadTabs() {
		var TABS = <?php print $JSON->fetchCourseCategory(); ?>;
		
		return TABS;
	}
</script>

<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/simpledu.js' ?>"></script>

	</body>
</html>