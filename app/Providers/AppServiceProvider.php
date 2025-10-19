<?php

namespace App\Providers;

use App\Contracts\Feed\FeedClientInterface;
use App\Contracts\Feed\FeedParserInterface;
use App\Contracts\Repository\PostRepositoryInterface;
use App\Contracts\Repository\UserRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Services\Feed\HttpFeedClient;
use App\Services\Feed\Parsers\LifeHackerParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FeedClientInterface::class, HttpFeedClient::class);
        $this->app->bind(FeedParserInterface::class, LifehackerParser::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
