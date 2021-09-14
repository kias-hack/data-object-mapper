<?php

namespace Doom\Validators;

class EmailValidator implements Validator {
    function validate($value) : bool {
        if(strpos($value, "@") <= 0)
            return false;

        $pair = explode("@", $value);

        if(count($pair) != 2)
            return false;

        if(strlen($pair[0]) < 1 || strlen($pair[1]) < 1)
            return false;

        return true;
    }
}