<?php

namespace Doom\Arguments;

use Doom\Decorators\PropertyDecorator;

interface Argument {
    function apply(PropertyDecorator $field) : void;
}