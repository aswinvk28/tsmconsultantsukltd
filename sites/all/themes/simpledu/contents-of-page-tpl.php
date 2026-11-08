<?php
/*
 * Created on 27 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<div id="art-main">
    <div class="cleared reset-box"></div>
<div id="art-hmenu-bg" class="art-bar art-nav">
</div>
<div class="cleared reset-box"></div>

<div class="art-header">

<div class="art-header-position">
    <div class="art-header-wrapper">
        <div class="cleared reset-box"></div>
        <div class="art-header-inner">
<!--<div class="art-headerobject"></div>-->
<div class="art-logo">
     <?php   if (!empty($site_name)) { echo '<h1 class="art-logo-name"><a href="'.check_url($front_page).'" title = "'.$site_name.'">'.$site_name.'</a></h1>'; } ?>
     <?php   if (!empty($site_slogan)) { echo '<h2 class="art-logo-text">'.$site_slogan.'</h2>'; } ?>
</div>

        </div>
    </div>
</div>


</div>
<div class="cleared reset-box"></div>


<table class="position" cellpadding="0" cellspacing="0" border="0">
<tr valign="top"><td class="half-width"><?php echo render($user1); ?></td>
<td><?php echo render($user2); ?></td></tr>
</table>


<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
<div class="art-postcontent">
<?php { echo $breadcrumb; } ?>

</div>
<div class="cleared"></div>

</div>

		<div class="cleared"></div>
    </div>
</div>


<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
<div class="art-postcontent">
<?php if (isset($mission) && !empty($mission)) { echo '<div id="mission">'.$mission.'</div>'; }; ?>
<?php if (!empty($help)) { echo render($help); } ?>
<?php if (!empty($messages)) { echo $messages; } ?>
<?php if (isset($action_links) && !empty($action_links)): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

</div>
<div class="cleared"></div>

</div>

		<div class="cleared"></div>
    </div>
</div>


<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
<div class="art-postcontent">
<?php endif; ?>
<?php echo art_content_replace(render($content)); ?>
<?php if ($art_post_position === FALSE): ?>

</div>
<div class="cleared"></div>

</div>

		<div class="cleared"></div>
    </div>
</div>

<div class="art-box art-post">
    <div class="art-box-body art-post-body">
<div class="art-post-inner art-article">
<div class="art-postcontent">
<?php if (!empty($tabs2)) { echo $tabs2.'<div class="cleared"></div>'; } ?>
<?php if (isset($mission) && !empty($mission)) { echo '<div id="mission">'.$mission.'</div>'; }; ?>
<?php if (!empty($help)) { echo render($help); } ?>
<?php if (!empty($messages)) { echo $messages; } ?>
<?php if (isset($action_links) && !empty($action_links)): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
<?php echo art_content_replace(render($content)); ?>

</div>
<div class="cleared"></div>

</div>

		<div class="cleared"></div>
    </div>
</div>