<?php
require 'vendor/autoload.php';
require 'cargarconfig.php';
use NoahBuscher\Macaw\Macaw;
use controller\PruebaController;


/* ******** */
//pagina principal
Macaw::get($URL_PATH . '/', "controller\PostController@listado");
//contador mensajes intercambiados
Macaw::get($URL_PATH . '/contador', "controller\PostController@contador");

/* ******** */
//iniciar sesion
Macaw::post($URL_PATH . '/login', "controller\UserController@procesarLogin");

/* ******** */
//validarLogin
Macaw::get($URL_PATH . '/existe/(:any)', "controller\ApiController@existeLogin");

/* ******** */
//cerrar sesion
Macaw::get($URL_PATH . '/logout', "controller\UserController@hacerLogout");

/* ******** */
//sesion iniciado sacar lista
Macaw::get($URL_PATH . '/listado', "controller\PostController@listadoSesionIniciada");
Macaw::get($URL_PATH . '/listado/page/(:num)', "controller\PostController@listadoSesionIniciada");

//busqueda de personas
Macaw::get($URL_PATH . '/busqueda', "controller\PostController@busquedaUsuario");
Macaw::get($URL_PATH . '/busqueda/page/(:num)', "controller\PostController@busquedaUsuario");

//mirar el correo
Macaw::get($URL_PATH . '/correo', "controller\PostController@listaCorreo");

/* ******** */
//ver perfil
Macaw::get($URL_PATH . '/perfil/(:any)', "controller\UserController@perfil");

/* ALBERTO */

//pre-registro  . la peticion post te manda al post-formulario directamente
Macaw::get($URL_PATH . '/api/comprobarEmail/(:any)', "controller\ApiController@apiComprobarEmail");
Macaw::post($URL_PATH . '/postregistro', "controller\UserController@formularioRegistro");


//Post-registro
Macaw::post($URL_PATH . '/registro', "controller\UserController@procesarRegistro");
Macaw::get($URL_PATH . '/api/comprobarLogin/(:any)', "controller\ApiController@apiComprobarLogin");
Macaw::get($URL_PATH . '/activate/(:num)/(:any)', "controller\UserController@cuentaActivada");

//facebook login
Macaw::get($URL_PATH . '/callbackphp', "controller\UserController@callbackphp");
//Macaw::get($URL_PATH . '/#_=_', "controller\UserController@procesarLogin");

// hechizos
Macaw::get($URL_PATH . '/hechizos/(:any)', "controller\UserController@hechizosFormu");
Macaw::post($URL_PATH . '/hechizos', "controller\UserController@hechizosFormuPost");


/* ******************************** */
/* Password Olvidada */

Macaw::get($URL_PATH . '/passOlvidada', "controller\UserController@passOlvidada");
Macaw::post($URL_PATH . '/restablecerPass', "controller\UserController@restablecePass");
Macaw::get($URL_PATH . '/restablecer/(:any)', "controller\UserController@cambioPass");
Macaw::post($URL_PATH . '/restablecerPassFin', "controller\UserController@restablecePassFin");
Macaw::get($URL_PATH . '/api/recaptcha/(:any)', "controller\ApiController@recaptcha");


/* ******** */
//Zona vip mas hechizos
Macaw::get($URL_PATH . '/zonavip', "controller\PostController@vip");
//Zona vip descripcion del click del pago
Macaw::get($URL_PATH . '/api/descripcion/(:any)', "controller\ApiController@descripcionPagoElegido");
//Zona vip envio de la compra
Macaw::post($URL_PATH . '/compra', "controller\UserController@procesarCompra");
//pasarela informa
Macaw::get($URL_PATH . '/informa', "controller\ApiController@informa");

/* ******** */
//pasarela retorno
Macaw::get($URL_PATH . '/retorno', "controller\UserController@retorno");
//Eliminar datos
Macaw::get($URL_PATH . '/eliminarDatos/(:num)', "controller\UserController@eliminarDatos");


// Captura de URL no definidas.
Macaw::error(function() {
  http_response_code(404);
  echo '404 :: Not Found';
});

Macaw::dispatch();
