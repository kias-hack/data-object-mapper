<?php

namespace Doom\Validators;

class BooleanValidator implements Validator {
    function validate($value) : bool {
        return is_bool($value);
    }
}