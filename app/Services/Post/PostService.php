<?php

namespace App\Services\Post;

use App\Contracts\Repository\PostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Post;

final readonly class PostService
{
    public function __construct(private PostRepositoryInterface $repository)
    {
    }

    public function list(array $params): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($params);
    }

    public function create(array $data): Post
    {
        return $this->repository->create($data);
    }

    public function show(int $id): Post
    {
        return $this->repository->findOrFail($id);
    }

    public function update(int $id, array $data): Post
    {
        $post = $this->repository->findOrFail($id);
        return $this->repository->update($post, $data);
    }

    public function delete(int $id): void
    {
        $post = $this->repository->findOrFail($id);
        $this->repository->delete($post);
    }
}

