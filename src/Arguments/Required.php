<?php

namespace Doom\Arguments;

use Doom\Field;

class Required extends ArgumentImpl {
    function apply(Field $field) : void{
        /**
         * TODO import class
         */
        $field->setValidator(new NotEmptyValidator);
    }
}