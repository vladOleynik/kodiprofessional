$(function () {
    $('#applyDiscount').on('click', function () {
        alert(1);
    });
    $('#removeDiscount').on('click', function () {
        alert(1);
    });
    $('#saveDiscountAmount').on('click', function () {
        $.ajax({
            url: '/save-discount',
            method: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                discount: $('#countDiscount').val()
            },
            success: function () {
                alert('Скидка сохранена.');
            },
            error: function (data) {
                var response = JSON.parse(data.responseText)
                alert(response.message);
            }
        })
    });

    $('.itemForDiscount').on('click', function () {
        var itemId = $(this).data('item_id');
        alert(itemId)
    });
    //check всех итемов на странице
    $('#chekAllItems').on('click', function () {
        var checked = $(this).prop('checked')
        if (checked) {
            $('.discount-item').each(function () {
                if (!$(this).prop('checked')) {
                    $(this).trigger('click');
                }
            })
        } else {
            $('.discount-item').removeAttr('checked');
        }
    });
});
