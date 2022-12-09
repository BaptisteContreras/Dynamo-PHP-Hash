<?php

namespace Dynamophp\Hash\Test;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use PHPUnit\Framework\TestCase;

class ResultExpectationTest extends TestCase
{
    private ?Hasher $hasher;

    protected function setUp(): void
    {
        $this->hasher = new Hasher(new DefaultContextMock());
    }

    public function testExpectation1(): void
    {
        $v = 'a'; // ca98bb --> 12 10 9 8 11 11
        $testContext = Context::buildSha256(3, 3);

        self::assertEquals(61, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation2(): void
    {
        $v = 'ThisIsATest'; //  8a5b8ea435
        $testContext = Context::buildSha256(5, 5);

        self::assertEquals(78, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation3(): void
    {
        $v = 'toto'; // 31f7a65e312e521b6a66 --> 3 1 15 7 10 6 5 14 3 1 2 14 5 2 1 11 6 10 6 6
        $testContext = Context::buildSha256(10, 10);

        self::assertEquals(128, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation4(): void
    {
        $v = 'php-is-great'; // 27c4e489618d82b4ed9dd7a4ed92d36b577cb027101b9ecfe6a63ed0bb1542ef --> 2 7 12 4 14 4 8 9 6 1 8 13 8 2 11 4 14 13 9 13 13 7 10 4 14 13 9 2 13 3 6 11 5 7 7 12 11 0 2 7 1 0 1 11 9 14 12 15 14 6 10 6 3 14 13 0 11 11 1 5 4 2 14 15
        $testContext = Context::buildSha256(32, 32);

        self::assertEquals(150, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation5(): void
    {
        $v = 'a'; // ca978e48bb
        $testContext = Context::buildSha256(5, 5);

        self::assertEquals(94, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation6(): void
    {
        $v = 'a'; // ca978112ca85afee48bb
        $testContext = Context::buildSha256(10, 10);

        self::assertEquals(172, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation7(): void
    {
        $v = 'a'; // ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb
        $testContext = Context::buildSha256(32, 32);

        self::assertEquals(169, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation8(): void
    {
        $v = 'a'; // ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb
        $testContext = Context::buildSha256(64, 0);

        self::assertEquals(169, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation9(): void
    {
        $v = 'a'; // ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb
        $testContext = Context::buildSha256(0, 64);

        self::assertEquals(169, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation10(): void
    {
        $v = 'b'; // 3e209d
        $testContext = Context::buildSha256(3, 3);

        self::assertEquals(41, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation11(): void
    {
        $v = 'b'; // 3e23ec009d
        $testContext = Context::buildSha256(5, 5);

        self::assertEquals(70, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation12(): void
    {
        $v = 'b'; // 3e23e81600aed59c009d
        $testContext = Context::buildSha256(10, 10);

        self::assertEquals(136, $this->hasher->hash($v, $testContext));
    }

    public function testExpectation13(): void
    {
        $v = 'b'; // 3e23e8160039594a33894f6564e1b1348bbd7a0088d42c4acb73eeaed59c009d
        $testContext = Context::buildSha256(32, 32);

        self::assertEquals(95, $this->hasher->hash($v, $testContext));
    }

    /*
        a = "8a5b8ea435"
        s = 0
        for l in range(len(a)):
            s += int(a[l], 16)
        print(s)
        print(s%360)
     */
}
