<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{

    public function __construct(private PostRepository $repository)
    {

    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $postId = $this->repository->create($data);
        return ['postId' => $postId];
    }

    /**
     * @return array
     */
    public function list(): array
    {
        $rows = $this->repository->get();
        return array_map(function ($item) {
            return [
                'content' => $item['content'],
                'createdAt' => $item['created_at']
            ];
        }, $rows);
    }

}
