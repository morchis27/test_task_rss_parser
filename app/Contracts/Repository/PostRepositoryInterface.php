<?php

namespace App\Contracts\Repository;


use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function saveMany(array $items): int;

    public function paginateFiltered(array $params): LengthAwarePaginator;

    public function create(array $data): Post;

    public function findOrFail(int $id): Post;

    public function update(Post $post, array $data): Post;

    public function delete(Post $post): void;
}

