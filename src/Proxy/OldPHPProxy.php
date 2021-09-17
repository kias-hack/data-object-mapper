<?php

namespace Doom\Proxy;

use Doom\Reflection\Property\ReflectionPropertyImpl;

class OldPHPProxy extends ReflectionPropertyImpl {
    protected $defaultModel;

    public function getDefaultValue() {
        $defaultObject = $this->getDefaultObject();

        $this->setAccessible(true);
        $value = $this->getValue($defaultObject);
        $this->setAccessible(false);

        return $value;
    }

    public function getType() {
        return gettype($this->getDefaultValue());
    }

    public function hasType(): bool {
        return $this->hasDefaultValue();
    }

    public function isInitialized(object $object = null): bool {
        $this->setAccessible(true);
        $value = $this->getValue($object);
        $this->setAccessible(false);

        return !empty($value);
    }

    public function hasDefaultValue(): bool {
        $defaultObject = $this->getDefaultObject();

        $this->setAccessible(true);
        $value = $this->getValue($defaultObject);
        $this->setAccessible(false);

        return !empty($value);
    }

    protected function getDefaultObject() : object {
        if(empty($this->defaultObject)){
            $cls = $this->getFullNameDeclarationClass();

            if(!class_exists($cls))
                // TODO сделать исключение
                throw new \Exception("unknown class " . $cls);


            $this->defaultObject = new $cls;
        }

        return  $this->defaultObject;
    }

    protected function getFullNameDeclarationClass() : string {
        $declaringReflectionClass = $this->getDeclaringClass();

//        return $declaringReflectionClass->getNamespaceName() . "\\" . $declaringReflectionClass->getName();
        return $declaringReflectionClass->getName();
    }
}