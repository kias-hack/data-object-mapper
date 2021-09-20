<?php

namespace Arguments;

use Doom\Arguments\Type;
use Doom\Decorators\PropertyModelDecorator;
use Doom\Mutators\ModelDataMutator;
use Doom\Validators\IntValidator;
use Doom\Validators\StringValidator;
use PHPUnit\Framework\TestCase;
use Test\TestParent;

class TypeTest extends TestCase
{

    public function testIntType()
    {
        $propMock = $this->createMock(PropertyModelDecorator::class);

        $propMock
            ->expects($this->at(0))
            ->method("addValidator")
            ->with($this->equalTo(new IntValidator))
        ;

        $argument = new Type("int");
        $argument->apply($propMock);
    }

    public function testStringType()
    {
        $propMock = $this->createMock(PropertyModelDecorator::class);

        $propMock
            ->expects($this->at(0))
            ->method("addValidator")
            ->with($this->equalTo(new StringValidator))
        ;

        $argument = new Type("string");
        $argument->apply($propMock);
    }

    // TODO сделать порождение себе подобных
    public function testModelType()
    {
        $propMock = $this->createMock(PropertyModelDecorator::class);

        $propMock
            ->expects($this->at(0))
            ->method("addMutator")
            ->with($this->equalTo(new ModelDataMutator(TestParent::class)))
        ;

        $argument = new Type(TestParent::class);
        $argument->apply($propMock);
    }
}
