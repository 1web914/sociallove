function buscarUsuario() {

    var validarBusqueda = function(string) {

        var validar = true;

        if( string == '' ) {
            validar = false;
        }
        if( string.match( /[ |<|,|>|\.|\?|\/|:|;|"|'|{|\[|}|\]|\||\\|~|`|!|@|#|\$|%|\^|&|\*|\(|\)|_|\-|\+|=]+/ ) != null ) {

            validar = false;
        }

        return validar;
      }

    if (event.keyCode == 13) {
        var usuario = document.getElementById("busqueda").value;
        var usuarioSanitizado = validarBusqueda(usuario);

        return usuarioSanitizado;
    }



}
