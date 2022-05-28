<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {

    public function index() {
    }

    public function findShoeById(array $shoes, $id) {
        foreach ($shoes as $shoe) {
            if ($shoe['id'] == $id) {
                return $shoe;
            }
        }
    }
    public function addToCart($id) {
        $shoes = config('shoes');
        $shoe = $this->findShoeById($shoes, $id);
        if (!Session::has('cart')) {
            Session::put('cart', [['shoe' => $shoe, 'quantity' => 1]]);
        } else {
            Session::push('cart', ['shoe' => $shoe, 'quantity' => 1]);
        }
        return redirect()->route('home.index');
    }

    public function increase($id) {
        $carts = Session::get('cart');
        foreach ($carts as &$cart) {
            if ($cart['shoe']['id'] == $id) {
                $cart['quantity'] += 1;
            }
        }
        Session::put('cart', $carts);
        return redirect()->route('home.index');
    }

    public function decrease($id) {
        $carts = Session::get('cart');
        foreach ($carts as $key => &$cart) {
            if ($cart['shoe']['id'] == $id) {
                $cart['quantity'] -= 1;
                if ($cart['quantity'] == 0) {
                    unset($carts[$key]);
                }
            }
        }
        Session::put('cart', $carts);
        return redirect()->route('home.index');
    }
    public function remove($id) {
        $carts = Session::get('cart');
        foreach ($carts as $key => &$cart) {
            if ($cart['shoe']['id'] == $id) {
                unset($carts[$key]);
            }
        }
        Session::put('cart', $carts);
        return redirect()->route('home.index');
    }
    public function removeCart() {
        Session::forget('cart');
    }
}
