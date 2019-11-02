<?php

namespace PhpProvablyFair\Interfaces;

interface VerifierInterface
{
    /**
     * Verify a value for a provably fair game
     * @param float $result
     * @return bool
     */
    public function verify(float $result): bool;
}
