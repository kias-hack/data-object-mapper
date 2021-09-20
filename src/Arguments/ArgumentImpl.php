<?php

namespace Doom\Arguments;

use Doom\Decorators\PropertyDecorator;
use Doom\Validators\PropertyValidator;

abstract class ArgumentImpl implements Argument {
    /**
     * @var string|null
     */
    protected $param;

    function __construct(string $param = null) {
        $this->param = $param;
    }

    abstract function apply(PropertyDecorator $field) : void;
}