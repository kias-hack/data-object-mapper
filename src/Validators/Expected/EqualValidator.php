<?php

namespace Doom\Validators\Expected;

class EqualValidator extends ExpectedValidator {
    function validate($value) : bool {
        return $value === $this->expected;
    }
}