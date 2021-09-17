<?php

namespace Doom\Arguments;

use Doom\Validators\PropertyValidator;

interface Argument {
    function apply(PropertyValidator $field) : void;
}