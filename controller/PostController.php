<?php
namespace controller;
require_once ("funciones.php");
use \model\Orm;
use \dawfony\Ti;

class PostController extends Controller
{
    function listado() {
        global $config;
        global $URL_PATH;
        
        echo Ti::render("view/mainView.phtml");
    }
}