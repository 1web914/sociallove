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
        $sacarListaMujeres = (new Orm)->listado();
        /*********Números aleatorios para tener una lista en main view aleatoria cada ez que entres, para hacerla mas real********/
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
       
        echo Ti::render("view/mainView.phtml", compact('sacarListaMenu'));
    }


    function contador() {
        $contador = (new Orm)->contador();
        (new Orm)->aumentarcontador($contador["contador"]);
        echo json_encode($contador["contador"]);
    }


}