<?php

namespace App\Console\Commands;

use App\Jobs\FetchFeedJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class QueueFeeds extends Command
{
    protected $signature = 'feeds:queue';
    protected $description = 'Dispatch fetch jobs for rss feeds';

    public function handle(): int
    {
        foreach (config('feeds.sources', []) as $url) {
            FetchFeedJob::dispatch($url)->onQueue('feeds')->delay(now()->addSeconds(15));;
        }

        $this->info('Dispatched');

        return self::SUCCESS;
    }
}

