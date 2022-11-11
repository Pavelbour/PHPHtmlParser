<?php declare(strict_types=1);

namespace App\Parser\States;

/**
 * Represent closing tag search state
 */
final class ClosingTagSearchState extends BaseState
{
    public function __construct(string $delimiter)
    {
        parent::__construct(['</']);
    }

    final public function nextState(): BaseState
    {
        return new FinalState;
    }
}