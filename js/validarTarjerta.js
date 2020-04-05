function validarTarjeta(){
    var tarjetaValida = document.getElementById('visaCorrecto');
    var tarjetaNOValida = document.getElementById('errorTarjeta');
    var todoOk = document.getElementById('tarjetacomprobada');

  $('input').validateCreditCard(function(result) {
        $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                 + '<br>Valid: ' + result.valid
                 + '<br>Length valid: ' + result.length_valid
                 + '<br>Luhn valid: ' + result.luhn_valid);
                 /* esto lleva a una etiqueta 'i', para validar luego el formulario.Con esto sabremos si la tarjeta es valida sino no manda el formulario */
                 todoOk.innerHTML = result.valid;
                 if(result.valid){
                    tarjetaValida.innerHTML ="Tarjeta correcta" ;
                    tarjetaNOValida.innerHTML ="";
                   }else{
                       tarjetaValida.innerHTML ="";
                       tarjetaNOValida.innerHTML ="*Tarjeta invalida" ;
                   }    
    }); 
    
}

    