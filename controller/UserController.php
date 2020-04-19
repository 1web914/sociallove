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
    /*****ALBERTO******/
    public function formularioRegistro()
    {
        global $URL_PATH;
        $sex = $_REQUEST["sex"];
        $nombre = $_REQUEST["prenombre"] ?? "";
        $email = $_REQUEST["email"] ?? "";
        $prepassword = $_REQUEST["prepassword"] ?? "";
        /* CALCULO LOS AÑOS */
        $day = $_REQUEST["day"];
        $month = $_REQUEST["month"];
        $year = $_REQUEST["year"];
        $fecha_nacimiento = $day . '-' . $month . '-' . $year;
        $dia_actual = date("Y-m-d");
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create($dia_actual));
        $edad = intval($edad_diff->format('%y')); //convertimos a int
        $data = ["sex" => $sex, "nombre" => $nombre, "email" => $email, "prepassword" => $prepassword, "edad" => $edad];
        echo Ti::render("view/registro/registroForm.phtml", $data);
    }

    public function procesarRegistro()
    { //POST REGISTRO
        global $config;
        global $URL_PATH;
        $usuario = new Usuario;
        $error = true;

        $usuario->login = sanitizar($_POST["login"] ?? ""); //name="login"
        $usuario->password = password_hash($_REQUEST["password"], PASSWORD_DEFAULT);
        $repPassword =  sanitizar($_REQUEST["repassword"]);    //name="repassword" /* Esta variable no hace nada */
        $usuario->sobreti = sanitizar($_REQUEST["sobreti"] ?? "");   //textarea sobreti
        /*CHECKBOX GUSTOS*/
        if (is_array($_POST['gustos'] ?? "")) {
            $selected = '';
            $num_gustos = count($_POST['gustos']);
            $current = 0;
            foreach ($_POST['gustos'] as $key => $value) {
                if ($current != $num_gustos - 1)
                    $selected .= $value . ', ';
                else
                    $selected .= $value . '.';
                $current++;
            }
        } else {
            $selected = "";
        }
        //echo '<div>Has seleccionado: '.$selected.'</div>'; //los que ha seleccionado
        $usuario->gustos = $selected;
        $usuario->nombre = sanitizar($_REQUEST["nombre"] ?? "");
        $usuario->apellidos = sanitizar($_REQUEST["apellidos"] ?? "");
        $usuario->edad = sanitizar($_REQUEST["edad"]);
        $usuario->ubicacion = sanitizar($_REQUEST["ubicacion"]  ?? "");
        $usuario->loquebuscas = sanitizar($_REQUEST["loquebuscas"]  ?? "");   //textarea sobreti

        //datos que vienen desde el otro formulario
        $usuario->email = sanitizar($_POST["email"]); //esto viene del otro form
        $usuario->genero = sanitizar($_POST["sex"]); //esto viene del index del otro form
        $usuario->rol_id = "1";
        $usuario->rango_id = "0";
        $usuario->hechizos = "3";
        $usuario->activada = "0";
       
        /*CHECKBOX AFICCIONES*/
        if (is_array($_POST['aficiones'] ?? "")) {
            $selectedaf = '';
            $num_af = count($_POST['aficiones']);
            $currentaf = 0;
            foreach ($_POST['aficiones'] as $key => $v) {
                if ($currentaf != $num_af - 1)
                    $selectedaf .= $v . ', ';
                else
                    $selectedaf .= $v . '.';
                $currentaf++;
            }
        } else {
            $selectedaf = "";
        }
        //echo '<div>Has seleccionado: '.$selected.'</div>'; //los que ha seleccionado
        $usuario->aficiones = $selectedaf;
        $usuario->busco = $_REQUEST["busco"];
        //foto del usuario
        $usuario->foto = $_FILES["foto"]["name"];


        //comprobacion del tamaño, y la extension en php      //var_dump($usuario->foto);//var_dump($_FILES["foto"]["size"]);
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_10mb = 10000000; //10mb maximo


        if (in_array($_FILES["foto"]["type"], $permitidos) && $_FILES["foto"]["size"] <= $limite_10mb) {
            if ($usuario->genero = "chico") {
                move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/fotosUsuarios/fotosChicos/" . $usuario->foto); //la muevo al directorio fotosChicos
            } else {
                move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/fotosUsuarios/fotosChicas/" . $usuario->foto); //la muevo al directorio fotosChicas
            }
        } else {
            $usuario->foto = "nofoto.png";
        }
        if ($usuario->foto === "") { //si no se indica foto se pone una x defecto
            $usuario->foto = "nofoto.png";
        }



        if ($error) {
            global $URL_PATH;
            //generamos un aleatorio para enviar el correo al usuario
            $fecha = idate("U"); //fecha en formato int
            $aleatorio = rand(2, 99);  //aleatorio entre 0 y 99
            $validacion = $fecha * $aleatorio;
            
            $insert = (new Orm)->insertarUsuario($usuario, $validacion);/* Esa variable tampoco hace nada */
            $emaildestino = "$usuario->email"; //falta cambiarlo por  $usuario->email
            $data = ["email" => $emaildestino];            
            $token = $validacion;
            include('emailcfg/enviar-confirmacion.php');
            echo Ti::render("view/registro/registroCompleto.phtml", $data);
        }
    } 
    
    // activacion de la cuenta despues de registrar
    public function cuentaActivada($accionUS,$validar)
    {       
        global $URL_PATH;        
        
        if($accionUS == 0){           
            $selectActivada = (new Orm)->dimeSiCuentaActivada($validar);            
                if($selectActivada === 0) {
                    //modificar 0 por 1
                    (new Orm)->poner1Activada($validar);
                    echo Ti::render("view/registro/cuentaActivada.phtml");
                } else {
                    header("Location: $URL_PATH/");
                }     
        } 
        
       header("Location: $URL_PATH/");
    }
    
    function dameUnAleatorio()
    {
        //generamos un aleatorio para enviar el correo al usuario
            $fechaInt = idate("U"); //fecha en formato int
            $unAleatorio = rand(2, 99);  //aleatorio entre 0 y 99
            return $fechaInt * $unAleatorio;        
    }


    /* *********** */

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
        $id = $id_pedido["pedido_id"];
        $sacarDatosPedido =  (new Orm)->sacarDatosPedidoPasarela($id);
        if ($sacarDatosPedido->pago == "ok") {
            /* PRUEBA HECHIZOS UPDATE*/
            $idrango = (new Orm)->hechizosrango($cod_pedido);
            $hechizosUsuario = (new Orm)->hechizosusuario($idrango["Hechizos"], $_SESSION["login"]);
        }
        //enviamos la id para una vez realizada toda la transaccion se borre los datos de la BD
        echo Ti::render("view/vip/pedido.phtml", compact("sacarDatosPedido", "id"));
    }

    /* eliminar datos */
    public function eliminarDatos($cod_pedido)
    {
        global $URL_PATH;
        (new Orm)->eliminarDatosUsuarioCompra($cod_pedido);
        header("Location: $URL_PATH/listado");
    }
    /* ANGEL & Albert PASSWORD FORGET */
    /* Contraseña olvidada CAPTCHA EN esta vista */   
    public function passOlvidada()
    {        
        echo Ti::render("view/passForget/passOlvidada.phtml");
    }
    /* obtenemos token con el email */
    public function restablecePass(){        
        /* ENVIO DEL EMAIL */
        $email = $_REQUEST["email"] ?? "";        
        if($email != ""){ //mail correcto pedimos token y mandamos email
            //obtengo el token con el mail, para insertarlo en el email
            $token = (new Orm)->obtenerNumValidacion($email);            
            $emaildestino = $email;            
            include('emailcfg/enviar-recuPass.php');            
            $data = ["email" => $email];
            echo Ti::render("view/passForget/avisoEnvioAlCorreo.phtml", $data);                 
        } else { //si el mail esta vacio retorna al captcha
            echo Ti::render("view/passForget/passOlvidada.phtml");
        }       
    }
    /* restablecemos la contraseña get*/   
    public function cambioPass($validUsuario){   
        $existeNumBase = (new Orm)->existeNumValidacion($validUsuario);
        $oldToken = $validUsuario;
        if($existeNumBase) {                       
            $dataHide = ["oldToken" => $oldToken];
            echo Ti::render("view/passForget/restablecerPass.phtml", $dataHide); //formulario     
            //(new Orm)->caducidadNumValidacion($email,$newToken); NOBORRAR
        } else {
            global $URL_PATH;
            header("Location: $URL_PATH/");
        }          
    }
    /* mostramos mensaje y actualizamos cambios en bd  post*/
    public function restablecePassFin(){
        $oldToken = $_REQUEST["oldToken"] ?? "";
        //cambio validacion    
        $objeto = new UserController;            
        $newToken = $objeto->dameUnAleatorio();            
        (new Orm)->cambiarValidacionCB($newToken,$oldToken);        
        //cambio contraseña del $newToken
        $newPass = $_REQUEST["password"] ?? "";        
        $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);        
        (new Orm)->cambioPassword($newPassHash,$newToken);
        echo Ti::render("view/passForget/passCambiada.phtml");
    }

/* ***** */
}
