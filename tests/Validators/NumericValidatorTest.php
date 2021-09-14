<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new NumericValidator();
    }

    public function testSuccessValidateWithInt()
    {
        $this->assertTrue($this->validator->validate(123));
    }

    public function testSuccessValidateWithFloat()
    {
        $this->assertTrue($this->validator->validate(123.0));
    }

    public function testSuccessValidateStringWithFloat()
    {
        $this->assertTrue($this->validator->validate("123.0"));
    }

    public function testSuccessValidateStringWithInt()
    {
        $this->assertTrue($this->validator->validate("123"));
    }

    public function testFallValidateWithString()
    {
        $this->assertFalse($this->validator->validate("qweq"));
    }

    public function testFallValidateWithEmptyString()
    {
        $this->assertFalse($this->validator->validate(""));
    }

    public function testFallValidateWithArray()
    {
        $this->assertFalse($this->validator->validate([]));
    }
}
