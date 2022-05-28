<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Golden Sneaker</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{-- Check css file in public folder --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>
    <div class="app">
        <main>
            <section class="card product">
                <img src="{{asset('images/nike.png')}}" alt="" class="logo">
                <div class="card-title">
                    <h2>Our Products</h2>
                </div>
                <div class="card-content">
                    @foreach ($shoes as $shoe)
                    <div class="card-item">
                        <div class="card-body">
                            <div class="card-image" style="background-color: {{$shoe['color']}}">
                                <img src="{{$shoe['image']}}" alt="">
                            </div>
                            <p class="card-name">
                                {{ $shoe['name'] }}
                            </p>
                            <div class="card-description">
                                {{ $shoe['description'] }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <h3 class="card-price">
                                ${{ $shoe['price'] }}
                            </h3>
                            @if (!isset($shoe['isInCart']))
                            <a href="{{route('cart.addToCart', ['id' => $shoe['id']])}}" class="card-addtocart">
                                ADD TO CART
                            </a>
                            @else
                            <div class="card-check">
                                <img src="{{asset('images/check.png')}}" alt="">
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            <section class="card">
                <img src="{{asset('images/nike.png')}}" alt="" class="logo">
                <div class="card-title">
                    <h2>Your Cart</h2>
                    <h2>${{number_format($total, 2, '.', '.')}}</h2>
                </div>
                <div class="cart-content">
                    @if (!empty($carts))
                    @foreach ($carts as $cart)
                    <div class="cart-item">
                        <div class="cart-image" style="background-color: {{$cart['shoe']['color']}}">
                            <img src="{{$cart['shoe']['image']}}" alt="">
                        </div>
                        <div class="cart-detail">
                            <p class="cart-name">{{ $cart['shoe']['name'] }}</p>
                            <p class="cart-price">${{ $cart['shoe']['price'] }}</p>
                            <div class="cart-footer">
                                <div class="cart-group">
                                    <a href="{{route('cart.decrease', ['id' => $cart['shoe']['id']])}}"
                                        class="cart-decrease">
                                        <img src="{{asset('images/minus.png')}}" alt="">
                                    </a>
                                    <span class="cart-quantity">{{$cart['quantity']}}</span>
                                    <a href="{{route('cart.increase', ['id' => $cart['shoe']['id']])}}"
                                        class="cart-increase">
                                        <img src="{{asset('images/plus.png')}}" alt="">
                                    </a>
                                </div>
                                <a href="{{route('cart.remove', ['id' => $cart['shoe']['id']])}}" class="cart-trash">
                                    <img src="{{asset('images/trash.png')}}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <span class="cart-empty">Your cart is empty.</span>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>

</html>