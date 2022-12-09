<?php

namespace Dynamophp\Hash;

class Hasher
{
    public function __construct(
        private readonly Context $defaultContext
    ) {
    }

    /**
     * @throws InvalidSelectionSizeException
     * @throws InvalidPrimaryHashAlgorithm
     */
    public function hash(string $value, ?Context $context = null, bool $contextValidation = true): float
    {
        $contextToUse = $context ?: $this->defaultContext;

        if ($contextValidation) {
            $this->verifyContext($contextToUse);
        }

        $firstHash = $this->applyFirstHashing($contextToUse->getPrimaryHashAlgorithm(), $value);

        [$firstPart, $secondPart] = $this->selectParts(
            $firstHash,
            $contextToUse->getStartSecondHashSelection(),
            $contextToUse->getEndSecondHashSelection()
        );

        $totalSelectionSize = $contextToUse->getStartSecondHashSelection() + $contextToUse->getEndSecondHashSelection();

        $fullChain = $firstPart.$secondPart;

        $sum = 0;
        for ($i = 0; $i < $totalSelectionSize; ++$i) {
            $sum += hexdec($fullChain[$i]);
        }

        return $sum % 360;
    }

    /**
     * @throws InvalidSelectionSizeException
     */
    private function verifyContext(Context $context): void
    {
        $totalSelectionSize = $context->getStartSecondHashSelection() + $context->getEndSecondHashSelection();

        if ($totalSelectionSize <= 0 || $totalSelectionSize > $context->getPrimaryHashAlgorithmResultSize()) {
            throw new InvalidSelectionSizeException($context);
        }
    }

    /**
     * @throws InvalidPrimaryHashAlgorithm
     */
    private function applyFirstHashing(string $hashAlgorithm, string $value): string
    {
        try {
            return hash($hashAlgorithm, $value);
        } catch (\ValueError $valueError) {
            throw new InvalidPrimaryHashAlgorithm($hashAlgorithm);
        }
    }

    /**
     * @return array<string>
     */
    private function selectParts(string $hashResult, int $firstPartSelection, int $secondPartSelection): array
    {
        return [
            $firstPartSelection > 0 ? substr($hashResult, 0, $firstPartSelection) : '',
            $secondPartSelection > 0 ? substr($hashResult, -$secondPartSelection, $secondPartSelection) : '',
        ];
    }
}
