<?php

namespace Doom\Arguments;

use Doom\Field;

abstract class ArgumentImpl implements Argument {
    /**
     * @var string|null
     */
    protected $param;

    function __construct(string $param = null) {
        $this->param = $param;
    }

    abstract function apply(Field $field) : void;
}