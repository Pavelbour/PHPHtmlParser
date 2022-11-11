<?php declare(strict_types=1);

namespace App\Parser\States;

/**
 * Represent autoclosed tag state
 */
final class AutoclosedTagState extends BaseState
{
    public function __construct()
    {
        parent::__construct([]);
    }

    final public function nextState(): BaseState
    {
        return new FinalState;
    }
}