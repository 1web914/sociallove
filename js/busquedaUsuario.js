function buscarUsuario() {

    var validarBusqueda = function(string) {

        var validar = true;
  
        if( string == '' ) { validar = false; }
  
        if( string.match( /[ |<|,|>|\.|\?|\/|:|;|"|'|{|\[|}|\]|\||\\|~|`|!|@|#|\$|%|\^|&|\*|\(|\)|_|\-|\+|=]+/ ) != null ) {
  
            validar = false;
        }
  
        return validar;
      }

    if (event.keyCode == 13) {
        var usuario = document.getElementById("busqueda").value;
        var usuarioSanitizado = validarBusqueda(usuario);
        if(usuarioSanitizado == true){
            location.href = URL_PATH + "/busqueda/" + usuario; 
        }else{
            location.href = URL_PATH + "/listado";
        }
    }
    
}
