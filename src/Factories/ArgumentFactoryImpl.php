<?php

namespace Doom\Factories;

use Doom\Arguments\Alias;
use Doom\Arguments\Argument;
use Doom\Arguments\Required;
use Doom\Arguments\Type;

class ArgumentFactoryImpl implements ArgumentFactory{
    /**
     * @var ArgumentFactoryImpl
     */
    static protected $instance;

    static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new self;

        return self::$instance;
    }

    function create($name, $value) : Argument{
        switch ($name) {
            case "Alias":
                return new Alias($value);
            case "Type":
                return new Type($value);
            case "Required":
                return new Required($value);
            // TODO create exception
            default:
                throw new \Exception("unknown argument " . $name);
        }
    }
}