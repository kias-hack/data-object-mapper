<?php

namespace Doom\Validators;

class StrictedNumericValidator implements Validator {
    function validate($value) : bool {
        return is_numeric($value) && !is_string($value);
    }
}