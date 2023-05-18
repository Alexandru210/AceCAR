<?php
date_default_timezone_set('Europe/Bucharest');
header('Content-type: text/html; charset=utf-8');

class Config {

	// init configuration Google Login
	public static $clientID = '709308979404-pgov7tabl2k9go6sf2au3a3tthvftid3.apps.googleusercontent.com';
	public static $clientSecret = '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';
	public static $redirectUri = 'https://localhost/acecar/login';

	private static $instance;

	public static $g_con;

	public static $_url = array();

	private static $_pages = array(

		'index', 'login', 'logout', 'adminpanel', 'offerlist', 'settings', 'locations'

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

	public static function getUrl(){
		$temp = "$_SERVER[REQUEST_URI]";
		$temp = str_replace('/acecar/','',$temp);
		return $temp;
	}

	public static function getUrlFull(){
		return "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	public static function protect($text){
	 	$config = HTMLPurifier_Config::createDefault();
	 	$purifier = new HTMLPurifier($config);
		$ez = $purifier->purify(self::xss_clean($text));

		return $ez;

	}
	public static function getData($table, $cond, $cond_value, $data){
		$qq = Config::$g_con->prepare('SELECT * FROM '.$table.' where '.$cond.' = ?');
		$qq->execute(array($cond_value));
		$q = $qq->fetch(PDO::FETCH_ASSOC);
		return $q[$data];
	}

	public static function isConnected(){
		if(isset($_SESSION['isUserID']) && !empty($_SESSION['isUserID'])){
			return 1;
		}
		return 0;
	}

	public static function createNotifAndRedirect($shownotif, $title, $message, $icon, $color, $redirect_location){
		if($shownotif){
			switch($icon){
				case 'error': $_icon = 'fa-triangle-exclamation'; break;
				case 'success': $_icon = 'fa-circle-check'; break;
				default: $_icon = 'fa-triangle-exclamation';
			}
			$_SESSION['notif_message'] = '
										<div class="toast-container position-fixed bottom-0 end-0 p-3">
											<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
												<div class="toast-header '.$color.' text-white">
													<strong class="me-auto"><i class="fa-solid '.$_icon.' fa-xl"></i> '.$title.'</strong>
													<small>acum</small>
													<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
												</div>
												<div class="toast-body '.$color.' text-white">
													'.$message.'
												</div>
											</div>
										</div>';
			$_SESSION['notif_show'] = 1;
		}
		echo '<script>location.replace("'.Config::$_PAGE_URL.$redirect_location.'")</script>';
		
	}

	public static function formatName(){
		try {
			$qq = Config::$g_con->prepare('SELECT * FROM `clienti` where `ID` = ?');
			$qq->execute(array($_SESSION['isUserID']));
			while ($q = $qq->fetch(PDO::FETCH_OBJ)) {
				if($q->accGoogle){
					$format = '<img src="'.$q->Imagine.'" height="25px" style="border-radius: 50%" alt="error img"> '.$q->Prenume.' '.$q->Nume;
				} else {
					if($q->Imagine){
						$format = '<img src="'.$q->Imagine.'" height="25px" style="border-radius: 50%" alt="error img"> '.$q->Prenume.' '.$q->Nume;
					} else {
						$format = '<img src="images/default_avatar.png" height="25px" style="border-radius: 50%" alt="error img"> '.$q->Prenume.' '.$q->Nume;
					}
						
				}
			}
		} catch (throwable $eroare) {
			print($eroare);
		}

		return $format;
	}

}
