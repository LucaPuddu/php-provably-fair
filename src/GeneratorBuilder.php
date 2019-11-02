<?php

namespace PhpProvablyFair;

class GeneratorBuilder extends Builder
{
    /**
     * GeneratorBuilder constructor.
     */
    public function __construct()
    {
        $this->provablyFair = new Generator();
    }

    /**
     * @return Generator
     */
    public function build(): Generator
    {
        return $this->provablyFair;
    }
}
