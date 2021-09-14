<?php

namespace Doom\Arguments;

use Doom\Field;

interface Argument {
    function apply(Field $field) : void;
}