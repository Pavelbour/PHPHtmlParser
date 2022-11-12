<?php declare(strict_types=1);

use App\Parser\DOM\HtmlDom;
use App\Parser\Dom\HtmlNode;
use App\Parser\Exceptions\NodeNotFoundException;
use PHPUnit\Framework\TestCase;

final class HtmlDomTest extends TestCase
{
    private static HtmlDom $dom;

    public static function setUpBeforeClass(): void
    {
        $rootNode = new HtmlNode('body');    

        $child1 = new HtmlNode('div', $rootNode);
        $child2 = new HtmlNode('div', $rootNode);
        $child3 = new HtmlNode('div', $rootNode);
        $innerNode = new HtmlNode('div', $child2, [], false, 'test');

        self::$dom = new HtmlDom($rootNode);
    }

    public function testGetNodeByIndexWithCorrectIndex(): void
    {
        $this->assertEquals('test', self::$dom->getNodeByIndex([1,0])->getNestedHtml());
    }

    public function testGetNodeByIndexWithIncorrectIndex(): void
    {
        $this->expectException(NodeNotFoundException::class);
        $this->expectExceptionMessage('Node 5 not found');

        self::$dom->getNodeByIndex([5]);
    }

    public function testCountNodes(): void
    {
        $this->assertEquals(4, self::$dom->countNodes());
    }
}