<?php

interface IReflectionProperty {
    public function getAttributes(string $name = null, int $flags = 0) : array;
    public function getDeclaringClass(): ReflectionClass;
    public function getDefaultValue();
    public function getDocComment();
    public function getModifiers(): int;
    public function getName(): string;
    public function getType(): ReflectionType;
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

class ReflectionPropertyImpl implements IReflectionProperty {
    protected $reflectionProperty;
    
    function __construct(ReflectionProperty $property){
        $this->reflectionProperty = $property;
    }
    
    public function getAttributes(string $name = null, int $flags = 0) : array {
        return $this->reflectionProperty->getAttributes($name, $flags);
    }
    
    public function getDeclaringClass(): ReflectionClass {
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
    
    public function getType(): ReflectionType {
        return $this->reflectionProperty->getType();
    }
    
    public function getValue(object $object = null) {
        if(empty($object))
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

class OldPHPProxy extends ReflectionPropertyImpl {
    protected $defaultModel;
    
    public function getDefaultValue() {
        $defaultObject = $this->getDefaultObject();
        
        $this->setAccessible(true);
        $value = $this->getValue($defaultObject);
        $this->setAccessible(false);
        
        return $value;
    }
    
    public function getType(): ReflectionType {
        return new ReflectionType($this->reflectionProperty->getDefaultValue());
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
            $cls = $this->getFullNameDecalationClass();
            
            if(!class_exists($cls))
                throw new \Exception("unknown class " . $cls);    
        
            
            $this->defaultObject = new $cls;
        }
            
        return  $this->defaultObject;
    }
    
    protected function getFullNameDecalationClass() : string {
        $declaringReflectionClass = $this->getDeclaringClass();
        
        return $declaringReflectionClass->getNamespaceName() . "\\" . $declaringReflectionClass->getName();
    }
}

interface PropValidatorDecorator {
    public function addValidator($validator);
    public function clearValidator();
}

class PropValidatorDecoratorImpl extends ReflectionPropertyImpl implements PropValidatorDecorator {
    protected $validators = [];
    
    public function addValidator($validator) {
        $validators[] = $validator;
    }
    
    public function clearValidator() {
        $validators = [];
    }
    
    public function setValue(object $object, $value): void {
        
        foreach ($this->validators as $validator){
            if(!$validator->validate($value)){
                throw new \Exception("fall check value");
            }
        }
        
        $this->reflectionProperty->setValue($object, $value);
    }
}

class Model {
    protected $var;
    
    protected $name = "Mary";
    
    protected $age = 30;
    
    protected $weight = 87.5;
    
    protected $children = [
        [
            "name" => "Victoria",
            "weight" => 87.4,
            "age" => 4,
        ]
    ];
}

$default = new Model;

$reflection = new ReflectionClass(Model::class);

foreach($reflection->getProperties() as $property){
    $property = new OldPHPProxy($property);

    print_r($property->getName());
    print_r("\n");
    print_r($property->getDefaultValue());
    print_r("\n");
    print_r($property->hasDefaultValue() ? "prop has default value" : "");
    
    print_r("\n\n");
}
