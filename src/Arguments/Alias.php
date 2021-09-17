<?php

namespace Doom\Arguments;

use Doom\Validators\PropertyValidator;

class Alias extends ArgumentImpl {
    function apply(PropertyValidator $field) : void{
        $field->setAlias($this->param);
    }
}