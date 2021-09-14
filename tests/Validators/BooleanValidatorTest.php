<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class BooleanValidatorTest extends TestCase
{
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new BooleanValidator();
    }

    public function testValidateWithTrueVal()
    {
        $this->assertTrue($this->validator->validate(true));
    }

    public function testValidateWithFalseVal()
    {
        $this->assertTrue($this->validator->validate(false));
    }

    public function testFallValidateWithIntVal()
    {
        $this->assertFalse($this->validator->validate(132));
    }

    public function testFallValidateWithFloatVal()
    {
        $this->assertFalse($this->validator->validate(132.0));
    }

    public function testFallValidateWithStringVal()
    {
        $this->assertFalse($this->validator->validate("true"));
    }
}
