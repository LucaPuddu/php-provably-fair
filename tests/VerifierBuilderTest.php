<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Verifier;
use PhpProvablyFair\VerifierBuilder;
use PHPUnit\Framework\TestCase;

class VerifierBuilderTest extends TestCase
{
    /** @var VerifierBuilder */
    private $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new VerifierBuilder();
    }

    /**
     * @test
     */
    public function itBuildsAVerifier()
    {
        $this->assertInstanceOf(Verifier::class, $this->builder->build());
    }
}
