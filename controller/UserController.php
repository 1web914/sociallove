<?php
namespace controller;
require_once ("funciones.php");
use \model\Orm;
use \dawfony\Ti;
use model\Usuario;

class UserController extends Controller
{

    public function login()
    {
        $title = "Login";
        echo Ti::render("view/login.phtml", compact("title"));
    }

    public function procesarLogin()
    {
        global $URL_PATH;

        $login = strtolower(sanitizar($_REQUEST["login"]));
        $usuario = new Usuario;
        $usuario->login = $login;
        $usuario->password = $_REQUEST["password"];
        $hashpass = (new Orm)->comprobarUsuario($usuario);
        if (!password_verify($usuario->password, $hashpass["password"])) {
            $error_msg = "Login o contraseña incorrecto";
            echo Ti::render("view/login.phtml", compact("error_msg", "login"));
        } else {
            $_SESSION['login'] = $usuario->login;
            $_SESSION['rol_id'] = $hashpass["rol"];
            header("Location: $URL_PATH/");
        }
    }

    public function hacerLogout()
    {
        global $URL_PATH;
        session_destroy();
        header("Location: $URL_PATH/");
    }

}    