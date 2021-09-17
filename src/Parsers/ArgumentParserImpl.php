<?php

namespace Doom\Parsers;

use Doom\Factories\ArgumentFactory;

class ArgumentParserImpl implements ArgumentParser {
    /**
     * Argument[]
     */
    protected $arguments = [];

    /**
     * @var ArgumentFactory
     */
    protected $argFactory;

    function __construct(ArgumentFactory $argFactory) {
        $this->argFactory = $argFactory;
    }

    function parse($doc) {
        $this->arguments = [];
        $lines = explode("\n", $doc);

        foreach ($lines as $key => $line){
            if(strpos($line, "@") <= 0)
                continue;

            $line = $this->clearLine($line);

            if(empty($line))
                continue;

            $this->processLine($line);
        }

        return $this->arguments;
    }

    protected function processLine($line) {
        $parts = explode("(", $line);

        $argumentName = $parts[0];

        if(count($parts) == 1)
            $parts[1] = "";

        $argumentValue = $parts[1];

        $this->buildArgument($argumentName, $argumentValue);
    }

    protected function clearLine(string $line) : string{
        return trim(str_replace(["**", "* ", "/", "@", ")", "\r"], "", $line));
    }

    protected function buildArgument(string $argumentName, $argumentValue){
        $this->arguments[] = $this->argFactory->create($argumentName, $argumentValue);
    }
}
