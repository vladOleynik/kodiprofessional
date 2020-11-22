<!DOCTYPE html>
<html>
<head>
    <base href="/">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{!!Seo::head(@$data)!!}
<!-- Template Basic Images Start-->
    <meta property="og:image" content="path/to/image.jpg">
    <link rel="shortcut icon" href="img/other/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/other/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/other/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/other/favicon/apple-touch-icon-114x114.png">
    <!-- Template Basic Images End-->
    <link rel="stylesheet" href="css/fonts.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fontello-codes.css">
    <!-- Bootstrap (latest) Grid Styles Only-->
    <link rel="stylesheet" href="{{asset('css/gridonly.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/add_styles.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
          integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
          integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
          crossorigin="anonymous"/>
    <!-- Load CSS, CSS Localstorage & WebFonts Main Function-->
    <script>!function (e) {
            "use strict";

            function t(e, t, n) {
                e.addEventListener ? e.addEventListener(t, n, !1) : e.attachEvent && e.attachEvent("on" + t, n)
            };

            function n(t, n) {
                return e.localStorage && localStorage[t + "_content"] && localStorage[t + "_file"] === n
            };

            function a(t, a) {
                if (e.localStorage && e.XMLHttpRequest) n(t, a) ? o(localStorage[t + "_content"]) : l(t, a); else {
                    var s = r.createElement("link");
                    s.href = a, s.id = t, s.rel = "stylesheet", s.type = "text/css", r.getElementsByTagName("head")[0].appendChild(s), r.cookie = t
                }
            }

            function l(e, t) {
                var n = new XMLHttpRequest;
                n.open("GET", t, !0), n.onreadystatechange = function () {
                    4 === n.readyState && 200 === n.status && (o(n.responseText), localStorage[e + "_content"] = n.responseText, localStorage[e + "_file"] = t)
                }, n.send()
            }

            function o(e) {
                var t = r.createElement("style");
                t.setAttribute("type", "text/css"), r.getElementsByTagName("head")[0].appendChild(t), t.styleSheet ? t.styleSheet.cssText = e : t.innerHTML = e
            }

            var r = e.document;
            e.loadCSS = function (e, t, n) {
                var a, l = r.createElement("link");
                if (t) a = t; else {
                    var o;
                    o = r.querySelectorAll ? r.querySelectorAll("style,link[rel=stylesheet],script") : (r.body || r.getElementsByTagName("head")[0]).childNodes, a = o[o.length - 1]
                }
                var s = r.styleSheets;
                l.rel = "stylesheet", l.href = e, l.media = "only x", a.parentNode.insertBefore(l, t ? a : a.nextSibling);
                var c = function (e) {
                    for (var t = l.href, n = s.length; n--;) if (s[n].href === t) return e();
                    setTimeout(function () {
                        c(e)
                    })
                };
                return l.onloadcssdefined = c, c(function () {
                    l.media = n || "all"
                }), l
            }, e.loadLocalStorageCSS = function (l, o) {
                n(l, o) || r.cookie.indexOf(l) > -1 ? a(l, o) : t(e, "load", function () {
                    a(l, o)
                })
            }
        }(this);</script>
    <style>
        .orders--list {
            margin: 20px 0px;
        }

        .orders--list .olrder--list__row {
            padding: 10px;
            border: 1px solid #cdcdcd;
            border-bottom: 0px;
            display: flex;
        }

        .orders--list .olrder--list__row:last-of-type {
            border-bottom: 1px solid #cdcdcd;
            margin-bottom: 20px;
        }

        .orders--list .orders--list__title {
            color: #030303;
            font-size: 45px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            display: block;
        }

        .orders--list .order--list__cell:not(:last-of-type) {
            border-right: 1px solid #cdcdcd;
        }

        .orders--list .order--table__header {
            background: #f8f8f8;
            text-align: center;
        }

        .orders--list .order--list__cell {
            width: 33.33333333%;
            padding: 0px 15px;
        }

        .orders--list .orders--user {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .orders--list .orders--user .orders--user__photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 20px;
        }

        .orders--list .orders--user .orders--user__photo img {
            object-fit: cover;
        }

        .orders--list .orders--user .user__info--filed {
            padding: 5px;
            border: 1px solid #cdcdcd;
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;


        }

        .orders--list .orders--user .user__info--filed .field--name {
            color: #888;
        }

        .orders--list .orders--user .user__info--filed .field--res {
            color: #e97498;
        }

        @media (max-width: 768px) {
            .orders--list .order--list__cell {
                font-size: 12px;
            }

        }

        .item-product {
            margin-bottom: 40px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/libs.min.css">
    <!-- Load Custom CSS Compiled without JS End-->
    <!-- Custom Browsers Color Start-->
    <!-- Chrome, Firefox OS and Opera-->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone-->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari-->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">
    <!-- Custom Browsers Color End 222-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139025536-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-139025536-1');
    </script>

    <meta name="google-site-verification" content="JOqLN92S-8qTq7ZLWWMjOJIr0Xrzg_E-SyixuR-MoLQ"/>
</head>
<body>
<!-- Google Tag Manager -->
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MFHKT9V');
</script>
<!-- End Google Tag Manager -->
<!-- NavMenus start-->
<div class="menu-button-mobile">
    <div class="menu-icon">
    </div>
</div>
<nav class="mobile-menu">
    <div class="top-panel">
        <div class="top-panel-left"></div>
        <div class="top-panel-center"></div>
        <div class="top-panel-right">
            <butotn data-popup="#popup-feedback" class="button-mobile-recall"><i class="fa fa-envelope-o"></i></butotn>
            <button data-count="0" class="button-mobile-fav">
                <div class="fa fa-heart-o"></div>
            </button>
            <button data-count="2" class="button-mobile-cart">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="82mm" height="77.2mm" version="1.1"
                     style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                     viewBox="0 0 8200 7720" xmlns:xlink="http://www.w3.org/1999/xlink">
              <defs>
                  <style type="text/css">.fil0 {
                          fill: #e97498
                      }</style>
              </defs>
                    <g id="����_x0020_1">
                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                        <path
                            d="M2750 6901c0,-179 139,-351 352,-351 306,0 448,376 243,581 -203,203 -478,83 -556,-86 -15,-33 -39,-96 -39,-144zm2877 -13c0,-274 350,-464 583,-244 244,229 34,596 -219,596 -201,0 -364,-155 -364,-352zm-5623 -6638c0,155 75,231 209,286 60,24 1022,366 1046,437l413 2256c101,584 226,1160 322,1748 37,229 124,310 392,310 -65,280 -286,621 -286,898 0,42 33,95 51,118 70,85 265,65 374,64 -8,12 -52,49 -74,78 -210,279 -169,791 119,1027 60,50 144,114 219,145 239,98 540,75 750,-70l107 -89c84,-77 150,-186 188,-293 70,-197 55,-440 -35,-622 -31,-63 -82,-104 -98,-175l1666 0c-5,56 -152,227 -169,404 -31,318 74,611 343,775 252,152 533,184 806,35 19,-11 19,-11 33,-19 338,-181 486,-678 301,-1013 -30,-54 -94,-138 -123,-179 92,0 263,8 331,-17 165,-62 165,-303 27,-390 -51,-40 -713,-26 -834,-26 -1151,0 -2302,-1 -3453,1 51,-170 182,-529 233,-652 1115,0 2223,0 3338,0 980,0 734,135 1143,-1095 187,-561 357,-1133 544,-1695 47,-143 265,-750 265,-893 0,-178 -151,-248 -299,-248 -1509,-77 -3096,-121 -4568,-200 -260,-14 -642,-73 -704,175 -29,115 7,198 74,264 123,119 423,69 641,88 1389,60 2824,119 4231,181 -8,99 -300,970 -340,1079 -147,401 -272,850 -403,1262 -41,129 -126,444 -181,549l-4113 0c-12,-141 -240,-1295 -269,-1475l-409 -2208c-24,-119 -39,-241 -67,-362 -41,-182 -205,-228 -363,-288 -148,-58 -1010,-418 -1117,-418 -132,0 -261,113 -261,247z"
                            class="fil0"></path>
                    </g>
            </svg>
            </button>
        </div>
    </div>
</nav>
<div class="open-mobile-menu">
    <div class="open-mobile-menu-wrapper">
        <div class="open-mobile-menu-search">
            <div class="input-wrapper-search">
                <form class="search-form need-valid" action="{{route('search')}}" method="GET">
                    <a class="button-search">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="33.5mm" height="33.5mm"
                             version="1.1"
                             style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                             viewBox="0 0 3350 3350" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <style type="text/css">
                        .str0 {
                            stroke: #2B2A29;
                            stroke-width: 229.99;
                            stroke-miterlimit: 22.9256
                        }

                        .fil0 {
                            fill: none
                        }

                        .fil1 {
                            fill: #2B2A29
                        }
                    </style>
                </defs>
                            <g id="����_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <circle cx="1318.13" cy="1319.24" r="1171.14" class="fil0 str0"></circle>
                                <path
                                    d="M2271.74 2093.84l1026.16 1024.58c46.25,46.19 46.31,121.79 0.13,168.05l-0.01 0c-46.17,46.25 -121.78,46.31 -168.03,0.13l-1029.6 -1028.03c22.23,-129.16 80.15,-103.05 171.35,-164.73z"
                                    class="fil1"></path>
                            </g>
              </svg>
                    </a>
                    <input type="search" name="search" value="">
                </form>
            </div>
        </div>
        @php($items = \App\Helpers\Catalog\Categories::all())
        @php($cart = Cart::index())
        @php($urls = $cart['urls'])
        @php($wishlist = \App\Models\Catalog\Product::wishlist())
        @php($wishitems = \App\Models\Catalog\Product::getWishlist())

        <div class="pages-list-mobile">
            @include('menu.head_main', ['items' => $items])
        </div>
    </div>
</div>
<nav class="nav top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="top-nav-left">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="{{route('wholesale')}}">Wholesale Prices</a></li>
                        <li><a href="{{route('shipping')}}">Shiping and Payments</a></li>
                        <li><a href="{{route('purchase')}}">Purchase returns</a></li>
                        <li><a href="{{route('contact')}}">Contacts</a></li>
                    </ul>
                </div>
                <div class="top-nav-right">
                    @if(auth()->user())
                        <a class="phone" href="{{route('cabinet')}}" style="margin-right: 10px; margin-left: -10px;">My
                            orders</a>
                    @endif
                    <button data-popup="#popup-feedback" class="button-msg">Send message<i
                            class="fa fa-paper-plane"></i></button>
                    @if(auth()->user())
                        <a class="phone">Welcome, {{auth()->user()->name}}</a>
                        <a href="/logout" class="phone">Logout</a>
                    @else
                        <a href="/login" class="phone">My account</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="main-panel">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="main-panel-search">
                    <div class="input-wrapper-search">
                        <form class="search-form need-valid" action="{{route('search')}}" method="GET">
                            <button class="button-search">
                                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="33.5mm"
                                     height="33.5mm"
                                     version="1.1"
                                     style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                     viewBox="0 0 3350 3350" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <style type="text/css">
                            .str0 {
                                stroke: #2B2A29;
                                stroke-width: 229.99;
                                stroke-miterlimit: 22.9256
                            }

                            .fil0 {
                                fill: none
                            }

                            .fil1 {
                                fill: #2B2A29
                            }
                        </style>
                    </defs>
                                    <g id="����_x0020_1">
                                        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                        <circle cx="1318.13" cy="1319.24" r="1171.14" class="fil0 str0"></circle>
                                        <path
                                            d="M2271.74 2093.84l1026.16 1024.58c46.25,46.19 46.31,121.79 0.13,168.05l-0.01 0c-46.17,46.25 -121.78,46.31 -168.03,0.13l-1029.6 -1028.03c22.23,-129.16 80.15,-103.05 171.35,-164.73z"
                                            class="fil1"></path>
                                    </g>
                  </svg>
                            </button>
                            <input type="search" placeholder="Search..." name="search" value="">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="main-panel-logo"><a href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="85.5mm" height="12.5mm"
                             version="1.1"
                             style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                             viewBox="0 0 8550 1250" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <defs>
                      <style type="text/css">
                          .fil2 {
                              fill: #2B2A29;
                              fill-rule: nonzero
                          }

                          .fil1 {
                              fill: #596A17
                          }

                          .fil0 {
                              fill: #75A125
                          }
                      </style>
                  </defs>
                            <g id="����_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path
                                    d="M440 315c-129,6 -276,126 -401,238 154,61 326,111 464,46 89,-43 135,-115 122,-172 -8,-31 -57,-118 -185,-112z"
                                    class="fil0"></path>
                                <path
                                    d="M678 322c57,-37 55,-108 24,-155 -51,-78 -145,-118 -233,-151 -8,111 2,190 56,274 27,43 98,67 153,32z"
                                    class="fil1"></path>
                                <polygon
                                    points="958,774 1229,477 1288,477 1079,703 1306,1007 1248,1007 1046,739 959,818 959,1007 911,1007 911,248 959,248 959,628 956,774 "
                                    class="fil2"></polygon>
                                <path id="1"
                                      d="M1813 741c0,87 -21,154 -63,203 -42,49 -100,73 -174,73 -46,0 -87,-11 -123,-34 -35,-22 -62,-54 -81,-97 -19,-41 -28,-90 -28,-145 0,-86 21,-154 62,-202 42,-48 100,-72 173,-72 73,0 130,24 171,73 42,49 63,116 63,201zm-419 0c0,73 16,130 48,171 32,40 77,61 136,61 59,0 104,-21 136,-61 32,-41 48,-98 48,-171 0,-73 -16,-130 -49,-170 -32,-40 -77,-60 -136,-60 -58,0 -103,20 -135,60 -32,40 -48,97 -48,170z"
                                      class="fil2"></path>
                                <path id="2"
                                      d="M2153 467c39,0 72,7 100,21 28,14 53,38 75,71l3 0c-2,-41 -3,-81 -3,-120l0 -191 48 0 0 759 -32 0 -12 -81 -4 0c-40,61 -98,91 -174,91 -73,0 -129,-23 -167,-68 -39,-46 -58,-112 -58,-199 0,-92 19,-162 57,-211 38,-48 94,-72 167,-72zm0 44c-58,0 -101,20 -130,61 -29,40 -44,99 -44,177 0,151 59,226 175,226 60,0 104,-18 132,-52 28,-35 42,-93 42,-173l0 -8c0,-82 -14,-141 -41,-177 -28,-36 -72,-54 -134,-54z"
                                      class="fil2"></path>
                                <path id="3"
                                      d="M2602 1007l-48 0 0 -530 48 0 0 530zm-55 -678c0,-31 10,-46 31,-46 10,0 17,4 23,12 6,8 9,20 9,34 0,15 -3,27 -9,35 -6,9 -13,13 -23,13 -21,0 -31,-16 -31,-48z"
                                      class="fil2"></path>
                                <path id="4"
                                      d="M3046 1017c-68,0 -121,-25 -159,-74l-7 0c5,46 7,73 7,83l0 220 -115 0 0 -778 93 0c3,10 8,34 16,72l6 0c36,-55 90,-82 161,-82 67,0 120,24 157,73 38,49 56,117 56,205 0,88 -19,157 -57,207 -38,49 -91,74 -158,74zm-28 -466c-45,0 -78,14 -99,40 -21,27 -32,70 -32,128l0 17c0,66 10,113 31,143 21,29 55,44 102,44 40,0 70,-16 92,-49 21,-32 32,-79 32,-139 0,-60 -11,-106 -32,-137 -21,-31 -52,-47 -94,-47z"
                                      class="fil2"></path>
                                <path id="5"
                                      d="M3668 458c23,0 42,1 57,4l-11 107c-16,-4 -33,-6 -51,-6 -46,0 -83,15 -111,45 -29,30 -43,69 -43,117l0 282 -114 0 0 -539 89 0 15 94 6 0c18,-32 41,-57 70,-76 29,-19 60,-28 93,-28z"
                                      class="fil2"></path>
                                <path id="6"
                                      d="M4284 736c0,88 -23,157 -68,207 -45,49 -108,74 -189,74 -50,0 -95,-12 -134,-34 -38,-23 -68,-56 -89,-99 -21,-42 -31,-92 -31,-148 0,-87 22,-156 67,-205 45,-49 108,-73 190,-73 78,0 140,25 185,75 46,50 69,118 69,203zm-393 0c0,125 46,187 138,187 91,0 137,-62 137,-187 0,-123 -46,-185 -138,-185 -48,0 -83,16 -105,48 -21,32 -32,78 -32,137z"
                                      class="fil2"></path>
                                <path id="7"
                                      d="M4686 554l-132 0 0 453 -115 0 0 -453 -89 0 0 -53 89 -35 0 -35c0,-64 15,-111 45,-142 30,-31 75,-46 137,-46 40,0 80,7 119,20l-30 86c-29,-9 -56,-13 -81,-13 -26,0 -45,8 -57,24 -12,16 -18,40 -18,72l0 36 132 0 0 86z"
                                      class="fil2"></path>
                                <path id="8"
                                      d="M5013 1017c-84,0 -150,-25 -197,-74 -47,-49 -71,-116 -71,-202 0,-88 22,-157 66,-208 44,-50 104,-75 181,-75 71,0 127,21 168,65 42,43 62,102 62,178l0 62 -359 0c2,52 16,93 42,121 27,28 65,42 113,42 32,0 62,-3 89,-9 27,-6 57,-16 89,-30l0 93c-28,14 -57,23 -85,28 -29,6 -62,9 -98,9zm-21 -472c-37,0 -66,11 -88,34 -22,23 -35,57 -39,101l245 0c-1,-44 -12,-78 -32,-101 -21,-23 -50,-34 -86,-34z"
                                      class="fil2"></path>
                                <path id="9"
                                      d="M5715 853c0,53 -19,93 -57,122 -39,28 -94,42 -165,42 -72,0 -130,-11 -173,-33l0 -99c63,29 122,44 177,44 70,0 105,-21 105,-64 0,-14 -3,-25 -11,-34 -8,-9 -21,-19 -39,-28 -18,-10 -43,-21 -74,-34 -62,-24 -105,-48 -127,-72 -21,-24 -32,-55 -32,-93 0,-47 18,-82 55,-108 38,-26 88,-38 152,-38 64,0 124,12 180,38l-37 87c-58,-25 -107,-37 -147,-37 -60,0 -90,18 -90,52 0,17 8,31 23,43 16,12 51,28 104,48 44,18 76,33 97,48 20,14 35,31 44,49 10,19 15,41 15,67z"
                                      class="fil2"></path>
                                <path id="10"
                                      d="M6201 853c0,53 -19,93 -57,122 -39,28 -94,42 -165,42 -72,0 -130,-11 -173,-33l0 -99c63,29 122,44 177,44 70,0 106,-21 106,-64 0,-14 -4,-25 -12,-34 -8,-9 -21,-19 -39,-28 -18,-10 -42,-21 -74,-34 -62,-24 -104,-48 -126,-72 -22,-24 -33,-55 -33,-93 0,-47 18,-82 56,-108 37,-26 87,-38 152,-38 63,0 123,12 179,38l-37 87c-58,-25 -107,-37 -146,-37 -61,0 -91,18 -91,52 0,17 8,31 23,43 16,12 51,28 104,48 44,18 77,33 97,48 20,14 35,31 45,49 9,19 14,41 14,67z"
                                      class="fil2"></path>
                                <path id="11"
                                      d="M6440 1007l-115 0 0 -539 115 0 0 539zm-122 -682c0,-21 6,-36 17,-47 11,-12 27,-17 48,-17 20,0 36,5 47,17 11,11 17,26 17,47 0,19 -6,35 -17,46 -11,11 -27,17 -47,17 -21,0 -37,-6 -48,-17 -11,-11 -17,-27 -17,-46z"
                                      class="fil2"></path>
                                <path id="12"
                                      d="M7082 736c0,88 -23,157 -68,207 -45,49 -108,74 -189,74 -50,0 -95,-12 -133,-34 -39,-23 -69,-56 -90,-99 -21,-42 -31,-92 -31,-148 0,-87 23,-156 67,-205 45,-49 109,-73 190,-73 78,0 140,25 186,75 45,50 68,118 68,203zm-393 0c0,125 46,187 138,187 91,0 137,-62 137,-187 0,-123 -46,-185 -138,-185 -48,0 -83,16 -104,48 -22,32 -33,78 -33,137z"
                                      class="fil2"></path>
                                <path id="13"
                                      d="M7688 1007l-115 0 0 -332c0,-41 -9,-72 -25,-93 -17,-20 -44,-31 -80,-31 -49,0 -84,15 -106,43 -23,29 -34,77 -34,144l0 269 -115 0 0 -539 90 0 16 70 6 0c16,-26 39,-45 69,-59 30,-14 63,-21 100,-21 129,0 194,66 194,197l0 352z"
                                      class="fil2"></path>
                                <path id="14"
                                      d="M8184 1007l-23 -75 -3 0c-26,33 -52,55 -79,67 -26,12 -60,18 -101,18 -53,0 -95,-15 -124,-43 -30,-29 -45,-69 -45,-122 0,-55 21,-97 62,-125 41,-29 104,-44 189,-47l93 -3 0 -28c0,-35 -8,-61 -24,-78 -16,-17 -41,-26 -75,-26 -28,0 -54,4 -80,13 -25,8 -49,17 -73,28l-37 -81c29,-16 61,-27 96,-35 35,-8 68,-12 99,-12 68,0 120,15 155,45 35,29 52,76 52,141l0 363 -82 0zm-170 -78c41,0 75,-12 100,-35 25,-23 38,-56 38,-98l0 -47 -69 3c-54,2 -94,11 -118,27 -25,16 -37,41 -37,74 0,24 7,43 21,56 15,13 36,20 65,20z"
                                      class="fil2"></path>
                                <polygon id="15" points="8541,1007 8426,1007 8426,248 8541,248 " class="fil2"></polygon>
                            </g>
                </svg>
                    </a></div>
            </div>
            <div class="col-md-4">
                <div class="main-panel-cart">
                    <button class="button-show-favorites">
                        <div class="icon"><i class="fa fa-heart-o"></i></div>
                        <div data-count="{{count($wishlist)}}" class="h6 count-wishlist">Favorites</div>
                    </button>
                    <button class="button-show-cart">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="82mm" height="77.2mm"
                                 version="1.1"
                                 style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                 viewBox="0 0 8200 7720" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <style type="text/css">.fil0 {
                                fill: #e97498
                            }</style>
                    </defs>
                                <g id="����_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path
                                        d="M2750 6901c0,-179 139,-351 352,-351 306,0 448,376 243,581 -203,203 -478,83 -556,-86 -15,-33 -39,-96 -39,-144zm2877 -13c0,-274 350,-464 583,-244 244,229 34,596 -219,596 -201,0 -364,-155 -364,-352zm-5623 -6638c0,155 75,231 209,286 60,24 1022,366 1046,437l413 2256c101,584 226,1160 322,1748 37,229 124,310 392,310 -65,280 -286,621 -286,898 0,42 33,95 51,118 70,85 265,65 374,64 -8,12 -52,49 -74,78 -210,279 -169,791 119,1027 60,50 144,114 219,145 239,98 540,75 750,-70l107 -89c84,-77 150,-186 188,-293 70,-197 55,-440 -35,-622 -31,-63 -82,-104 -98,-175l1666 0c-5,56 -152,227 -169,404 -31,318 74,611 343,775 252,152 533,184 806,35 19,-11 19,-11 33,-19 338,-181 486,-678 301,-1013 -30,-54 -94,-138 -123,-179 92,0 263,8 331,-17 165,-62 165,-303 27,-390 -51,-40 -713,-26 -834,-26 -1151,0 -2302,-1 -3453,1 51,-170 182,-529 233,-652 1115,0 2223,0 3338,0 980,0 734,135 1143,-1095 187,-561 357,-1133 544,-1695 47,-143 265,-750 265,-893 0,-178 -151,-248 -299,-248 -1509,-77 -3096,-121 -4568,-200 -260,-14 -642,-73 -704,175 -29,115 7,198 74,264 123,119 423,69 641,88 1389,60 2824,119 4231,181 -8,99 -300,970 -340,1079 -147,401 -272,850 -403,1262 -41,129 -126,444 -181,549l-4113 0c-12,-141 -240,-1295 -269,-1475l-409 -2208c-24,-119 -39,-241 -67,-362 -41,-182 -205,-228 -363,-288 -148,-58 -1010,-418 -1117,-418 -132,0 -261,113 -261,247z"
                                        class="fil0"></path>
                                </g>
                             </svg>
                        </div>
                        <div data-count="{{$cart['count'] ?? 0}}" class="h6 count-cart">My cart</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="nav header-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-nav-pages">
                    @include('menu.head_main', ['items' => $items])
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="basket-open">
    <button class="button-back">Back</button>
    <div class="basket-container">
        <div class="basket-container-top">
            <ul class="basket-container-top-change">
                <li class="fav-change current changewishlist">
                    <div class="icon"><i class="fa fa-heart-o"></i></div>
                    <div data-count="{{count($wishlist)}}" class="h6 count-wishlist">Favorites</div>
                </li>

                <li class="basket-change cartchange">
                    <div class="icon"><img src="img/svg/cart.svg" alt="cart"></div>
                    <div data-count="{{$cart['count'] ?? 0}}" class="h6 count-cart">Cart</div>
                </li>
            </ul>
        </div>

        <div class="basket-container-main custom-scroll-block custom-scroll_hidden-y">
            <ul class="basket-container-main-change">
                <li style="display: none;" class="fav-change">
                    <div id="wishlist" class="products-list -favorites">

                    </div>
                </li>
                <li style="display: none;" class="basket-change">
                    <div class="products-list -cart" id="cartitems">
                        <ul>

                            @if($cart['products'])
                                @foreach($cart['products'] as $k=>$v)
                                    <li>
                                        <div class="product"><a
                                                href="{{\App\Helpers\Catalog\Products::buildUrl($v->meta['alias'],$urls[$v->categories[0]->id])}}"
                                                class="product-thumb">
                                                <img src="{{$v->images[0]}}"
                                                     alt=""></a>
                                            <div class="text">
                                                <div class="product-name">{{$v->title}}</div>
                                                <div class="product-count">
                                                    <div data-max-count="100500" class="count-block -cart">
                                                        <button data-price="{{$v->price}}" data-product_id="{{$v->id}}"
                                                                class="button-dec"></button>
                                                        <div class="count">{{$v->count}}</div>
                                                        <button data-price="{{$v->price}}" data-product_id="{{$v->id}}"
                                                                class="button-inc"></button>
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    @if($v->old_price)
                                                        <div
                                                            class="old-price strike dollar">{{$v->old_price}} @if($v->discount)
                                                                - {{$v->discount}} %@endif </div>
                                                    @endif
                                                    <div class="price dollar">{{$v->price}}</div>
                                                </div>
                                            </div>
                                            <div class="product-delete" data-product_id="{{$v->id}}">
                                                <div class="close-icon"></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

        <div class="basket-container-bottom">
            <div class="subtotal-price h4 dollar"></div>
            <div class="basket-container-bottom-go">
                <button class="button button-show-cart">Go to cart</button>
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom-sending">
    <div class="container">
        <div class="row">
            <div class="fixed-bottom-sending-left">
                <div class="img"><img src="img/icons/sending.png" alt="sending-icon"></div>
            </div>
            <div class="fixed-bottom-sending-right">
                <div class="text">
                    <div class="fz32 semibold ttu">{!! $txt->free_delivery ?? ''!!}</div>
                    <div class="h6">{!! $txt->free_delivery_text ?? ''!!}</div>
                </div>
                <div class="fixed-bottom-sending-right-button">
                    <button class="button">ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
@if (Session::has('success'))
    {{--<div class="alert alert-success">--}}
    {{--<ul>--}}
    {{--<li>{!! Session::get('success') !!}</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
@endif
<div class="fixed-panel">
    <div class="fixed-panel-left">
        <div class="fixed-panel-search">
            <form action="#" id="mobile-search-form">
                <input type="search" placeholder="Enter product name" id="input-search-mobile-form">
            </form>
        </div>
        <div class="fixed-panel-left-pages">Search of product</div>
    </div>
    <div class="fixed-panel-right">
        <button class="fixed-panel-right-button">
            <div class="-inactive"><img src="img/svg/search.svg" alt=""></div>
            <div class="-active">
                <div class="close-icon"></div>
            </div>
        </button>
    </div>
</div>
@yield('content')
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-left"><a href="" class="mail"><i
                            class="fa fa-envelope"></i>{!! $txt->email ?? '' !!}</a></div>
            </div>
            <div class="col-md-4">
                <div class="main-panel-logo"><a href="#"><img src="img/svg/logo.svg" alt=""></a></div>
            </div>
            <div class="col-md-4">
                <div class="footer-right tar"><a class="phone"> <i
                            class="fa fa-phone"></i>{!! $txt->admin_phone ?? '' !!}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end-->
<!-- Popup start-->
<div id="popup-feedback" class="popup-main popup-feedback">
    <div class="popup-wrapper">
        <div class="popup-content">
            <div class="popup-content-inner">
                <div class="popup-content-main">
                    <div class="popup-close">
                        <div class="close-icon"></div>
                    </div>
                    <p class="semibold ttu">{!! $txt->contact_form ?? '' !!}</p>
                    <div class="popup-feedback-form">
                        <form class="message-form" action="{{route('form.save')}}" method="POST">
                            @CSRF
                            <div class="popup-feedback-form-top">
                                <div class="input-wrapper">
                                    <input required name="email" type="email" placeholder="YOUR EMAIL*">
                                </div>
                                <div class="input-wrapper">
                                    <input required name="msg" type="text" placeholder="YOUR COMMENT*">
                                </div>
                            </div>
                            <div class="input-wrapper-submit">
                                <div class="button-send">
                                    <input id="message_send" type="submit" value="Send">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup start-->
<div id="popup-feedback-success" class="popup-main popup-feedback-success">
    <div class="popup-wrapper">
        <div class="popup-content">
            <div class="popup-content-inner">
                <div class="popup-content-main">
                    <div class="popup-feedback-success-icon"><img src="img/svg/mail.svg" alt="mail sent"></div>
                    <div class="popup-feedback-success-text">
                        <p class="semibold ttu">{!!$txt->form_text1 ?? '' !!}</p>
                        <p>{!!$txt->form_text2 ?? '' !!}</p>
                    </div>
                    <div class="popup-feedback-success-button">
                        <button class="button">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-order-success" class="popup-main popup-feedback-success">
    <div class="popup-wrapper">
        <div class="popup-content">
            <div class="popup-content-inner">
                <div class="popup-content-main">
                    <div class="popup-feedback-success-icon"><img src="img/svg/mail.svg" alt="mail sent"></div>
                    <div class="popup-feedback-success-text">
                        <p class="semibold ttu">Thanks!, your order is accepted</p>
                        <p></p>
                    </div>
                    <div class="popup-feedback-success-button">
                        <button class="button">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-preview" class="popup-main popup-preview">
    <div class="popup-wrapper">
        <div class="popup-content">
            <div class="popup-content-inner">
                <div class="popup-close">
                    <div class="close-icon"></div>
                </div>
                <div class="popup-content-main">
                    <div class="popup-preview-left vca">
                        <div class="img"><img src="img/thumbs/card1.png" alt="#"></div>
                    </div>
                    <div class="popup-preview-right">
                        <div class="text card-info">
                            <div class="fz30 card-info-name"></div>
                            <p class="card-info-sending">Fast worldwide shipping</p>
                            <div class="h6 card-info-sending-desc">Free and fast international shipping anywhere in the
                                world, with any order!
                            </div>
                            <div class="h3 card-info-price dollar"></div>
                            <p class="card-info-price-regular strike dollar"></p>

                            <div data-max-count="9999" class="count-block -single">
                                <button class="button-dec"></button>
                                <div class="count">1</div>
                                <button class="button-inc"></button>
                            </div>
                            <a href="#" class="button card-info-button-cart">go to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="popup-order" class="popup-main popup-order">
    <div class="popup-wrapper">
        <div class="popup-content">
            <div class="popup-content-inner">
                <div class="popup-content-main">
                    <div class="popup-order-top">
                        <div class="popup-order-top-left">
                            <div class="popup-close">
                                <button class="button-continue">Continue Shopping</button>
                            </div>
                        </div>
                        <div class="popup-order-top-right tar"><img src="img/icons/paypal-logo.png" alt=""></div>
                    </div>
                    <div class="popup-order-basket">
                        <div class="popup-order-basket-headers">
                            <p class="light">
                            <ul>
                                <li class="count-cart" data-count="{{$cart['count'] ?? 0}}">My Cart</li>
                                <li>Price</li>
                                <li>Quantity:</li>
                                <li>Total</li>
                            </ul>
                            </p>
                        </div>
                        <div class="popup-order-basket-items">
                            <div id="cart-order-products" class="products-list -order">
                                <ul>

                                    @foreach($cart['products'] as $k=>$v)
                                        <li>
                                            <div class="product"><a
                                                    href="{{\App\Helpers\Catalog\Products::buildUrl($v->meta['alias'],$urls[$v->categories[0]->id])}}"
                                                    class="product-thumb"><img
                                                        src="{{$v->images[0]}}" alt=""></a>
                                                <div class="text">
                                                    <div data-count="1000" class="product-name">{{$v->title}}</div>
                                                    <div class="product-price">
                                                        @if($v->old_price)
                                                            <div
                                                                class="old-price strike dollar">{{$v->old_price}}</div>@if($v->discount)
                                                                - {{$v->discount}} %@endif
                                                        @endif
                                                        <div class="price dollar">{{$v->price}}</div>
                                                    </div>
                                                    <div class="product-count">
                                                        <div data-max-count="100500" class="count-block -order">
                                                            <button class="button-dec"></button>
                                                            <div class="count">{{$v->count}}</div>
                                                            <button class="button-inc"></button>
                                                        </div>
                                                    </div>
                                                    <div class="product-price-total">
                                                        <div class="price dollar">{{$v->count * $v->price}}</div>
                                                    </div>
                                                </div>
                                                <div class="product-delete" data-product_id="{{$v->id}}">
                                                    <div class="close-icon"></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <form id="payment-form" method="post" action="https://shop.westernbid.info">
                        <div class="popup-order-middle">
                            <div class="row">
                                @csrf
                                <div class="popup-order-middle-left fll">
                                    <div class="input-wrapper input-wrapper-textarea">
                                    <textarea id="textarea" name="shipping[note]" cols="30" rows="10"
                                              placeholder="Add a note"></textarea>
                                    </div>
                                    <input type="hidden" name="charset" value="utf-8">
                                    <input type="hidden" name="item_name" value="kodiprofessional order">
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="hidden" name="return" value="http://www.kodiprofessional.com">
                                    <input type="hidden" name="cancel_return" value="http://www.kodiprofessional.com">
                                    <input type="hidden" name="notify_url" value="http://www.kodiprofessional.com">
                                </div>
                                <div class="popup-order-middle-right fll">
                                    <div class="popup-order-middle-info h6 light">
                                        <ul>
                                            {{--<li>--}}
                                            {{--<div class="fll subtotal-label">Subtotal</div>--}}
                                            {{--<div class="flr subtotal-value dollar">40.80</div>--}}
                                            {{--</li>--}}

                                            <li>
                                                <div class="fll shipping-label">Worldwide Free Shipping</div>
                                                <div class="flr shipping-value">FREE</div>
                                            </li>
                                            <li class="semibold">
                                                <div class="fll total-label ttu">Total</div>
                                                <div class="flr total-value dollar">{{$cart['sum']}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="popup-order-fields">
                            <p class="semibold">Shipping Address</p>
                            <ul class="fields-list">
                                <li class="field-row">
                                    <div required class="label">Country</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[country]" placeholder="Country">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">First Name</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[firstName]"
                                                   placeholder="First Name">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">Last Name</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[lastName]"
                                                   placeholder="Last Name">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">Address</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[address]" placeholder="Address">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div class="label">Apt./Suite</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input type="text" name="shipping[apartment]" placeholder="Apt./Suite">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">City</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[city]" placeholder="City">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div class="label">State/Province</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input type="text" name="shipping[state]" placeholder="State/Province">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">ZIP/Postal Code</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="shipping[zip]"
                                                   placeholder="ZIP/Postal Code">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">Telephone</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="text" name="phone" placeholder="Telephone">
                                        </div>
                                    </div>
                                </li>
                                <li class="field-row">
                                    <div required class="label">Email Address:</div>
                                    <div class="field">
                                        <div class="input-wrap">
                                            <input required type="email" name="email" placeholder="Email Address:">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="popup-order-bottom">
                            <div class="row">

                                <div class="col-md-8">
                                    <div class="col-md-4 tac flr"><input type="submit" value="Confirm order"
                                                                         class="button"></div>
                                    <div class="ssl-logo"><img src="img/icons/ssl-logo.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Popup end-->
<!-- Optimized loading JS Start-->
<script>
    var scr = {
        "scripts": [
            {"src": "js/libs.min.js", "async": false},
            {"src": "js/common.js", "async": false}
        ]
    };
    !function (t, n, r) {
        "use strict";
        var c = function (t) {
            if ("[object Array]" !== Object.prototype.toString.call(t)) return !1;
            for (var r = 0; r < t.length; r++) {
                var c = n.createElement("script"), e = t[r];
                c.src = e.src, c.async = e.async, n.body.appendChild(c)
            }
            return !0
        };
        t.addEventListener ? t.addEventListener("load", function () {
            c(r.scripts);
        }, !1) : t.attachEvent ? t.attachEvent("onload", function () {
            c(r.scripts)
        }) : t.onload = function () {
            c(r.scripts)
        }
    }(window, document, scr);
</script>
<script src="js/libs.min.js"></script>
<script src="js/laroute.js"></script>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"
        integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ=="
        crossorigin="anonymous"></script>

<script src="js/common.js"></script>
<script>
    $('.open-mobile-menu-search .button-search').click(function (event) {
        event.preventDefault();
        $('.open-mobile-menu-search').toggleClass('show-search');

    });

    $('.fixed-panel-right-button,.fixed-panel-left-pages').click(function (event) {
        $('.fixed-panel').toggleClass('opened');

    });

    $('#mobile-search-form').on('submit', function (e) {
        e.preventDefault();
        let searchString = $('#input-search-mobile-form').val();
        window.location.href = '/search?search=' + searchString;
    });
</script>
<script src="{{asset('/js/discount-product.js')}}"></script>
<!-- Optimized loading JS End-->
</body>
</html>
