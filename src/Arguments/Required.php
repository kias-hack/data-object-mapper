<?php

namespace Doom\Arguments;

use Doom\Validators\NotEmptyValidator;
use Doom\Validators\PropertyValidator;

class Required extends ArgumentImpl {
    function apply(PropertyValidator $field) : void{
        /**
         * TODO import class
         */
        $field->addValidator(new NotEmptyValidator);
    }
}