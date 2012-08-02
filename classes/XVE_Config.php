<?php if (defined('IN_XVE') !== TRUE) exit(255);
/**
 * @author SaltwaterC
 * @link https://github.com/SaltwaterC/XVE-Various-Embed
 * @license GPL v3.0
 */
final class XVE_Config {
	
	private $version = '1.0.3';
	private $option  = 'XVE_Various_Embed';
	private $domain  = 'xve';
	
	private $types = array(
		'video',
		'audio',
		'image',
	);
	
	private $special_types = array(
		'swf',
		'flv',
	);
	
	private $video = array(
		'youtube.com'      => array(
			'match'        => 'v=([a-zA-Z0-9\_\-]{11})',
			'capture'      => 1,
			'result'       => 'http://www.youtube.com/v/%1%?fs=1&hd=1&version=3&modestbranding=1',
		),
		
		'youtu.be'         => array(
			'match'        => '^\/([a-zA-Z0-9\_\-]{11})',
			'capture'      => 1,
			'result'       => 'http://www.youtube.com/v/%1%?fs=1&hd=1&version=3&modestbranding=1',
		),
		
		'metacafe.com'     => array(
			'match'        => 'watch\/(\d+\/[a-z0-9\_]+)',
			'capture'      => 1,
			'result'       => 'http://www.metacafe.com/fplayer/%1%.swf',
		),
		
		'dailymotion.com'  => array(
			'match'        => 'video\/([a-z0-9]{6})_?',
			'capture'      => 1,
			'result'       => 'http://www.dailymotion.com/swf/video/%1%?additionalInfos=0',
		),
		
		'revver.com'       => array(
			'match'        => 'video\/(\d+)',
			'capture'      => 1,
			'result'       => 'http://flash.revver.com/player/1.0/player.swf?mediaId=%1%',
		),
		
		'spike.com'        => array(
			'match'        => '^\/video\/(?:.*?\/)?(\d+)\??',
			'capture'      => 1,
			'result'       => 'http://media.mtvnservices.com/mgid:ifilm:video:spike.com:%1%',
		),
		
		'vimeo.com'        => array(
			'match'        => '\/(\d+)$',
			'capture'      => 1,
			'result'       => 'http://vimeo.com/moogaloop.swf?clip_id=%1%&server=vimeo.com&show_title=1&show_byline=1&show_portrait=1&color=00ADEF&fullscreen=1&autoplay=0&loop=0',
		),
		
		'livestream.com'   => array(
			'match'        => '(\w+)\??',
			'capture'      => 1,
			'result'       => 'http://cdn.livestream.com/grid/LSPlayer.swf?channel=%1%&autoPlay=false',
		),
		
		'capped.tv'        => array(
			array( // Legacy Capped.TV URL Syntax
				'match'    => '^\/playeralt\.php\?vid=([a-z0-9\-\_]+)&?',
				'capture'  => 1,
				'result'   => 'http://capped.micksam7.com/play.swf?vid=%1%',
			),
			
			array( // New Capped.TV URL Syntax
				'match'    => '^\/([a-z0-9\-\_]+(?:\|(?:hq|mq|lq))?)',
				'capture'  => 1,
				'result'   => 'http://capped.micksam7.com/play.swf?vid=%1%',
			),
		),
		
		'trilulilu.ro'     => array(
			'match'        => '^\/([a-zA-Z0-9]{3,15})\/([0-9a-f]{14})',
			'capture'      => 2,
			'result'       => 'http://embed.trilulilu.ro/video/%1%/%2%.swf?username=%1%&hash=%2%&color=0xeaeaea',
		),
		
		'220.ro'           => array(
			'match'        => '^\/.*?\/.*?\/([a-zA-Z0-9]{10})',
			'capture'      => 1,
			'result'       => 'http://www.220.ro/emb/%1%',
		),
		
		'collegehumor.com' => array(
			'match'        => '^\/video\:(\d+)',
			'capture'      => 1,
			'result'       => 'http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=%1%&fullscreen=1',
		),
		
		'myvideo.de'       => array(
			'match'        => '^\/watch\/(\d+)',
			'capture'      => 1,
			'result'       => 'http://www.myvideo.de/movie/%1%',
		),
		
		'snotr.com'        => array(
			'match'        => '^\/video\/(\d+)',
			'capture'      => 1,
			'result'       => 'http://www.snotr.com/player.swf?v6&video=%1%&embedded=true&autoplay=false&toolbar=false',
		),
		
		'gametrailers.com' => array(
			array( // New GameTrailers URL Syntax
				'match'    => '^\/video\/.*?\/(\d+)\??',
				'capture'  => 1,
				'result'   => 'http://media.mtvnservices.com/mgid:moses:video:gametrailers.com:%1%',
			),
			
			array( // New User Movie GameTrailers URL Syntax
				'match'    => '^\/user-movie\/.*?\/(\d+)\??',
				'capture'  => 1,
				'result'   => 'http://www.gametrailers.com/remote_wrap.php?umid=%1%',
			),
			
			array( // Legacy GameTrailers URL Syntax
				'match'    => '^\/player\/(\d+)\.html$',
				'capture'  => 1,
				'result'   => 'http://media.mtvnservices.com/mgid:moses:video:gametrailers.com:%1%',
			),
			
			array( // Legacy User Movie GameTrailers URL Syntax
				'match'    => '^\/player\/usermovies\/(\d+)\.html$',
				'capture'  => 1,
				'result'   => 'http://www.gametrailers.com/remote_wrap.php?umid=%1%',
			),
		),
		
		'blip.tv'          => array (
			'match'        => '-(\d+)$',
			'capture'      => 1,
			'result'       => 'http://a.blip.tv/scripts/flash/stratos.swf#file=http%3A%2F%2Fblip.tv%2Frss%2Fflash%2F%1%',
		),
	);
	
	private $audio = array(
		'trilulilu.ro'     => array(
			'match'        => '^\/([a-zA-Z0-9]{3,15})\/([0-9a-f]{14})',
			'capture'      => 2,
			'result'       => 'http://embed.trilulilu.ro/audio/%1%/%2%.swf?username=%1%&hash=%2%',
		),
		
		'220.ro'           => array(
			'match'        => '^\/.*?\/.*?\/([a-zA-Z0-9]{10})',
			'capture'      => 1,
			'result'       => 'http://www.220.ro/emb/%1%',
		),
	);
	
	private $image = array(
		'trilulilu.ro'     => array(
			'match'        => '^\/([a-zA-Z0-9]{3,15})\/([0-9a-f]{14})',
			'capture'      => 2,
			'result'       => 'http://embed.trilulilu.ro/jpg/%1%/%2%',
		),
	);
	
	/**
	 * Raw Flowplayer config:
	 * config => {'playlist':[IMG{'url':'URL','autoPlay':false,'scaling':'fit'}],'canvas':{'backgroundColor':'#000','backgroundGradient': 'none'}}
	 * img    => {'url':'IMG','scaling':'fit'},
	 */
	private $players = array(
		'flowplayer'  => array(
			'name'    => '<a target="_blank" href="http://flowplayer.org/">Flowplayer</a>',
			'license' => '<a target="_blank" href="http://www.gnu.org/licenses/gpl-3.0.html">GPL 3.0</a>',
			'config'  => 'config=%7B%27playlist%27%3A%5BIMG%7B%27url%27%3A%27URL%27%2C%27autoPlay%27%3Afalse%2C%27scaling%27%3A%27fit%27%7D%5D%2C%27canvas%27%3A%7B%27backgroundColor%27%3A%27%23000%27%2C%27backgroundGradient%27%3A+%27none%27%7D%7D',
			'img'     => '%7B%27url%27%3A%27IMG%27%2C%27scaling%27%3A%27fit%27%7D%2C',
		),
		
		'flvplayer'   => array(
			'name'    => '<a target="_blank" href="http://flv-player.net/">FLV Player</a>',
			'license' => '<a target="_blank" href="http://creativecommons.org/licenses/by-sa/3.0/">CC BY-SA 3.0</a> / <a href="http://www.mozilla.org/MPL/MPL-1.1.html">MPL 1.1</a>',
			'config'  => 'flv=URL&autoplay=0&autoload=0&volume=100&bgcolor1=4f4f4f&bgcolor2=4f4f4f&showstop=1&showvolume=1&showtime=2&showloading=always&showfullscreen=1&&ondoubleclick=fullscreen&shortcut=1&loadonstop=0&margin=4&showiconplay=1&iconplaybgalpha=50IMG',
			'img'     => '&startimage=IMG',
		),
		
		'jwplayer'    => array(
			'name'    => '<a target="_blank" href="http://www.longtailvideo.com/players/jw-flv-player/">JW Player</a>',
			'license' => '<a target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY-NC-SA 3.0</a>',
			'config'  => 'file=URLIMG',
			'img'     => '&image=IMG',
		),
	);
	
	private $default_config = array(
		
		'video'              => array(
			'width'          => '448',
			'height'         => '386',
		),
		
		'audio'              => array(
			'width'          => '448',
			'height'         => '46',
		),
		
		'image'              => array(
			'width'          => '448',
			'height'         => '386',
		),
		
		'swf'                => array(
			'width'          => '448',
			'height'         => '386',
		),
		
		'flv'                => array(
			'width'          => '448',
			'height'         => '386',
			'player'         => 'flowplayer',
		),
		
		'audio.trilulilu.ro' => array(
			'width'          => '448',
			'height'         => '80',
		),
		
	);
	
	private $validator = array(
		'flv_player' => 'players',
	);
	
	private $config    = array();
	private $all_types = array();
	
	final private function __construct()
	{
		// delete_option($this->option);
		add_option($this->option, $this->default_config);
		$this->config = get_option($this->option);
		$this->all_types = array_merge($this->types, $this->special_types);
	}
	
	/**
	 * @return XVE_Config
	 */
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
	
	public function __get($property)
	{
		if ( ! isset ($this->{$property}))
		{
			throw new Exception(__xve('Error:').' '.sprintf(__xve('undefined configuration entry %s.'), XVE_View::filter($property)));
		}
		return $this->{$property};
	}
	
	public function __isset($name)
	{
		return isset ($this->$name);
	}
	
} // End XVE_Config
