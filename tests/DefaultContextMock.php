<?php

namespace Dynamophp\Hash\Test;

use Dynamophp\Hash\Context;

class DefaultContextMock extends Context
{
    public function __construct()
    {
        parent::__construct(
            '', 0, 0, 0
        );
    }

    public function getPrimaryHashAlgorithm(): string
    {
        throw new \Exception('Default context should not be used in test case');
    }

    public function getStartSecondHashSelection(): int
    {
        throw new \Exception('Default context should not be used in test case');
    }

    public function getEndSecondHashSelection(): int
    {
        throw new \Exception('Default context should not be used in test case');
    }

    public function getPrimaryHashAlgorithmResultSize(): int
    {
        throw new \Exception('Default context should not be used in test case');
    }

    public function __call(string $name, array $arguments)
    {
        throw new \Exception('Default context should not be used in test case');
    }
}
