<?php

namespace Doom\Validators;

class EmptyValidator implements Validator {
    function validate($value) : bool {
        return empty($value);
    }
}