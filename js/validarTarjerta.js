function validarTarjeta(){
    //genera solo validaciones de tarjeta tipo Visa.

    var error = document.getElementById("errorTarjeta");
    var correcto = document.getElementById("visaCorrecto");
    var tarjeta = document.getElementById("tarjeta").value;
    console.log(tarjeta);


    var cadena = tarjeta.toString();
    var longitud = cadena.length;
    var cifra = null;
    var cifra_cad=null;
    var suma=0;

    for (var i=0; i < longitud; i+=2){
      cifra = parseInt(cadena.charAt(i))*2;
      if (cifra > 9){ 
        cifra_cad = cifra.toString();
        cifra = parseInt(cifra_cad.charAt(0)) + 
   parseInt(cifra_cad.charAt(1));
      }
      suma+=cifra;
    }

    for (var i=1; i < longitud; i+=2){
      suma += parseInt(cadena.charAt(i));
    }
       
    if ((suma % 10) == 0){ 
      error.innerHTML ="";
        correcto.innerHTML = "Número de Visa  correcto";
    } else {
      correcto.innerHTML ="";
        error.innerHTML = "No es un número de Visa correcto";
    }
   }