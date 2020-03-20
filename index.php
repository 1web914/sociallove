<?php
require 'vendor/autoload.php';
require 'cargarconfig.php';
require 'fb-login/fb-init.php';


use NoahBuscher\Macaw\Macaw;
use controller\PruebaController;

/* echo "<pre>" . var_dump($_SERVER["REQUEST_URI"]) . var_dump($_SERVER["QUERY_STRING"]) . "</pre>"; */
/*
//pagina principal
*/Macaw::get($URL_PATH . '/', "controller\PostController@listado");
//contador mensajes intercambiados
Macaw::get($URL_PATH . '/contador', "controller\PostController@contador");

//registro
Macaw::get($URL_PATH . '/registro', "controller\UserController@formularioRegistro");
Macaw::post($URL_PATH . '/registro', "controller\UserController@procesarRegistro");

//iniciar sesion
Macaw::post($URL_PATH . '/login', "controller\UserController@procesarLogin");

//validarLogin
Macaw::get($URL_PATH . '/existe/(:any)', "controller\ApiController@existeLogin");

//cerrar sesion
Macaw::get($URL_PATH . '/logout', "controller\UserController@hacerLogout");

//sesion iniciado sacar lista
Macaw::get($URL_PATH . '/listado', "controller\PostController@listadoSesionIniciada");

/*
//lo ultimo
Macaw::get($URL_PATH . '/loUltimo', "controller\PostController@listado");
Macaw::get($URL_PATH . '/loUltimo/page/(:num)', "controller\PostController@listado");

//borrar Post y Perfil desde admin
Macaw::get($URL_PATH . '/borrarPost/(:any)', "controller\UserController@borrarPost");
Macaw::get($URL_PATH . '/borrarPerfil/(:any)', "controller\UserController@borrarPerfil");

//ver post
Macaw::get($URL_PATH . '/leerMas/(:any)', "controller\PostController@leerPost");

//ver perfil
Macaw::get($URL_PATH . '/perfil/(:any)', "controller\UserController@perfil");

// seguir y dejar de seguir
Macaw::get($URL_PATH . '/perfil/(:any)/seguir', "controller\UserController@seguirPerfil");
Macaw::get($URL_PATH . '/perfil/(:any)/noseguir', "controller\UserController@noSeguirPerfil");

// ver posts de usuarios seguidos
Macaw::get($URL_PATH . '/siguiendo', "controller\PostController@listarSeguidos");
Macaw::get($URL_PATH . '/siguiendo/pag/(:num)', "controller\PostController@listarSeguidos");

//nuevo Post
Macaw::get($URL_PATH . '/post/new', "controller\PostController@formularioNuevoPost");
Macaw::post($URL_PATH . '/post/new', "controller\PostController@procesarNuevoPost");


//nuevo comentario
Macaw ::post($URL_PATH . '/leerMas/(:num)/comentario/new', "controller\PostController@nuevoComentario");

//api JSON

Macaw::get($URL_PATH . '/api/like/(:num)', "controller\ApiController@likeClick");
  */



// Captura de URL no definidas.
Macaw::error(function() {
  http_response_code(404);
  echo '404 :: Not Found';
});

Macaw::dispatch();
