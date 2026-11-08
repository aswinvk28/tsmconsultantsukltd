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
		<link rel="stylesheet" href="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/styles/main_new.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/jquery/jquery-1.7.2.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/bootstrap/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/underscore.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/backbone/backbone.js'; ?>"></script>
	</head>
	<body>
		<script type="text/javascript">
			var TSM = TSM || {};
			function LoadFaqs() { return <?php echo $JSON->fetchFAQs("fa_questions"); ?>; }
			TSM.basePath = function() { return "<?php echo $base_path; ?>"; };
		</script>
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
			<?php if(!empty($_POST['enquiry_email']) && !empty($_POST['enquiry_content']) && !empty($_POST['enquiry_name'])) {
                $from = str_replace(array("\n", "\r", "\n\r"), "", strip_tags($_POST['enquiry_email']));
                $to = variable_get('site_mail', ini_get('sendmail_from'));
                // $headers = array("From" => $from, "To" => variable_get('site_mail', ini_get('sendmail_from')), "Subject" => "Enquiry from ".$from);
                // $smtp = Mail::factory('smtp',
                   // array ('host' => localhost,
                     // 'auth' => true,
                     // 'username' => "aswinvk28@gmail.com",
                     // 'password' => "Pl10XyS7"));
                $enquiry = strip_tags($_POST['enquiry_content']);
                print $from.$to;
                $mail = mail($to, "Enquiry From ".$from, $enquiry);
                if(!$mail) { print "<p>Message delivery failed</p>"; } else { ?>
			<div class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<p>Thank you for sending the enquiry. We will respond to that shortly.</p>
				</div>
			</div>
			
		  <?php } } else { ?>
			<div class="row-fluid columns-wrapper">
				<div class="columns-holder">
					<h2 class="page-title">Contact Us</h2>
					<div id="contactformholder">
						<form id="contactform" action="contact-us" method="POST">
							<table class="form-table">
								<tbody>
									<tr>
										<td><span>Name *</span></td>
										<td class="form-field"><input type="text" class="contact-field" name="enquiry_name" size="60" /></td>
										<td id="location" rowspan="4"><h5 class="column-heading gray align-center">Find Us here:</h5><div id="map_location_container"></div></td>
									</tr>
									<tr>
										<td><span>Email Address *</span></td>
										<td class="form-field"><input class="contact-field" name="enquiry_email" type="text" /></td>
									<tr>
										<td><span>Enquiry *</span></td>
										<td class="form-field"><textarea class="contact-field" name="enquiry_content" rows="5" cols="50"></textarea></td>
									</tr>
									<tr>
										<td></td>
										<td class="form-field"><input type="submit" class="btn btn-primary" value="Send Enquiry" /></td>
									</tr>
									<tr>
										<td></td>
										<td colspan="2"><div id="faqpage"></div></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
			<?php } ?>
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
		<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/simpledu.js' ?>"></script>
	</body>
</html>
			