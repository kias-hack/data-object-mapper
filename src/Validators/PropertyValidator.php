<?php

namespace Doom\Validators;

interface PropertyValidator {
    public function addValidator($validator) : void;
    public function clearValidator() : void;
    public function setAlias(string $alias) : void;
    public function hasAlias() : bool;
    public function getAlias() : string;
}