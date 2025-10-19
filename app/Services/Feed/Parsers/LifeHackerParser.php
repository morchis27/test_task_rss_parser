<?php

namespace App\Services\Feed\Parsers;;

use App\Contracts\Feed\FeedParserInterface;
use App\Exceptions\LifeHackerNotParsedException;
use SimpleXMLElement;

class LifeHackerParser implements FeedParserInterface
{
    /**
     * @throws LifeHackerNotParsedException
     */
    public function parse(string $xml): array
    {
        try {
            $doc = @simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

            if (!$doc) {
                return [];
            }

            return $this->parseRss($doc);
        } catch (\Exception $exception) {
            throw new LifeHackerNotParsedException(previous: $exception);
        }
    }

    private function parseRss(SimpleXMLElement $xml): array
    {
        $channel = $xml->channel ?: $xml;
        $out = [];

        foreach ($channel->item as $item) {

            $contentEncoded = $item->children('content', true)->encoded ?? null;

            $out[] = [
                'title' => $this->parseString($item->title),
                'link' => $this->parseString($item->link),
                'description' => $this->parseString($contentEncoded ?: $item->description ?? ''),
                'pub_date' => $this->parseString($item->pubDate ?? ''),
            ];
        }

        return $out;
    }

    private function parseString($node): ?string
    {
        if ($node === null) return null;
        $v = trim((string)$node);

        return $v === '' ? null : $v;
    }
}

