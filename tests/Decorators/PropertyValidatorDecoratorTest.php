<?php

namespace Decorators;

use Doom\Decorators\PropertyValidatorDecorator;
use Doom\Validators\IntValidator;
use Doom\Validators\NotEmptyValidator;
use PHPUnit\Framework\TestCase;
use Test\TestModel;

const SETUP_VALUE = 123;

class PropertyValidatorDecoratorTest extends TestCase
{
    protected $propertyDecorator;

    protected function setUp(): void
    {
        $this->object = new TestModel();

        $property = (new \ReflectionClass(TestModel::class))->getProperty("withoutType");

        $this->propertyDecorator = new PropertyValidatorDecorator($property);
    }

    public function testSuccessSetValue()
    {
        $mockIntValidator = $this->createMock(IntValidator::class);
        $mockIntValidator
            ->expects($this->once())
            ->method("validate")
            ->with($this->equalTo(SETUP_VALUE))
            ->willReturn(true)
        ;

        $mockNotEmptyValidator = $this->createMock(NotEmptyValidator::class);
        $mockNotEmptyValidator
            ->expects($this->once())
            ->method("validate")
            ->with($this->equalTo(SETUP_VALUE))
            ->willReturn(true)
        ;

        $this->propertyDecorator->addValidator($mockIntValidator);
        $this->propertyDecorator->addValidator($mockNotEmptyValidator);

        $this->propertyDecorator->setAccessible(true);

        $this->propertyDecorator->setValue($this->object, SETUP_VALUE);

        $this->assertEquals(SETUP_VALUE, $this->propertyDecorator->getValue($this->object));
    }

    public function testFallSetValue()
    {
        $mockIntValidator = $this->createMock(IntValidator::class);
        $mockIntValidator
            ->expects($this->once())
            ->method("validate")
            ->with($this->equalTo(SETUP_VALUE))
            ->willReturn(false)
        ;

        $mockNotEmptyValidator = $this->createMock(NotEmptyValidator::class);
        $mockNotEmptyValidator
            ->expects($this->never())
            ->method("validate")
            ->willReturn(false)
        ;

        $this->propertyDecorator->addValidator($mockIntValidator);
        $this->propertyDecorator->addValidator($mockNotEmptyValidator);

        $this->propertyDecorator->setAccessible(true);

        $this->expectException(\Exception::class);

        $this->propertyDecorator->setValue($this->object, SETUP_VALUE);
    }
}
