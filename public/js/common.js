$(function() {

var _stick_menu_height = 75;
var _mobile_stick_menu_height = 52;
$('body').append('<div class="notification"><ul></ul></div>');
if ($(window).width()<1024) {
  _stick_menu_height = _mobile_stick_menu_height;
}
// Распаковка svg для манипуляций с ним
$('img[src$=".svg"]').each(function() {
  var $img = jQuery(this);
  var imgURL = $img.attr('src');
  var attributes = $img.prop("attributes");

  $.get(imgURL, function(data) {
    // Get the SVG tag, ignore the rest
    var $svg = jQuery(data).find('svg');

    // Remove any invalid XML tags
    $svg = $svg.removeAttr('xmlns:a');

    // Loop through IMG attributes and apply on SVG
    $.each(attributes, function() {
      $svg.attr(this.name, this.value);
    });

    // Replace IMG with SVG
    $img.replaceWith($svg);
  }, 'xml');
});

// Маска номера
$('input[type=tel]').mask('+(99) 999999999999999', {autoclear: false});
$('.select-input select').mfs();

$('.custom-scroll-block').customScroll({
  offsetTop: 0,
  offsetBottom: 0,
  trackWidth: 5,
  // vertical: true,
  horizontal: false
});


$('.open-mobile-menu .sub-menu').customScroll({
  offsetTop: 0,
  offsetBottom: 18,
  trackWidth: 10,
  // vertical: true,
  horizontal: false
});


$('.button-show-favorites').click(function(event) {
  openCart('fav');
});
$('.button-show-cart, .card-info-button-cart, .button-buy').click(function(event) {
  openCart();
});


$('.basket-open').mouseup(function (e){
  var div = $(".basket-container");
  if (!div.is(e.target) && div.has(e.target).length === 0) {
    closeCart();
  }
});

$('.basket-container-top-change .basket-change').click(function(event) {
  if (!$(this).hasClass('current')) {
    changeCart();
  }
});

$('.basket-container-top-change .fav-change').click(function(event) {
  if (!$(this).hasClass('current')) {
    changeCart('fav');
  }
});

$('.open-mobile-menu .menu-item-has-children').click(function(event) {
  $('.open-mobile-menu .menu-item-has-children').removeClass('active');
  $(this).addClass('active');
  $(this).find('.sub-menu').eq(0).addClass('current').customScroll();
  $('.menu-button-mobile').addClass('open-sub');
});

$('.pages-list-mobile').click(function(event) {
  // event
  if (!$('.sub-menu').is(event.target)) {
    $(this).closest('.menu-item-has-chilren').removeClass('active');
  }
});
function changeCart(state = 'cart'){
  if (state=="cart") {
    $('.basket-container-top-change .basket-change').addClass('current');
    $('.basket-container-top-change .fav-change').removeClass('current');
    $('.basket-container-main-change .fav-change').animate({'margin-left': '-100%', opacity: '0'}, 800/*, function(){$(this).hide()}*/).hide().removeClass('current');
    $('.basket-container-main-change .basket-change').animate({'margin-left': '0%', opacity: '1'}, 300).show().addClass('current');
    $('.basket-container-main-change .basket-change').scrollTop(0);
    
    // $('.custom-scroll-block').customScroll({
    //   offsetTop: 0,
    //   offsetBottom: 0,
    //   trackWidth: 5,
    // });
  }
  if(state=="fav"){
    $('.basket-container-top-change .basket-change').removeClass('current');
    $('.basket-container-top-change .fav-change').addClass('current');
    $('.basket-container-main-change .basket-change').animate({'margin-left': '100%', opacity: '0'}, 800/*, function(){$(this).hide()}*/).hide().removeClass('current');
    $('.basket-container-main-change .fav-change').animate({'margin-left': '0%', opacity: '1'}, 300).show().addClass('current');
    $('.basket-container-main-change .basket-change').scrollTop(0);
    // $('.custom-scroll-block').customScroll();
    // $('.custom-scroll-block').customScroll({
    //   offsetTop: 0,
    //   offsetBottom: 0,
    //   trackWidth: 5,
    // });
  }
  
}

function openCart(state = 'cart'){
  $('.basket-open').addClass('opened');
  $('body').addClass('lock-body');
  $('.body-site-wrapper,.top-nav,.main-panel,.header-nav').addClass('blur').addClass('slide-left');
  // $('.basket-container-main').addClass('custom-scroll_hidden-y');
  $('.custom-scroll-block').customScroll();
  changeCart(state);
}
function closeCart(){
  $('.basket-open,.mobile-menu .top-panel-right button,.top-panel').removeClass('opened');
  $('body').removeClass('lock-body');
  $('.body-site-wrapper,.top-nav,.main-panel,.header-nav').removeClass('blur').removeClass('slide-left');
}

$('.basket-container-top li').click(function(event) {
  $(this).index
});
$('.mobile-menu .top-panel-right button').click(function(event) {
  if (!$(this).hasClass('opened')) {
    $('.mobile-menu .top-panel-right button').removeClass('opened');
    $(this).addClass('opened');
    if ($(this).hasClass('button-mobile-fav')) {
      openCart('fav');
    }
    if ($(this).hasClass('button-mobile-cart')) {
      openCart();
    }
    $('.top-panel').addClass('opened');
    
  }
  else{
    $('.mobile-menu .top-panel-right button').removeClass('opened');
    $('.top-panel').removeClass('opened');
    closeCart();
  }
});

// Залипающее меню
$(window).scroll(function(){
  // if ($(this).scrollTop() > 400) {
  //     // $('.top-nav').addClass('fixed');
  // } else {
  //     // $('.top-nav').removeClass('fixed');
  // }
});

// ВСПЛЫВАЮЩИЕ ОКНА
// Вызов всплывающего окна
$('[data-popup]').click(function(event) {
  var _popup_id = $(this).attr('data-popup');
  callPopup(_popup_id);
});

// Закрытие попапа при клике вне области
$('.popup-main').mouseup(function (e){
  var div = $(".popup-content");
  if (!div.is(e.target) && div.has(e.target).length === 0) {
    closePopup($(this));
  }
});
// Закрытие при клике на кнопку
$('.popup-close').click(function(event) {
  closePopup($(this));
});

function callPopup(_id){
  $('body').addClass('lock-body');
  $('.body-site-wrapper,.top-nav,.main-panel,.header-nav').addClass('blur');
  $(_id).fadeIn('fast');
}
function closePopup(_object) {
  _object.closest('.popup-main').fadeOut('fast');
  $('.body-site-wrapper,.top-nav,.main-panel,.header-nav').removeClass('blur');
  $('body').removeClass('lock-body');
}

// Кнопка вызова мобильного меню
$('.menu-button-mobile').click(function(event) {
  if ($(this).hasClass('open-sub')) {
    var _level = $('.pages-list-mobile').find('.current').length;
    console.log(_level);
    if(_level==1){
      // $('.open-mobile-menu .menu-item-has-children').removeClass('active');
      $('.menu-button-mobile').removeClass('open-sub');
      $('.pages-list-mobile').find('.current').removeClass('current');
    }
    else{
      console.log($('.pages-list-mobile').find('.current').eq(_level));
      $('.pages-list-mobile').find('.current').eq(_level-1).removeClass('current');
    }

    
    
  }
  else{
    $('.menu-button-mobile,.open-mobile-menu').toggleClass('opened');
    $('body').toggleClass('lock-body');
  }
  
});
// Для десктопа
$('.main-menu-button').click(function(event) {
  $(this).toggleClass('opened');
  $('.open-menu').toggleClass('opened');
});
$('.open-mobile-menu-search button').click(function(event) {
  $('.open-mobile-menu-search').toggleClass('show-search');
});

$('.basket-container-bottom-go .button').click(function(event) {
  closeCart();
  callPopup('.popup-order');
});

// Переключение табов
$('.tabs-panel li').click(function(event) {
  if (!$(this).hasClass('current')) {
    var _index = $(this).index();
    console.log(_index);
    var _parent = $(this).closest('.section');
    _parent.find('.tabs-panel li,.tabs-content li').removeClass('current');
    _parent.find('.tabs-content li').fadeOut('fast');
    _parent.find('.tabs-panel li').eq(_index).addClass('current');
    _parent.find('.tabs-content li').eq(_index).addClass('current').fadeIn('fast');
  }
});

// Для CF7
document.addEventListener( 'wpcf7submit', function( event ) {
  
}, false );

var body = document.body,
    timer;
    
// Для большей производительности при скролле
window.addEventListener('scroll', function() {
  clearTimeout(timer);
  if(!body.classList.contains('disable-hover')) {
    body.classList.add('disable-hover')
  }
  
  timer = setTimeout(function(){
    body.classList.remove('disable-hover')
  },500);
}, false);




function Notification(_text = 'Уведомление', _time = 5){
  var _html = '<li><div class="notification-close"><i class="fa fa-close"></i></div><div class="notification-text">'+_text+'</div></li>';
  $('.notification ul').prepend(_html);
  var _obj = $('.notification li').eq(0);
  NotificationTimeout(_obj,_time);
}
function NotificationTimeout(_not, _fadeTime){
  var timer;
  timer = setTimeout(function(){
    NotificationClose(_not);
  },_fadeTime*1000);
}
function NotificationClose(_not){
  _not.slideUp('slow');
}
$('.notification').on('click', '.notification-close', function(event) {
  NotificationClose($(this).closest('li'));
});

// Прелоадер
$('.preloader-block').delay(500).fadeOut('fast');

$('.button-inc').click(function(event) {
  var _block = $(this).closest('.count-block');
  var _max_count = 99;
  var _count_block = _block.find('.count');
  var _count = parseInt(_count_block.text());
  if (_block.attr('data-max-count')) {
    _max_count = parseInt(_block.attr('data-max-count'));
  }
  if (_count<_max_count) {
   _count++;
   _count_block.text(_count);
  }
  else{
    Notification('Max count of product: '+_max_count);
  }
});
$('.button-dec').click(function(event) {

  var _block = $(this).closest('.count-block');
  var _count_block = _block.find('.count');
  var _count = parseInt(_count_block.text());
  var _min_count = 1;
  if (_block.attr('data-min-count')) {
    _min_count = parseInt(_block.attr('data-min-count'));
  }
  if (_count>_min_count) {
    _count--;
    _count_block.text(_count);
  }
  else{
    Notification('Min count of product: '+_min_count);
  }
});
$('.button-add-to-favorites').click(function(event) {
  let product_id = $(this).attr('data-product_id');
  if ($(this).hasClass('-added')) {
    $(this).removeClass('-added').text('add to favorites');
    deleteCookie(product_id);
    var num = $('.count-wishlist').attr('data-count');
    $('.count-wishlist').attr('data-count',--num);
  }
  else{
    $(this).addClass('-added').text('remove from favorites');
    setCookie('products', product_id, 30);
    var num = $('.count-wishlist').attr('data-count');
    $('.count-wishlist').attr('data-count',++num);
  }
});

$('.language-select li').click(function(event) {
  if (!$(this).hasClass('current')) {
    var _index = $(this).index();
    $('.language-select li').removeClass('current');
    $(this).addClass('current').closest('.language-select').attr('data-lang', $(this).text());
  
    $('.sending-block-text-change').slideUp('fast');
    $('.sending-block-text-change').eq(_index).slideDown('fast');
  }
});

if ($('[data-parallaxify-range]').length) {
  var i,
  size,
  color,
  width = $(window).width(),
  height = 500;

  $.parallaxify({
    positionProperty: 'transform',
    responsive: true,
    motionType: 'natural',
    mouseMotionType: 'gaussian',
    motionAngleX: 90,
    motionAngleY: 90,
    alphaFilter: 1,
    adjustBasePosition: false,
    alphaPosition: 0.015,
  });
}

$('.catalogue-block-message-button .button').click(function(event) {
  $(this).closest('.catalogue-block-message').slideUp('fast');
});

function GetCardInfo(card) {
  this.id = parseInt(card.attr('data-id'));
  this.name = card.find('.card-name').text();
  this.img = card.find('.img img').attr('src');
  this.price = parseFloat(card.find('.price').text()).toFixed(2);
  this.oldPrice = parseFloat(card.find('.old-price').text()).toFixed(2);
  this.minOrder = 1; //parseInt(card.attr('data-min-order'));
  if (card.attr('data-min-order')) {
    this.minOrder = parseInt(card.attr('data-min-order'));
  }
  this.logInfo = function(){
    console.log('id - '+this.id+', '+'Название - '+this.name+', '+'Картинка - '+this.img+', '+'Цена - '+this.price+', '+'Старая цена - '+this.oldPrice+', '+'Минимальное кол-во - '+this.minOrder);
  }

}
$('.button-view').click(function(event) {
  //var card = new GetCardInfo($(this).closest('.card'));
  //card.logInfo();
 // CallCardPreview(card);
  // console.log(card.id);
});
function CallCardPreview(card) {
  var _popup = $('.popup-preview');
  _popup.find('.img img').attr('src', card.img);
  _popup.find('.card-info').attr('data-id', card.id);
  _popup.find('.card-info-name').text(card.name);
  _popup.find('.card-info-price').text(card.price);
  _popup.find('.card-info-price-regular').text(card.oldPrice);
  callPopup('.popup-preview');
}
// ------------
// -Конец кода-
// ------------

});
var _sending_show = localStorage.getItem('sending-show');

if(!_sending_show){
  setTimeout(function() {
    $('.fixed-bottom-sending').addClass('show');
  },5000);
}

$('.fixed-bottom-sending button').click(function(event) {
  $('.fixed-bottom-sending').removeClass('show');
  localStorage.setItem('sending-show', true);
});