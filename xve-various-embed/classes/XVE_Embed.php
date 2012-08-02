<?php if (defined('IN_XVE') !== TRUE) exit(255);
/**
 * @author SaltwaterC
 * @link https://github.com/SaltwaterC/XVE-Various-Embed
 * @license GPL v3.0
 */
class XVE_Embed {
	
	// can haz lookup table for legacy support
	private static $map = array(
		'youtube'       => 'video',
		'google-video'  => 'video',
		'metacafe'      => 'video',
		'trilu-video'   => 'video',
		'trilu-audio'   => 'audio',
		'trilu-image'   => 'image',
		'trilu-imagine' => 'image',
		'dailymotion'   => 'video',
		'revver'        => 'video',
		'spike'         => 'video',
		'vimeo'         => 'video',
		'jumpcut'       => 'video',
		'capped'        => 'video',
		'gametrailers'  => 'video',
		'collegehumor'  => 'video',
		'myvideo'       => 'video',
		'snotr'         => 'video',
	);
	
	private static $config;
	
	public static function filter($content = NULL)
	{
		if (strpos($content, '[') !== FALSE)
		{
			$config = XVE_Config::instance();
			self::$config = $config->config;
			$size = 0;
			$types_expression = implode('|', $config->all_types);
			
			preg_match_all('/\[('.$types_expression.'|youtube|metacafe|trilu-video|trilu-audio|trilu-image|trilu-imagine|dailymotion|revver|spike|vimeo|jumpcut|capped|gametrailers|collegehumor|myvideo|snotr)(.*?)?\](.*?)\[\/(?:'.$types_expression.'|youtube|metacafe|trilu-video|trilu-audio|trilu-image|trilu-imagine|dailymotion|revver|spike|vimeo|jumpcut|capped|gametrailers|collegehumor|myvideo|snotr)\]/', $content, $matches);
			list ($all, $types, $attribs, $urls) = $matches;
			
			if (sizeof($matches) === 4)
			{
				$size = sizeof($matches[0]);
				
				for ($i = 0; $i < $size; $i++)
				{
					if ( ! in_array($types[$i], $config->all_types))
					{
						// fix the type for the new system
						$types[$i] = self::$map[$types[$i]];
					}
					
					$content = self::embed($content, $all[$i], $types[$i], trim($attribs[$i]), $urls[$i]);
				}
			}
		}
		
		return $content;
	}
	
	public static function embed($content, $match, $type, $attrib, $url)
	{
		switch ($type)
		{
			case 'video':
			case 'audio':
			case 'image':
				try
				{
					$conversion = XVE_URL_Toolkit::convert_from_url($url, $type);
				}
				catch (Exception $e)
				{
					return '<!-- XVE Error: '.$e->getMessage().' -->';
				}
			break;
			
			default:
				$conversion['url'] = $url; // nothing to convert
			break;
		}
		
		$key = $type.'.'.$conversion['domain'];
		if ((isset (self::$config[$type]['disabled']) AND self::$config[$type]['disabled'] === TRUE) OR (isset (self::$config[$key]['disabled']) AND self::$config[$key]['disabled'] === TRUE))
		{
			$replace = '<a href="'.$url.'">'.$url.'</a>';
		}
		else
		{
			$replace = self::object($conversion, $type, $attrib);
		}
		
		return str_replace($match, $replace, $content);
	}
	
	public static function object($conversion, $type, $attrib)
	{
		if (strlen($attrib) > 0) // We have attrib
		{
			$attrib = preg_replace('/\s+/', ' ', $attrib);
			$attrib = str_replace('"', '', $attrib);
			$attrib = str_replace("'", '', $attrib);
			$attrib = str_replace(' ', '&', $attrib);
			parse_str($attrib, $parsed_attrib);
			
			$width = 0;
			$height = 0;
			
			if (isset ($parsed_attrib['width']))
			{
				$width = $parsed_attrib['width'];
			}
			
			if (isset ($parsed_attrib['w']))
			{
				$width = $parsed_attrib['width'];
			}
			
			if (isset ($parsed_attrib['height']))
			{
				$height = $parsed_attrib['height'];
			}
			
			if (isset ($parsed_attrib['h']))
			{
				$height = $parsed_attrib['h'];
			}
			
			// The user may fuck these up
			$parsed_attrib['width'] = self::intval($width, $type, 'width');
			$parsed_attrib['height'] = self::intval($height, $type, 'height');
		}
		else // Fetch from self::$config
		{
			$key = $type.'.'.$conversion['domain'];
			
			if (isset (self::$config[$key]['width']))
			{
				$parsed_attrib['width'] = self::$config[$key]['width'];
			}
			else
			{
				$parsed_attrib['width'] = self::$config[$type]['width'];
			}
			
			if (isset (self::$config[$key]['height']))
			{
				$parsed_attrib['height'] = self::$config[$key]['height'];
			}
			else
			{
				$parsed_attrib['height'] = self::$config[$type]['height'];
			}
		}
		
		if ($type == 'flv')
		{
			$conversion['url'] = self::get_player($conversion['url'], $parsed_attrib);
		}
		
		$data = array(
			'width'   => $parsed_attrib['width'],
			'height'  => $parsed_attrib['height'],
			'url'     => $conversion['url'],
			'noflash' => __xve('If you can see this, then you might need a Flash Player upgrade or you need to install Flash Player if it\'s missing. Get <a href="http://get.adobe.com/flashplayer/">Flash Player</a> from Adobe. This error may appear if the URL path to the embedded object is broken or you have connectivity issue to the embedded object. <a href="https://github.com/SaltwaterC/XVE-Various-Embed">Powered BY XVE Various Embed</a>.'),
		);
		
		if ( ! is_feed())
		{
			$view = 'object';
		}
		else
		{
			$view = 'object.feed';
		}
		
		return XVE_View::factory($view, $data)->render();
	}
	
	public static function intval($val, $type, $unit)
	{
		$val = preg_replace('/[^\d]/', '', $val);
		if (empty($val))
		{
			// Fetch from self::$config instead
			// The user certainly fucked this up
			$val = self::$config[$type][$unit];
		}
		return $val;
	}
	
	public static function get_player($url, $parsed_attrib)
	{
		$player = self::$config['flv']['player'];
		$players = XVE_Config::instance()->players;
		
		if (isset ($parsed_attrib['player']) AND ! empty ($parsed_attrib['player']))
		{
			if (isset ($players[$parsed_attrib['player']]))
			{
				$player = $parsed_attrib['player'];
			}
		}
		
		// Fix it for Windows. It's 20-fucking-11 and we still have to write code to fix Windows-style paths.
		$path = str_replace('\\', '/', dirname(__FILE__));
		preg_match('/(wp-content.*?)classes$/iD', $path, $path);
		$path = get_option('home').'/'.$path[1].'players/'.$player.'.swf?';
		
		$config = str_replace('URL', $url, $players[$player]['config']);
		
		$img = '';
		
		if (isset ($parsed_attrib['img']) AND ! empty($parsed_attrib['img']))
		{
			$img = str_replace('IMG', $parsed_attrib['img'], $players[$player]['img']);
		}
		
		if (isset ($parsed_attrib['image']) AND ! empty($parsed_attrib['image']))
		{
			$img = str_replace('IMG', $parsed_attrib['image'], $players[$player]['img']);
		}
		
		$config = str_replace('IMG', $img, $config);
		
		return $path.$config;
	}
	
} // End XVE_Embed