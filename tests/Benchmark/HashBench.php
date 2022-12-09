<?php

namespace Dynamophp\Hash\Test\Benchmark;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use Dynamophp\Hash\Test\DefaultContextMock;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use PhpBench\Attributes\Skip;

#[Skip]
class HashBench
{
    private Hasher $hasher;

    public function __construct()
    {
        $this->hasher = new Hasher(DefaultContextMock::buildSha256(0, 0));
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithSmallSelection(): void
    {
        $context = Context::buildSha256(3, 3);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithSmallSelection2(): void
    {
        $context = Context::buildSha256(5, 5);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithMedSelection(): void
    {
        $context = Context::buildSha256(10, 10);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithMedSelection2(): void
    {
        $context = Context::buildSha256(20, 10);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithBigSelection(): void
    {
        $context = Context::buildSha256(32, 32);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithBigSelection2(): void
    {
        $context = Context::buildSha256(30, 30);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithSmallSelection3(): void
    {
        $context = Context::buildSha256(0, 3);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithSmallSelection4(): void
    {
        $context = Context::buildSha256(5, 0);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithMedSelection3(): void
    {
        $context = Context::buildSha256(0, 10);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithMedSelection4(): void
    {
        $context = Context::buildSha256(20, 0);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithBigSelection3(): void
    {
        $context = Context::buildSha256(0, 64);

        $this->hasher->hash('a', $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    public function benchOneHashWithBigSelection4(): void
    {
        $context = Context::buildSha256(60, 0);

        $this->hasher->hash('a', $context);
    }
}
