<?php

namespace Doom\Arguments;

use Doom\Field;

class Alias extends ArgumentImpl {
    function apply(Field $field) : void{
        $field->setAlias($this->param);
    }
}