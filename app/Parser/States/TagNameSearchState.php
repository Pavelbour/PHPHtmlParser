<?php declare(strict_types=1);

namespace App\Parser\States;

use App\Parser\Exceptions\InvalidDelimiterException;

/**
 * Represent tag name search state
 */
final class TagNameSearchState extends BaseState
{
    public function __construct()
    {
        parent::__construct(['/>', '>']);
    }

    final public function nextState(): BaseState
    {
        switch ($this->getCurrentDelimiter()) {
            case '/>': return new AutoclosedTagState;
                        break;
            case '>': return new ClosingTagSearchState(explode(' ', $this->getPayload())[0]);
                        break;
            default: throw new InvalidDelimiterException("Delimiter $this->currentDelimiter isn\'t valid.");
        }
    }
}