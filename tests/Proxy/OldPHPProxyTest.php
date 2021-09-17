<?php

namespace Proxy;

use Doom\Proxy\OldPHPProxy;
use PHPUnit\Framework\TestCase;
use Test\TestModel;
use const Test\TEST_VALUE_INT;

class OldPHPProxyTest extends TestCase
{
    protected $defObj;
    protected $reflectionCls;

    protected function getProxyProperty($propertyName){
        $property = $this->reflectionCls->getProperty($propertyName);

        return new OldPHPProxy($property);
    }

    protected function setUp(): void
    {
        $this->defObj = new TestModel;

        $this->reflectionCls = new \ReflectionClass(TestModel::class);
    }

    public function testSuccessIsInitialized()
    {
        $proxy = $this->getProxyProperty("withTypeInt");

        $this->assertTrue($proxy->isInitialized($this->defObj));
    }

    public function testFallIsInitialized()
    {
        $proxy = $this->getProxyProperty("withoutType");

        $this->assertFalse($proxy->isInitialized($this->defObj));
    }

    public function testFallHasType()
    {
        $proxy = $this->getProxyProperty("withoutType");

        $this->assertFalse($proxy->hasType());
    }

    public function testSuccessHasType()
    {
        $proxy = $this->getProxyProperty("withTypeInt");

        $this->assertTrue($proxy->hasType());
    }

    public function testSuccessGetType()
    {
        $proxy = $this->getProxyProperty("withTypeInt");

        $this->assertEquals("integer", $proxy->getType());
    }

    public function testFallGetType()
    {
        $proxy = $this->getProxyProperty("withoutType");

        $this->assertEquals("NULL", $proxy->getType());
    }

    public function testFallGetDefaultValue()
    {
        $proxy = $this->getProxyProperty("withoutType");

        $this->assertNull($proxy->getDefaultValue());
    }

    public function testSuccessGetDefaultValue()
    {
        $proxy = $this->getProxyProperty("withTypeInt");

        $this->assertEquals(TEST_VALUE_INT, $proxy->getDefaultValue());
    }

    public function testSuccessHasDefaultValue()
    {
        $proxy = $this->getProxyProperty("withTypeInt");

        $this->assertTrue($proxy->hasDefaultValue());
    }

    public function testFallHasDefaultValue()
    {
        $proxy = $this->getProxyProperty("withoutType");

        $this->assertFalse($proxy->hasDefaultValue());
    }
}