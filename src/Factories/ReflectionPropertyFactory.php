<?php

namespace Doom\Factories;

use Doom\Proxy\OldPHPProxy;
use Doom\Reflection\Property\ReflectionPropertyImpl;

class ReflectionPropertyFactory
{
    static protected $instance;

    static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self;

        return self::$instance;
    }

    public function fromReflectionClass(\ReflectionClass $for){
        $properties = $for->getProperties();

        foreach ($properties as &$property){
            $property = new ReflectionPropertyImpl($property);
            // TODO сделать проверку на версию PHP
            $property = new OldPHPProxy($property);
        }

        return $properties;
    }
}