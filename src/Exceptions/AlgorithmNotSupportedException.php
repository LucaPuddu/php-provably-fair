<?php

namespace PhpProvablyFair\Exceptions;

use Exception;

class AlgorithmNotSupportedException extends Exception
{
    /**
     * AlgorithmNotSupportedException constructor.
     * @param string|null $algo
     */
    public function __construct(?string $algo = null)
    {
        if (is_null($algo)) {
            $message = "Algorithm not supported.";
        }  else {
            $message = "Algorithm {$algo} not supported.";
        }
        parent::__construct($message);
    }
}
