<?php if (defined('IN_XVE') !== TRUE) exit(255);
/**
 * @author SaltwaterC
 * @link https://github.com/SaltwaterC/XVE-Various-Embed
 * @license GPL v3.0
 */
class XVE_View {
	
	private $view, $data;
	
	/**
	 * @return XVE_View 
	 */
	public static function factory($view, $data = array())
	{
		return new self($view, $data);
	}
	
	public function __construct($view, $data = array())
	{
		$this->view = $view;
		$this->data = $data;
	}
	
	public function render()
	{
		ob_start();
		extract($this->data, EXTR_SKIP);
		
		$view = dirname(__FILE__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$this->view.'.php';
		if ( ! is_file($view))
		{
			throw new Exception(__xve('Error:').' '.__xve('invalid view.'));
		}
		require $view;
		
		return ob_get_clean();
	}
	
	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (Exception $e)
		{
			return $e->getMessage();
		}
	}
	
	public static function filter($text)
	{
		return htmlentities($text, ENT_QUOTES, 'UTF-8');
	}
	
} // End XVE_View