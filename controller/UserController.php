<?php

namespace controller;

require_once("funciones.php");

use \model\Orm;
use \dawfony\Ti;
use model\Usuario;

class UserController extends Controller
{
    public function procesarLogin()
    {
        global $URL_PATH;

        $usuario = new Usuario;
        $email = $_REQUEST["email"];
        $usuario->email = $email;
        $usuario->password = $_REQUEST["password"];
        $hashpass = (new Orm)->comprobarUsuario($usuario);
        if (!password_verify($usuario->password, $hashpass["password"])) {
            $sacarListaMenu = (new PostController)->listaMain();
            $error_msg = "*Login o contraseña incorrecto";
            echo Ti::render("view/principal.phtml", compact("error_msg", "sacarListaMenu"));
        } else {

            session_start();
            $_SESSION['login'] = $hashpass["login"];
            $_SESSION['rol_id'] = $hashpass["rol"];
            $_SESSION['fotoPerfil'] = $hashpass["foto"];
            $_SESSION['genero'] = $hashpass["genero"];
            header("Location: $URL_PATH/listado");
        }
    }

    public function hacerLogout()
    {
        global $URL_PATH;
        session_destroy();
        header("Location: $URL_PATH/");
    }
    /* Hacemos pasarela de pago */
    public function procesarCompra()
    {

        $idCompra = $_REQUEST['prodId'];

        //guardamos el producto elegido
        (new Orm)->guardarPedido($_SESSION['login']);
        $id_pedido = (new Orm)->idPedido($_SESSION['login']);
        (new Orm)->guardarProducto($idCompra, $id_pedido["id"]);

        //sacamos datos del paquete comprado
        $datosPaquete = (new Orm)->obtenerPaquete($idCompra);
        $importe = $datosPaquete["precio"];

        //tardamos 3seg para que nos rediriga a la pasarela.
        sleep(3);
        $cod_comercio = 2222;
        $cod_pedido = $idCompra;
        $concepto = "Hechizos";
        header("Location: http://localhost/pasarela/index.php?cod_comercio=$cod_comercio&cod_pedido=$cod_pedido&importe=$importe&concepto=$concepto");
    }
    /* devolvemos el retorno de la pasarela */
    public function retorno()
    {

        $cod_pedido = $_REQUEST["cod_pedido"];
        $id_pedido = (new Orm)->idDelPedido($cod_pedido);
        $sacarDatosPedido =  (new Orm)->sacarDatosPedidoPasarela($id_pedido["pedido_id"]);
        if ($sacarDatosPedido->pago == "ok") {
            /* PRUEBA HECHIZOS UPDATE*/
            $idrango = (new Orm)->hechizosrango($cod_pedido);
            $hechizosUsuario = (new Orm)->hechizosusuario($idrango["Hechizos"], $_SESSION["login"]);
        } 
        //enviamos el cod_pedido para una vez realizada toda la transaccion se borre los datos de la BD
        /* echo Ti::render("view/pedido.phtml", compact("sacarDatosPedido", "cod_pedido")); */
    }

    /*eliminar datos
     public function eliminarDatos($cod_pedido){
        global $URL_PATH;
        (new Orm)->eliminarDatosUsuarioCompra($cod_pedido,$_SESSION["login"],$_COOKIE["PHPSESSID"]);
        header("Location: $URL_PATH/");
     } */
}
