<?php declare(strict_types=1);

use App\Parser\Dom\HtmlNode;
use PHPUnit\Framework\TestCase;
use App\Parser\HtmlStringParser;

final class HtmlStringParserTest extends TestCase
{
    public function testSimpleDiv(): void
    {
        $parser = new HtmlStringParser('<div>Test text</div>');

        $htmlNode = $parser->parse();

        $this->assertInstanceOf(HtmlNode::class, $htmlNode);
        $this->assertEquals('div', $htmlNode->getTag());
        $this->assertEquals('Test text', $htmlNode->getNestedHtml());
        $this->assertEmpty($htmlNode->getAttributes());
        $this->assertFalse($htmlNode->isAutoclosed());
    }

    public function testDivWithAttributes(): void
    {
        $parser = new HtmlStringParser('<div attribute1=test-attribute-1 attribute2=test-attribute-2>Test text</div>');

        $htmlNode = $parser->parse();

        $this->assertInstanceOf(HtmlNode::class, $htmlNode);
        $this->assertEquals('div', $htmlNode->getTag());
        $this->assertEquals('Test text', $htmlNode->getNestedHtml());
        $this->assertCount(2, $htmlNode->getAttributes());
        $this->assertEquals('attribute1=test-attribute-1', $htmlNode->getAttributes()[0]);
        $this->assertEquals('attribute2=test-attribute-2', $htmlNode->getAttributes()[1]);
        $this->assertFalse($htmlNode->isAutoclosed());
    }
}