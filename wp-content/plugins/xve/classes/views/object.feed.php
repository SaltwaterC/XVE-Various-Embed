<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>
<object width="<?php echo $width ?>" height="<?php echo $height ?>">
	<param name="movie" value="<?php echo $url ?>"></param>
	<param name="allowFullScreen" value="true"></param>
	<param name="allowscriptaccess" value="none"></param>
	<embed src="<?php echo $url ?>" type="application/x-shockwave-flash" allowscriptaccess="none" allowfullscreen="true" width="<?php echo $width ?>" height="<?php echo $height ?>"></embed>
</object>