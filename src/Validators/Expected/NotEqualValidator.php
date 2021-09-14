<?php

namespace Doom\Validators\Expected;

class NotEqualValidator extends ExpectedValidator {
    function validate($value) : bool {
        return $value !== $this->expected;
    }
}