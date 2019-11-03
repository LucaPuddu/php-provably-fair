<?php

namespace PhpProvablyFair\Interfaces;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;

interface BuilderInterface
{
    /**
     * @param string $algorithm
     * @return BuilderInterface
     * @throws InvalidAlgorithmException
     */
    public function algorithm(string $algorithm): BuilderInterface;

    /**
     * @param string $serverSeed
     * @return BuilderInterface
     */
    public function serverSeed(string $serverSeed): BuilderInterface;

    /**
     * @param string $clientSeed
     * @return BuilderInterface
     */
    public function clientSeed(string $clientSeed): BuilderInterface;

    /**
     * @param string $nonce
     * @return BuilderInterface
     */
    public function nonce(string $nonce): BuilderInterface;

    /**
     * @param float $min
     * @param float $max
     * @return BuilderInterface
     */
    public function range(float $min, float $max): BuilderInterface;

    /**
     * @return ProvablyFairInterface
     */
    public function build();
}
