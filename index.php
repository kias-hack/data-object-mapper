<?php 


// class ModelExample extends Domain {
//     /**
//      * @Required
//      * @Validator(nameValidator)
//      * @Type(string)
//      * @Alias(username)
//      */
//     protected $name = '123';
// }

interface Argument {
    function apply(Field $field) : void;
}

abstract class ArgumentImpl implements Argument {
    protected $param;
    
    function __construct($param = null) {
        $this->param = $param;
    }
    
    abstract function apply(Field $field) : void;
}

class Required extends ArgumentImpl {
    function apply(Field $field) : void{
        $field->setValidator(new NotEmptyValidator);
    }
}

class Type extends ArgumentImpl {
    function apply(Field $field) : void {
        switch ($this->param) {
            case "int": 
            case "integer": 
                $field->setValidator(new IntValidator);
                break;
            case "bool": 
            case "boolean": 
                $field->setValidator(new BooleanValidator);
                break;
            case "string": 
                $field->setValidator(new StringValidator);
                break;
            case "numeric": 
                $field->setValidator(new StrictedNumericValidator);
                break;
            case "string, numeric":
            case "numeric, string":
                $field->setValidator(new NumericValidator);
                break;
            case "email": 
                $field->setValidator(new EmailValidator);
                break;
            case "float": 
                $field->setValidator(new FloatValidator);
                break;    
            default:
                throw new Exception("unknown type" . $this->param);
        }
    }
}

class Alias extends ArgumentImpl {
    function apply(Field $field) : void{
        $this->field->setAlias($this->param);
    }
}

interface ArgumentFactory {
    static function getInstance($name, $value);
}

class ArgumentFactoryImpl implements ArgumentFactory{
    static function getInstance($name, $value){
        switch($name){
            case "Alias":
                return new Alias($value);
                break;
                
            case "Type":
                return new Type($value);
                break;
                
            case "Required":
                return new Required($value);
                break;
                
            default:
                throw new Exception("unknown argument " . $name);
        }
    }
}

interface ArgumentParserFactory {
    static function getInstance();
}

class ArgumentParserFactoryImpl implements ArgumentParserFactory {
    static function getInstance(){
        return new ArgumentParserIml(new ArgumentFactoryImpl);
    }
}

interface ArgumentParser {
    function parse($doc);
}

class ArgumentParserIml implements ArgumentParser {
    /**
     * Argument[]
     */
    protected $arguments = [];
    
    function __construct(ArgumentFactory $argFactory) {
        $this->argFactory = $argFactory;
    }
    
    function parse($doc) {
        $lines = explode("\n", $doc);
        
        foreach ($lines as $line){
            if(stristr("@", $line) < 0)
                continue;
                    
            $this->processLine($line);
        }
        
        return $this->arguments;
    }
    
    function processLine($line) {
        $line = trim(str_replace(["*", "/", "@", ")"], "", $line));
        
        $parts = explode("(", $line);
        
        $argumentName = $parts[0];
        $argumentValue = $parts[1] ?: null;
        
        if(empty($argumentName))
            return;
        
        $this->arguments[] = $this->argFactory->getInstance($argumentName, $argumentValue);
    }
}

$doc = "/**
        * @Required()
        * @Type(int)
        */";
$parser = ArgumentParserFactoryImpl::getInstance();
print_r($parser->parse($doc));


abstract class FillingTemplateImpl implements FillingTemplate {
    protected $fields = [];
    protected $preparedData, $data, $model;
    
    function __construct($model, $data){
        $this->model = $model;
        $this->data = $data;
    }
    
    function prepareData(){
        $this->preparedData = [];
    }
    
    function applyArguments(){
        $fields = $this->model->getFieldsList();
        
        foreach ($fields as $field){
            // $fields
        }
    }
    
    function parse(){
        $this->prepareData();
        $this->prepareFields();
        $this->applyArguments();
        
        $this->comparsion();
        
        $this->validate();
    }
}

interface Field {
    function getName();
    
    function setAlias($alias);
    function getAlias();
    
    function setValidator(Validator $validator);
    
    function setValue($value);
}

class FieldImpl implements Field {
    protected $validators = [];
    /**
     * string 
     */
    protected $name;
    protected $alias;
    
    function __construct($field){
        $this->name = "qwerty";
    }
    
    function getName(){
        return $this->name;
    }
    
    function setAlias($alias){
        $this->alias = $alias;
    }
    
    function getAlias(){
        return $this->alias;
    }
    
    function setValidator(Validator $validator){
        $this->validators[] = $validator;
    }
    
    function setValue($value){
        foreach ($this->validators as $validator){
            if(!$validator->validate($value))
                throw new ValidateValueException($validator);
        }
        
        print_r($value);
    }
}

class ValidateValueException extends Exception {
    function __construct(Validator $validator){
        parent::__construct("Произошла ошибка при валидации поля");
    }
}

interface  Validator {
    function validate($value) : bool;
}

class IntValidator implements Validator {
    function validate($value) : bool {
        return is_int($value) and !is_string($value);
    }
}

class FloatValidator implements Validator {
    function validate($value) : bool {
        return is_float($value) && !is_string($value);
    }
}

class StrictedNumericValidator implements Validator {
    function validate($value) : bool {
        return is_numeric($value) && !is_string($value);
    }
}

class NumericValidator implements Validator {
    function validate($value) : bool {
        return is_numeric($value);
    }
}

class StringValidator implements Validator {
    function validate($value) : bool {
        return is_string($value);
    }
}

class BooleanValidator implements Validator {
    function validate($value) : bool {
        return is_bool($value);
    }
}

class EmailValidator implements Validator {
    function validate($value) : bool {
        if(stristr("@", $value) <= 0)
            return false;
        
        return true;
    }
}

class EmptyValidator implements Validator {
    function validate($value) : bool {
        return empty($value);
    }
}

class NotEmptyValidator implements Validator {
    function validate($value) : bool {
        return !empty($value);
    }
}

abstract class ExpectedValidator implements Validator {
    function __construct($expected){
        $this->expected = $expected;
    }
}

class EqualValidator extends ExpectedValidator {
    function validate($value) : bool {
        return $value === $this->expected;
    }
}

class NotEqualValidator extends ExpectedValidator {
    function validate($value) : bool {
        return $value !== $this->expected;
    }
}

class InValidator extends ExpectedValidator {
    function validate($value) : bool {
        return in_array($value, $this->expected);
    }
}

class NotInValidator extends ExpectedValidator {
    function validate($value) : bool {
        return !in_array($value, $this->expected);
    }
}

$validator = new EqualValidator(new ValidatorContextImpl, 123);

$field = new FieldImpl("");

$argumentRequired = new Required("");
$argumentRequired->apply($field);

$argumentType = new Type("int");
$argumentType->apply($field);

$field->setValue(123.0);

?>
