<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>

<h3><?php printf(__xve('%s Specific Options'), ucfirst($type)) ?></h3>

<table class="widefat fixed" cellspacing="0">
<thead>
	<tr>
		<th width="20%"><?php _e_xve('Domain') ?></th>
		<th width="10%"><?php _e_xve('Enabled') ?></th>
		<th width="15%"><?php _e_xve('Specific Width') ?></th>
		<th><?php _e_xve('Specific Height') ?></th>
	</tr>
</thead>
<tbody>
	<?php foreach ($services as $domain => $domain_config) : ?>
	<?php
	$key = $type.'.'.$domain;
	
	if ( ! isset($config[$key]['disabled']) OR $config[$key]['disabled'] !== TRUE)
	{
		$enabled = 'checked="checked" ';
	}
	else
	{
		$enabled = '';
	}

	if (isset ($config[$key]['width']))
	{
		$width = $config[$key]['width'];
	}
	else
	{
		$width = $config[$type]['width'];
	}

	if (isset ($config[$key]['height']))
	{
		$height = $config[$key]['height'];
	}
	else
	{
		$height = $config[$type]['height'];
	}
	?>
	<tr>
		<td><?php echo $domain ?></td>
		<?php $domain = str_replace('.', '_', $domain) ?>
		<td id="parent_<?php echo $type ?>_disabled_<?php echo $domain ?>">
			<input type="checkbox" id="<?php echo $type ?>_disabled_<?php echo $domain ?>" onclick="xve.save_box(this.id)" <?php echo $enabled ?>/>
		</td>
		<td id="parent_<?php echo $type ?>_width_<?php echo $domain ?>">
			<input type="text" id="<?php echo $type ?>_width_<?php echo $domain ?>" onclick="xve.save_text(this.id)" onfocus="xve.save_text(this.id)" value="<?php echo $width ?>" />
		</td>
		<td id="parent_<?php echo $type ?>_height_<?php echo $domain ?>">
			<input type="text" id="<?php echo $type ?>_height_<?php echo $domain ?>" onclick="xve.save_text(this.id)" onfocus="xve.save_text(this.id)" value="<?php echo $height ?>" />
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
