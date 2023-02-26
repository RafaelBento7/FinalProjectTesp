<?php

namespace common\components;


use common\components\phpMQTT;

class Mosquitto
{

    public function FazPublishNoMosquitto($canal, $msg)
    {
        $server = "localhost";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
    }
}