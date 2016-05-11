<?php

namespace RWebServices\DomainAvailability\Client;

use RWebServices\DomainAvailability\Exception\ReadTimeOutException;
use RWebServices\DomainAvailability\Exception\ConnectionException;


/**
 * A simple WHOIS Server client that connects to the specified server and sends a whois query according to RFC3912
 * Class simpleWhoisClient
 * @author Helge Sverre
 * @package HelgeSverre\Client
 */
class SimpleWhoisClient implements WhoisClientInterface
{
    protected $server;
    protected $port = 43;
    protected $timeout;

    protected $errno;
    protected $errorstr;

    protected $response;
    
    public function __construct($server = false, $port = 43, $timeout = 60) {
        if ($server) $this->server = $server;
        if ($port) $this->port = $port;
        $this->timeout = $timeout;

        $this->errno = null;
        $this->errorstr = null;
    }

    /**
     * @param string $domain the domain name to get whois data for
     */
    public function query($domain)
    {
        $bResult = false;

        // Initialize the response to null
        $response = null;

        // Get the filePointer to the socket connection
        $filePointer = @fsockopen($this->server, $this->port, $this->errno, $this->errorstr, $this->timeout); // Suppress warnings

        // Check if we have a file pointer
        if ($filePointer) {

            // Send our query to the file pointer
            fwrite($filePointer, self::formatQueryString($domain));

            // Set read timeout
            stream_set_timeout($filePointer, $this->timeout);

            // Append the response from the server to the response variable until end of file is reached
            while (!feof($filePointer)) {
                $response .= fgets($filePointer, 128);
            }

            $info = stream_get_meta_data($filePointer);
            // Close the file pointer
            fclose($filePointer);
        } else {
            throw new ConnectionException($this->server, $this->port, $this->errno, null, $this->errorstr);
        }

        // return the response, even if we never sent a request
        $this->response = $response;

        if ($info['timed_out']) {
            throw new ReadTimeOutException();
        } else {
            $bResult = true;
        }
        
        return $bResult;
    }

    private static function formatQueryString($queryString)
    {
        $temp = strtolower($queryString);
        $temp = trim($temp);

        // Format the domain query according to RFC3912
        return $temp . "\r\n";
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string the whois server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getTimeout() {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout) {
        $this->timeout = $timeout;
    }

    /**
     * @return null
     */
    public function getErrno() {
        return $this->errno;
    }

    /**
     * @return null
     */
    public function getErrorstr() {
        return $this->errorstr;
    }


}