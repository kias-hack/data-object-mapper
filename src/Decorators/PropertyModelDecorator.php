<?php

namespace Doom\Decorators;

use Doom\Mutators\Mutator;
use Doom\Mutators\PropertyMutator;
use Doom\Reflection\Property\ReflectionPropertyImpl;
use Doom\Validators\PropertyValidator;

class PropertyModelDecorator extends ReflectionPropertyImpl implements PropertyDecorator {
    protected $validators = [];
    protected $alias;
    protected $isAliasSetup = false;
    protected $mutators = [];

    public function clearMutator()
    {
        $this->mutators = [];
    }

    public function addMutator(Mutator $mutator)
    {
        $this->mutators[] = $mutator;
    }

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
        /**
         * @var $mutator Mutator
         */
        foreach ($this->mutators as $mutator){
            $value = $mutator->mutate($value);
        }

        foreach ($this->validators as $validator){
            if(!$validator->validate($value)){
                // TODO создать исключение
                throw new \Exception("fall check value " . get_class($validator));
            }
        }

        $this->reflectionProperty->setValue($object, $value);
    }
}