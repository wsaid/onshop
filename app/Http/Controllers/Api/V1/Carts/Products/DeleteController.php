<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Controllers\Controller;
use Domains\Customer\Actions\RemoveProductFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Cart $cart, CartItem $item)
    {
        RemoveProductFromCart::handle($cart, $item);

        return new JsonResponse(
            null,
            Response::HTTP_ACCEPTED,
        );
    }
}
