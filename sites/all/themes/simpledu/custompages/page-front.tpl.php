<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_name; ?></title>
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/underscore.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/backbone.js'; ?>"></script>
	</head>
	<?php if($is_admin) { ?>
		<?php print render($page['page_top']); ?>
	<?php } ?>
	<body class="front">
		<div class="row-fluid simpledu">
			<div id="topbandholder" class="row-fluid">
				<div class="top-band">
					<table id="logoholder">
						<tbody>
							<tr>
								<td><a class="logo">
									<img height="50" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/test_image.png'; ?>" />
								</a></td>
								<td class="navigation"><?php if(!empty($main_menu)) {
									print tsm_render_navigation($main_menu, 'navigation', array('nav', 'nav-pills'));
								} ?></td>
							</tr>
							<tr>
								<td colspan="2" ><p class="logo"><?php echo $site_name; ?></p></td>
							</tr>
							<tr>
								<td colspan="2" class="slogan"><span><?php echo $site_slogan; ?></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div id="frontpage" class="row-fluid columns-wrapper"></div>
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

<script type="text/template" id="tpl-tile-heading">
	<h3 class="tile-heading"><%= heading %></h3>
</script>

<script type="text/template" id="tpl-tile-pic">
	<img src="<%= imageSource %>" />
</script>

<script type="text/template" id="tpl-tile-content">
	<p><%= tileContent %></p>
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
	<a href="#slider" class="carousel-nav btn-slider" onclick="<%= onclick %>"><i class="<%= ClassNames %>"></i></a>
</script>

<?php var_dump($is_admin); ?>
	</body>
</html>
