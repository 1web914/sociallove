    jQuery(function($) {
        // Websocket
        var ws = new WebSocket("ws://localhost:8080/");
        
        
        ws.onopen = function(e) {
            console.log('conectado');
            ws.send( //se crea la conexion con un user_id
                JSON.stringify({
                    'type': 'socket',
                    'user_id': session
                })
            );
        };
        
        ws.onerror = function(e) {
            console.log('hubo un error en la conexion del socket');
        }

        // Events al pulsar enter keyCode==13
        //var fotoa = '/' + '<?php echo $fotoPerfil;?>';
        $('#chat_input').on('keyup', function(e) {
            if (e.keyCode == 13 && !e.shiftKey) {
                var chat_msg = $(this).val();
                var fotoa = fotoPerfil;
                var fotob = fotoPerfilB;
                //console.log(fotoa);
                var momentoActual = new Date();
                var hora = momentoActual.getHours();
                var minuto = momentoActual.getMinutes();
                var segundo = momentoActual.getSeconds();
                var horaconvers = hora + ":" + minuto;         

                if (chat_msg != "") {
                    ws.send( //enviamos la informacion al server.php
                        JSON.stringify({
                            'type': 'chat',
                            'user_id': session,
                            'chat_msg': chat_msg,
                            'fotoa': fotoa,
                            'fotob': fotob,
                            'horaconvers': horaconvers
                        })
                    );
                }
                $(this).val('');
            }
        });

        ws.onmessage = function(e) { //esta es la salida hacia la pagina
            var json = JSON.parse(e.data);
            switch (json.type) {
                case 'chat':
                    $('#chat_output').append(json.msg); //va dentro empaquetado
                    break;
            }
        }



    });

