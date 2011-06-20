<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>

<p>
	<?php printf(__xve('<strong>Usage mode:</strong> [service-type]http://example.com/permalink[/service-type], where the service-type is one of the following: %s. The URL must point to either an external service, or to a SWF / FLV / MP4 file.'), implode(', ', $all_types)) ?>
</p>
<p>
	<?php _e_xve("<strong>Real world example:</strong> [<strong>video</strong>]http://www.youtube.com/watch?v=QUy60AGnpfE[/<strong>video</strong>]. All the video services use the video tag, all the audio services use the audio tag, etc. The support for the old-style tags (if you're an old <a href='http://wordpress.org/extend/plugins/xhtml-video-embed/' target='_blank'>XHTML Video Embed user</a>) is enabled, but it's not recommended to use the old tags. The legacy support is present just to make this plug-in to be a drop-in replacement for XHTML Video Embed.") ?>
</p>
<p>
	<?php _e_xve('<strong>Tag attributes:</strong> width, height, player, image. Shorthand attributes: w, h, img (for width, height, image).') ?>
</p>
<p>
	<?php printf(__xve('<strong>Attributes example:</strong> [flv <strong>width</strong>=640 <strong>height</strong>=480 <strong>player</strong>=jwplayer <strong>image</strong>=http://example.com/path/to/file.png]http://example.com/path/to/file.flv[/flv]. Width and height are supported by all the embedding types. "player" is a special keyword for overriding the default media player if the type is "flv". The supported media players are: %s. In order to use them, you must specify these compact names for each player: %s. The "image" keyword provides a method for specifying a splash image for the FLV player. This syntax is the same for all the supported players. You may use single / double quotes for the attributes. width="640" is valid syntax, for example. If the image path contain spaces, the input must be URL-encoded. %%20 is the URL encoding for the space char.'), implode(', ', $player_names), implode(', ', $player_short_names)) ?>
</p>
<?php foreach ($types as $type) : ?>
<p>
	<?php printf(__xve('<strong>Supported %s services: </strong> %s'), $type, implode(', ', $services[$type])) ?>
</p>
<?php endforeach; ?>
