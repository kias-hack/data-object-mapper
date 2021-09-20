<?php


use Doom\Model;
use PHPUnit\Framework\TestCase;

class Test extends Model {
    /**
     * @Type(string)
     * @Required
     */
    protected $name;

    /**
     * @Type(int)
     * @Required
     */
    protected $age = 19;

    /**
     * @Required
     */
    protected $comment;

    /**
     * @Type (array)
     */
    protected $array;

    protected $unknown;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return mixed
     */
    public function getArray()
    {
        return $this->array;
    }

    public function getUnknown()
    {
        return $this->unknown;
    }
}

class ModelTest extends TestCase
{
    protected function getTestRaw(){
        return [
            "name" => "Alice",
            "age" => 21,
            "comment" => "qwerty",
            "array" => ["qwerty", 123],
            "unknown" => [123, 123, '123']
        ];
    }

    public function testParseRaw()
    {
        $raw = $this->getTestRaw();

        $instance = new Test($raw);

        $this->assertEquals($raw["name"], $instance->getName());
        $this->assertEquals($raw["age"], $instance->getAge());
        $this->assertEquals($raw["comment"], $instance->getComment());
        $this->assertEquals($raw["array"], $instance->getArray());
        $this->assertEquals($raw["unknown"], $instance->getUnknown());
    }

    public function testRequiredFields (){
        // TODO переопределить исключения
        $this->expectException(\Exception::class);

        $instance = new Test([]);
    }

    public function testCreateWithExtendedModelsProp(){
        $raw = [
            "name" => "Meg",
            "age" => 21,
            "children" => [
                "name" => "Masha"
            ]
        ];
        $instance = new \Test\TestParent($raw);

        $this->assertEquals($raw["name"], $instance->getName());
        $this->assertEquals($raw["age"], $instance->getAge());
        $this->assertEquals(new \Test\TestChildren($raw["children"]), $instance->getChildren());
    }
}
