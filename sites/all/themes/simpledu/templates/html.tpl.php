<?php //$vars = get_defined_vars(); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php print $head_title; ?></title>
	<?php if ($is_admin) { ?>
	<meta name="description" content="" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php print $head; ?>
	<?php print $styles; ?>
	<?php print $scripts; ?>
	<!--[if IE 6]><link rel="stylesheet" href="<?php echo base_path() . $directory; ?>/style.ie6.css" type="text/css" media="screen" /><![endif]-->  
	<!--[if IE 7]><link rel="stylesheet" href="<?php echo base_path() . $directory; ?>/style.ie7.css" type="text/css" media="screen" /><![endif]-->
	<?php } ?>
	<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
	<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main_new.css'; ?>" />
	<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/underscore.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/backbone.js'; ?>"></script>
</head>
<body <?php if(!empty($classes)) { echo 'class="'.$classes.'"'; } ?> <?php if(!empty($attributes)) { print $attributes; } ?>>
	<?php print $page_top; ?>
  		<?php print $page; ?>
		<div id="footer" class="row-fluid columns-wrapper">
			<div class="columns-holder">
				<h4 class="column-heading align-center">Our partners are</h4>
				<ul class="list-column">
					<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Prometric_Logo.png'; ?>"/></a></li>
					<li><a class="footer-image" href="#"><img src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/partner/Vue.png'; ?>"/></a></li>
				</ul>
				<ul class="list-column">
					<li>Copyright &copy; TSM Consultants UK Ltd</li>
					<li class="divider">|</li>
					<li><a href="terms-and-conditions">Terms and Conditions</a></li>
					<li class="divider">|</li>
					<li><a href="privacy">Privacy</a></li>
				</ul>
			</div>
		</div>
	</div>
  	<?php print $page_bottom; ?>
</body>
</html>