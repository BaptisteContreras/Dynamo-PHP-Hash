<?php

namespace Dynamophp\Hash\Test\Benchmark;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use Dynamophp\Hash\Test\DefaultContextMock;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\OutputMode;
use PhpBench\Attributes\OutputTimeUnit;
use PhpBench\Attributes\ParamProviders;
use PhpBench\Attributes\Revs;

class ValueVarianteBench
{
    private Hasher $hasher;

    public function __construct()
    {
        $this->hasher = new Hasher(DefaultContextMock::buildSha256(0, 0));
    }

    #[Revs(10000)]
    #[Iterations(10)]
    #[OutputMode('throughput')]
    #[OutputTimeUnit('seconds')]
    #[ParamProviders(['provideValue', 'provideStartSelection', 'provideEndSelection'])]
    public function benchHashVariante($params): void
    {
        if (0 === $params['start'] && 0 === $params['end']) {
            return;
        }

        $context = Context::buildSha256($params['start'], $params['end']);

        $this->hasher->hash($params['value'], $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    #[OutputMode('throughput')]
    #[OutputTimeUnit('seconds')]
    #[ParamProviders(['provideValueMed', 'provideStartSelection', 'provideEndSelection'])]
    public function benchHashVarianteMedValue($params): void
    {
        if (0 === $params['start'] && 0 === $params['end']) {
            return;
        }

        $context = Context::buildSha256($params['start'], $params['end']);

        $this->hasher->hash($params['value'], $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    #[OutputMode('throughput')]
    #[OutputTimeUnit('seconds')]
    #[ParamProviders(['provideValueMed2', 'provideStartSelection', 'provideEndSelection'])]
    public function benchHashVarianteMedValue2($params): void
    {
        if (0 === $params['start'] && 0 === $params['end']) {
            return;
        }

        $context = Context::buildSha256($params['start'], $params['end']);

        $this->hasher->hash($params['value'], $context);
    }

    #[Revs(10000)]
    #[Iterations(10)]
    #[OutputMode('throughput')]
    #[OutputTimeUnit('seconds')]
    #[ParamProviders(['provideValueBig', 'provideStartSelection', 'provideEndSelection'])]
    public function benchHashVarianteBigValue($params): void
    {
        if (0 === $params['start'] && 0 === $params['end']) {
            return;
        }

        $context = Context::buildSha256($params['start'], $params['end']);

        $this->hasher->hash($params['value'], $context);
    }

    public function provideValue()
    {
        $v = 'a';

        while ('aa' !== $v) {
            $c = ++$v;
            yield $c => ['value' => $c];
        }
    }

    public function provideValueMed()
    {
        $v = 'aaaa';

        while ('aaaaa' !== $v) {
            $c = ++$v;
            yield $c => ['value' => $c];
        }
    }

    public function provideValueMed2()
    {
        $v = 'aaaaaaa';

        while ('aaaaaaaa' !== $v) {
            $c = ++$v;
            yield $c => ['value' => $c];
        }
    }

    public function provideValueBig()
    {
        $v = 'aaaaaaaaaaaaaaaaaaaaaaaa';

        while ('aaaaaaaaaaaaaaaaaaaaaaaaa' !== $v) {
            $c = ++$v;
            yield $c => ['value' => $c];
        }
    }

    public function provideStartSelection()
    {
        yield '0' => ['start' => 0];
        yield '3' => ['start' => 3];
        yield '5' => ['start' => 5];
//        yield '10' => ['start' => 10];
//        yield '20' => ['start' => 20];
//        yield '32' => ['start' => 32];
    }

    public function provideEndSelection()
    {
        yield '0' => ['end' => 0];
        yield '3' => ['end' => 3];
        yield '5' => ['end' => 5];
//        yield '10' => ['end' => 10];
//        yield '20' => ['end' => 20];
//        yield '32' => ['end' => 32];
    }
}
