<?php declare(strict_types = 1);
namespace App\Parser\Dom;

/**
 * Represent a node of the HTML DOM
 * 
 * @property ?HtmlNode $parent node parent
 * @property array $children node children
 * @property string $tag html tag
 * @property string $node node content
 * @property array $attributes node attributes
 * @property bool $isAutoclosed is tag autoclosed
 * 
 * @method void addChild(HtmlNode $child) add a child to the parent node
 * @method array getChildren() return the current node children
 * @method int getChildrenNumber() return the current node children number
 * @method string getTag() return current node tag
 * @method string getNestedHtml() return current node content
 * @method HtmlNode|null getParent() return current node parent or null
 * @method bool isAutoclosed() return is tag autoclosed
 */
class HtmlNode
{
    private ?HtmlNode $parent = null;
    private array $children = [];
    private array $attributes = [];
    private string $tag;
    private bool $isAutoclosed = false; 
    private string $nestedHtml = '';
    
    public function __construct(
        string $tag,
        HtmlNode $parent = null,
        array $attributes = [],
        bool $isAutoclosed = false,
        string $nestedHtml = ''
    ) {
        $this->tag = $tag;
        $this->parent = $parent;
        $this->nestedHtml = $nestedHtml;
        $this->attributes = $attributes;
        $this->isAutoclosed = $isAutoclosed;

        if ($parent) {
            $parent->addChild($this);
        }
    }

    /**
     * Add a child to the parent node
     * @param HtmlNOde chiald to add
     */
    public function addChild(HtmlNode $child): void
    {
        $this->children[] = $child;
    }

    /**
     * Return the current node children
     * @return array children
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Return the current node children number
     * @return int children number
     */
    public function getChildrenNumber(): int
    {
        return sizeof($this->children);
    }

    /**
     * Return current node tag
     * @return string tag
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Return the current node content
     * @return string content
     */
    public function getNestedHtml(): string
    {
        return $this->nestedHtml;
    }

    /**
     * Return the current node parent or null
     * @return HtmlNode parent
     */
    public function getParent(): HtmlNode | null
    {
        return $this->parent;
    }

    /**
     * Return the current node attributes
     * @return array attributes
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Return is tag autoclosed
     * @return bool is autoclosed
     */
    public function isAutoclosed(): bool
    {
        return $this->isAutoclosed;
    }
}