<?php

namespace Doom\Validators;

use Doom\Field;
use Doom\Validators\Validator;


class FieldImpl implements Field {
    /**
     * @var Validator[]
     */
    protected $validators = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $alias;

    function __construct($field) {
        $this->name = "qwerty";
    }

    function getName() : string {
        return $this->name;
    }

    function setAlias(string $alias) {
        $this->alias = $alias;
    }

    function getAlias() : string {
        return $this->alias;
    }

    function setValidator(Validator $validator) {
        $this->validators[] = $validator;
    }

    function setValue($value) : void {
        foreach ($this->validators as $validator){
            if(!$validator->validate($value))
                throw new ValidateValueException($validator);
        }

        print_r($value);
    }
}