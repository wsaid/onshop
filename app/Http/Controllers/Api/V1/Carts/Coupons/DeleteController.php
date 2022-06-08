<?php

namespace App\Http\Controllers\Api\V1\Carts\Coupons;

use App\Http\Controllers\Controller;
use Domains\Customer\Actions\RemoveCouponFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Cart $cart, string $uuid)
    {
        RemoveCouponFromCart::handle($cart, $uuid);

        return new JsonResponse(
            null,
            Response::HTTP_ACCEPTED,
        );
    }
}
