<?php
define('IN_XVE', TRUE);

$class_directory = dirname(__FILE__).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR;
function __autoload_xve($class)
{
	global $class_directory;
	$class = $class_directory.$class.'.php';
	if (is_file($class))
	{
		require $class;
	}
	else
	{
		echo sprintf("Fatal: Class %s not found.", htmlentities($class, ENT_QUOTES, 'UTF-8'));
		exit(255);
	}
}
spl_autoload_register('__autoload_xve');

/**
 * Mock the XVE I18N WP functions wrappers
 */
function __xve($text)
{
	return $text;
}

function _e_xve($text)
{
	echo $text;
}

/**
 * Mock WordPress functions
 */
function add_option($option, $value) {}

function get_option($option)
{
	return array();
}
