<?php declare(strict_types=1);

namespace App\Parser\States;

/**
 * Represent final state
 */
final class FinalState extends BaseState
{
    public function __construct()
    {
        parent::__construct([]);
    }

    final public function nextState(): BaseState
    {
        return new FinalState();
    }
}