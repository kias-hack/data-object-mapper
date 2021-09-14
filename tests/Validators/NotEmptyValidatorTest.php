<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class NotEmptyValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new NotEmptyValidator();
    }

    public function testSuccessValidateWithInt()
    {
        $this->assertTrue($this->validator->validate(123));
    }

    public function testSuccessValidateWithFloat()
    {
        $this->assertTrue($this->validator->validate(123.0));
    }

    public function testSuccessValidateWithString()
    {
        $this->assertTrue($this->validator->validate("123"));
    }

    public function testSuccessValidateWithArray()
    {
        $this->assertTrue($this->validator->validate([123, 123]));
    }

    public function testFallValidateWithString()
    {
        $this->assertFalse($this->validator->validate(""));
    }

    public function testFallValidateWithNull()
    {
        $this->assertFalse($this->validator->validate(null));
    }

    public function testFallValidateWithArray()
    {
        $this->assertFalse($this->validator->validate([]));
    }
}
