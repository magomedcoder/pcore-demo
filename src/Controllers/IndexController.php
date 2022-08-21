<?php

declare(strict_types=1);

namespace App\Controllers;

use PCore\HttpMessage\Response;
use PCore\Routing\Annotations\Controller;
use PCore\Routing\Annotations\GetMapping;
use PCore\Routing\Annotations\PostMapping;
use PCore\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

#[Controller(prefix: '/')]
class IndexController
{

    #[GetMapping(path: '/')]
    public function index(): ResponseInterface
    {
        return Response::json(true, [
            'messages' => 'PCore'
        ]);
    }

    #[PostMapping(path: '/validator')]
    public function validator(ServerRequestInterface $request): ResponseInterface
    {
        $name = $request->get('title');
        $validator = new Validator();
        $validator->make([
            'title' => $name
        ], [
            'title' => 'required|max:10|min:5'
        ]);
        if ($validator->fails()) {
            return Response::json(false, [], [
                'fields' => $validator->failed()
            ]);
        }
        $data = $validator->valid();
        return Response::json(true, $data);
    }

}