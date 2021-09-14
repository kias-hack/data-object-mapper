<?php

namespace Doom;
use Doom\Validators\Validator;

interface Field {
    function getName();

    function setAlias(string $alias);
    function getAlias() : string;

    function setValidator(Validator $validator);

    function setValue($value) : void;
}