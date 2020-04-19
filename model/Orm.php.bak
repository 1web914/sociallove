<?php

namespace model;

use dawfony\Klasto;

class Orm
{
    /****** Saca el listado de mujeres que hay en la bd para interactuar con ellas, ahora mismo en MainView de forma aleatoria en inicio Sin registrarse *****/
    function listado()
    {
        return  Klasto::getInstance()->query(
            "SELECT foto_perfil as foto, login, edad,ubicacion FROM usuario where genero='chica'",
            [],
            "model\Usuario"
        );
    }
    /****** Para poner el contador de los mensajes intercambiados MainView *****/
    public function contador()
    {
        return Klasto::getInstance()->queryOne(
            "SELECT contador FROM contador WHERE id = 1",
            []
        );
    }
    /****** Para poner el aumento del contador de los mensajes intercambiados MainView *****/
    public function aumentarcontador($contador)
    {
        Klasto::getInstance()->execute(
            "UPDATE contador SET contador=$contador + 2 where id=1",
        );
    }

    /*****Vemos si hay login existente, sino no entra *****/
    public function loginExistente($login)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT login FROM `usuario` WHERE email=?",
            [$login]
        );
    }
    /*** Sacamos la información importante y login, rol, fotoPerfil, genero irán en el sesion para facilitarnos la ayuda ya que utilizamos main con principal ***/
    public function comprobarUsuario($usuario)
    {
        $bd = Klasto::getInstance();
        $sql = "SELECT usuario.login, usuario.password, rol.id as rol,usuario.genero, usuario.nombre, usuario.email, usuario.foto_perfil as foto
        from usuario, rol where rol.id=usuario.rol_id and email=?;";
        return $bd->queryOne($sql, [$usuario->email]);
    }
    /* Sacamos toda la información importante para ver en el listado del usuario al hacer login */
    function listadoSesionIni($pagina = 1, $login)
    {
        global $config;
        $limite = $config["post_per_page"];
        $offset = ($pagina - 1) * $limite;
        return  Klasto::getInstance()->query(
            "SELECT foto_perfil as foto, login, edad,ubicacion,genero FROM usuario where genero like(SELECT busco from usuario where login=?) EXCEPT(SELECT foto_perfil as foto, login, edad,ubicacion,genero FROM usuario where login = ?)  LIMIT $limite OFFSET $offset",
            [$login, $login],
            "model\Usuario"
        );
    }

    /* sacamos un count de todas las personas segun busqueda de género para sacar a todas esas personas que se registren de nuevo y aumente la base de datos */
    function contadorPersonas($login)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT count(genero) as cantidadPersonas FROM usuario WHERE genero like (SELECT busco from usuario where login=?)  ",
            [$login],
            "model\Usuario"
        );
    }

    /* sacamos el contador de hechizos del usuario */
    function contadorHechizos($login)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT hechizos from usuario  Where login=?",
            [$login]
        );
    }

    /**ALBERTO**/
    /*****verificar si existe email en el pre-registro*****/
    function existeEmail($email)
    {
        $bd = Klasto::getInstance();
        $sql = "SELECT COUNT(*) FROM usuario WHERE email = ?";
        return $bd->queryOne($sql, [$email])["COUNT(*)"];
    }


    /*****comprobacion del login post-registro quizas haya que unificarlo luego con el de arriba*****/
    function existeLogin($login)
    {
        $bd = Klasto::getInstance();
        $sql = "SELECT COUNT(*) FROM usuario WHERE login = ?";
        return $bd->queryOne($sql, [$login])["COUNT(*)"];
    }
    function insertarUsuario($usuario, $validacion)
    {
        $bd = Klasto::getInstance();
        $sql = "INSERT INTO usuario (login, password, email, nombre, apellidos, edad, hechizos, genero, busco, ubicacion, rol_id, rango_id, foto_perfil, validacion, activada, sobreti, gustos, loquebuscas, aficiones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $bd->execute($sql, [$usuario->login, $usuario->password, $usuario->email, $usuario->nombre, $usuario->apellidos, $usuario->edad, $usuario->hechizos, $usuario->genero, $usuario->busco, $usuario->ubicacion, $usuario->rol_id, $usuario->rango_id, $usuario->foto, $validacion, $usuario->activada, $usuario->sobreti, $usuario->gustos, $usuario->loquebuscas, $usuario->aficiones]);
    }
    function obtenerNumValidacion($email)
    {
        $bd = Klasto::getInstance();
        $sql = "SELECT validacion FROM usuario WHERE email = ?";
        $dato = $bd->queryOne($sql, [$email]);
        return $dato["validacion"]; // devuelvo numero
        //SELECT validacion FROM `usuario` WHERE email = 'alba@gmail.com';
        //return $bd->queryOne($sql, [$email])["COUNT(*)"];        
    }
    function existeNumValidacion($validacion)
    {        
        $bd = Klasto::getInstance();
        $sql = "SELECT COUNT(*) FROM usuario WHERE validacion = ?";
        return $bd->queryOne($sql, [$validacion])["COUNT(*)"];        
    }
    
    
    function cambiarValidacionCB($newToken,$oldToken)
    {
        Klasto::getInstance()->execute(
            "UPDATE usuario SET validacion = ? where validacion = ?",
            [$newToken,$oldToken]
        );    
    }
    
    function dimeSiCuentaActivada($validacion)
    {
        $bd = Klasto::getInstance();            
        $sql = "SELECT activada FROM usuario where validacion = ?";
        $dato =  $bd->queryOne($sql, [$validacion]);  
        return $dato["activada"];   //saco solo el 1
        //SELECT activada from usuario where validacion = '134905271485'
    }
    
    public function poner1Activada($validacion)
    {
        Klasto::getInstance()->execute(
            "UPDATE usuario SET activada = '1' where validacion = ? ",
            [$validacion]
        );       
    }   
    
    public function caducidadNumValidacion($email,$newToken)
    {              
        /* NOBORRAR encendemos el generador a los 15 minutos */        
        //Klasto::getInstance()->execute("CALL aleatoriodb()");
        //Klasto::getInstance()->execute("CALL onevento()");        
        //Klasto::getInstance()->execute("CALL offevento()");
        //Klasto::getInstance()->execute("CALL setglobalevent1()");
        //Klasto::getInstance()->execute("CALL setglobalevent0()");        
        Klasto::getInstance()->execute("CALL setglobalevent1()");
        sleep(3);
        Klasto::getInstance()->execute("CALL onevento()");         
    }    

    /* ********* */

    /* sacamos datos del paquete de zona vip el nombre y precio */
    function obtenerPaquete($id)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT nombre, precio from rango where id=?",
            [$id]
        );
    }
    /* guardamos Productos de la cesta para realizar la compra en pedido */
    public function guardarPedido($usuario)
    {
        return Klasto::getInstance()->execute(
            "INSERT INTO `pedido`( `usuario_login`) VALUES (?)",
            [$usuario]
        );
    }

    /* sacamos la id del pedido  */
    public function idPedido($id_usuario)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT id FROM `pedido` WHERE Usuario_login=?",
            [$id_usuario]
        );
    }
    /* guardamos los productos de un cliente en el pedido que ha comprado */
    public function guardarProducto($id_producto, $id_pedido)
    {
        return Klasto::getInstance()->execute(
            "INSERT INTO `producto_has_pedido`(`Producto_id`, `Pedido_id`) VALUES (?,?)",
            [$id_producto, $id_pedido]
        );
    }


    /*informacion de la pasarela de si a pagado a cancelado o ha surgido error  */
    public function informacionPasarela($cod_pedido, $importe, $estado, $cod_operacion)
    {
        return Klasto::getInstance()->execute(
            "UPDATE `pedido` SET `pago`=?,`cod_operacion`=?,`importe`=?",
            [$estado, $cod_operacion, $importe]
        );
    }

    /* sacar datos del cod_pedido */
    public function sacarDatosPedidoPasarela($cod_pedido)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT pago, cod_operacion, importe,usuario_login FROM pedido where id=?",
            [$cod_pedido],
            "model\Pedido"
        );
    }
    /* sacamos la id del pedido, ya que no coincide el cod_pedido con la id */
    public function idDelPedido($id)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT pedido_id FROM producto_has_pedido WHERE producto_id=?",
            [$id]
        );
    }

    /* Realizacion y actualizacion de los hechizos comprados mediante zonavip */
    function hechizosrango($id)
    {
        return Klasto::getInstance()->queryOne(
            "SELECT Hechizos from rango Where id=? ",
            [$id]
        );
    }
    function hechizosusuario($id, $usuario)
    {
        return Klasto::getInstance()->execute(
            "UPDATE usuario SET hechizos=hechizos+ ? where login=?",
            [$id, $usuario]
        );
    }
    /* eliminar datos del usuario de su compra */
    public function eliminarDatosUsuarioCompra($idPedido)
    {

        Klasto::getInstance()->startTransaction();

        (new Orm)->borrarProductoHasComprado($idPedido);
        (new Orm)->borrarPedido($idPedido);

        Klasto::getInstance()->commit();
    }

    public function borrarProductoHasComprado($idPedido)
    {
        return Klasto::getInstance()->execute(
            "DELETE FROM `producto_has_pedido` WHERE Pedido_id=?",
            [$idPedido]
        );
    }
    public function borrarPedido($idPedido)
    {
        return Klasto::getInstance()->execute(
            "DELETE FROM `pedido` WHERE id=?",
            [$idPedido]
        );
    }
    public function cambioPassword($newPassHash,$newToken)
    {
        return Klasto::getInstance()->execute(
            "UPDATE `usuario` SET `password`= ? WHERE validacion = ? ",
            [$newPassHash,$newToken]
        );

    }
}
