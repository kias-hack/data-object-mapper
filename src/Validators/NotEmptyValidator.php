<?php

namespace Doom\Validators;

class NotEmptyValidator implements Validator {
    function validate($value) : bool {
        return !empty($value);
    }
}