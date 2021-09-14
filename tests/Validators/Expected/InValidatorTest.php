<?php

namespace Doom\Validators\Expected;

use PHPUnit\Framework\TestCase;

class InValidatorTest extends TestCase
{
    function dataProvider(){
        return [
            [[1, 2, 3], 1, true],
            [[1, 2, 3], 2, true],
            [[1, 2, 3], 3, true],
            [[1, 2, 3], 4, false],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidate($sample, $value, $expected)
    {
        $validator = new InValidator($sample);

        $this->assertEquals($expected, $validator->validate($value));
    }
}
