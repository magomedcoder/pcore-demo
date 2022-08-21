<?php

declare(strict_types=1);

namespace App\Services;

use App\Abstracts\AbstractService;
use App\Repositories\PostRepository;

/**
 * Class PostService
 * @package App\Services
 */
class PostService extends AbstractService
{

    public function __construct(private PostRepository $repository)
    {

    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $postId = $this->repository->create($data);
        $this->setData(['postId' => $postId]);
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