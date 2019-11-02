<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Exceptions\AlgorithmNotSupportedException;
use PhpProvablyFair\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function itCreatesAnInstanceWithAValidHmacAlgorithm()
    {
        foreach (hash_hmac_algos() as $hash_hmac_algo) {
            try {
                $generator = new Generator($hash_hmac_algo);
                $this->assertNotNull($generator);
            } catch (\Exception $exception) {
                $this->fail($exception->getMessage());
            }
        }
    }

    /**
     * @test
     */
    public function itUsesSha512256ByDefaultIfNoAlgorithmIsProvided()
    {
        $generator = new Generator();

        $this->assertEquals('sha512/256', $generator->getAlgorithm());
    }

    /**
     * @test
     */
    public function itThrowsAlgorithmNotSupportedExceptionIfTheAlgorithmIsNotValid()
    {
        $this->expectException(AlgorithmNotSupportedException::class);

        new Generator('invalid hmac algorithm');
    }
}
