<?php

namespace Dynamophp\Hash;

class InvalidSelectionSizeException extends \Exception
{
    public function __construct(Context $invalidContext)
    {
        parent::__construct(sprintf(
            'The given selection interval is not correct (start [%s] + end [%s] > limit %s output size [%s]',
            $invalidContext->getStartSecondHashSelection(),
            $invalidContext->getEndSecondHashSelection(),
            $invalidContext->getPrimaryHashAlgorithm(),
            $invalidContext->getPrimaryHashAlgorithmResultSize()
        ));
    }
}
