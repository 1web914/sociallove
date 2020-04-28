<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
require_once('Facebook/autoload.php');

$FBObject = new \Facebook\Facebook([
	'app_id' => '630181460866748',
	'app_secret' => 'pedir a alberto',
	'default_graph_version' => 'v2.7'
]);

$handler = $FBObject -> getRedirectLoginHelper();
?>