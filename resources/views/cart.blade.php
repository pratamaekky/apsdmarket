@extends('layouts.default')

@section('content')

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Keranjang</h1>
                <p class="lead fw-normal text-white-50 mb-0">Food & Beverage | Retail</p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="col-sm-12" id="cart-section">
                <!-- <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Nama Brang</h5>
                                <p class="card-text"><small class="text-body-secondary">Hitam</small></p>
                                <form class="row row-cols-lg-auto g-3 align-items-center">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <div class="col-12">
                                        <input type="number" class="form-control" value="1">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-sm-12">
                <a href="/checkout" class="btn btn-lg btn-success" id="btn-checkout">Checkout</a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            populateCartData()
        })

        function deleteCartItem(id) {
            if(cartData != null) {
                for (let i = 0; i < cartData.length; i++) {
                    if(cartData[i].id == id) {
                        cartData.splice(i, 1);
                        populateCartData();
                        break;
                    }
                }

                localStorage.setItem('cart', JSON.stringify(cartData))
                getCartData()
                setCartQtyItem()
            }
        }

        function populateCartData() {
            $('#cart-section').empty()
            if(cartData != null && cartData.length > 0) {
                $('#btn-checkout').show()
                for (let i = 0; i < cartData.length; i++) {
                    $('#cart-section').append(
                        '<div class="card mb-3">'
                            +'<div class="row g-0">'
                                +'<div class="col-md-4">'
                                    +'<img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" class="img-fluid rounded-start" alt="...">'
                                +'</div>'
                                +'<div class="col-md-8">'
                                    +'<div class="card-body">'
                                        +'<h5 class="card-title">'+cartData[i].name+'</h5>'
                                        +'<p class="card-text"><small class="text-body-secondary">'+setCurrency(cartData[i].price)+'</small></p>'
                                        +'<form class="row row-cols-lg-auto g-3 align-items-center">'
                                            +'<div class="col-12">'
                                                +'<button type="button" class="btn btn-danger" onclick="deleteCartItem('+cartData[i].id+')"><i class="fas fa-trash"></i></button>'
                                            +'</div>'
                                            +'<div class="col-12">'
                                                +'<input type="number" class="form-control" value="'+cartData[i].qty+'">'
                                            +'</div>'
                                        +'</form>'
                                    +'</div>'
                                +'</div>'
                            +'</div>'
                        +'</div>')
                }
            } else {
                $('#btn-checkout').hide()
                $('#cart-section').html("<h4>Belum ada produk di keranjang kamu.</h4><a href='/' class='btn btn-primary'>Kembali ke halaman produk</a>")
            }
        }
    </script>
@stop