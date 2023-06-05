let cartData = JSON.parse(localStorage.getItem("cart"));

$(document).ready(function(){
    $('#cart-item-qty').text(cartData != null ? cartData.length : 0)
})

function setCurrency(number) {
    var number_string = number.toString(),
        split = number_string.split('.'),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    var rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp. ' + (rupiah == "" ? 0 : rupiah) + '';
}

function setCartQtyItem() {
    $('#cart-item-qty').text(cartData != null || cartData.length > 0 ? cartData.length : 0)
}

function getCartData() {
    cartData = JSON.parse(localStorage.getItem("cart"));
}