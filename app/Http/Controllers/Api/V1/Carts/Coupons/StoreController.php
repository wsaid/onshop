<?php

namespace App\Http\Controllers\Api\V1\Carts\Coupons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Carts\Coupons\StoreRequest;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
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
    public function __invoke(StoreRequest $request, Cart $cart)
    {
        $coupon = Coupon::query()->where(
            'code', 
            $request->code
        )->firstOrFail();

        CartAggregate::retrieve(
            $cart->uuid
        )->applyCoupon(
            $cart->id,
            $coupon->code
        )->persist();

        return new JsonResponse(
            null,
            Response::HTTP_ACCEPTED,
        );
    }
}
