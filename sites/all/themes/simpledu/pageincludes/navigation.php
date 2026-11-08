<?php
/*
 * Created on 25 Jul 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 
?>

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