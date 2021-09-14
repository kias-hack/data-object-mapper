<?php

namespace Doom\Validators\Expected;

use PHPUnit\Framework\TestCase;

class NotInValidatorTest extends TestCase
{
    function dataProvider(){
        return [
            [[1, 2, 3], 1, false],
            [[1, 2, 3], 2, false],
            [[1, 2, 3], 3, false],
            [[1, 2, 3], 4, true],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testValidate($sample, $value, $expected)
    {
        $validator = new NotInValidator($sample);

        $this->assertEquals($expected, $validator->validate($value));
    }
}
