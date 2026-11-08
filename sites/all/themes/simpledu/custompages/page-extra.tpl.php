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
			<div id="wrapper" class="row-fluid columns-wrapper">
				<div id="container" class="columns-holder">
					<h2 class="node-title"><?php echo $node->title; ?></h2>
					<div><?php print drupal_render($content); ?></div>
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
			