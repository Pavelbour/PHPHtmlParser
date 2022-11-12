<?php declare(strict_types = 1);

namespace App\Parser;

use App\Parser\DOM\HtmlNode;

interface StringParser
{
    public function parse(): HtmlNode|null;
}