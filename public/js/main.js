$(function () {

   $('.button-search').click(function (e) {

        window.location.href = '/search';
    });
    function closePopup(_object) {
        _object.closest('.popup-main').fadeOut('fast');
        $('.body-site-wrapper,.top-nav,.main-panel,.header-nav').removeClass('blur');
        $('body').removeClass('lock-body');
    }
        //Cart queries
        //ADDED PRODUCT

    $('.card-info-button-cart, .button-buy').click(function (e) {
e.preventDefault();
            let count = $('.cart-count').text() || 1;
            let product_id = $(this).attr('data-product_id');
            addCart(product_id, count);
           
    });

    //REMOVE PRODUCT

    $('#cartitems, #cart-order-products').on('click','.product-delete',function () {

        let product_id = $(this).attr('data-product_id');
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'product_id': product_id},
            url: laroute.route('shop.cart.delete'),

            success: function (res) {
                var count = res['count'];
                var num = $('.count-cart').attr('data-count');
                var sum = Number(num) - Number(count);
                $('.count-cart').attr('data-count',sum);
                getCart();
            }
        });
        return false;
    });

    //RELOAD CART

    $('.button-show-cart, .cartchange, .button-mobile-cart').click(function (e) {
        var action = $(this).attr('class');
        getCart(action);

    });

    function addCart(product_id, count) {

        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'product_id': product_id, 'count': count},
            url: laroute.route('shop.cart.add'),

            success: function (res) {
                var count = res['count'];
                var num = $('.count-cart').attr('data-count');
                var sum = Number(count) + Number(num);
                $('.count-cart').attr('data-count', sum);
				 getCart();
                return false;
            }
        });
    }

    function removeCart(product_id, count) {

        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'product_id': product_id, 'count': count},
            url: laroute.route('shop.cart.remove'),

            success: function (res) {
                var count = res['count'];
                var num = $('.count-cart').attr('data-count');
                var sum = Number(num) - Number(count);
                $('.count-cart').attr('data-count',sum);
                return false;
            }
        });

    }

    function getCart(action) {
        $.ajax({
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'action': action},
            url: laroute.route('shop.cart'),

            success: function (response) {
                if(!response.view_confirm) {
                    response.view_confirm = '';
                }
                $('#cartitems').html(response.view);
                $('#cart-order-products').html(response.view_confirm);
                $('.subtotal-price, .total-value').text(response.sum);
            },
        });
    }

    //WISHLIST

    //RELOAD WISHLIST

    $('.button-show-favorites, .button-mobile-fav, .changewishlist').click(function (e) {
        getWishlist();
    });

    function getWishlist() {
        $.ajax({
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: laroute.route('wishlist.get'),

            success: function (response) {

                $('#wishlist').html(response)
            },
        });
    }

    //REMOVE WISHLIST

    $('#wishlist').on('click','.remove-wishlist',function () {

        let product_id = $(this).attr('data-product-id');
        var num = $('.count-wishlist').attr('data-count');
        $('.count-wishlist').attr('data-count',--num);
        deleteCookie(product_id);
        $('.wish-'+product_id).removeClass('-added').text('add to favorites');
        getWishlist();
    });

    $('#cartitems, #cart-order-products').on('click','.button-dec',function(event) {
        var _block = $(this).closest('.count-block');
        var _count_block = _block.find('.count');
        var _count = parseInt(_count_block.text());
        var _min_count = 1;
        let price = $(this).attr('data-price');
        let subtotal = $('.subtotal-price').text();
        let product_id = $(this).attr('data-product_id');
        let total =  $('.total-'+product_id).text();

        if (_block.attr('data-min-count')) {
            _min_count = parseInt(_block.attr('data-min-count'));
        }
        if (_count>_min_count) {
            _count--;
            removeCart(product_id,1);
            $('.total-'+product_id).text(Math.round((Number(total) - Number(price)) * 100) / 100 );
            $('.subtotal-price, .total-value').text(Math.round((subtotal - price) * 100) / 100 );
            _count_block.text(_count);

        }
        else{
            Notification('Min count of product: '+_min_count);
        }
    });

    $('#cartitems, #cart-order-products').on('click','.button-inc',function(event) {
        var _block = $(this).closest('.count-block');
        var _max_count = 99;
        var _count_block = _block.find('.count');
        var _count = parseInt(_count_block.text());
        let product_id = $(this).attr('data-product_id');
        let price = $(this).attr('data-price');
        let subtotal = $('.subtotal-price').text();
        let total =  $('.total-'+product_id).text();

        if (_block.attr('data-max-count')) {
            _max_count = parseInt(_block.attr('data-max-count'));
        }
        if (_count<_max_count) {
            _count++;
            addCart(product_id,1 );
            $('.total-'+product_id).text(Math.round((Number(total) + Number(price)) * 100) / 100 );
            $('.subtotal-price, .total-value').text(Math.round((Number(subtotal) + Number(price)) * 100) / 100 );
            _count_block.text(_count);
        }
        else{
            Notification('Max count of product: '+_max_count);
        }
    });

    $("#payment-form").submit(function (e) {
        e.preventDefault();
        let form = $(this);
        data = $(this).serialize();
        $.ajax({
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: data,
            url: laroute.route('shop.cart.order'),

            success: function (response) {
                if(response.res == 'success') {
                    form.append('<input type="hidden" name="wb_hash" value="'+response.wb_hash+'">');
                    form.append('<input type="hidden" name="wb_login" value="'+response.wb_login+'">');
                    form.append('<input type="hidden" name="invoice" value="'+response.invoice+'">');
                    form.append('<input type="hidden" name="amount" value="'+response.amount+'">');
					form.append('<input type="hidden" name="return" value="'+response.return+'">');
                    form.append('<input type="hidden" name="cancel_return" value="'+response.cancel_return+'">');
                    form.append('<input type="hidden" name="notify_url" value="'+response.notify_url+'">');
                    $.each(response.items, function( index, value ) {
                        $.each(value, function (key, val) {
                            form.append('<input type="hidden" name="'+key+'" value="'+val+'">');
                        })
                    });
                    form.submit();
                }
            },
        });

    });

    $('.message-form').each(function () {
            $(this).submit(function (e) {
                var that = this;
                e.preventDefault();
                var data = $(this).serialize();


                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: data,
                    url: laroute.route('form.save'),

                    success: function (response) {

                        $(that)[0].reset();
                        closePopup($('.popup-close'));
                        $('#popup-feedback-success').show();
                    },
                });
            });
        });

    $('.popup-feedback-success-button').click( function (e) {

        closePopup($(this));

    })

});