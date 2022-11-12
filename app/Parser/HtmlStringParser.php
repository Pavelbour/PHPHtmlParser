<?php declare(strict_types = 1);

namespace App\Parser;

use App\Parser\Dom\HtmlNode;
use App\Parser\States\AutoclosedTagState;
use App\Parser\States\BaseState;
use App\Parser\States\ClosingTagSearchState;
use App\Parser\States\FinalState;
use App\Parser\States\OpeningTagSearchState;
use App\Parser\States\OpenTagState;
use App\Parser\States\TagNameSearchState;
use App\Parser\States\TagState;

class HtmlStringParser implements StringParser
{
    private string $html;
    private ?HtmlNode $parent = null;

    private int $cursor = 0;

    private string $nestedHtml;
    private string $htmlText;
    private string $tagName;
    private array $tagAttributes;
    private bool $isAutoclosed = false;

    private BaseState $currentState;

    public function __construct(string $html, HtmlNode $parent = null)
    {
        $this->html = $html;
        $this->parent = $parent;
    }

    public function parse(): HtmlNode|null
    {
        $this->currentState = new OpeningTagSearchState;

        while (!is_a($this->currentState, FinalState::class)) {
            if (!$this->scanString()) {
                return null;
            }

            $this->processState();
            $this->currentState = $this->currentState->nextState();
        }

        return new HtmlNode(
            $this->tagName,
            $this->parent,
            $this->tagAttributes,
            $this->isAutoclosed,
            $this->nestedHtml
        );
    }

    private function scanString(): bool
    {
        foreach ($this->currentState->getDelimiters() as $delimiter) {
            $position = strpos($this->html, $delimiter, $this->cursor);

            if ($position === false) {
                continue;
            }

            $this->currentState->setPayload(substr($this->html, $this->cursor, $position - $this->cursor));
            $this->currentState->setCurrentDelimiter($delimiter);
            $this->cursor = $position + strlen($delimiter);
            return true;
        }

        return is_a($this->currentState, AutoclosedTagState::class);
    }

    private function processState()
    {
        switch (get_class($this->currentState)) {
            case OpeningTagSearchState::class:
                    $this->htmlText = $this->currentState->getPayload();
                    break;
            case TagNameSearchState::class: 
                    $data = explode(' ', $this->currentState->getPayload());
                    $this->tagName = array_shift($data);
                    $this->tagAttributes = $data;
                    break;
            case AutoclosedTagState::class:
                    $this->isAutoclosed = true;
                    break;
            case ClosingTagSearchState::class:
                    $this->nestedHtml = $this->currentState->getPayload();
                    break;
        }
    }
}