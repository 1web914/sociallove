<?php
namespace controller;
require_once ("funciones.php");
use \model\Orm;
use \dawfony\Ti;

class PostController extends Controller
{
        //listado Principal de inicio.
    function listado() {

        global $config;
        global $URL_PATH;
        $sacarListaMenu = (new PostController)->listaMain();
        /*********Números aleatorios para tener una lista en main view aleatoria cada ez que entres, para hacerla mas real********/
        echo Ti::render("view/principal.phtml", compact('sacarListaMenu'));
    }

    //sacamos datos del listado del main.(Una función para mantener datos al hacer login erroneo).
    function listaMain(){

        $sacarListaMujeres = (new Orm)->listado();
        $numeros=array();
        $i=0;

        while($i<12){

        $num=rand(0,23);

        if(in_array($num,$numeros)===false){
            array_push($numeros,$num);
                $i++;
            }

        }

        for($i= 0; $i<12; $i++){

            $sacarListaMenu[$i] = [
            "fotos"=>$sacarListaMujeres[$numeros[$i]]->foto,
            "login"=>$sacarListaMujeres[$numeros[$i]]->login,
            "edad"=>$sacarListaMujeres[$numeros[$i]]->edad,
            "ubicacion"=>$sacarListaMujeres[$numeros[$i]]->ubicacion];

        }
        return $sacarListaMenu;
    }


    //contador de mensajes escribiendo...
    function contador() {
        $contador = (new Orm)->contador();
        (new Orm)->aumentarcontador($contador["contador"]);
        echo json_encode($contador["contador"]);
    }
    //sacamos la busqueda de genero elegido por el usuario.
    function listadoSesionIniciada($pagina = 1){

        global $config;
        global $URL_PATH;
        $login = $_SESSION["login"];
        $sacarLista = (new Orm)->listadoSesionIni($pagina,$login);
        $hechizos = (new Orm)->contadorHechizos($login);
        /* Para paginación */
        $cuenta = (new Orm)->contadorPersonas($login);
        $numpaginas = ceil ($cuenta->cantidadPersonas / $config["post_per_page"]);
        $ruta = "$URL_PATH/listado/page/";

        echo Ti::render("view/principal.phtml", compact("sacarLista","hechizos","cuenta", "numpaginas", "pagina", "ruta"));

    }

    //busqueda de usuario FALTA PONER TODO EL ORM Y EL LISTADO.ESTO ES UNA PRUEBA DE RECOGIDA PARÁMETROS.
    function busquedaUsuario(){

        $usuario = $_REQUEST["busquedaUsuario"];
        echo Ti::render("view/usuarios/busquedaUsuario.phtml", compact("usuario"));
    }

    //Entramos en la zonaVip
    function vip(){
        echo Ti::render("view/vip/zonaVip.phtml");
    }


}
