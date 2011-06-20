<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>

<?php echo $xve_js; ?>

<script type="text/javascript">
	jQuery(document).ready(function () {
		
		var radios = ['flv_player'];
		
		jQuery.each(radios, function (key, radio) {
			jQuery(':input[name=' + radio + ']').change(function () {
				xve.send_request(radio, 'radio', jQuery(':input[name=' + radio +']:checked').val());
			});
		});
		
	});
</script>

<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><abbr title="XVE Various Embed">XVE</abbr> v<?php echo $version ?> <?php _e_xve('Dashboard') ?></h2>
	
	<h2><?php _e_xve('General Options') ?></h2>
	
	<?php foreach ($types as $type) : ?>
	
	<h3><?php printf(__xve('%s'), ucfirst($type)) ?></h3>
	
	<?php
	if ( ! isset($config[$type]['disabled']) AND $config[$type]['disabled'] !== TRUE)
	{
		$enabled = 'checked="checked" ';
	}
	else
	{
		$enabled = '';
	}
	?>
	
	<table class="widefat fixed" cellspacing="0">
	<tbody>
		<tr>
			<td width="20%"><?php _e_xve('Enabled') ?></td>
			<td width="20%" id="parent_<?php echo $type ?>_disabled">
				<input type="checkbox" id="<?php echo $type ?>_disabled" onclick="xve.save_box(this.id)" <?php echo $enabled ?>/> <?php _e_xve('yes / no') ?>
			</td>
			<td>
				<?php printf(__xve('Enables the %s for all supported domains.'), $type) ?>
			</td>
		</tr>
		<tr>
			<td><?php _e_xve('Global Width') ?></td>
			<td id="parent_<?php echo $type ?>_width">
				<input type="text" id="<?php echo $type ?>_width" onclick="xve.save_text(this.id)" onfocus="xve.save_text(this.id)" value="<?php echo $config[$type]['width'] ?>" />
			</td>
			<td>
				<?php _e_xve('Width') ?> <?php printf(__xve('(pixels) used for all %s content. Override for each specific domain or with embeding tag attributes.'), $type) ?>
			</td>
		</tr>
		<tr>
			<td><?php _e_xve('Global Height') ?></td>
			<td id="parent_<?php echo $type ?>_height">
				<input type="text" id="<?php echo $type ?>_height" onclick="xve.save_text(this.id)" onfocus="xve.save_text(this.id)" value="<?php echo $config[$type]['height'] ?>" />
			</td>
			<td>
				<?php _e_xve('Height') ?> <?php printf(__xve('(pixels) used for all %s content. Override for each specific domain or with embeding tag attributes.'), $type) ?>
			</td>
		</tr>
		<?php if ($type == 'flv') : ?>
		<tr>
			<td><?php _e_xve('Media Player') ?></td>
			<td id="parent_flv_player">
				<?php _e_xve('Player / Licence') ?>
				<br />
				<?php foreach ($players as $player => $data) : ?>
					<?php
					if ($config['flv']['player'] == $player)
					{
						$checked = 'checked="checked" ';
					}
					else
					{
						$checked = '';
					}
					?>
					<input type="radio" name="flv_player" value="<?php echo $player ?>" <?php echo $checked ?>/> <?php echo $data['name'] ?> / <?php echo $data['license'] ?>
					<br />
				<?php endforeach; ?>
			</td>
			<td><?php _e_xve('Pick a Media Player for FLV embedding.') ?></td>
		</tr>
		<?php endif; ?>
	</tbody>
	</table>
	<br />
	<?php endforeach; ?>
	<?php
	foreach ($specifics as $specific)
	{
		echo $specific;
	}
	?>
</div>
