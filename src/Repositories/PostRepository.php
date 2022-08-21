<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;

/**
 * Class PostRepository
 * @package App\Repositories
 */
class PostRepository
{

    public function __construct(private Post $model)
    {

    }

    /**
     * @param array $data
     * @return int|null
     */
    public function create(array $data): ?int
    {
        return $this->model::query()
            ->insert([
                'content' => $data['content'],
                'created_at' => time()
            ]);
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->model::query()
            ->order('id', 'DESC')
            ->get()
            ->toArray();
    }

}