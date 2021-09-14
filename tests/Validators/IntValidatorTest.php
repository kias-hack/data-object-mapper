<?php

namespace Doom\Validators;

use PHPUnit\Framework\TestCase;

class IntValidatorTest extends TestCase
{
    /**
     * @var IntValidator
     */
    protected $validator;

    protected function setUp(): void
    {
        $this->validator = new IntValidator();
    }

    public function testSuccessValidate()
    {
        $this->assertTrue($this->validator->validate(123));
    }

    public function testFallValidateWithString()
    {
        $this->assertFalse($this->validator->validate("123"));
    }

    public function testFallValidateWithFloat()
    {
        $this->assertFalse($this->validator->validate(123.0));
    }
}
