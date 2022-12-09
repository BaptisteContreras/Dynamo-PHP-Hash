<?php

namespace Dynamophp\Hash;

class InvalidPrimaryHashAlgorithm extends \Exception
{
    public function __construct(string $hashAlgorithm)
    {
        parent::__construct(sprintf(
            '%s is an unknown hash algorithm. See the available list using the hash hash_algos',
            $hashAlgorithm
        ));
    }
}
