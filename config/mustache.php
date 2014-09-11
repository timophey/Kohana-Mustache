<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
		//'template_class_prefix' => '__MyTemplates_',
		'cache' => APPPATH.'/cache/mustache',
		'cache_file_mode' => 0666, // Please, configure your umask instead of doing this :)
		'cache_lambda_templates' => true,
		'loader'=> new Mustache_Loader_FilesystemLoader(APPPATH.'views'),
		//'partials_loader' => new Mustache_Loader_FilesystemLoader(APPPATH.'views'), // the same as [loader] by default
    //'helpers' => array('i18n' => function($text) {
        // do something translatey here...
    //}),
    //'escape' => function($value) {
    //    return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    //},
    //'charset' => 'ISO-8859-1',
    //'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
    //'strict_callables' => true,
    //'pragmas' => [Mustache_Engine::PRAGMA_FILTERS],
);
