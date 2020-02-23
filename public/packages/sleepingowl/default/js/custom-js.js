$(function () {
    var leftDrug = document.getElementById('left-drug'),
         rDArr = $('#right-drug'),
         rightDrug = rDArr[0],
         drake = dragula([leftDrug, rightDrug], {
                copy: function (el, source) {
                    return source === leftDrug
                },
                moves: function (el, container, handle) {
                    return handle.classList.contains('de-name');
                },
                accepts: function (el, target) {
                    return target !== leftDrug
                }
         });
        function initNumbers() {
            $('#right-drug .de-html').each(function (k, v) {
                $(this).attr('data-number', k);
                $(this).find('input, textarea, select').each(function (k1, v1) {
                    var name = $(v1).attr('name');
                    name = name.replace(/\[\d*\]/, '[' + k + ']');
                    $(v1).attr('name', name);
                })
            })
        };
        initNumbers();
        drake.on('drop', function (el, target, source, sibling) {
            initNumbers();
        });
        $('body').on('click', '.de-close', function () {
            $(this).parent().remove();
            initNumbers();
        });
    $('.de-hint').click(function () {
        $(this).toggleClass('active');
        $('.de-hint').not($(this)).removeClass('active');
    });
    $('#blog_post_create').submit(function () {
        $('#left-drug').remove();
        that = this;
        window.setTimeout(function () {
            $(that).unbind('submit').trigger('submit');
            return true;
        }, 100);
        return false;
    });
    var renameOR = function (parent) {
        parent.find('.option-row').each(function(i1,e1){
            $(e1).find('input').each(function(i2,e2){
                 var name = $(this).attr('name');
                    name = name.replace(/\]\[\d*\]/, ']['+(i1+1)+']');
                    $(this).attr('name', name);
            });
        });
    };
    rDArr.on('click','.option-row .glyphicon-remove',function(){
        var c = $(this).parent().parent();
        $(this).parent().remove();
        renameOR(c);
    });
    rDArr.on('click','.add-option',function(){
        $(this).before('<div class="option-row"><label>Option</label> Value:<input type="text" name="block[1][options][options][2][value]"> Title:<input type="text" name="block[1][options][options][2][title]"> checked <input class="indicator" type="checkbox" name="block[0][options][options][2][checked]"><span class="glyphicon glyphicon-remove"></span></div>');
        var c = $(this).parent();
        initNumbers();
        renameOR(c);
    });
    rDArr.on('click','.option-row [type="checkbox"]',function(){
        if ($(this).prop('checked') == true) {
            $(this).parents('.option-row').find('[type="checkbox"]').not($(this)).prop('checked',false);
        }
    });
    
   
});
//    $('body').on('click', '.popup-b', function () {
//        $('#bunner-popup').modal('show');
//    });
//    $('body').on('click', '.de-popup', function () {
//        $('.settings-wrap-block').html($(this).parent().find('.settings-popup-content').html());
//        $('#settings-popup').modal('show');
//    });
//    $('#right-drug').on('click', '.del-block', function () {
//        $(this).parents('.option').remove();
//    });