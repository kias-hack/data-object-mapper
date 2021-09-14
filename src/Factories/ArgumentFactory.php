<?php

namespace Doom\Factories;

use Doom\Arguments\Argument;

interface ArgumentFactory {
    function create($name, $value) : Argument;
}