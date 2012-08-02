<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>
<object type="application/x-shockwave-flash" style="width:<?php echo $width ?>px;height:<?php echo $height ?>px" data="<?php echo $url ?>">
	<param name="allowfullscreen" value="true" />
	<param name="allowscriptaccess" value="never" />
	<param name="quality" value="best" />
	<param name="wmode" value="opaque" />
	<param name="movie" value="<?php echo $url ?>" />
	<param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" />
<?php echo $noflash ?>
</object>