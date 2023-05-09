<?php
session_start();
define('acecar',true);

spl_autoload_register(function ($class) {
    include 'inc/' . $class . '.class.php';
});

Config::init()->getContent();

?>