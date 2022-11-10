<?php declare(strict_types = 1);
namespace App\Parser\DOM;

use App\Parser\Dom\HtmlNode;
use App\Parser\Exceptions\NodeNotFoundException;

/**
 * Represents Html DOM tree
 * 
 * @property HtmlNode $root root node of the tree
 * 
 * @method 
 * @method HtmlNode getRoot() return root node
 * @method HtmlNode getNodeByIndex(array $index) return given node
 * @methode int countNodes() return numbers of nodes
 * @methode int getNodeChildrenNumber(HtmlNode $node) return numbers of nodes
 */
class HtmlDom
{
    private HtmlNode $root;

    public function __construct(HtmlNode $root)
    {
        $this->root = $root;
    }
    
    /**
     * Return root node
     * @return HtmlNode|null root node or null
     */
    public function getRoot(): HtmlNode|null
    {
        return $this->root;
    }

    /**
     * Return the node with given index
     * @param array $nodeIndex index
     * @return HtmlNode node
     * @throws NodNotFoundException if the node with given index not found
     */
    public function getNodeByIndex(array $nodeIndex): HtmlNode
    {
        $currentNode = $this->root;

        try {
            foreach ($nodeIndex as $index) {    
                $currentNode = $currentNode->getChildren()[$index];
            } 
        } catch (\Exception $e) {
            throw new NodeNotFoundException("Node $index not found");
        }

        return $currentNode;
    }

    /**
     * Return number of nodes
     * 
     * @return int number of nodes
     */
    public function countNodes(): int
    {
        return $this->getNodeChildrenNumber($this->root);
    }

    /**
     * Return number of nodes
     * 
     * @param HtmlNode $node node
     * @return int number of nodes
     */
    private function getNodeChildrenNumber(HtmlNode $node): int
    {
        $nodes = $node->getChildrenNumber();
        
        foreach ($node->getChildren() as $currentNode) {
            $nodes += $this->getNodeChildrenNumber($currentNode);
        }

        return $nodes;
    }
}