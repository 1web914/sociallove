function validarBusqueda(){
    var usuario = document.getElementById("busqueda").value;
    var sanitizar = validarBusquedaLupa(usuario);
    
    function validarBusquedaLupa(string) {

        var validar = true;
  
        if( string == '' ) { 
            validar = false;
        }
        if( string.match( /[ |<|,|>|\.|\?|\/|:|;|"|'|{|\[|}|\]|\||\\|~|`|!|@|#|\$|%|\^|&|\*|\(|\)|_|\-|\+|=]+/ ) != null ) {
  
            validar = false;
        }
  
        return validar;
      }

    return usuario != ""  && sanitizar;
}