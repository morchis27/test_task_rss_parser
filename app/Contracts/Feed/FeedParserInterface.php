<?php

namespace App\Contracts\Feed;


interface FeedParserInterface
{
    public function parse(string $xml): array;
}

