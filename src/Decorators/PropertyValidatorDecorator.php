<?php

namespace Doom\Decorators;

use Doom\Reflection\Property\ReflectionPropertyImpl;
use Doom\Validators\PropertyValidator;

class PropertyValidatorDecorator extends ReflectionPropertyImpl implements PropertyValidator {
    protected $validators = [];
    protected $alias;
    protected $isAliasSetup = false;

    public function addValidator($validator) : void {
        $this->validators[] = $validator;
    }

    public function clearValidator() : void {
        $this->validators = [];
    }

    public function setAlias(string $alias) : void {
        $this->alias = $alias;
        $this->isAliasSetup = true;
    }

    public function hasAlias() : bool {
        return $this->isAliasSetup;
    }

    public function getAlias() : string {
        return $this->alias;
    }

    public function setValue(object $object, $value): void {

        foreach ($this->validators as $validator){
            if(!$validator->validate($value)){
                // TODO создать исключение
                throw new \Exception("fall check value " . get_class($validator));
            }
        }

        $this->reflectionProperty->setValue($object, $value);
    }
}