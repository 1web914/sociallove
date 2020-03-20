
function comprobarlogin() {
    var validarLogin = document.getElementById("mail").value;
    console.log(validarLogin);
    //hacemos una comprobación via email, para saber si ese email existe en la BD, sino tiene que registrarse.
    fetch(URL_PATH + "/existe/" + validarLogin, {
        method: "GET",
        headers: {
            "Accept": "application/json"
        }
    })
        .then(res => res.json())
        /* console.log(res) */
        .then(data => {
             console.log(data);  
            if (data == "registro") {

                Swal.fire({
                    icon: 'error',
                    type: 'info',
                    title: 'Email no existente!! Porfavor,Regístrese.',
                    timer: 3000,
                    showConfirmButton: false
                });
       
                error = false;
            } else {
                error = true;
            }

        })

}