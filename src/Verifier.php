<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Interfaces\ProvablyFairInterface;
use PhpProvablyFair\Interfaces\VerifierInterface;

/**
 * Class Verifier
 * Verify a results against HMAC with a set algorithm, server and client seeds, nonce, min and max.
 * @package PhpProvablyFair
 */
class Verifier extends ProvablyFair implements VerifierInterface, ProvablyFairInterface
{
    /**
     * Verify a value for a provably fair game.
     * @param float $result
     * @return bool
     */
    public function verify(float $result): bool
    {
        return false;
    }
}
