<?php declare(strict_types=1);

use App\Parser\DOM\HtmlNode;
use PHPUnit\Framework\TestCase;

final class HtmlNodeTest extends TestCase
{
    public function testHtmlNode(): void
    {
        $rootNode = new HtmlNode('body');
        $this->assertEquals(0, $rootNode->getChildrenNumber());

        $child1 = new HtmlNode('div', $rootNode);
        $child2 = new HtmlNode('div', $rootNode);
        $child3 = new HtmlNode('div', $rootNode);
        $innerNode = new HtmlNode('div', $child2, [], false, 'test');

        $this->assertEquals(3, $rootNode->getChildrenNumber());
        $this->assertEquals('test', $rootNode->getChildren()[1]->getChildren()[0]->getNestedHtml());
    }
}