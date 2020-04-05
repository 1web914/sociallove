function clickVip(id) {
    /* hacer fetch con la bd para que me devuelva los datos correspondientes a la id marcada. */

    var paquete;
    var precioPorDia;

    if (id == 1) {
        paquete = 6;
    } else if (id == 2) {
        paquete = 3;
    } else if (id == 3) {
        paquete = 1;
    }
    fetch(URL_PATH + "/api/descripcion/" + id)
        .then((res) => res.json())
        .then((res) => {
            var titulo = document.getElementById("titulo");
            var precio = document.getElementById("precio");
            var preciodia = document.getElementById("preciodia");
            var idpaquete = document.getElementById("idpaquete");
            idpaquete.setAttribute("value", id);
            titulo.innerHTML = res.titulo;
            precio.innerHTML = res.precio;

            if (res.precio == 6.90) {
                precioPorDia = res.precio / 7;
            } else {
                precioPorDia = (res.precio / paquete) / 30;
            }
            preciodia.innerHTML = precioPorDia.toFixed(2);

            var clickbody = document.getElementById(id);
            $('.clickbody').addClass('sinclick-body');
            $('.clickbody').removeClass('click-body');

            if (clickbody.classList.contains('sinclick-body')) {
                clickbody.classList.remove('sinclick-body');
                clickbody.classList.add('click-body');
            }

            var sinclickheader = document.getElementById(id + "1");
            $('.clickheader').addClass('sinclick-header');
            $('.clickheader').removeClass('click-header');

            if (sinclickheader.classList.contains('sinclick-header')) {
                 sinclickheader.classList.remove('sinclick-header');
                sinclickheader.classList.add('click-header');
            }

        })
}