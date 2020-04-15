/* Alberto */

// NOMBRE 1 metodo
function comprobarPreNombre() {
    let regex = /^[a-zA-Záéíóú][a-zA-Záéíóú\s]{3,30}$/;
    let prenombre = $('#prenombre').val();
    let colorPrenombre = $('#prenombre');
    if (prenombre === '') {
        colorPrenombre.addClass("is-invalid");
    } else if (!regex.test(prenombre)) {
        colorPrenombre.addClass("is-invalid");
    } else {
        colorPrenombre.removeClass("is-invalid");
        colorPrenombre.addClass("is-valid");
    }
}


// EMAIL 2 metodos
function comprobaremail() {
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
                if (res.emailExiste == 0) {
                    document.getElementById("checkemail").innerHTML = "<i class='fa fa-check' style='color:green'>Email disponible</i>";
                    campoEmail.addClass("is-valid");
                    document.getElementById("preboton").disabled = false;
                } else {
                    document.getElementById("checkemail").innerHTML = "<i class='fa fa-close' style='color:red'>Email ya existe";
                    campoEmail.addClass("is-invalid");
                    document.getElementById("preboton").disabled = true;
                }
            });
    }
}

function validarEmailCorrecto(valor) {
    var regex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return regex.test(valor) ? true : false;
}


// CONTRASEÑA 2 metodos
function validarprePassword(valor){
    //letras 1-15 y numeros 1-15
    /*The password can only contain letters and/or digits and must be at least 6 characters long and no more than 20. I know it says {6,18} but it just works out that way*/
    var regex = /^([a-zA-Z0-9]{6,20}?)$/;
    return regex.test(valor) ? true : false;
}

function cssvalidarprePassword() {
    let preContrasenia = $('#txtPassword').val();
    let colorPreContrasenia = $('#txtPassword');
    if (!validarprePassword(preContrasenia)) {
        colorPreContrasenia.addClass("is-invalid");
        document.getElementById("preboton").disabled = true;
    } else {
        colorPreContrasenia.removeClass("is-invalid is-valid");
        colorPreContrasenia.addClass("is-valid");
        document.getElementById("preboton").disabled = false;
    }
}




// ENVIAR PRE-FORM
//verificamos el genero y la fecha antes de enviar el form
//verificamos el genero y la fecha antes de enviar el form
function validarModal() {
    generoPreform = document.getElementById("register-sex").value;
    day = document.getElementById("day").value;
    month = document.getElementById("month").value;
    year = document.getElementById("year").value;
    $('#formuModal').submit(function (e) {
        if (day === "DD") {
            e.preventDefault();
            e.stopPropagation();
            $("#day").addClass("is-invalid");
            //alert('falta seleccionar el dia');
        }
        if (month === "MM") {
            e.preventDefault();
            e.stopPropagation();
            $("#month").addClass("is-invalid");
        }
        if (year === "AA") {
            e.preventDefault();
            e.stopPropagation();
            $("#year").addClass("is-invalid");
        }
        if (generoPreform === "X") {
            e.preventDefault();
            e.stopPropagation();
            $("#register-sex").addClass("is-invalid");
        }
    });
}

// FECHA DE NACIMIENTO 3 metodos
//estos 3 metodos son de onchange para los colores de los selects del pre-form.
//fecha nacimiento y genero
function cumpleD() {
    day = $("#day").val();
    $("#day").removeClass("is-invalid");
    $("#day").addClass("is-valid");
}

function cumpleM() {
    month = $("#month").val();
    $("#month").removeClass("is-invalid");
    $("#month").addClass("is-valid");
}

function cumpleY() {
    year = $("#year").val();
    $("#year").removeClass("is-invalid");
    $("#year").addClass("is-valid");
}

// GENERO 1 metodo
function genero() {
    //solo cambia color
    generoPreform = $("#register-sex").val();
    $("#register-sex").removeClass("is-invalid");
    $("#register-sex").addClass("is-valid");
}
