<?php

namespace Helge\Tests;

use RWebServices\DomainAvailability\Client\SimpleWhoisClient;

class SimpleWhoisClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RWebServices\DomainAvailability\Client\WhoisClientInterface
     */
    protected $whoisClient;

    public function setup()
    {

        require 'vendor/autoload.php';


        $this->whoisClient = new SimpleWhoisClient();


    }

    /**
     * Test that the .com whois server is responding as excpected with google.com
     */
    public function testComWhoisClient(){
        $this->whoisClient->setServer("whois.verisign-grs.com");

        $this->whoisClient->query("google.com");

        $this->assertStringStartsWith("\nWhois Server ", $this->whoisClient->getResponse());
    }
}
