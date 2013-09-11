<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Statistics {
	public function log_activity() {
		// We need an instance of CI as we will be using some CI classes
		$CI = &get_instance();
		$CI -> load -> library(array("session", "my_auth"));
		// Start off with the session stuff we know
		$data = array();
		$data['user_id'] = $CI -> session -> userdata('user_id');
		$data['username'] = $CI -> session -> userdata('username');

		// Next up, we want to know what page we're on, use the router class
		$data['section'] = $CI -> router -> class;
		$data['action'] = $CI -> router -> method;

		// set time zone
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		// Lastly, we need to know when this is happening
		$today = date("Y-m-d H:i:s");
		$data['when'] = $today;

		// We don't need it, but we'll log the URI just in case
		$data['uri'] = uri_string();

		// And write it to the database
		//$CI->db->insert('statistics', $data);

		$xau = $data['user_id'] . "-" . $data['username'] . "-" . $data['action'] . "-" . $data['section'] . "-" . $data['when'] . "\n";

		$filename = "log/" . date('Y-m-d') . ".txt";

		if (file_exists($filename)) {
			file_put_contents($filename, $xau, FILE_APPEND | LOCK_EX);
		} else {

			$fp = fopen($filename, 'w') or die("Couldn't open $filename for writing!");
			fwrite($fp, $xau) or die("Couldn't write values to file!");
			fclose($fp);
		}
	}

}
