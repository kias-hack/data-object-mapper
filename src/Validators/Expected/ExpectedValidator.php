<?php

namespace Doom\Validators\Expected;

use Doom\Validators\Validator;

abstract class ExpectedValidator implements Validator {
    /**
     * @var mixed
     */
    protected $expected;

    function __construct($expected){
        $this->expected = $expected;
    }
}