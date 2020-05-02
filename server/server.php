<?php
set_time_limit(0);
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require_once '../vendor/autoload.php';

/*
onOpen : se llama cuando un nuevo cliente se ha conectado
onMessage : se llama cuando un mensaje es recibido por una conexión
onClose : se llama cuando se cierra una conexión
onError : se llama cuando se produce un error en una conexión
*/



class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;

	public function __construct() {
		$this->clients = new \SplObjectStorage;
		echo "Servidor Arrancado\n";
	}

	public function onOpen(ConnectionInterface $conn) {
		$this->clients->attach($conn);
       
		// $this->users[$conn->resourceId] = $conn;
        
        
        echo "Nueva conexion del numero: ({$conn->resourceId})\n";        
	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		// unset($this->users[$conn->resourceId]);
        echo "Connection {$conn->resourceId} se desconecto\n";
	}

	public function onMessage(ConnectionInterface $from,  $data) { //una vez pulsado "enter" llega aqui
		$from_id = $from->resourceId;        
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'chat':
				$user_id = $data->user_id; //login del usuario se extrae del $data JSON
				$chat_msg = $data->chat_msg; //mensaje se extrae del $data JSON
                $fotoa = $data->fotoa; //foto de mensajeA
                $fotob = $data->fotob; //foto de mensajeB
                $horaconvers = $data->horaconvers;
				//$response_from = "<span style='color:#000000'><b>".$user_id.":</b> ".$chat_msg."</span><br><br>";
				//buble respuesta de aalola
                /*echo "\n";
                echo($fotoa); */
                
                $response_from =                 
                                "<div class='card-body p-0'>    
                                            <div class='bubbleWrapper'>
                                                <div class='inlineContainer'>   
                                                    <img class='inlineIcon ml-2' src='$fotoa'>                                                    
                                                    <div class='otherBubble other'>
                                                    <span class='other text-primary'>".$horaconvers."&nbsp;</span>"
                                                        .$chat_msg.
                                                    "</div>
                                                </div>
                                            </div>";          
             
                //$response_to = "<b>".$user_id."</b>: ".$chat_msg."<br><br>";
                //buble respuesta para pepe
                $response_to = 
                                "<div class='bubbleWrapper'>
                                                <div class='inlineContainer own'>
                                                    <img class='inlineIcon mr-3' src='$fotoa'>

                                                    <div class='ownBubble own'>
                                                    <span class='other text-primary'>".$horaconvers."&nbsp;</span>"
                                                       .$chat_msg.
                                                    "</div>
                                                </div>
                                            </div>";             
                
				// reenviamos el paquete  de nuevo al js
				$from->send(json_encode(array("type"=>$type,"msg"=>$response_from))); //me lo envia a mi
				foreach($this->clients as $client)
				{                  
					if($from!=$client) //y si hay otro cliente se lo envia al otro tmbn con el siguiente send  
					{
						$client->send(json_encode(array("type"=>$type,"msg"=>$response_to)));
					}
				}
				break;
		}
	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
		echo "An error has occurred: {$e->getMessage()}\n";
		$conn->close();
	}
    
}




$server = IoServer::factory(
	new HttpServer(new WsServer(new Chat())),
	8080
);
$server->run();
?>
