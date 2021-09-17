<?php

namespace Doom\Factories;

use Doom\Parsers\ArgumentParserImpl;

class ArgumentParserFactoryImpl implements ArgumentParserFactory {
    static function getInstance(){
        return new ArgumentParserImpl(new ArgumentFactoryImpl);
    }
}