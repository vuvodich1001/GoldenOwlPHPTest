<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function index() {
        //Do data ở dạng json từ trước nên em lưu data vào thư mục shoes ở trong config
        $shoes = config('shoes');
        $carts = Session::get('cart');
        $total = 0;
        if (isset($carts)) {
            $shoes = $this->checkShoeInCart($shoes, $carts);
            $total = array_reduce(
                $carts,
                function ($acc, $cart) {
                    return $acc + $cart['shoe']['price'] * $cart['quantity'];
                },
                0
            );
        }

        return view('app', [
            'shoes' => $shoes,
            'carts' => $carts,
            'total' => $total
        ]);
    }

    public function checkShoeInCart($shoes, $carts) {
        foreach ($shoes as &$shoe) {
            foreach ($carts as $cart) {
                if ($shoe['id'] == $cart['shoe']['id']) {
                    $shoe['isInCart'] = 1;
                }
            }
        }
        return $shoes;
    }
}
