<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Generator;
use PhpProvablyFair\GeneratorBuilder;
use PHPUnit\Framework\TestCase;

class GeneratorBuilderTest extends TestCase
{
    /** @var GeneratorBuilder */
    private $builder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new GeneratorBuilder();
    }

    /**
     * @test
     */
    public function itBuildsAGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->builder->build());
    }
}
