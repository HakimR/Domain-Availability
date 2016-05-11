<?php

namespace Helge\Tests;

use RWebServices\DomainAvailability\Loader\JsonLoader;

class JsonLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \RWebServices\DomainAvailability\Loader\JsonLoader
     */
    protected $jsonLoader;

    public function setup()
    {

        require 'vendor/autoload.php';


        $this->jsonLoader = new JsonLoader('src/data/servers.json');

    }

    /**
     * Test that the it extension is readable from the json table
     */
    public function testGetItExtention() {

        $json = $this->jsonLoader->load();

        $this->assertNotEmpty($json);

        $this->assertArrayHasKey('it', $json);
    }
}
