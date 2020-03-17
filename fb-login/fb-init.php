<?php

//inicio sesion
session_start();

//autoload file de la carpeta vendor
require 'fb-login/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '626744431482156',
    'app_secret' => 'de520bd3a43baff2c79e63f04ffe9856',
    'default_graph_version' => 'v2.7'
]);

$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/sociallove");

try {
    $accesToken = $helper->getAccessToken();
    if (isset($accesToken)) {
        $_SESSION['acceso_fb'] = (string) $accesToken;
        header("Location: index.php");
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

//para coger el nombre,email etc
/* if ($_SESSION['acceso_fb']) {

    try {

        $fb->setDefaultAccessToken($_SESSION['acceso_fb']);
        $res = $fb->get('/me?locale=es_ES&fields=name,email');
        $user = $res->getGraphUser();
        //aqui nos saldria el nombre, asi que tenemos que recogerlo y guardarlo en la bd.
        $user->getField('name');
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} */
