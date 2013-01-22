var Pronamic_Cookies = {
    config: {},
    ready: function() {
        Pronamic_Cookies.notify.ready();
    },
    notify: {
        config:{},
        ready: function() {
            Pronamic_Cookies.notify.config.dom = {
                'close_button': jQuery('.pronamic_cookie_close_button'),
                'holder': jQuery('#pronamic_cookie_holder')
            };

            Pronamic_Cookies.notify.binds();
        },
        binds: function() {
            Pronamic_Cookies.notify.config.dom.close_button.click(
                Pronamic_Cookies.notify.set_and_hide
            );
        },
        set_and_hide: function(e) {
            e.preventDefault();
            Pronamic_Cookies.notify.config.dom.holder.hide();
            Pronamic_Cookies.cookie.make({
                'name': 'pcl_viewed',
                'value': 1
            });
        }
    },
    blocks: {
        config: {},
        ready: function() {
            
        },
        binds: function() {

        }
    },
    cookie: {
        make: function( args ) {
            document.cookie = escape( args.name ) + '=' + escape( args.value ) + "; path=/";
        }

    }
};

jQuery(Pronamic_Cookies.ready);