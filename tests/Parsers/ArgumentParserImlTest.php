<?php

namespace Parsers;

use Doom\Arguments\Alias;
use Doom\Arguments\Required;
use Doom\Arguments\Type;
use Doom\Factories\ArgumentFactoryImpl;
use Doom\Parsers\ArgumentParserImpl;
use PHPUnit\Framework\TestCase;

class ArgumentParserImlTest extends TestCase
{

    public function testParse()
    {
        $phpdocstring = "
        /**
        * @Required()
        * @Type(int)
        * @Alias(testTest)
        * @Required
        */
        ";

        $argFactoryMock = $this->createMock(ArgumentFactoryImpl::class);

        $argFactoryMock
            ->expects($this->at(0))
            ->method("create")
            ->with($this->equalTo("Required"), $this->equalTo(""))
            ->willReturn(new Required())
        ;

        $argFactoryMock
            ->expects($this->at(1))
            ->method("create")
            ->with($this->equalTo("Type"), $this->equalTo("int"))
            ->willReturn(new Type("int"))
        ;

        $argFactoryMock
            ->expects($this->at(2))
            ->method("create")
            ->with($this->equalTo("Alias"), $this->equalTo("testTest"))
            ->willReturn(new Alias("testTest"))
        ;

        $argFactoryMock
            ->expects($this->at(3))
            ->method("create")
            ->with($this->equalTo("Required"), $this->equalTo(""))
            ->willReturn(new Required(""))
        ;

        $argParser = new ArgumentParserImpl($argFactoryMock);

        $argParser->parse($phpdocstring);
    }
}
