<?php if (defined('IN_XVE') !== TRUE) exit(255);
/**
 * The URL Toolkit class contains methods for converting an URL to an embedable
 * URL. This is a general purpose implementation, able to convert any type of
 * URL to any type of URL based on a specified type and domain name, but is
 * configured for the embedable URL purposes. Its functionality is extendable
 * transparently via the configuration object. You mau use it as general purpose
 * URL conversion library if you remove my embedded phpunit tests and you write
 * your own configuration object.
 * 
 * @author SaltwaterC
 * @link https://github.com/SaltwaterC/XVE-Various-Embed
 * @license GPL v3.0
 */
class XVE_URL_Toolkit {
	
	/**
	 * Convers the URL to an embedable URL. Returns the domain name as well.
	 * 
	 * @param string $url
	 * @param string $type
	 * @return array
	 * 
	 * // youtube.com //
	 * @assert ('http://www.youtube.com/watch?v=QUy60AGnpfE', 'video') == array('domain' => 'youtube.com', 'url' => 'http://www.youtube.com/v/QUy60AGnpfE?fs=1&hd=1&version=3&modestbranding=1')
	 * @assert ('http://www.youtube.com/watch?v=QUy60AGnpfE&fmt=34', 'video') == array('domain' => 'youtube.com', 'url' => 'http://www.youtube.com/v/QUy60AGnpfE?fs=1&hd=1&version=3&modestbranding=1')
	 * 
	 * // youtu.be //
	 * @assert ('http://youtu.be/QUy60AGnpfE', 'video') == array('domain' => 'youtu.be', 'url' => 'http://www.youtube.com/v/QUy60AGnpfE?fs=1&hd=1&version=3&modestbranding=1')
	 * 
	 * // metacafe.com //
	 * @assert ('http://www.metacafe.com/watch/5040838/cards_out_fight_reds/', 'video') == array('domain' => 'metacafe.com', 'url' => 'http://www.metacafe.com/fplayer/5040838/cards_out_fight_reds.swf')
	 * 
	 * // dailymotion.com //
	 * @assert ('http://www.dailymotion.com/us/cluster/auto/featured/video/x4g5zc', 'video') == array('domain' => 'dailymotion.com', 'url' => 'http://www.dailymotion.com/swf/video/x4g5zc?additionalInfos=0')
	 * @assert ('http://www.dailymotion.com/video/x4g5zc_rolex-24-hours-of-daytona-2008-epis_auto', 'video') == array('domain' => 'dailymotion.com', 'url' => 'http://www.dailymotion.com/swf/video/x4g5zc?additionalInfos=0')
	 * 
	 * // revver.com //
	 * @assert ('http://revver.com/video/268495/hows-my-driving/', 'video') == array('domain' => 'revver.com', 'url' => 'http://flash.revver.com/player/1.0/player.swf?mediaId=268495')
	 * 
	 * // spike.com //
	 * @assert ('http://www.spike.com/video/2881456', 'video') == array('domain' => 'spike.com', 'url' => 'http://media.mtvnservices.com/mgid:ifilm:video:spike.com:2881456')
	 * @assert ('http://www.spike.com/video/30-second-hot-chick/2881456', 'video') == array('domain' => 'spike.com', 'url' => 'http://media.mtvnservices.com/mgid:ifilm:video:spike.com:2881456')
	 * 
	 * // vimeo.com //
	 * @assert ('http://www.vimeo.com/1084537', 'video') == array('domain' => 'vimeo.com', 'url' => 'http://vimeo.com/moogaloop.swf?clip_id=1084537&server=vimeo.com&show_title=1&show_byline=1&show_portrait=1&color=00ADEF&fullscreen=1&autoplay=0&loop=0')
	 * 
	 * // livestream.com //
	 * @assert ('http://www.livestream.com/teamcoco', 'video') == array('domain' => 'livestream.com', 'url' => 'http://cdn.livestream.com/grid/LSPlayer.swf?channel=teamcoco&autoPlay=false')
	 * 
	 * // capped.tv //
	 * @assert ('http://capped.tv/fairlight-panic_room', 'video') == array('domain' => 'capped.tv', 'url' => 'http://capped.micksam7.com/play.swf?vid=fairlight-panic_room')
	 * @assert ('http://capped.tv/fairlight-panic_room|hq', 'video') == array('domain' => 'capped.tv', 'url' => 'http://capped.micksam7.com/play.swf?vid=fairlight-panic_room|hq')
	 * @assert ('http://capped.tv/fairlight-panic_room|mq', 'video') == array('domain' => 'capped.tv', 'url' => 'http://capped.micksam7.com/play.swf?vid=fairlight-panic_room|mq')
	 * @assert ('http://capped.tv/fairlight-panic_room|lq', 'video') == array('domain' => 'capped.tv', 'url' => 'http://capped.micksam7.com/play.swf?vid=fairlight-panic_room|lq')
	 * @assert ('http://capped.tv/playeralt.php?vid=fairlight-panic_room', 'video') == array('domain' => 'capped.tv', 'url' => 'http://capped.micksam7.com/play.swf?vid=fairlight-panic_room')
	 * 
	 * // trilulilu.ro //
	 * @assert ('http://www.trilulilu.ro/SaltwaterC/54fcf02ed330bd', 'video') == array('domain' => 'trilulilu.ro', 'url' => 'http://embed.trilulilu.ro/video/SaltwaterC/54fcf02ed330bd.swf?username=SaltwaterC&hash=54fcf02ed330bd&color=0xeaeaea')
	 * @assert ('http://www.trilulilu.ro/ambro/26129477a2da0c', 'audio') == array('domain' => 'trilulilu.ro', 'url' => 'http://embed.trilulilu.ro/audio/ambro/26129477a2da0c.swf?username=ambro&hash=26129477a2da0c')
	 * @assert ('http://www.trilulilu.ro/SaltwaterC/1c4693d5217706', 'image') == array('domain' => 'trilulilu.ro', 'url' => 'http://embed.trilulilu.ro/jpg/SaltwaterC/1c4693d5217706')
	 * 
	 * // 220.ro //
	 * @assert ('http://www.220.ro/funny/All-Rocky-Movies-In-5-Seconds/Uec4da3zWk/?rel=related', 'video') == array('domain' => '220.ro', 'url' => 'http://www.220.ro/emb/Uec4da3zWk')
	 * @assert ('http://www.220.ro/muzica/hip-hop/Parazitii-Pabibabum/auV6aw4MFC/', 'audio') == array('domain' => '220.ro', 'url' => 'http://www.220.ro/emb/auV6aw4MFC')
	 * 
	 * // collegehumor.com //
	 * @assert ('http://www.collegehumor.com/video:1795924', 'video') == array('domain' => 'collegehumor.com', 'url' => 'http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=1795924&fullscreen=1')
	 * 
	 * // myvideo.de //
	 * @assert ('http://www.myvideo.de/watch/7859059/Anmache_am_Strand', 'video') == array('domain' => 'myvideo.de', 'url' => 'http://www.myvideo.de/movie/7859059')
	 * 
	 * // snotr.com //
	 * @assert ('http://www.snotr.com/video/6547/HydroBOB', 'video') == array('domain' => 'snotr.com', 'url' => 'http://www.snotr.com/player.swf?v6&video=6547&embedded=true&autoplay=false&toolbar=false')
	 * 
	 * // gametrailers.com //
	 * @assert ('http://www.gametrailers.com/video/gc-2008-starcraft-ii/39088', 'video') == array('domain' => 'gametrailers.com', 'url' => 'http://media.mtvnservices.com/mgid:moses:video:gametrailers.com:39088')
	 * @assert ('http://www.gametrailers.com/player/39088.html', 'video') == array('domain' => 'gametrailers.com', 'url' => 'http://media.mtvnservices.com/mgid:moses:video:gametrailers.com:39088')
	 * @assert ('http://www.gametrailers.com/user-movie/e3-2008-livewire-the-conduit/245725', 'video') == array('domain' => 'gametrailers.com', 'url' => 'http://www.gametrailers.com/remote_wrap.php?umid=245725')
	 * @assert ('http://www.gametrailers.com/player/usermovies/245725.html', 'video') == array('domain' => 'gametrailers.com', 'url' => 'http://www.gametrailers.com/remote_wrap.php?umid=245725')
	 * 
	 * // blip.tv //
	 * @assert ('http://blip.tv/djangocon/secrets-of-postgresql-performance-5572403', 'video') == array('domain' => 'blip.tv', 'url' => 'http://a.blip.tv/scripts/flash/stratos.swf#file=http%3A%2F%2Fblip.tv%2Frss%2Fflash%2F5572403')
	 */
	public static function convert_from_url($url, $type)
	{
		$url_segments = self::get_url_segments($url);
		return array(
			'domain' => $url_segments['domain'],
			'url'    => self::convert_from_path($url_segments['domain'], $url_segments['path'], $type), 
		);
	}
	
	/**
	 * Returns the URL segments: domain and full path.
	 *
	 * @param string $url
	 * @return array
	 * 
	 * @assert ('http://example.com/') == array('domain' => 'example.com', 'path' => '/')
	 * @assert ('http://example.com/path') == array('domain' => 'example.com', 'path' => '/path')
	 * @assert ('http://example.com/path?query=input') == array('domain' => 'example.com', 'path' => '/path?query=input')
	 * @assert ('http://example.com/path?query=input#fragment') == array('domain' => 'example.com', 'path' => '/path?query=input#fragment')
	 */
	public static function get_url_segments($url)
	{
		$parsed = parse_url($url);
		if ( ! isset($parsed['host']))
		{
			$exception = __xve('Error:').' '. __xve('invalid domain specification into the URL.');
			throw new Exception($exception);
		}
		
		if (isset($parsed['query']) AND strlen($parsed['query']) > 0)
		{
			$parsed['query'] = '?'.$parsed['query'];
		}
		else
		{
			$parsed['query'] = '';
		}
		if ( ! isset($parsed['fragment']))
		{
			$parsed['fragment'] = '';
		}
		else
		{
			$parsed['fragment'] = '#'.$parsed['fragment'];
		}
		return array(
			'domain' => self::domain($parsed['host']),
			'path'   => $parsed['path'].$parsed['query'].$parsed['fragment'],
		);
	}

	
	/**
	 * Converts the data to an embedable URL.
	 *
	 * @param string $domain
	 * @param string $path
	 * @param string $type
	 * @return string
	 * 
	 * // this is useless since it's tested by self::convert_from_url() but it
	 * will make phpUnit STFU about having untested methods //
	 * @assert ('youtube.com', '/watch?v=QUy60AGnpfE', 'video') == 'http://www.youtube.com/v/QUy60AGnpfE?fs=1&hd=1&version=3&modestbranding=1'
	 */
	public static function convert_from_path($domain, $path, $type)
	{
		$type = strtolower($type);
		$invalid_url = __xve('Error:').' '.__xve('invalid embed URL.');
		$config = XVE_Config::instance();
		
		if ( ! isset ($config->$type))
		{
			throw new Exception(__xve('Error:').' '.sprintf(__xve('invalid type %s.'), XVE_View::filter($type)));
		}
		 
		if ( ! isset($config->{$type}[$domain]))
		{
			throw new Exception(__xve('Error:').' '.sprintf(__xve('invalid domain %s for the type %s.'), XVE_View::filter($domain), XVE_View::filter($type)));
		}
		
		$expressions = $config->{$type}[$domain];
		
		if (isset($expressions['match']))
		{
			preg_match('/'.$expressions['match'].'/iD', $path, $matches);
			for ($i = 1; $i <= $expressions['capture']; $i++)
			{
				if ( ! isset($matches[$i]))
				{
					throw new Exception($invalid_url);
				}
				$expressions['result'] = str_replace("%{$i}%", $matches[$i], $expressions['result']);
			}
			return $expressions['result'];
		}
		else
		{
			$alternatives = sizeof($expressions);
			for ($alternative = 0; $alternative < $alternatives; $alternative++)
			{
				$skip = FALSE;
				preg_match('/'.$expressions[$alternative]['match'].'/iD', $path, $matches);
				for ($i = 1; $i <= $expressions[$alternative]['capture']; $i++)
				{
					if ( ! isset($matches[$i]))
					{
						$skip = TRUE;
						break;
					}
					else
					{
						$expressions[$alternative]['result'] = str_replace("%{$i}%", $matches[$i], $expressions[$alternative]['result']);						
					}
				}
				
				if ($skip === FALSE)
				{
					return $expressions[$alternative]['result'];
				}
			}
			throw new Exception($invalid_url);
		}
	}
		
	/**
	 * Returns the domain name (in lowercase) for the specified HTTP host.
	 *
	 * @param string $host
	 * @return string
	 * 
	 * @assert ('example.com') == 'example.com'
	 * @assert ('www.example.com') == 'example.com'
	 * @assert ('level-2.level-1.example.com') == 'example.com'
	 */
	public static function domain($host)
	{
		if(filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === FALSE AND filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === FALSE)
		{
			preg_match('/((?:[\w]+)?\.[\w]+)\.?$/D', $host, $match);
			if (isset($match[1]))
				return strtolower($match[1]);
		}
		throw new Exception(__xve('Error:').' '.__xve('Invalid domain specification into the URL.'));
	}
	
} // End XVE_URL_Toolkit
