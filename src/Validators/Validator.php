<?php

namespace Doom\Validators;

interface  Validator {
    function validate($value) : bool;
}