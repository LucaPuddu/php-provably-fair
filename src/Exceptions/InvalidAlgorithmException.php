<?php

namespace LucaPuddu\PhpProvablyFair\Exceptions;

use Exception;

class InvalidAlgorithmException extends Exception
{
    /**
     * InvalidAlgorithmException constructor.
     * @param string|null $algorithm
     */
    public function __construct(?string $algorithm = null)
    {
        if (is_null($algorithm)) {
            $message = 'Algorithm not provided.';
        } else {
            $message = "Algorithm {$algorithm} not supported.";
        }
        parent::__construct($message);
    }
}
