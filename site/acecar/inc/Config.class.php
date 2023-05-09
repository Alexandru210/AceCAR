<?php
date_default_timezone_set('Europe/Bucharest');
header('Content-type: text/html; charset=utf-8');

class Config {

	// init configuration Google Login
	public static $clientID = '709308979404-pgov7tabl2k9go6sf2au3a3tthvftid3.apps.googleusercontent.com';
	public static $clientSecret = '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';
	public static $redirectUri = 'https://localhost/acecar';

	private static $instance;

	public static $g_con;

	public static $_url = array();

	private static $_pages = array(

		'index', 'login', 'logout', 'adminpanel', 'offerlist'

	);

	public static $_PAGE_URL = 'https://localhost/acecar/';

	private function __construct() {

		$db['mysql'] = array(

			'host' 		=>	'localhost',

			'username' 	=> 	'root',

			'dbname' 	=> 	'acecar',

			'password' 	=> 	''

		);

		try {

			self::$g_con = new PDO('mysql:host='.$db['mysql']['host'].';dbname='.$db['mysql']['dbname'].';charset=utf8',$db['mysql']['username'],$db['mysql']['password']);

			self::$g_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			self::$g_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			self::$g_con->exec('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8";');

		} catch (PDOException $e) {

			@file_put_contents('error_log',@file_get_contents('error_log') . $e->getMessage() . "\n");

			die(include 'inc/pages/error/maintenance.p.php');

		}

		self::_getUrl();

	}

	public static function init(){

		if (is_null(self::$instance))

		{

			self::$instance = new self();

		}

		return self::$instance;

	}

	private static function _getUrl() {

		$url = isset($_GET['page']) ? $_GET['page'] : null;

        $url = rtrim($url, '/');

        $url = filter_var($url, FILTER_SANITIZE_URL);

        self::$_url = explode('/', $url);

	}

	public static function getContent() {

		require_once 'inc/libs/html-purifier/HTMLPurifier.auto.php';
		require_once 'inc/libs/vendor/autoload.php';
        include_once 'inc/header.inc.php';

            if(in_array(self::$_url[0],self::$_pages)){

				include_once 'inc/pages/'.self::$_url[0].'.p.php';

			} else {

                include_once 'inc/pages/index.p.php';
			}

        include_once 'inc/footer.inc.php';	

	}

	public static function _getPage() {

		return self::$_url[0];

	}

	public static function getPage() {

		return isset(self::$_url[2]) ? self::$_url[2] : 1;

	}

	public static function xss_clean($data){
	        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
	        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
	        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
	        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

	        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

	        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
	        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
	        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

	        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
	        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

	        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

	        do
	        {
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
	        }
	        while ($old_data !== $data);

	        return $data;
	}

	public static function protect($text){
	 	$config = HTMLPurifier_Config::createDefault();
	 	$purifier = new HTMLPurifier($config);
		$ez = $purifier->purify(self::xss_clean($text));

		return $ez;

	}

}
