<?php

namespace Doom\Validators\Expected;

use PHPUnit\Framework\TestCase;

class EqualValidatorTest extends TestCase
{
    public function expectedProvider(){
        return [
            [123, 123, true],
            [123.0, 123.0, true],
            ["123", "123", true],
            ["asd", "asd", true],
            ["", "", true],
            [null, null, true],
            [[], [], true],
            [[123], [123], true],
            [[123], [], false],
            [[123], 123, false],
            [123.0, 123, false],
            ["123", "", false],
            ["asdasd", "asda", false],
            ["asdasd", [], false],
        ];
    }

    /**
     * @dataProvider expectedProvider
     */
    public function testValidate($sample, $value, $expected)
    {
        $validator = new EqualValidator($sample);

        $this->assertEquals($expected, $validator->validate($value));
    }
}
