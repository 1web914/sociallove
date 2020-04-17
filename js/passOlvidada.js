function passOlvidada(a) {
    $("#loaderpost").css('visibility', 'visible'); //activo el loader
    var mail = document.getElementById('email').value;
    var captcha = grecaptcha.getResponse();

    /* ESTO LO DEJAMOS ASí YA QUE PUEDEN MANIPULAR EL REQUIRED Y DEJARLO EN BLANCO, ASI QUE HACEMOS COMPROBACIONES */
    if (mail === "") {
        Swal.fire({
            icon: 'warning',
            type: 'info',
            title: 'Email vacio!! Porfavor,Rellénelo.',
            timer: 3000,
            showConfirmButton: false
        });
        return false;

    } else if (captcha === "") {
        Swal.fire({
            icon: 'warning',
            type: 'info',
            title: 'Capcha sin completar!!',
            timer: 3000,
            showConfirmButton: false
        });
        return false;

    } else {
        //seTtimeout para dar tiempo a la captcha y que no lance un pequeño error
        setTimeout(
            function () {
                /* Voy hacer un fetch para ver si me devuelve true al hacer recaptcha */
                /* window.location.replace(URL_PATH + "/api/recaptcha/" + captcha);  ESTO ES UNA PRUEBA PARA ER LO QUE NOS DARÍA ESTÁ
                TODO COMENTADO EN EL API CONTROLLER PASSOLVIDADA, TENEMOS EL ERROR DEL FETCH,DE MOMENTO HASTA NUEVO AVISO LO DEJAMOS ASI. */
                fetch(URL_PATH + "/api/recaptcha/" + captcha)
                    .then((res) => res.json())
                    .then((res) => {
                        //RES DEVUELVE TRUE;                                       
                        /*fetch envia la comprobacion a google y devuelve RES DEVUELVE TRUE; */
                        //alert("fetch ok")
                        if (res) {
                            return true;
                        }
                        //si hay algun error en la captcha refresca la pagina
                        //alert("error interno en captcha, intentalo mas tarde");
                        location.reload(true); //recargamos la pagina 
                    });
            }, 3000);

    }
}

/********* Alberto **********/
function recPassEmail() {
    //$("#btn_modal").trigger("click");
    let email = $('#email').val();
    let campoEmail = $('#email');
    var emaillenght = email.length;
    if (!validarEmailCorrecto(email)) {
        document.getElementById("checkemail").innerHTML = "<i class='fa fa-exclamation' style='color:red'> &nbsp;Email incorrecto</i>  <input id='emailchecker' type='hidden' value='0' name='emailchecker'> ";
        campoEmail.addClass("is-invalid");
        document.getElementById("preboton").disabled = true;
    } else {
        document.getElementById("checkemail").innerHTML = "";
        fetch(URL_PATH + "/api/comprobarEmail/" + email)
            .then((res) => res.json())
            .then((res) => {
                campoEmail.removeClass("is-invalid is-valid");
                if (res.emailExiste == 1) {
                    document.getElementById("checkemail").innerHTML = "<i class='fa fa-check' style='color:green'>ok</i>";
                    campoEmail.addClass("is-valid");
                    document.getElementById("preboton").disabled = false;
                } else {
                    document.getElementById("checkemail").innerHTML = "<a href='http://localhost" + URL_PATH + "'>Registrate aqu&iacute;</a>";
                    campoEmail.addClass("is-invalid");
                    document.getElementById("preboton").disabled = true;
                }
            });
    }
}


/* passOlvidada.phtml onload */
function webpassOlvidadaLoad() {
    $("#loaderpost").css('visibility', 'hidden'); //oculto el loader
}

function webpassOlvidadaLoader() {
    $("#loaderpost").css('visibility', 'visible');

}
