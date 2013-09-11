<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class My_Log{

    function __construct()
    {
        //parent::__construct();
    }
    public function write_log($vPath) {
		$message = 'Something happened in my script..';
		$timestamp = date('d/m/Y H:i:s');
		$log_file = $vPath.'\my_script.log';

		error_log('[' . $timestamp . '] INFO: ' . $message . PHP_EOL, 3, $log_file);
	}
}