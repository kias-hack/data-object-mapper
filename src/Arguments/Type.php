<?php

namespace Doom\Arguments;

use Doom\Validators\BooleanValidator;
use Doom\Validators\EmailValidator;
use Doom\Validators\FloatValidator;
use Doom\Validators\IntValidator;
use Doom\Validators\NumericValidator;
use Doom\Validators\PropertyValidator;
use Doom\Validators\StrictedNumericValidator;
use Doom\Validators\StringValidator;

class Type extends ArgumentImpl {
    function apply(PropertyValidator $field) : void {
        /**
         * TODO import classes
         */
        switch ($this->param) {
            case "int":
            case "integer":
                $field->addValidator(new IntValidator);
                break;
            case "bool":
            case "boolean":
                $field->addValidator(new BooleanValidator);
                break;
            case "string":
                $field->addValidator(new StringValidator);
                break;
            case "numeric":
                $field->addValidator(new StrictedNumericValidator);
                break;
            case "string, numeric":
            case "numeric, string":
                $field->addValidator(new NumericValidator);
                break;
            case "email":
                $field->addValidator(new EmailValidator);
                break;
            case "float":
                $field->addValidator(new FloatValidator);
                break;
            default:
                // TODO create exception
                throw new \Exception("unknown type" . $this->param);
        }
    }
}