<?php

namespace Doom\Decorators;

use Doom\Mutators\PropertyMutator;
use Doom\Validators\PropertyValidator;

interface PropertyDecorator extends PropertyMutator, PropertyValidator
{

}