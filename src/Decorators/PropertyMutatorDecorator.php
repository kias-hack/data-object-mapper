<?php

namespace Doom\Decorators;

use Doom\Mutators\Mutator;
use Doom\Mutators\PropertyMutator;
use Doom\Reflection\Property\ReflectionPropertyImpl;

class PropertyMutatorDecorator extends ReflectionPropertyImpl implements PropertyMutator
{
    protected $mutators;

    public function addMutator(Mutator $mutator)
    {
        $this->mutators[] = $mutator;
    }

    public function clearMutator()
    {
        $this->mutators = [];
    }

    public function setValue(object $object, $value): void
    {
        /**
         * @var $mutator Mutator
         */
        foreach ($this->mutators as $mutator){
            $value = $mutator->mutate($value);
        }

        parent::setValue($object, $value);
    }
}