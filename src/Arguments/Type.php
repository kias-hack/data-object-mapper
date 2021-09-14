<?php

namespace Doom\Arguments;

use Doom\Field;

class Type extends ArgumentImpl {
    function apply(Field $field) : void {
        /**
         * TODO import classes
         */
        switch ($this->param) {
            case "int":
            case "integer":
                $field->setValidator(new IntValidator);
                break;
            case "bool":
            case "boolean":
                $field->setValidator(new BooleanValidator);
                break;
            case "string":
                $field->setValidator(new StringValidator);
                break;
            case "numeric":
                $field->setValidator(new StrictedNumericValidator);
                break;
            case "string, numeric":
            case "numeric, string":
                $field->setValidator(new NumericValidator);
                break;
            case "email":
                $field->setValidator(new EmailValidator);
                break;
            case "float":
                $field->setValidator(new FloatValidator);
                break;
            default:
                // TODO create exception
                throw new \Exception("unknown type" . $this->param);
        }
    }
}