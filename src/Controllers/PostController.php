<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Services\PostService;
use PCore\HttpMessage\Response;
use PCore\Routing\Annotations\{Controller, GetMapping, PostMapping};
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
            $request->input(['content']),
            ['content' => 'required|max:10|min:5']
        );
        if ($validator->fails()) {
            return Response::jsonError(['fields' => $validator->failed()]);
        }
        $data = $validator->valid();
        $service->create($data);
        if ($service->fails()) {
            return Response::jsonError($service->failed());
        }
        return Response::json(true, $service->data());
    }

}