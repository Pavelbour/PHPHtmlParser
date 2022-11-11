<?php declare(strict_types=1);

namespace App\Parser\States;

/**
 * Represent opening state search state
 */
final class OpeningTagSearchState extends BaseState
{
    public function __construct()
    {
        parent::__construct(['<']);
    }

    final public function nextState(): BaseState
    {
        return new TagNameSearchState;
    }
}