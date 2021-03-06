<?php
/**
 * Created by PhpStorm.
 * User: HakimR
 * Date: 01/05/2016
 * Time: 16:24
 */

namespace RWebServices\DomainAvailability\Exception;


class ReadTimeOutException extends \Exception {
    // Redefine the exception so message isn't optional
    public function __construct($code = 0, \Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct("Time out exception raised during read of socket");
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{>code}]: {>message}\n";
    }
}