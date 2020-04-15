function changePass(){
    var newPass = document.getElementById("password").value;
    var rePass = document.getElementById("repassword").value;

    if(newPass === "" || rePass === ""){
        Swal.fire({
            icon: 'warning',
            type: 'info',
            title: 'Oops...',
            text: '¡Hay algún tipo de error, revíselo!',
            timer: 3000,
            showConfirmButton: false
        });
        return false;
    }
    return true;
}
