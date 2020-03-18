function contador() {
    fetch(URL_PATH + "/contador")

        .then((res) => res.json())
        .then((res) => {
            $("#contador").html(res + " <span id='contadorMensaje' style='color:white'>mensajes intercambiados...</span>");
        })
}