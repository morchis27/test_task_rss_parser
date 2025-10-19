<?php

namespace App\Jobs;

namespace App\Jobs;

use App\Contracts\Feed\FeedClientInterface;
use App\Contracts\Feed\FeedParserInterface;
use App\Contracts\Repository\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchFeedJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    public int $backoff = 60;

    public function __construct(public string $url)
    {
    }

    public function uniqueId(): string
    {
        return $this->url;
    }

    public function handle(
        FeedClientInterface     $client,
        FeedParserInterface     $parser,
        PostRepositoryInterface $posts
    ): void
    {
        $result = $client->get($this->url);
        if ($result['not_modified'] ?? false) return;

        $items = $parser->parse($result['body'] ?? '');
        $posts->saveMany($items);
    }
}

