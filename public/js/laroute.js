(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["DELETE"],"uri":"_debugbar\/cache\/{key}\/{tags?}","name":"debugbar.cache.delete","action":"Barryvdh\Debugbar\Controllers\CacheController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"index","action":"App\Http\Controllers\WelcomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"profile.logout","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":"password.update","action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"search\/{pageQuery?}","name":"search","action":"App\Http\Controllers\SearchController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"shipping","name":"shipping","action":"App\Http\Controllers\StaticPagesController@shipping"},{"host":null,"methods":["GET","HEAD"],"uri":"wholesale","name":"wholesale","action":"App\Http\Controllers\StaticPagesController@wholesale"},{"host":null,"methods":["POST"],"uri":"generatewishlist","name":"wishlist.get","action":"App\Http\Controllers\WelcomeController@wishlist"},{"host":null,"methods":["POST"],"uri":"formsend","name":"form.save","action":"App\Http\Controllers\FormController@store"},{"host":null,"methods":["POST"],"uri":"shop\/cart\/add","name":"shop.cart.add","action":"App\Http\Controllers\Shop\Cart@add"},{"host":null,"methods":["POST"],"uri":"shop\/cart\/delete","name":"shop.cart.delete","action":"App\Http\Controllers\Shop\Cart@delete"},{"host":null,"methods":["POST"],"uri":"shop\/cart","name":"shop.cart","action":"App\Http\Controllers\Shop\Cart@reload"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/cart\/count","name":"shop.cart.count","action":"App\Http\Controllers\Shop\Cart@count"},{"host":null,"methods":["POST"],"uri":"shop\/cart\/remove","name":"shop.cart.remove","action":"App\Http\Controllers\Shop\Cart@remove"},{"host":null,"methods":["POST"],"uri":"shop\/cart\/order","name":"shop.cart.order","action":"App\Http\Controllers\Shop\Cart@order"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/cart\/thanks\/{id?}","name":"shop.cart.thanks","action":"App\Http\Controllers\Shop\Cart@thanks"},{"host":null,"methods":["GET","HEAD"],"uri":"{any?}\/{pageQuery?}","name":null,"action":"\App\Http\Call@url"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/all\/showhide\/{model?}\/{id?}","name":"admin_showhide","action":"App\Admin\Controllers\ShowHideController@Show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/all\/showhidecategory\/{model?}\/{id?}","name":"admin_showhide_category","action":"App\Admin\Controllers\ShowHideController@Category"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/cacheclear","name":"cacheclear","action":"App\Admin\Controllers\ClearController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin","name":"admin.dashboard","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getDashboard"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/{adminModel}","name":"admin.model","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getDisplay"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}","name":"admin.model","action":"SleepingOwl\Admin\Http\Controllers\AdminController@inlineEdit"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/{adminModel}\/create","name":"admin.model.create","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getCreate"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/create","name":"admin.model.store","action":"SleepingOwl\Admin\Http\Controllers\AdminController@postStore"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/{adminModel}\/{adminModelId}\/edit","name":"admin.model.edit","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getEdit"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/{adminModelId}\/edit","name":"admin.model.update","action":"SleepingOwl\Admin\Http\Controllers\AdminController@postUpdate"},{"host":null,"methods":["DELETE"],"uri":"admin\/{adminModel}\/{adminModelId}\/delete","name":"admin.model.delete","action":"SleepingOwl\Admin\Http\Controllers\AdminController@deleteDelete"},{"host":null,"methods":["DELETE"],"uri":"admin\/{adminModel}\/{adminModelId}\/destroy","name":"admin.model.destroy","action":"SleepingOwl\Admin\Http\Controllers\AdminController@deleteDestroy"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/{adminModelId}\/restore","name":"admin.model.restore","action":"SleepingOwl\Admin\Http\Controllers\AdminController@postRestore"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/{adminWildcard}","name":"admin.wildcard","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getWildcard"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/env\/editor","name":"admin.env.editor","action":"SleepingOwl\Admin\Http\Controllers\AdminController@getEnvEditor"},{"host":null,"methods":["POST"],"uri":"admin\/env\/editor","name":"admin.env.editor.post","action":"SleepingOwl\Admin\Http\Controllers\AdminController@postEnvEditor"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/{adminModelId}\/up","name":"admin.display.column.move-up","action":"SleepingOwl\Admin\Http\Controllers\DisplayColumnController@orderUp"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/{adminModelId}\/down","name":"admin.display.column.move-down","action":"SleepingOwl\Admin\Http\Controllers\DisplayColumnController@orderDown"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/{adminModel}\/async\/{adminDisplayName?}","name":"admin.display.async","action":"SleepingOwl\Admin\Http\Controllers\DisplayController@async"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/async\/{adminDisplayName?}","name":"admin.display.async.inlineEdit","action":"SleepingOwl\Admin\Http\Controllers\AdminController@inlineEdit"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/reorder","name":"admin.display.tree.reorder","action":"SleepingOwl\Admin\Http\Controllers\DisplayController@treeReorder"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/image\/{field}\/{id?}","name":"admin.form.element.image","action":"SleepingOwl\Admin\Http\Controllers\UploadController@fromField"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/file\/{field}\/{id?}","name":"admin.form.element.file","action":"SleepingOwl\Admin\Http\Controllers\UploadController@fromField"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/dependent-select\/{field}\/{id?}","name":"admin.form.element.dependent-select","action":"\SleepingOwl\Admin\Http\Controllers\FormElementController@dependentSelect"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/selectajax\/{field}\/{id?}","name":"admin.form.element.selectajax","action":"SleepingOwl\Admin\Http\Controllers\FormElementController@selectSearch"},{"host":null,"methods":["POST"],"uri":"admin\/{adminModel}\/multiselectajax\/{field}\/{id?}","name":"admin.form.element.multiselectajax","action":"SleepingOwl\Admin\Http\Controllers\FormElementController@multiselectSearch"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/ckeditor\/upload\/image","name":"admin.ckeditor.upload","action":"SleepingOwl\Admin\Http\Controllers\UploadController@ckEditorStore"},{"host":null,"methods":["POST"],"uri":"admin\/ckeditor\/upload\/image","name":"admin.ckeditor.upload","action":"SleepingOwl\Admin\Http\Controllers\UploadController@ckEditorStore"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

