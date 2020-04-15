function passOlvidada() {

    var mail = document.getElementById('email').value;
    var captcha = grecaptcha.getResponse();
    /* ESTO LO DEJAMOS ASí YA QUE PUEDEN MANIPULAR EL REQUIRED Y DEJARLO EN BLANCO, ASI QUE HACEMOS COMPROBACIONES */
    if(mail === ""){
        Swal.fire({
            icon: 'warning',
            type: 'info',
            title: 'Email vacio!! Porfavor,Rellénelo.',
            timer: 3000,
            showConfirmButton: false
        });
    }
    console.log(captcha);


    /* Voy hacer un fetch para ver si me devuelve true al hacer recaptcha */
     /* window.location.replace(URL_PATH + "/api/recaptcha/" + captcha);  ESTO ES UNA PRUEBA PARA ER LO QUE NOS DARÍA ESTÁ
     TODO COMENTADO EN EL API CONTROLLER PASSOLVIDADA, TENEMOS EL ERROR DEL FETCH,DE MOMENTO HASTA NUEVO AVISO LO DEJAMOS ASI. */
   /*  fetch(URL_PATH + "/api/recaptcha/" + captcha)
        .then((res) => res.json())
        .then(res => {
            console.log(res);
        }); */

    return true;


}
