<?php declare(strict_types = 1);
namespace App\Parser\Dom;

/**
 * Represent a node of the HTML DOM
* 
 * @property ?HtmlNode $parent node parent
 * @property array $children node children
 * @property string $tag html tag
 * @property string $node node content
 * 
 * @method void addChild(HtmlNode $child) add a child to the parent node
 * @method array getChildren() return the current node children
 * @method int getChildrenNumber() return the current node children number
 * @method string getTag() return current node tag
 * @method string getNode() return current node content
 * @method HtmlNode|null getParent() return current node parent or null
 */
class HtmlNode
{
    private ?HtmlNode $parent = null;
    private ?array $children = [];
    private string $tag;
    private ?string $node;
    
    public function __construct(string $tag, HtmlNode $parent = null, string $node = '')
    {
        $this->tag = $tag;
        $this->parent = $parent;
        $this->node = $node;

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
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * Return the current node parent or null
     * @return HtmlNode parent
     */
    public function getParent(): HtmlNode | null
    {
        return $this->parent;
    }
}