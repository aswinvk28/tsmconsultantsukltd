<?php
/*
 * Created on 16 Aug 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
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
			$(".collapse").collapse({
				toggle: false
			});
		});
		</script>
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
			<div class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<h2 class="node-title"><?php echo $node->title; ?></h2>
					<div id="collapsibleContainer" class="accordion">
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#faq-1" data-parent="#collapsibleContainer" data-toggle="collapse"> I'm new to IT. Where do I start?</a>
							</div>
							<div id="faq-1" class="accordion-body collapse">
								<div class="accordion-inner"> Certification is a great way to get a quick introduction to the IT industry and gain an advantage in the job market. 
									Even the most difficult certification requires far less preparation time or financial investment than a four-year degree in computer science.
								</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#faq-2" data-parent="#collapsibleContainer" data-toggle="collapse"> I don't know which course is right for me. Can you help?</a>
							</div>
							<div id="faq-2" class="accordion-body collapse">
								<div class="accordion-inner"> TSM has very experianced instructors and experts ready to help you pick the right course.</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#faq-3" data-parent="#collapsibleContainer" data-toggle="collapse"> What does each course include?</a>
							</div>
							<div id="faq-3" class="accordion-body collapse">
								<div class="accordion-inner"> All our IT certification training courses include user guides, hands-on exercises simulations to provide a comprehensive learning experience. 
								A test prep service is also included for the majority of our courses. This service provides you with the opportunity to 
								test your knowledge in a simulated, certification-testing environment.all our courses include VLE( Virtual Learning Enviornment) an online resource containing relevant resources.</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#faq-4" data-parent="#collapsibleContainer" data-toggle="collapse"> What do my fees cover?</a>
							</div>
							<div id="faq-4" class="accordion-body collapse">
								<div class="accordion-inner"> Your fees include course ware, hands-on simulations, user guides and product documentation, a test prep service and technical and learning support. 
								All of our courses include VLE account and access to online relevant resources.</div>
							</div>
						</div>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" href="#faq-5" data-parent="#collapsibleContainer" data-toggle="collapse"> How do I enroll?</a>
							</div>
							<div id="faq-5" class="accordion-body collapse">
								<div class="accordion-inner"> We've made the enrollment process as easy as possible. All you have to do is to fill the information request on the right side of this web page about the course 
								of your choice and a TSM Learning consultant will contact you. To make enrollment as easy and convenient as possible for you, we'll take care of much of the paperwork involved.</div>
							</div>
						</div>
					</div>
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
	</body>
</html>
			