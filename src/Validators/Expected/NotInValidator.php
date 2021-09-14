<?php

namespace Doom\Validators\Expected;

class NotInValidator extends ExpectedValidator {
    function validate($value) : bool {
        return !in_array($value, $this->expected);
    }
}