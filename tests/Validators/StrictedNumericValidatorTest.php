<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class StrictedNumericValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new StrictedNumericValidator();
    }

    public function testSuccessValidateWithInt()
    {
        $this->assertTrue($this->validator->validate(123));
    }

    public function testSuccessValidateWithFloat()
    {
        $this->assertTrue($this->validator->validate(123.0));
    }

    public function testFallValidateStringWithFloat()
    {
        $this->assertFalse($this->validator->validate("123.0"));
    }

    public function testFallValidateStringWithInt()
    {
        $this->assertFalse($this->validator->validate("123"));
    }

    public function testFallValidateWithString()
    {
        $this->assertFalse($this->validator->validate("test"));
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
