<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class EmptyValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new EmptyValidator();
    }

    public function testSuccessValidateWithEmptyString()
    {
        $this->assertTrue($this->validator->validate(""));
    }

    public function testSuccessValidateWithEmptyArray()
    {
        $this->assertTrue($this->validator->validate([]));
    }

    public function testSuccessValidateWithNull()
    {
        $this->assertTrue($this->validator->validate(null));
    }

    public function testSuccessValidateWithZero()
    {
        $this->assertTrue($this->validator->validate(0));
    }

    public function testFallValidateWithInt()
    {
        $this->assertFalse($this->validator->validate(123));
    }

    public function testFallValidateWithFloat()
    {
        $this->assertFalse($this->validator->validate(123.0));
    }

    public function testFallValidateWithNonEnptyString()
    {
        $this->assertFalse($this->validator->validate("123"));
    }

    public function testFallValidateWithNonEmptyArray()
    {
        $this->assertFalse($this->validator->validate([123, 123]));
    }
}
