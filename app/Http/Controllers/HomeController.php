<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class HomeController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function __invoke()
    {
        return $this->responseFactory->view("home");
    }
}
