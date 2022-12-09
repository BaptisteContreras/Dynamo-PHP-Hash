<?php

namespace Dynamophp\Hash\Test;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use PHPUnit\Framework\TestCase;

class ResultIntervalTest extends TestCase
{
    private ?Hasher $hasher;

    protected function setUp(): void
    {
        $this->hasher = new Hasher(new DefaultContextMock());
    }

    public function testResultIsInIntervalForTinyInput(): void
    {
        $v = 'a';
        $testContext = Context::buildSha256(30, 30);

        while ('aaaaa' !== $v) {
            $this->assertResultIsInInterval(
                $this->hasher->hash($v++, $testContext)
            );
        }
    }

    public function testResultIsInIntervalForTinyInput2(): void
    {
        $v = 'a';

        $testContext = Context::buildSha256(1, 1);

        while ('aaaaa' !== $v) {
            $this->assertResultIsInInterval(
                $this->hasher->hash($v++, $testContext)
            );
        }
    }

    public function testResultIsInIntervalForTinyInput3(): void
    {
        $v = 'a';

        $testContext = Context::buildSha256(3, 0);

        while ('aaaaa' !== $v) {
            $this->assertResultIsInInterval(
                $this->hasher->hash($v++, $testContext)
            );
        }
    }

    public function testResultIsInIntervalForTinyInput4(): void
    {
        $v = 'a';

        $testContext = Context::buildSha256(0, 3);

        while ('aaaaa' !== $v) {
            $this->assertResultIsInInterval(
                $this->hasher->hash($v++, $testContext)
            );
        }
    }

    public function testResultIsInIntervalForTinyInput5(): void
    {
        $v = 'a';

        $testContext = Context::buildSha256(5, 5);

        while ('aaaaa' !== $v) {
            $this->assertResultIsInInterval(
                $this->hasher->hash($v++, $testContext)
            );
        }
    }

    private function assertResultIsInInterval(int $result): void
    {
        self::assertTrue($result >= 0 && $result <= 360);
    }
}
