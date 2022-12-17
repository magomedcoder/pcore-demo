<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Services\PostService;
use PCore\HttpMessage\Response;
use PCore\Routing\Attributes\{Controller, GetMapping, PostMapping};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};

#[Controller(prefix: '/post')]
class PostController extends AbstractController
{

    #[GetMapping(path: '/list')]
    public function index(PostService $service): ResponseInterface
    {
        return Response::json(true, [
            'items' => $service->list()
        ]);
    }

    #[PostMapping(path: '/create')]
    public function validator(ServerRequestInterface $request, PostService $service): ResponseInterface
    {
        $validator = $this->validate(
            $request->inputs(['content']),
            ['content' => 'required|max:10|min:5']
        );
        if ($validator->fails()) {
            return Response::jsonError(['fields' => $validator->failed()]);
        }
        $data = $validator->valid();
        return Response::json(true, $service->create($data));
    }

}
