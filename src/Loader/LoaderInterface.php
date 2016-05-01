<?php

namespace RWebServices\DomainAvailability\Loader;

interface LoaderInterface
{

    public function __construct($path);

    public function load();


}