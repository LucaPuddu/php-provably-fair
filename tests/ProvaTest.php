<?php

namespace PhpProvablyFair\Tests;

use PhpProvablyFair\Prova;
use PHPUnit\Framework\TestCase;

class ProvaTest extends TestCase
{
    /**
     * @var Prova
     */
    private $prova;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prova = new Prova();
    }

    /**
     * @test
     */
    public function provaReturnsTrue()
    {
        $this->assertTrue($this->prova->prova());
    }
}
