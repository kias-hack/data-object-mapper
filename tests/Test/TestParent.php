<?php

namespace Test;

use Doom\Model;

class TestParent extends Model
{
    /**
     * @Required
     * @Type(string)
     */
    protected $name;

    /**
     * @Type(int)
     */
    protected $age;

    /**
     * @Type(Test\TestChildren)
     */
    protected $children;

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }
}