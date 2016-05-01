<?php

namespace RWebServices\DomainAvailability\Tests;

use RWebServices\DomainAvailability\Client\SimpleWhoisClient;
use RWebServices\DomainAvailability\Loader\JsonLoader;
use RWebServices\DomainAvailability\Service\DomainAvailability;


class DomainAvailabilityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RWebServices\DomainAvailability\Service\DomainAvailability
     */
    protected $service;

    public function setup()
    {

        require 'vendor/autoload.php';

        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader("src/data/servers.json");
        $this->service = new DomainAvailability($whoisClient, $dataLoader);


    }


    // TODO(22 okt 2015) ~ Helge: Write tests
}
