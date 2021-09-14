<?php

namespace Doom\Validators\Expected;

use PHPUnit\Framework\TestCase;

class NotEqualValidatorTest extends TestCase
{
    public function expectedProvider(){
        return [
            [123, 123, false],
            [123.0, 123.0, false],
            ["123", "123", false],
            ["asd", "asd", false],
            ["", "", false],
            [null, null, false],
            [[], [], false],
            [[123], [123], false],
            [[123], [], true],
            [[123], 123, true],
            [123.0, 123, true],
            ["123", "", true],
            ["asdasd", "asda", true],
            ["asdasd", [], true],
        ];
    }

    /**
     * @dataProvider expectedProvider
     */
    public function testValidate($sample, $value, $expected)
    {
        $validator = new NotEqualValidator($sample);

        $this->assertEquals($expected, $validator->validate($value));
    }
}
