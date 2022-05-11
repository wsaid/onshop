<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (!auth()->check() || !auth()->user()->cart) {
            return new Response(
                null,
                Response::HTTP_NO_CONTENT
            );
        }
        
        return new JsonResponse(
            new CartResource(
                auth()->user()->cart
            ),
            Response::HTTP_OK
        );
    }
}
