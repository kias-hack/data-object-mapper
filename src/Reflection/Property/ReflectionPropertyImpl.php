<?php

namespace Doom\Reflection\Property;

class ReflectionPropertyImpl implements ReflectionProperty {
    protected $reflectionProperty;

    function __construct($property){
        /**
         * @var ReflectionProperty|\ReflectionProperty $property
         */
        $this->reflectionProperty = $property;
    }

    public function getAttributes(string $name = null, int $flags = 0) : array {
        return $this->reflectionProperty->getAttributes($name, $flags);
    }

    public function getDeclaringClass(): \ReflectionClass {
        return $this->reflectionProperty->getDeclaringClass();
    }

    public function getDefaultValue() {
        return $this->reflectionProperty->getDefaultValue();
    }

    public function getDocComment() {
        return $this->reflectionProperty->getDocComment();
    }

    public function getModifiers(): int {
        return $this->reflectionProperty->getModifiers();
    }

    public function getName(): string {
        return $this->reflectionProperty->getName();
    }

    public function getType() {
        return $this->reflectionProperty->getType();
    }

    public function getValue(object $object = null) {
        if(empty($object)) // TODO исключения
            throw new \Exception("object has null type");

        return $this->reflectionProperty->getValue($object);
    }

    public function hasDefaultValue(): bool {
        return $this->reflectionProperty->hasDefaultValue();
    }

    public function hasType(): bool {
        return $this->reflectionProperty->hasType();
    }

    public function isDefault(): bool {
        return $this->reflectionProperty->isDefault();
    }

    public function isInitialized(object $object = null): bool {
        return $this->reflectionProperty->isInitialized($object);
    }

    public function isPrivate(): bool {
        return $this->reflectionProperty->isPrivate();
    }

    public function isProtected(): bool {
        return $this->reflectionProperty->isProtected();
    }

    public function isPublic(): bool {
        return $this->reflectionProperty->isPublic();
    }

    public function isStatic(): bool {
        return $this->reflectionProperty->isStatic();
    }

    public function setAccessible(bool $accessible): void {
        $this->reflectionProperty->setAccessible($accessible);
    }

    public function setValue(object $object, $value): void {
        $this->reflectionProperty->setValue($object, $value);
    }
}