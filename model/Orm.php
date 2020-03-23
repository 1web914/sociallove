<?php
namespace model;
use dawfony\Klasto;

class Orm
{
    /****** Saca el listado de mujeres que hay en la bd para interactuar con ellas, ahora mismo en MainView de forma aleatoria en inicio Sin registrarse *****/
    function listado(){
        return  Klasto::getInstance()->query(
            "SELECT foto_perfil as foto, login, edad,ubicacion FROM usuario where genero='chica'",
            [], "model\Usuario"
        );
    }
    /****** Para poner el contador de los mensajes intercambiados MainView *****/
    public function contador() {
        return Klasto::getInstance()->queryOne(
            "SELECT contador FROM contador WHERE id = 1",
            []
        );
    }
    /****** Para poner el aumento del contador de los mensajes intercambiados MainView *****/
    public function aumentarcontador($contador) {
        Klasto::getInstance()->execute(
            "UPDATE contador SET contador=$contador + 2 where id=1",
        );
    }

    /*****Vemos si hay login existente, sino no entra *****/
    public function loginExistente($login){
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
    function listadoSesionIni($login){
        return  Klasto::getInstance()->query(
            "SELECT foto_perfil as foto, login, edad,ubicacion,genero FROM usuario where genero like (SELECT busco from usuario where login=?) ",
            [$login], "model\Usuario"
        );
    }
    
}
