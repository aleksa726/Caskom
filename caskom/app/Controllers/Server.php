<?php
/* Sava Gavrić 0359/18 */

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Chat;

    /**
     * Server
     * WebSocket server podignut na portu 8081, pokreće se kao posebna  
     * nit kontrole i služi kao posrednik u komunikaciji moderatora i
     * korisnika.
     */

    require 'C:\wamp64\www\repo\Implementacija\CI implementacija\caskom/vendor/autoload.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8081
    );

    $server->run();