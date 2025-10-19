<?php

namespace App\Repositories;

use App\Contracts\Repository\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

final readonly class PostRepository implements PostRepositoryInterface
{
    public function __construct(
        private Post $post,
        private Str  $stringHelper,
    )
    {
    }

    public function saveMany(array $items): int
    {
        $new = 0;
        foreach ($items as $item) {
            $link = $item['link'] ?? null;

            if (!$link) {
                $link = 'nolink:' . md5(($item['title'] ?? '') . '|' . ($item['pub_date'] ?? ''));
            }

            $created = $this->post->firstOrCreate(
                ['link' => $link],
                [
                    'title' => $this->stringHelper->limit($item['title'] ?? '', 255, ''),
                    'description' => $item['description'] ?? '',
                    'pub_date' => $item['pub_date'] ?? '',
                ]
            )->wasRecentlyCreated;

            if ($created) {
                $new++;
            }
        }

        return $new;
    }

    public function paginateFiltered(array $params): LengthAwarePaginator
    {
        $perPage = min((int)($params['per_page'] ?? 15), 100);
        $sort = $params['sort'] ?? 'created_at';
        $order = strtolower($params['order'] ?? 'desc') === 'asc' ? 'asc' : 'desc';
        $search = $params['search'] ?? null;
        $from = $params['date_from'] ?? null;
        $to = $params['date_to'] ?? null;

        $sortable = ['title', 'pub_date', 'created_at', 'updated_at'];
        if (!in_array($sort, $sortable, true)) $sort = 'created_at';

        $q = Post::query();

        if ($search) {
            $q->where(function ($qq) use ($search) {
                $qq->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            });
        }
        if ($from) $q->whereDate('created_at', '>=', $from);
        if ($to) $q->whereDate('created_at', '<=', $to);

        $q->orderBy($sort, $order);

        return $q->paginate($perPage)->appends($params);
    }

    public function create(array $data): Post
    {
        return $this->post->create($data);
    }

    public function findOrFail(int $id): Post
    {
        return $this->post->findOrFail($id);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);

        return $post->refresh();
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}
