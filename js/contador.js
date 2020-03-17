function contador() {
    fetch(URL_PATH + "/contador")

        .then((res) => res.json())
        .then((res) => {
            $("#contador").html(res + " <span style='color:white'>mensajes intercambiados...</span>");
        })
}