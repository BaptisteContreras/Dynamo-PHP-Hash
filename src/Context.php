<?php

namespace Dynamophp\Hash;

class Context
{
    public function __construct(
        private readonly string $primaryHashAlgorithm,
        private readonly int $startSecondHashSelection,
        private readonly int $endSecondHashSelection,
        private readonly int $primaryHashAlgorithmResultSize
    ) {
    }

    public static function buildSha256(
        int $startSecondHashSelection,
        int $endSecondHashSelection
    ): self {
        return new self('sha256', $startSecondHashSelection, $endSecondHashSelection, 64);
    }

    public function getPrimaryHashAlgorithm(): string
    {
        return $this->primaryHashAlgorithm;
    }

    public function getStartSecondHashSelection(): int
    {
        return $this->startSecondHashSelection;
    }

    public function getEndSecondHashSelection(): int
    {
        return $this->endSecondHashSelection;
    }

    public function getPrimaryHashAlgorithmResultSize(): int
    {
        return $this->primaryHashAlgorithmResultSize;
    }
}
