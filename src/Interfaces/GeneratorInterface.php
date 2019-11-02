<?php

namespace PhpProvablyFair\Interfaces;

interface GeneratorInterface
{
    /**
     * Generate a value for a provably fair game
     * @return float
     */
    public function generate(): float;
}
