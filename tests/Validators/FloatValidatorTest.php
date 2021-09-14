<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class FloatValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new FloatValidator();
    }

    public function testSuccessValidate()
    {
        $this->assertTrue($this->validator->validate(123.0));
    }

    public function testFallValidateWithInt()
    {
        $this->assertFalse($this->validator->validate(123));
    }

    public function testFallValidateWithString()
    {
        $this->assertFalse($this->validator->validate("123"));
    }
}
