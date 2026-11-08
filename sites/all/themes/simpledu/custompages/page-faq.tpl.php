<?php
/*
 * Created on 16 Aug 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
function tsm_fetch_faqs($machineName) {
	$vid = db_select("taxonomy_vocabulary", "tv")->fields("tv", array("vid"))->condition("machine_name", $machineName)->execute()->fetch()->vid;
	$query = db_query("SELECT ttd.name AS question, ttd.description AS answer FROM {taxonomy_term_data} ttd WHERE ttd.vid='".$vid."'");
	return $query->fetchAll();
}

//var_dump(tsm_fetch_faqs("fa_questions"));

?>

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
			<div id="topBandHolder" class="row-fluid">
				<div class="top-band">
					<table id="logoHolder">
						<tbody>
							<tr>
								<td><a class="logo">
									<img height="40" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/test_image.png'; ?>" />
								</a></td>
								<td class="navigation"><?php if(!empty($main_menu)) {
									print tsm_generate_menu($main_menu, 'navigation', array('nav', 'nav-pills'));
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
			<div id="faqPageWrapper" class="row-fluid columns-wrapper">
				<div id="faqPage" class="columns-holder">
					<h2 class="node-title"><?php echo $node->title; ?></h2>
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
		
<script type="text/template" id="tpl-faq-each">
	<div class="accordion-group">
		<div class="accordion-heading">
			<a class="accordion-toggle" href="<%= reference %>" data-parent="<%= parentId %>" data-toggle="<%= collapsibleClassName %>"><%= question %></a>
		</div>
		<div class="accordion-body collapse" id="<%= bodyId %>">
			<div class="accordion-inner"><%= answer %></div>
		</div>
	</div>	
</script>

<script type="text/javascript">
	function LoadFaqs() {
		var FAQS = <?php echo drupal_json_encode(tsm_fetch_faqs("fa_questions")); ?>;
		
		return FAQS;
	}
</script>

<script type="text/javascript" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/js/simpledu.js' ?>"></script>
	</body>
</html>
			