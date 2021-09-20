<?php

namespace Doom\Arguments;

use Doom\Decorators\PropertyDecorator;
use Doom\Model;
use Doom\Mutators\ModelDataMutator;
use Doom\Validators\ArrayValidator;
use Doom\Validators\BooleanValidator;
use Doom\Validators\EmailValidator;
use Doom\Validators\FloatValidator;
use Doom\Validators\IntValidator;
use Doom\Validators\NumericValidator;
use Doom\Validators\StrictedNumericValidator;
use Doom\Validators\StringValidator;

class Type extends ArgumentImpl {
    function apply(PropertyDecorator $field) : void {
        switch ($this->param) {
            case "int":
            case "integer":
                $field->addValidator(new IntValidator);
                break;
            case "array":
                $field->addValidator(new ArrayValidator);
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
                if(!$this->isExtendsModelClass($this->param))
                    throw new \Exception("unknown type " . $this->param); // TODO создать исключение

                $field->addMutator(new ModelDataMutator($this->param));
        }
    }

    protected function isExtendsModelClass(string $className){
        return class_exists($this->param) && in_array(Model::class, array_values(class_parents($className)));
    }
}