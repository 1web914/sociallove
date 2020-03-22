function verNotificaciones(){
    fetch(URL_PATH + "/api/notificaciones")
            .then((res) => res.json())
            .then(res => {
            });

            /* Hay que hacer las notificaciones cuando tengamos el perfil hecho, para ver las personas que han visitado el perfil de otro */
}