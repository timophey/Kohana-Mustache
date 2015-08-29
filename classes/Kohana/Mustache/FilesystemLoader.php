<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Mustache_FilesystemLoader extends Mustache_Loader_FilesystemLoader{

	private $extension = '.mustache';
	
    /**
     * Helper function for getting a Mustache template file name.
     *
     * @param string $name
     *
     * @return string Template file name
     */
    protected function getFileName($name)
    {
        $fileName = Kohana::find_file('views', $name, substr($this->extension,1));//
        if($fileName === false)
					throw new Kohana_View_Exception('The requested view :file could not be found', array(
							':file' => $file,
					));
        return $fileName;
    }
	
	}
