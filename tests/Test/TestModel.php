<?php

namespace Test;

const TEST_VALUE_INT = 123;

class TestModel {
    /**
     * and initialized, with default type
     */
    protected $withTypeInt = TEST_VALUE_INT;

    /**
     * and non initialized, without default type
     */
    protected $withoutType;
}