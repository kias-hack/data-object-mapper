<?php

namespace Doom\Mutators;

class ModelDataMutator implements Mutator
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function mutate($value)
    {
        if(!class_exists($this->class)){
            throw new \Exception("class " . $this->class . " not found");
        }

        return (new $this->class($value));
    }
}