<?php

namespace Doom\Reflection\Property;

interface ReflectionProperty {
    public function getAttributes(string $name = null, int $flags = 0) : array;
    public function getDeclaringClass(): \ReflectionClass;
    public function getDefaultValue();
    public function getDocComment();
    public function getModifiers(): int;
    public function getName(): string;
    public function getType();
    public function getValue(object $object = null);
    public function hasDefaultValue(): bool;
    public function hasType(): bool;
    public function isDefault(): bool;
    public function isInitialized(object $object = null): bool;
    public function isPrivate(): bool;
    public function isProtected(): bool;
    public function isPublic(): bool;
    public function isStatic(): bool;
    public function setAccessible(bool $accessible): void;
    public function setValue(object $object, mixed $value): void;
}