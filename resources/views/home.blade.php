@extends('layouts.default')

@section('content')

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">APSD Market</h1>
                <p class="lead fw-normal text-white-50 mb-0">Food & Beverage | Retail</p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-left">
                @foreach ($productData as $product)
                    {{-- <?php dd($product); ?> --}}
                    
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ (!is_null($product['image']) ? asset('product/img/' . $product["image"]) : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg") }}" alt="..." style="max-height: 200px;"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><a href="{{ url('detail/' . $product["id"]) }}">{{ $product['name'] }}</a></h5>
                                    <!-- Product price-->
                                    <span>IDR {{ number_format($product['price'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><button type="button" class="btn btn-outline-dark mt-auto" onclick="addToCart({{$product["id"]}})">Add to cart</button></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        let products = {{ Illuminate\Support\Js::from($productData) }}

        function addToCart(id) {
            var found = false
            if(cartData != null && cartData.length > 0) {
                for (let i = 0; i < cartData.length; i++) {
                    if(cartData[i].id == id) {
                        cartData[i].qty = parseInt(cartData[i].qty) + 1
                        localStorage.setItem('cart', JSON.stringify(cartData))
                        getCartData()
                        found = true
                        break
                    }
                }
            }
            
            if(!found) {
                for (let i = 0; i < products.length; i++) {
                    if(products[i].id == id) {
                        var toCart = {
                            id: products[i].id,
                            name: products[i].name,
                            price: products[i].price,
                            qty: 1,
                        }
                        
                        if(cartData == null) localStorage.setItem('cart', JSON.stringify([toCart]))
                        else {
                            cartData.push(toCart)
                            localStorage.setItem('cart', JSON.stringify(cartData))
                        }

                        getCartData()
                        setCartQtyItem()
                    }
                }
            }
        }
    </script>
@stop