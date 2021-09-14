<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class StringValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new StringValidator();
    }

    public function testSuccessValidateWithNonEmptyString()
    {
        $this->assertTrue($this->validator->validate("13123"));
    }

    public function testSuccessValidateWithNonEmpty()
    {
        $this->assertTrue($this->validator->validate(""));
    }

    public function testFallValidateWithInt()
    {
        $this->assertFalse($this->validator->validate(123));
    }

    public function testFallValidateWithFloat()
    {
        $this->assertFalse($this->validator->validate(123.0));
    }

    public function testFallValidateWithArray()
    {
        $this->assertFalse($this->validator->validate([]));
    }
}
