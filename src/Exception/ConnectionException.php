<?php
/**
 * Created by PhpStorm.
 * User: HakimR
 * Date: 01/05/2016
 * Time: 16:24
 */

namespace RWebServices\DomainAvailability\Exception;


class ConnectionException extends \Exception {
    // Redefine the exception so message isn't optional
    public function __construct($server, $port, $code = 0, \Exception $previous = null, $errorstr = null) {
        // some code

        // make sure everything is assigned properly
        $error = "Error to connect to the whois server $server:$port.";

        if(!is_null($errorstr)) $error .= ' '.$errorstr;
        parent::__construct($error);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{>code}]: {>message}\n";
    }
}