<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Interfaces\GeneratorInterface;
use PhpProvablyFair\Interfaces\ProvablyFairInterface;

/**
 * Class Generator
 * Generates a random number using a known hash algorithm for HMAC.
 * See https://www.php.net/manual/en/function.hash-hmac-algos.php for a list of supported algorithms
 * @package PhpProvablyFair
 */
class Generator extends ProvablyFair implements GeneratorInterface, ProvablyFairInterface
{
    /**
     * Generate a value for a provably fair game
     */
    public function generate(): float
    {
        return 0.0;
    }
}
