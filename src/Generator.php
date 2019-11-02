<?php

namespace PhpProvablyFair;

use PhpProvablyFair\Exceptions\AlgorithmNotSupportedException;

/**
 * Class Generator
 * Generates a random number using a known hash algorithm for HMAC.
 * See https://www.php.net/manual/en/function.hash-hmac-algos.php for a list of supported algorithms
 * @package PhpProvablyFair
 */
class Generator
{
    /** @var string */
    private const DEFAULT_ALGORITHM = 'sha512/256';
    /** @var string */
    private $algorithm;

    /**
     * Generator constructor.
     *
     * @param string|null $algorithm The hmac algorithm that this Generator instance will use.
     * @throws AlgorithmNotSupportedException
     */
    public function __construct(?string $algorithm = self::DEFAULT_ALGORITHM)
    {
        if (!in_array($algorithm, hash_hmac_algos())) {
            throw new AlgorithmNotSupportedException($algorithm);
        }
        $this->algorithm = $algorithm;
    }

    /**
     * @return string|null
     */
    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }
}
