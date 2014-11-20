<?php defined('SYSPATH') or die('No direct script access.');

class View extends Kohana_View{
	
	static protected $kohanaVariables_ = null;
	protected $_tmpl;

	public function set_filename($file) {
		$mustacheFile = Kohana::find_file('views', $file, 'mustache');
		// If there's no mustache file by that name, do the default:
		if ($mustacheFile === false) return Kohana_View::set_filename($file);
		
		$this->_file = $mustacheFile;
		$this->_tmpl = $file;

		return $this;
		}

	protected static function kohanaVariables() {
		if (self::$kohanaVariables_) return self::$kohanaVariables_;
		
		self::$kohanaVariables_ = array(
			'DOCROOT' => DOCROOT,
			'APPPATH' => APPPATH,
			'MODPATH' => MODPATH,
			'SYSPATH' => SYSPATH,
			'baseUrl' => Kohana::$base_url,
		);
		
		return self::$kohanaVariables_;
	}
	public function render($file = NULL)
	{
   if ($file !== NULL)
   {
       $this->set_filename($file);
   }
   if (empty($this->_file))
   {
       throw new View_Exception('You must set the file to use within your view before rendering');
   }
   $extension = pathinfo($this->_file, PATHINFO_EXTENSION);
   if($extension == 'mustache') $this->_file = $this->_tmpl;
   // Combine local and global data and capture the output
   return View::capture($this->_file, $this->_data, $extension);
	}

	protected static function capture($kohana_view_filename, array $kohana_view_data) {
		$extension = func_get_args()[2]; // is mustache ?
		// If it's not a mustache file, do the default:
		if ($extension == 'php') return Kohana_View::capture($kohana_view_filename, $kohana_view_data);
		// continue
		$vars = Arr::merge(self::kohanaVariables(), View::$_global_data);
		$vars = Arr::merge($vars, $kohana_view_data);
		$conf = Kohana::$config->load('mustache')->as_array();
		$mustache = new Mustache_Engine($conf);
		$tpl = $mustache->loadTemplate($kohana_view_filename);
		return $tpl->render($vars);
	}
	
	public function as_array(){
		$data = [];
		foreach($this->_data as $key=>$item){
			$data[$key] = is_object($item) ?  false : $item;//((method_exists($item,'as_array'))?$item->as_array():$item->render())
			}
		return $this->_data;
		}

}
