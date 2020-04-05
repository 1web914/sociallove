<?php

namespace controller;

use \model\Orm;

require_once("funciones.php");

class ApiController extends Controller
{
    //recibimos el email y con el email comprobamos el login si existe o tiene que registrarse.
    public function existeLogin($email)
    {

        header('Content-type: application/json');
        $loginExiste = (new Orm)->loginExistente($email);
        if ($loginExiste != null) {
            echo json_encode("existe");
        } else {
            echo json_encode("registro");
        }
    }
    //ver la descripcion del paquete elegido a la hora de efectuar pago.
    public function descripcionPagoElegido($id){

        $descripcionPaquete = (new Orm)->obtenerPaquete($id);
        $data["titulo"] = $descripcionPaquete["nombre"];
        $data["precio"] = $descripcionPaquete["precio"];

        echo json_encode($data);
    }
    /* Hay que poner las notificaciones de la gente que ha visitado tu perfil */
    public function notificaciones(){

    }
    /* informar de la realizacion de la compra mediante pasarela */
    public function informa()
   {
       header('Content-type: application/json');  

      $cod_pedido = $_REQUEST["cod_pedido"];
      $importe = $_REQUEST["importe"];
      $estado = $_REQUEST["estado"];
      $cod_operacion = $_REQUEST["cod_operacion"];

    (new Orm)->informacionPasarela($cod_pedido, $importe,$estado,$cod_operacion);

    /* PRUEBA HECHIZOS UPDATE,FUNCIONA,FALTA PONER EL LOGIN QUE SE TIENE QUE MANDAR DESDE OTRO SITIO ESTO VA EN RETORNO NO RAYARSE*/
    $idrango = (new Orm)->hechizosrango($cod_pedido);
    $hechizosUsuario = (new Orm)->hechizosusuario($idrango["Hechizos"],"Angie");


      $msg = "Servidor de la tienda informado"; 

       echo json_encode($msg);  
   }


}
