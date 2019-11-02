<?php

namespace PhpProvablyFair;

class VerifierBuilder extends Builder
{
    /**
     * VerifierBuilder constructor.
     */
    public function __construct()
    {
        $this->provablyFair = new Verifier();
    }

    /**
     * @return Verifier
     */
    public function build(): Verifier
    {
        return $this->provablyFair;
    }
}
