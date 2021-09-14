<?php

namespace Doom\Validators;

class FloatValidator implements Validator {
    function validate($value) : bool {
        return is_float($value) && !is_string($value);
    }
}