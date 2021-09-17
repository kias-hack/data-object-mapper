<?php

namespace Doom\Reflection;

use Doom\Factories\ReflectionPropertyFactory;

class ReflectionRepresentation
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;

    /**
     * @var ReflectionPropertyFactory
     */
    protected $reflectionPropertyFactory;

    public function __construct(string $className)
    {
        if(!class_exists($className))
            // TODO создать исключение
            throw new \Exception("Error. Class $className not found");

        $this->className = $className;

        $this->reflectionClass = new \ReflectionClass($className);

        $this->reflectionPropertyFactory = ReflectionPropertyFactory::getInstance();
    }

    public function getProperties(){
        return $this->reflectionPropertyFactory->fromReflectionClass($this->reflectionClass);
    }
}