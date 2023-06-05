@extends('layouts.default')

@section('content')

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Checkout</h1>
                <p class="lead fw-normal text-white-50 mb-0">Food & Beverage | Retail</p>
            </div>
        </div>
    </header>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-sm-8" id="">
                    <form action="{{ route('submitcheckout') }}" method="POST" id="form-checkout">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" name="receiver_name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat Penerima</label>
                            <textarea class="form-control" name="receiver_address" aria-describedby="addressHelp"></textarea>
                            <div id="addressHelp" class="form-text">Mohon masukkan alamat lengkap kamu</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Handphone Penerima</label>
                            <input type="text" class="form-control" name="receiver_phone">
                        </div>
                        <textarea class="d-none" name="items" id="orderitem"></textarea>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
                <div class="col-sm-4" id="checkout-detail">
                    <table class="table" id="tbl-checkout-summary">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        $(document).ready(function(){
            if(cartData != null) {
                $('#orderitem').text(JSON.stringify(cartData))
                var total = 0
                for (let i = 0; i < cartData.length; i++) {
                    var subtotal = parseInt(cartData[i].qty) * parseInt(cartData[i].price)
                    total += subtotal
                    $('#tbl-checkout-summary tbody').append('<tr><td>'+cartData[i].name+'</td><td>'+cartData[i].qty+'</td><td>'+setCurrency(subtotal)+'</td></tr>')
                }
                $('#tbl-checkout-summary tbody').append('<tr><th colspan="2">Total</th><th>'+setCurrency(total)+'</th></tr>')
            } else $('#cart-section').html("<h4>Belum ada produk di keranjang kamu.</h4>")
        })

        $('#form-checkout').submit(function(e){
            e.preventDefault()
            localStorage.removeItem('cart')
            this.submit()
        })
    </script>
@stop