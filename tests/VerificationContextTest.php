<?php

namespace Dynamophp\Hash\Test;

use Dynamophp\Hash\Context;
use Dynamophp\Hash\Hasher;
use Dynamophp\Hash\InvalidSelectionSizeException;
use PHPUnit\Framework\TestCase;

class VerificationContextTest extends TestCase
{
    private ?Hasher $hasher;

    protected function setUp(): void
    {
        $this->hasher = new Hasher(new DefaultContextMock());
    }

    public function testTotalSizeIsNotTooGreat(): void
    {
        $context = Context::buildSha256(30, 30); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsNotTooGreat2(): void
    {
        $context = Context::buildSha256(30, 20); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsNotTooGreat3(): void
    {
        $context = Context::buildSha256(20, 30); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsEqualToTheLimit(): void
    {
        $context = Context::buildSha256(63, 1); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsEqualToTheLimit2(): void
    {
        $context = Context::buildSha256(1, 63); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsEqualToTheLimit3(): void
    {
        $context = Context::buildSha256(64, 0); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsEqualToTheLimit4(): void
    {
        $context = Context::buildSha256(0, 64); // Max here is 64

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context));
    }

    public function testTotalSizeIsTooGreatThrowAnException(): void
    {
        $context = Context::buildSha256(200, 200); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsTooGreatThrowAnException2(): void
    {
        $context = Context::buildSha256(0, 65); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsTooGreatThrowAnException3(): void
    {
        $context = Context::buildSha256(65, 0); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsTooGreatThrowAnException4(): void
    {
        $context = Context::buildSha256(400, 400); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsTooGreatAndContextValidationIsDisabled(): void
    {
        $context = new Context('sha256', 50, 50, 0);

        self::assertNotNull($this->hasher->hash('dynamoPhpTestKey', $context, false));
    }

    public function testTotalSizeIsZeroThrowAnException(): void
    {
        $context = Context::buildSha256(0, 0); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsNegativeThrowAnException(): void
    {
        $context = Context::buildSha256(-1, 0); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }

    public function testTotalSizeIsNegativeThrowAnException2(): void
    {
        $context = Context::buildSha256(0, -1); // Max here is 64

        $this->expectException(InvalidSelectionSizeException::class);

        $this->hasher->hash('dynamoPhpTestKey', $context);
    }
}
