<?php

namespace App\Contracts\Feed;


interface FeedClientInterface
{
    public function get(string $url, ?string $etag = null, ?string $lastModified = null): array;
}

