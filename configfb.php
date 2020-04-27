<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once('Facebook/autoload.php');

$FBObject = new \Facebook\Facebook([
	'app_id' => '630181460866748',
	'app_secret' => 'c8b4d2048fb4ee5bc2cec47611f76bc2',
	'default_graph_version' => 'v2.7'
]);

$handler = $FBObject -> getRedirectLoginHelper();
?>