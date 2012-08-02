<?php
/**
 * Tried to implement an autoloaded that plays nicely with both WordPress and 
 * phpUnit. It seems that it's either too complicated or impossible to go around
 * the WordPress's retartded autoloader that requires rocket scientists to
 * append something to the SPL autload stack in order to avoid autoloading
 * exceptions. This is fucking dandy!
 * 
 * PS: I hope one day I can drop all the XVE prefix in favor of a good old
 * namespace, but since people are still nostalgic about PHP 5.2.x, I won't kill
 * the support for 5.2.x right now.
 */

define('IN_XVE', TRUE);
$directory = dirname(__FILE__).DIRECTORY_SEPARATOR;
require $directory.'XVE_Config.php';
require $directory.'XVE_View.php';
require $directory.'XVE_Admin.php';
require $directory.'XVE_Embed.php';
require $directory.'XVE_URL_Toolkit.php';

function __xve($text)
{
	return __($text, XVE_Config::instance()->domain);
}

function _e_xve($text)
{
	_e($text, XVE_Config::instance()->domain);
}
