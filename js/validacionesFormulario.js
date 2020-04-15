/******************** Alberto ********************/

/* Al cargar el post-formulario */
function webcargada() {
    // desactivo repassword ONLOAD WEB/ y activo escuchador de eventos en Contraseña
    //alert(a);
    plugPasswStreng();
    $("#loaderpost").css('visibility', 'hidden'); //oculto el loader
    //document.getElementById("repassword").disabled = true; //desactivo repassword NOBORRAR
    $("#password").keyup(comprobarPasswordSeguro);
    $("#repassword").keyup(comprobarPasswordIguales);
}

/* Login 1 metodo */
function existeLogin() {
    login = $('#login').val();
    //console.log(login);
    //var userlenght = login.length; ya lo compruebas con el regex
    let campoLogin = $('#login');
    let regex = /^(?=.*[a-zA-Z])([A-Za-z0-9]){2,20}$/;

    if (!regex.test(login)) {
        console.log("regex no valido");
        document.getElementById("checkusername").innerHTML = "<i class='fa fa-close' style='color:red'> &nbsp;No válido</i>  <input id='usernamechecker' type='hidden' value='0' name='usernamechecker'> ";
        campoLogin.addClass("is-invalid");
        document.getElementById("thesubmitBoton").disabled = true;
    } else {
        document.getElementById("checkusername").innerHTML = "";
        fetch(URL_PATH + "/api/comprobarLogin/" + login)
            .then((res) => res.json())
            .then((res) => {
                campoLogin.removeClass("is-invalid is-valid");
                if (res.loginExiste == 0) {
                    document.getElementById("checkusername").innerHTML = "<i class='fa fa-check' style='color:green'>&nbsp;Disponible</i>";
                    campoLogin.addClass("is-valid");
                    document.getElementById("thesubmitBoton").disabled = false;
                } else {
                    document.getElementById("checkusername").innerHTML = "<i class='fa fa-close' style='color:red'>&nbsp;nombre ocupado";
                    campoLogin.addClass("is-invalid");
                    document.getElementById("thesubmitBoton").disabled = true;
                }

            });
        //console.log("en la bd no existe");
    }
}


/* Contraseña y Repite Contraseña 3 metodos */
function comprobarPasswordSeguro() {
    document.getElementById('password').addEventListener('input', function (e) {
        const campo = e.target,
            valido = document.getElementById('checkpass'),
            regex = /^(?=.*\d)(?=.*[a-záéíóúüñ]).*[A-ZÁÉÍÓÚÜÑ]/;
        if (regex.test(campo.value)) {
            document.getElementById("checkpass").innerHTML = "<i class='fa fa-check' style='color:green'>Válido</i>";
            //valido.innerText = "válida";
            document.getElementById("repassword").disabled = false;
        } else {
            document.getElementById("checkpass").innerHTML = "<i class='fa fa-check' style='color:red'>Insegura</i>";
        }
    });
}

function comprobarPasswordIguales() {
    var password = $("#password").val(); //para validar si son =les
    var confirmarPassword = $("#repassword").val(); //para validar si son =les
    //console.log(password);
    if (password != confirmarPassword) {
        $("#divcomprobarsisoniguales").html("<i class='fa fa-close pt-2' style='color:red'>&nbsp;Las claves no coinciden</i><input value='error' type='hidden'>");
        document.getElementById("checkrepass").innerHTML = "";

        document.getElementById("thesubmitBoton").disabled = true;
    } else {
        $("#divcomprobarsisoniguales").html("<i class='fa fa-check pt-2' style='color:green'>Las claves coinciden</i> <input type='hidden'  value='1'>");
        document.getElementById("thesubmitBoton").disabled = false;
        var camporePassword = $("#repassword"); //para cambiar el color
        var campoPassword = $("#password"); //para cambiar el color
        campoPassword.addClass("is-valid");
        camporePassword.addClass("is-valid");
        document.getElementById("checkrepass").innerHTML = "<i class='fa fa-check' style='color:green'>Válido</i>";

    }
}

function plugPasswStreng(a) {
    //console.log(a);
    //console.log($('#password').val());
    $('#password').passtrength({
        passwordToggle: true,
        eyeImg : 'assets/fotosInterfaces/visibilidad.svg',
        //eyeImg: "img/eye.svg",
        tooltip: true,
        textWeak: "Debil",
        textMedium: "Medio",
        textStrong: "Fuerte",
        textVeryStrong: "Muy fuerte"
    });
}


/* Sobreti counter oninput 1 metodo  */
function sendCounter() {
    var textarea = document.getElementById("textarea"),
        counter = document.getElementById("count"),
        maxLength = textarea.getAttribute("maxlength");
    counter.innerHTML = maxLength;
    textarea.oninput = function () {
        counter.innerHTML = maxLength - this.value.length;
        if (counter.innerHTML == 0) {
            counter.classList.add("zero");
        } else {
            counter.classList.remove("zero");
        }
    }
}

/* loquebuscas counter input 1 metodo  */
function sendCounter2() {
    var loquebuscas = document.getElementById("loquebuscas"),
        counter2 = document.getElementById("count2"),
        maxLength2 = loquebuscas.getAttribute("maxlength");
    counter2.innerHTML = maxLength2;
    loquebuscas.oninput = function () {
        counter2.innerHTML = maxLength2 - this.value.length;
        if (counter2.innerHTML == 0) {
            counter2.classList.add("zero");
        } else {
            counter2.classList.remove("zero");
        }
    }
}

/* EDAD 1 metodo */
function comprobarEdad() {
    let edad = $('#edad').val();
    console.log(edad);
    if (edad < 18) {
        //console.log("debes tener 18 años");
        $('#edad').val("");
        document.getElementById("checkEdad").innerHTML = "&nbsp;<i class='fa fa-exclamation' style='color:yellow'> Debes ser mayor de edad</i> ";
    } else if (edad > 99) {
        $('#edad').val("");
    } else {
        document.getElementById("checkEdad").innerHTML = "";
    }
}

/* Preferencia de busqueda 1 metodo  onchange */

function selectBusco() {
    let buscoid = $('#buscoid').val();
    //alert(buscoid);
    if (buscoid !== "Selecciona una opcion") {
        $("#errbuscoid").html("");
    }
}

/* file input 2 metodos*/
function resetImage(input) {
    input.value = '';
    input.onchange();
}

function readImage(input) {
    var receiver = input.nextElementSibling.nextElementSibling;
    input.setAttribute('title', input.value.replace(/^.*[\\/]/, ''));
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            receiver.style.backgroundImage = 'url(' + e.target.result + ')';
        };
        reader.readAsDataURL(input.files[0]);
    } else receiver.style.backgroundImage = 'none';
}




/* Enviar ----> al enviar el form 2 metodos  */
$(document).ready(function () {
    $('form').submit(function (e) {
        if ($('#nombre').val()) {
            var validNom = $('#nombre').val();
        } else {
            var validNom = nombrePhp;
        }
        let validApe = $('#apellidos').val();
        let validProv = $('#ubicacion').val();
        $('#nombre').val(sanitizar(validNom));
        $('#apellidos').val(sanitizar(validApe));
        $('#ubicacion').val(sanitizar(validProv));

        //DEBE MARCAR una PREFERENCIA DE BUSQUEDA
        let buscoid = $('#buscoid').val();
        if (buscoid == "Selecciona una opcion") {
            e.preventDefault();
            $("#errbuscoid").html("<i class='fa fa-close' style='color:red'>&nbsp;Elige una opcion</i>");
        } else {
            $("#loaderpost").css('visibility', 'visible');
        }



    });
});

function sanitizar(str) {
    strClean = str.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
    strMax30 = strClean.slice(0, 30); //maximo 30 caracteres
    return strMax30;
}
