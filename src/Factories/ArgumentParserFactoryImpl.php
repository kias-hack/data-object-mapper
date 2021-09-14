<?php

namespace Doom\Factories;

use Doom\Parsers\ArgumentParserIml;

class ArgumentParserFactoryImpl implements ArgumentParserFactory {
    static function getInstance(){
        return new ArgumentParserIml(new ArgumentFactoryImpl);
    }
}