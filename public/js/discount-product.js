$(function () {
    var itemsChecked = [];
    $('#applyDiscount').on('click', function () {
        var discount = $('#countDiscount').val();
        //заполняем массив выбранными селектами
        fillArray();
        saveDiscount(itemsChecked, discount);
    });
    $('#removeDiscount').on('click', function () {
        //заполняем массив выбранными селектами
        fillArray();
        saveDiscount(itemsChecked, null);
    });

//сохранение скидки в сессию
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
//применение скидки у итема
    $(document).on('click', '.itemForDiscount', function () {
        var itemId = [],
            discount = $('#countDiscount').val();
        itemId.push($(this).data('item_id'));
        if (!$('#countDiscount').val()) {
            alert('Для применения скидки нужно заполнить поле "Введите скидку"!');
            return false;
        }
        saveDiscount(itemId, discount);
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

//поиск товаров по названию
    $('#findProduct').on('input', function () {
        $.ajax({
            url: '/find-product',
            method: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                title: $(this).val()
            },
            success: function (data) {
                $('#inputsForDiscount').html(data);
            },
            error: function (data) {
                var response = JSON.parse(data.responseText)
                alert(response.message);
            }
        })
    });

    function saveDiscount(ids, discount) {
        $.ajax({
            url: '/save-dicsount',
            method: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                ids: ids,
                discount: discount,
            },
            success: function (data) {
                itemsChecked = [];
                alert('Сохранено');
                location.reload()
            },
            error: function (data) {
                itemsChecked = [];
                alert('Ошибка сохранения');
                location.reload()
            }
        })
    }

    function fillArray() {
        $('.discount-item').each(function () {
            if ($(this).prop('checked')) {
                itemsChecked.push($(this).val());
            }
        });
    }
});
