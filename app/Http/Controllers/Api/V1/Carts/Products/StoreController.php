<?php

namespace App\Http\Controllers\Api\V1\Carts\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Carts\ProductRequest;
use Domains\Customer\Aggregates\CartAggregate;
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
        CartAggregate::retrieve(
            $cart->uuid,
        )->addProduct(
            $cart->id,
            $request->get('purchasable_id'),
            $request->get('purchasable_type'),
        )->persist();

        return new JsonResponse(
             null,
            Response::HTTP_CREATED,
        );
    }
}
