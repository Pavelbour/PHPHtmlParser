<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Parser\HtmlStringParser;

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
$parser = new HtmlStringParser($html);
echo 'OK';
