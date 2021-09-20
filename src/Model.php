<?php

namespace Doom;

use Doom\Arguments\Argument;
use Doom\Decorators\PropertyModelDecorator;
use Doom\Factories\ArgumentParserFactoryImpl;
use Doom\Reflection\ReflectionRepresentation;

class Model
{
    /**
     * @param $raw
     * @throws \Exception
     *
     * TODO перенести построение объекта из конструктора
     */
    public function __construct($raw)
    {
        $representation = new ReflectionRepresentation(get_called_class());

        $argumentParser = ArgumentParserFactoryImpl::getInstance();

        $properties = $representation->getProperties();

        foreach ($properties as &$property){
            $property = new PropertyModelDecorator($property);

            $docComment = $property->getDocComment();

            $arguments = $argumentParser->parse($docComment);

            /**
             * @var $argument Argument
             */
            foreach ($arguments as $argument) {
                $argument->apply($property);
            }
        }

        $propertyMap = $this->buildPropertyMap($properties);

        /**
         * @var $property PropertyModelDecorator
         */
        unset($property);
        foreach ($propertyMap as $key => $property) {
            $value = in_array($key, array_keys($raw)) ? $raw[$key] : null;

            try {
                if(!$property->isPublic())
                    $this->setNonAccessible($this, $property, $value);
                else
                    $this->setAccessible($this, $property, $value);
            } catch (\Exception $e){
                throw new \Exception("property " . $key . ": ". $e->getMessage());
            }
        }
    }

    protected function buildPropertyMap($properties){
        $map = [];

        /**
         * @var $property PropertyModelDecorator
         */
        foreach ($properties as $property){
            if($property->hasAlias())
                $map[$property->getAlias()] = $property;
            else
                $map[$property->getName()] = $property;
        }

        return $map;
    }

    protected function setNonAccessible($object, $property, $value) {
        /**
         * @var $property PropertyModelDecorator
         */

        $property->setAccessible(true);
        $property->setValue($object, $value);
        $property->setAccessible(false);
    }

    protected function setAccessible($object, $property, $value) {
        /**
         * @var $property PropertyModelDecorator
         */

        $property->setValue($object, $value);
    }
}