<?php

namespace Doom\Validators;

class NumericValidator implements Validator {
    function validate($value) : bool {
        return is_numeric($value);
    }
}