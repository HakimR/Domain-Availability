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


        $this->jsonLoader = new JsonLoader();


    }


    // TODO(22 okt 2015) ~ Helge: Write tests


}
