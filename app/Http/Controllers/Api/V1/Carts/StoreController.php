<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CartResource;
use Domains\Customer\Actions\CreateCart;
use Domains\Customer\Enums\CartStatus;
use Domains\Customer\Factories\CartFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cart = CreateCart::handle(
            CartFactory::make(
                [
                    'status' => CartStatus::PENDING()->value,
                    'userID' => auth()->id ?? null
                ]       
            )
        );

        return new JsonResponse(
            new CartResource(
                $cart
            ),
            Response::HTTP_CREATED
        );
    }
}
