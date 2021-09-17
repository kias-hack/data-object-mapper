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
}

class ModelTest extends TestCase
{

    public function testParseRaw()
    {
        $raw = [
            "name" => "Alice",
            "age" => 21,
            "comment" => "qwerty",
        ];

        $instance = new Test($raw);

        $this->assertEquals($raw["name"], $instance->getName());
        $this->assertEquals($raw["age"], $instance->getAge());
        $this->assertEquals($raw["comment"], $instance->getComment());
    }
}
