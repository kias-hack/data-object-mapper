<?php

namespace Doom\Validators;

class StringValidator implements Validator {
    function validate($value) : bool {
        return is_string($value);
    }
}