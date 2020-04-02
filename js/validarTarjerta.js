function validarTarjeta(){
    var tarjetaValida = document.getElementById('visaCorrecto');
    var tarjetaNOValida = document.getElementById('errorTarjeta');

  $('input').validateCreditCard(function(result) {
        $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                 + '<br>Valid: ' + result.valid
                 + '<br>Length valid: ' + result.length_valid
                 + '<br>Luhn valid: ' + result.luhn_valid);
                 console.log(result);
                 if(result.valid){
                    tarjetaValida.innerHTML ="Tarjeta correcta" ;
                    tarjetaNOValida.innerHTML ="";
                   }else{
                       tarjetaValida.innerHTML ="";
                       tarjetaNOValida.innerHTML ="*Tarjeta invalida" ;
                   }    
    }); 
    
}

    