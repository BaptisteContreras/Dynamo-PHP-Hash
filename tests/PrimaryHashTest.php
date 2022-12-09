<?php

namespace Dynamophp\Hash\Test;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use Dynamophp\Hash\InvalidPrimaryHashAlgorithm;
use PHPUnit\Framework\TestCase;

class PrimaryHashTest extends TestCase
{
    private ?Hasher $hasher;

    protected function setUp(): void
    {
        $this->hasher = new Hasher(new DefaultContextMock());
    }

    public function testUnknownPrimaryHashAlgorithmThrowAnException(): void
    {
        $context = new Context('ThisIsAnUnknownHashAlgo', 1, 1, 64);

        $this->expectException(InvalidPrimaryHashAlgorithm::class);

        $this->hasher->hash('ThisIsATestValue', $context);
    }
}
