<?php

namespace App\Services\Feed;

use App\Contracts\Feed\FeedClientInterface;
use App\Exceptions\HttpFeedException;
use Exception;
use Illuminate\Support\Facades\Http;

readonly class HttpFeedClient implements FeedClientInterface
{

    public function __construct(
        private Http $http,
    )
    {
    }

    /**
     * @throws HttpFeedException
     */
    public function get(string $url, ?string $etag = null, ?string $lastModified = null): array
    {
        try {
            $request = $this->http::timeout(15)->withHeaders([
                'User-Agent' => 'LaravelFeedWorker/1.0',
                'Accept' => 'application/rss+xml, application/atom+xml, application/xml;q=0.9,*/*;q=0.8',
            ]);

            if ($etag) {
                $request = $request->withHeaders(['If-None-Match' => $etag]);
            }
            if ($lastModified) {
                $request = $request->withHeaders(['If-Modified-Since' => $lastModified]);
            }

            $result = $request->get($url);

            if ($result->status() === 304) {
                return [
                    'status' => 304,
                    'body' => null,
                    'etag' => $etag,
                    'last_modified' => $lastModified,
                    'not_modified' => true
                ];
            }
        } catch (Exception $e) {
            throw new HttpFeedException($e->getMessage(), $e->getCode(), $e);
        }

        return [
            'status' => $result->status(),
            'body' => $result->body(),
            'etag' => $result->header('ETag'),
            'last_modified' => $result->header('Last-Modified'),
            'not_modified' => false,
        ];
    }
}

