<?php if (defined('IN_XVE') !== TRUE) exit(255);
/**
 * @author SaltwaterC
 * @link https://github.com/SaltwaterC/XVE-Various-Embed
 * @license GPL v3.0
 */
final class XVE_Admin {
	
	private $config;
	
	final private function __construct()
	{
		$this->config = XVE_Config::instance();
	}
	
	public static function instance()
	{
		static $instance;
		if (($instance instanceof self) !== TRUE)
		{
			$instance = new self();
		}
		return $instance;
	}
	
	final private function __clone() {}
	
	public static function panel()
	{
		$hook = add_options_page(
			'XVE Dashboard',
			'XVE',
			10,
			'xve-various-embed',
			array(
				self::instance(),
				'dashboard',
			)
		);
		
		add_contextual_help($hook, self::instance()->help());
	}
	
	public function dashboard()
	{
		$specifics = array();
		$types = $this->config->types;
		foreach ($types as $type)
		{
			$specifics[] = XVE_View::factory(
				'specific',
				array(
					'config'   => $this->config->config,
					'type'     => $type,
					'services' => $this->config->$type,
				)
			);
		}
		
		echo XVE_View::factory(
			'dashboard',
			array(
				'xve_js'    => XVE_View::factory('xve.js'),
				'config'    => $this->config->config,
				'players'   => $this->config->players,
				'version'   => $this->config->version,
				'types'     => $this->config->all_types,
				'specifics' => $specifics,
			)
		);
	}
	
	public function help()
	{
		$player_names = array();
		$player_short_names = array();
		foreach ($this->config->players as $player => $meta)
		{
			$player_names[] = $meta['name'];
			$player_short_names[] = $player;
		}
		
		$services = array();
		foreach ($this->config->types as $type)
		{
			$domains = array();
			foreach ($this->config->{$type} as $domain => $stuff)
			{
				$domains[] = $domain;
			}
			$services[$type] = $domains;
		}
		
		return XVE_View::factory(
			'help',
			array(
				'types'              => $this->config->types,
				'services'           => $services,
				'all_types'          => $this->config->all_types,
				'player_names'       => $player_names,
				'player_short_names' => $player_short_names,
			)
		);
	}
	
	public function xve_save_options()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if (isset ($_POST['action']) AND $_POST['action'] == 'xve_save_options'
					AND isset ($_POST['type']) AND isset ($_POST['config_id']))
			{
				/**
				 * I'd attach the db write event to the destructor of config,
				 * but WordPress fails in wp-includes/cache.php. WTF?
				 */
				$config = $this->config->config;
				switch ($_POST['type'])
				{
					case 'checkbox':
						if (isset ($_POST['value']))
						{
							$value = ! (bool) $_POST['value'];
							list ($type, $disable, $domain, $tld) = explode('_', $_POST['config_id']);
							
							if (isset ($domain) AND isset ($tld)) // Domain Setting
							{
								$key = $this->validate_domain($type, $domain.'.'.$tld);
							}
							else // Global Setting
							{
								$key = $type;
							}
							
							if ($value)
							{
								$config[$key][$disable] = $value;
							}
							else
							{
								unset ($config[$key][$disable]);
								if (sizeof($config[$key]) === 0)
								{
									unset ($config[$key]);
								}
							}
							
							$this->update_config($config);
						}
					break;
					
					case 'text':
						list ($type, $option, $domain, $tld) = explode('_', $_POST['config_id']);
						
						if (in_array($type, $this->config->all_types) AND ($option == 'width' OR $option == 'height'))
						{
							if (isset ($domain) AND isset ($tld)) // Domain Setting
							{
								$key = $this->validate_domain($type, $domain.'.'.$tld);
								$value = XVE_Embed::intval($_POST['value'], $type, $option);
								$default_value = $this->config->default_config[$type][$option];
								
								if ($value == $default_value)
								{
									unset ($config[$key][$option]);
									if (sizeof($config[$key]) === 0)
									{
										unset ($config[$key]);
									}
								}
								else
								{
									$config[$key][$option] = $value;
								}
							}
							else // Global Setting
							{
								$config[$type][$option] = XVE_Embed::intval($_POST['value'], $type, $option);
							}
							
							$this->update_config($config, $value);
						}
					break;
					
					case 'radio':
						if (isset ($_POST['value']))
						{
							if (isset ($this->config->validator[$_POST['config_id']]))
							{
								$key = $this->config->validator[$_POST['config_id']];
								if (isset ($this->config->{$key}[$_POST['value']]))
								{
									list ($type, $option) = explode('_', $_POST['config_id']);
									$config[$type][$option] = $_POST['value'];
									$this->update_config($config, $value);
								}
							}
						}
					break;
				}
			}
		}
		
		$this->update_fail();
	}
	
	private function validate_domain($type, $domain)
	{
		if ( ! isset ($this->config->{$type}[$domain]))
		{
			$this->update_fail();
		}
		return $type.'.'.$domain;
	}
	
	private function update_config($config)
	{
		if ( ! update_option($this->config->option, $config))
		{
			$this->update_fail();
		}
		else
		{
			$this->update_sucess();
		}
	}
	
	private function update_sucess()
	{
		echo json_encode(array('status' => 'success'));
		exit (0);
	}
	
	private function update_fail()
	{
		echo json_encode(array('status' => 'fail'));
		exit (1);
	}
	
} // End XVE_Admin