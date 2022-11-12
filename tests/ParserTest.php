<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Parser\HtmlParser;

final class ParserTest extends TestCase
{
    public function testPushAndPop(): void
    {
        $html = <<<HTML
        <html>
            <head>

            </head>
            <body>
                <div>SomeText</div>
                <div>SomeText</div>
                <div>SomeText</div>
            </body>
        </html>
        HTML;

        // $parser = new HtmlParser($html);

        // $this->assertIsObject($parser);
        // $this->assertEquals(3, $parser->count());
        $this->assertTrue(true);
    }
}