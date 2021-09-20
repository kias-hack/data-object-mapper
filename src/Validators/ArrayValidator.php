<?php

namespace Doom\Validators;

class ArrayValidator implements Validator
{
    public function validate($value): bool
    {
        return is_array($value);
    }
}