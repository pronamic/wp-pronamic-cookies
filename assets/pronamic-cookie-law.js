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
            Pronamic_Cookies.blocks.config.dom = {
                'show_button': jQuery('.pronamic_cblock_show_button'),
                'holder': jQuery('.pronamic_cblock_holder')
            };

            Pronamic_Cookies.blocks.binds();
        },
        binds: function() {
            Pronamic_Cookies.blocks.config.dom.show_button.click(
                Pronamic_Cookies.blocks.set_and_get
            );
        },
        set_and_get: function(e) {
            e.preventDefault();

            var self = jQuery(this);

            Pronamic_Cookies.blocks.config.name = self.data('name');

            Pronamic_Cookies.cookie.make({
                'name': 'pcl_block_' + Pronamic_Cookies.blocks.config.name,
                'value': 1
            });

            jQuery.ajax({
                method:'POST',
                url:Pronamic_Cookies.config.ajaxurl,
                data:{
                    action:'cblock',
                    name:Pronamic_Cookies.blocks.config.name
                },
                dataType:'json',
                success:Pronamic_Cookies.blocks._success
            });
        },
        _success: function(data) {
            if(data.resp) {
                jQuery('.pcl_block_' + Pronamic_Cookies.blocks.config.name).empty().html(data.html);
            }
        }
    },
    cookie: {
        make: function( args ) {
            document.cookie = escape( args.name ) + '=' + escape( args.value ) + "; path=/";
        }

    }
};

jQuery(Pronamic_Cookies.ready);