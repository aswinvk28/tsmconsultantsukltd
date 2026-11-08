<?php
/*
 * Created on 12 Aug 2012
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
				<div class="columns-holder">
					<h2 class="node-title"><?php echo $node->title; ?></h2>
					<div class="success-story">
						<h3 class="column-heading blue">AJAY</h3>
						<img width="290" class="story-image pull-left" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/success-stories/ajay-ss.jpg'; ?>" />
						<div class="story-content pull-left">
							The most important thing TSM gave me is confidence. IT qualifications encouraged me to go for better jobs. The TSM instructors were excellent. 
							I am currently a CCNA and working towards MCSA. I feel really Confident that I have the real hands on knowledge which is expected in industry.
						</div>
					</div>
					<div class="success-story">
						<h3 class="column-heading blue">MOUSHMI</h3>
						<img width="290" class="story-image pull-left" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/success-stories/Moushmi-ss.png'; ?>" />
						<div class="story-content pull-left">
							I have greatly enjoyed my time at TSM. I learned a lot here, they not only helped me with my course but they also helped me with my CV and interview skills. 
							Thanks to them I feel more confident.
						</div>
					</div>
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