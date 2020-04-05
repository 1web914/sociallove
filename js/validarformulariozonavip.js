function validarformulariozonavip() {


    var tarjetaValida = document.getElementById('tarjetacomprobada').textContent;
    var numeroTarjeta = document.getElementById('card_number').value;
    var validezTarjeta = document.getElementById('expiry_date').value;
    var cvvTarjeta = document.getElementById('cvv').value;
    var sanitizar = sanitizarValidezCvv(validezTarjeta, cvvTarjeta);
        
    function sanitizarValidezCvv(fecha, cvv){
        let validFecha = true;
        let validCvv = true;
        let todoOk = true;
        if(!fecha.match(/^([0-9]{2})(\/)([0-9]{2})/ )){
            validFecha = false;
        }
        if(!cvv.match(/^[0-9]{3}/)){
            validCvv = false;
        }
        if(validFecha != true || validCvv != true){
            todoOk = false;
        }
        return todoOk;
    }

    if (numeroTarjeta === "" || validezTarjeta === "" || cvvTarjeta === "" || tarjetaValida === "false" || sanitizar != true) {
        Swal.fire({
            icon: 'warning',
            type: 'info',
            title: 'Oops...',
            text: '¡Hay algún tipo de error con la tarjeta, revíselo!',
            timer: 3000,
            showConfirmButton: false
        });
        return false;
    } else {
        return true;
    }

}