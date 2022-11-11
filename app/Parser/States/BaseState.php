<?php declare(strict_types=1);

namespace App\Parser\States;

/**
 * Base class for parse states
 * 
 * @property string $payload parcing result
 * @property aray $delimiters parcing delimiters
 * @property string $currentDelimiter currentDelimiter
 * 
 * @method void setPayload(string $payload) set parcing result
 * @method string getPayload() get parcing result
 * @method array getDelimiters() return parcing delimiters
 * @method void setCurrentDelimiter(string Delimiter) set current delimiter
 * @method string getCurrentDelimiter() return current delimiter
 * @method BaseState nextState() return next state
 */
abstract class BaseState
{
    private string $payload = '';
    private readonly array $delimiters;
    private string $currentDelimiter;

    public function __construct(array $delimiters)
    {
        $this->delimiters = $delimiters;
    }

    /**
     * Set parsing result
     * @param string $payload parcing result
     */
    final public function setPayload(string $payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get parcing result
     * @return string parcing result
     */
    final public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * Get parcing delimiters
     * @return array parcing delimiters
     */
    final public function getDelimiters(): array
    {
        return $this->delimiters;
    }

    /**
     * Set current delimiter
     * @param string $delimiter delimiter
     */
    final public function setCurrentDelimiter(string $delimiter)
    {
        $this->currentDelimiter = $delimiter;
    }

    /**
     * Get current delimiter
     * @return string delimeter
     */
    final protected function getCurrentDelimiter(): string
    {
        return $this->currentDelimiter;
    }

    abstract public function nextState(): BaseState;
}