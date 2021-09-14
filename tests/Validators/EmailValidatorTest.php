<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class EmailValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new EmailValidator();
    }

    function emailDataProvider(){
        return array(
            array("qwerty@qwerty.ru", true),
            array("as.qwerty@qwerty.com.ru", true),
            array("qwerty@qwerty.ru", true),
            array("@qwerty.ru", false),
            array("qwerty@", false),
            array("qwerty.ru", false),
        );
    }

    /**
     * @dataProvider emailDataProvider
     */
    public function testSuccess($example, $expected)
    {
        $this->assertEquals($expected, $this->validator->validate($example));
    }
}
