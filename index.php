<?php
/*
Plugin Name: XVE Various Embed
Plugin URI: https://github.com/SaltwaterC/XVE-Various-Embed
Description: XVE is a plug-in which embeds various content into your WordPress powered website. Check <a href="options-general.php?page=XVE_Admin.php">Settings &raquo; XVE</a> for configuration.
Version: 1.0.4
Author: SaltwaterC
Author URI: http://www.saltwaterc.eu/
License: GPL v3.0
*/

require dirname(__FILE__).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.'bootstrap.php';
if((function_exists('add_filter')) AND (function_exists('add_action')))
{
	/**
	 * Hook the translation support
	 */
	load_plugin_textdomain(XVE_Config::instance()->domain, FALSE, dirname(plugin_basename(__FILE__)).'/translate/');
	/**
	 * A high priority filter as in production other filters proved to
	 * corrupt its input
	 *
	 * (tag, callback, priority)
	 */
	add_filter('the_content', array('XVE_Embed', 'filter'), 1);
	add_filter('the_excerpt', array('XVE_Embed', 'filter'), 1);
	/**
	 * Plug in the Admin Panel
	 */
	add_action('admin_menu', array('XVE_Admin', 'panel'));
	/**
	 * Plug in the AJAX Admin Support
	 */
	add_action('wp_ajax_xve_save_options', array(XVE_Admin::instance(), 'xve_save_options'));
}
else // probably you shouldn't be here ...
{
	exit(255);
}
