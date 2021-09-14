<?php

namespace Doom\Parsers;

interface ArgumentParser {
    function parse(string $doc);
}