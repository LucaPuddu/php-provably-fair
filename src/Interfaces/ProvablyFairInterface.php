<?php

namespace PhpProvablyFair\Interfaces;

use PhpProvablyFair\Exceptions\InvalidAlgorithmException;

interface ProvablyFairInterface
{
    /** @var float */
    public const DEFAULT_MIN = 0;
    /** @var float */
    public const DEFAULT_MAX = 100;
    /** @var string */
    public const DEFAULT_ALGORITHM = 'sha512/256';

    /**
     * @return string
     */
    public function getAlgorithm(): string;

    /**
     * @param string $algorithm
     * @throws InvalidAlgorithmException
     */
    public function setAlgorithm(string $algorithm): void;

    /**
     * @return string
     */
    public function getServerSeed(): string;

    /**
     * @param string $serverSeed
     */
    public function setServerSeed(string $serverSeed): void;

    /**
     * @return string
     */
    public function getClientSeed(): string;

    /**
     * @param string $clientSeed
     */
    public function setClientSeed(string $clientSeed): void;

    /**
     * @return string
     */
    public function getNonce(): string;

    /**
     * @param string $nonce
     */
    public function setNonce(string $nonce): void;

    /**
     * @return float
     */
    public function getMin(): float;

    /**
     * @param float $min
     */
    public function setMin(float $min): void;

    /**
     * @return float
     */
    public function getMax(): float;

    /**
     * @param float $max
     */
    public function setMax(float $max): void;
}
