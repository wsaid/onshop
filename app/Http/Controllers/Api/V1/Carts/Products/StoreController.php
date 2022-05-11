<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Carts\ProductRequest;
use App\Http\Resources\Api\V1\CartItemResource;
use Domains\Customer\Actions\AddProductToCart;
use Domains\Customer\Factories\CartItemFactory;
use Domains\Customer\Models\Cart;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProductRequest $request, Cart $cart)
    {
        $cartItem = AddProductToCart::handle(
            CartItemFactory::make(
                $request->validated()
            ),
            $cart
        );

        return new JsonResponse(
            new CartItemResource($cartItem),
            Response::HTTP_CREATED
        );
    }
}
