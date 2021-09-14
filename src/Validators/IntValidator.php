<?php

namespace Doom\Validators;

class IntValidator implements Validator {
    function validate($value) : bool {
        return is_int($value) and !is_string($value);
    }
}