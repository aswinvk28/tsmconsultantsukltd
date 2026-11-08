<?php 

$query = drupal_get_path_alias() ? drupal_get_path_alias() : $_REQUEST['q'];
	switch($query) {
		case "courses-we-offer": ?>
		<script type="text/javascript">
			var TSM = TSM || {};
			function LoadCourses() { return { appended : <?php print $JSON->fetchCourses("COMBO"); ?>, main: <?php print $JSON->fetchCourses("DESIGN"); ?> }; }
			function LoadCertifiers() { return <?php print $JSON->fetchProviders(); ?>; }
			function LoadTabs() { return <?php print $JSON->fetchCourseCategory(); ?>; }
			TSM.basePath = function() { return "<?php echo $base_path; ?>"; };
		</script>
		<?php break; 
		case "success-stories": ?>
        <script type="text/javascript">
            var TSM = TSM || {};
            TSM.basePath = function() { return "<?php echo $base_path; ?>"; };
        </script>
		<?php $nodes = db_select("node", "n")->fields("n", array("nid"))->condition("type", "testimonial")->execute()->fetchAll(); break;
		default: break;
	}
?>

	<div class="row-fluid simpledu">
		<div id="topbandholder" class="row-fluid">
			<div class="top-band">
				<table id="logoholder">
					<tbody>
						<tr>
							<td><a class="logo">
								<img width="123" height="50" src="<?php echo base_path().'sites/tsm-consultantsuk.com/clientapp/images/logo.png'; ?>" />
							</a></td>
							<td class="navigation"><?php if(!empty($main_menu)) { print tsm_render_navigation($main_menu, 'navigation', array('nav', 'nav-pills')); } ?></td>
						</tr>
						<tr>
							<td colspan="2" ><p class="logo"><?php echo $site_name; ?></p></td>
						</tr>
						<tr>
							<td colspan="2" class="slogan"><span><?php print $site_slogan; ?></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
<?php
if($is_front) {
	$node_id = db_select("node", "n")->fields("n", array("nid"))->condition("title", "Home Page")->execute()->fetch()->nid;
	$node = node_load($node_id);
	$node_view = node_view($node); 
	
?>

<script type="text/javascript">
	var TSM = TSM || {};
	function LoadCourses() { return { appended : <?php print $JSON->fetchCourses("COMBO"); ?>, main: <?php print $JSON->fetchCourses("DESIGN"); ?> }; }
	function LoadEssentials() { return <?php print $JSON->fetchFrontPageContent(); ?>; }
	TSM.basePath = function() { return "<?php echo $base_path; ?>"; };
</script>

	<div class="row-fluid full-page">
		<div class="columns-holder"><?php render_body(render($node_view), $node); ?></div>
	</div> 
<?php } else { ?>

<?php if(isset($node)) { ?>
	<div class="row-fluid columns-wrapper">
		<div class="columns-holder">
			<h2 class="page-title"><?php print $node->title; ?></h2>
			<?php render_body(render($page['content']), $node); ?>
		</div>
	</div> 
	<?php if(isset($nodes)) { ?>
        <div class="row-fluid">
            <div class="columns-holder">
        <?php foreach($nodes as $node_item) { $single_item = node_load($node_item->nid); $single_view = node_view($single_item, ''); ?>
                    <div class="success-story">
                        <h3 class="column-heading blue"><?php echo $single_item->title; ?></h3>
                        <div class="story-content"><?php print render($single_view); ?></div>
                    </div>
        <?php } ?>
            </div>
        </div>
    <?php } ?>
	
<?php } ?>

<?php if(!isset($node) || (empty($node->body[$node->language][0]['value'])) || $is_admin) { ?>
    <div class="row-fluid">
        <div class="columns-holder"><?php print render($page['content']); ?></div>
    </div>
<?php }

} ?>

