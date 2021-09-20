<?php

namespace Doom\Mutators;

interface PropertyMutator
{
    public function addMutator(Mutator $mutator);
    public function clearMutator();
}