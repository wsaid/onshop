<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Carts\Products\UpdateRequest;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, Cart $cart, CartItem $item)
    {
        CartAggregate::retrieve(
            $item->cart->uuid,
        )->increaseQuantity(
            $item->cart->id,
            $item->id,
            $request->get('quantity'),
        )->persist();

        return new JsonResponse(
            null,
            Response::HTTP_ACCEPTED,
        );
    }
}
