var Pronamic_Cookies = {
    config: {},
    ready: function() {
        Pronamic_Cookies.notify.ready();
        Pronamic_Cookies.section.ready();
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
    section: {
        config: {},
        ready: function() {
            Pronamic_Cookies.section.config.dom = {
                'additional_buttons': jQuery('.jShowCookieLawModal'),
                'show_button': jQuery('.pronamic_csection_show_button'),
                'modal': jQuery('.pronamic_csection_modal'),
                'accept_cookie': jQuery('.jAcceptCookie'),
                'close_modal': jQuery('.jCloseModal'),
                'overlay': jQuery('<div></div>')
            };

            Pronamic_Cookies.section.binds();
            Pronamic_Cookies.section.center_show_button();
        },
        binds: function() {
            Pronamic_Cookies.section.config.dom.additional_buttons.css('cursor', 'pointer');

            Pronamic_Cookies.section.config.dom.additional_buttons.click(
                Pronamic_Cookies.section.show_modal
            );

            Pronamic_Cookies.section.config.dom.show_button.click(
                Pronamic_Cookies.section.show_modal
            );

            Pronamic_Cookies.section.config.dom.accept_cookie.click(
                Pronamic_Cookies.section.accepted
            );

            Pronamic_Cookies.section.config.dom.close_modal.click(
                Pronamic_Cookies.section.hide_modal
            );
        },
        center_show_button: function() {
            var width = Pronamic_Cookies.section.config.dom.show_button.width();
            Pronamic_Cookies.section.config.dom.show_button.css({
                'marginRight': Math.abs(width/2) * -1
            });
        },
        show_modal: function(e) {
            e.preventDefault();
            Pronamic_Cookies.section.config.dom.modal.hide();
            Pronamic_Cookies.section.config.dom.modal.show();
            Pronamic_Cookies.section.show_overlay();
        },
        hide_modal: function(e) {
            if( undefined != e)
                e.preventDefault();
            Pronamic_Cookies.section.config.dom.modal.hide();
            Pronamic_Cookies.section.hide_overlay();
        },
        show_overlay: function() {
            var overlay = jQuery('<div></div>').addClass('pcl-overlay');
            jQuery('body').append(overlay);
        },
        hide_overlay: function() {
            jQuery('.pcl-overlay').remove();
        },
        accepted: function(e) {
            e.preventDefault();

            var name = jQuery(this).data('name');

            Pronamic_Cookies.cookie.make({
                'name': 'pcl_section_' + name,
                'value': 1
            });

            Pronamic_Cookies.section.hide_modal();
            document.location.reload(true);
        }
    },
    blocker: {
        config: {},
        ready: function() {
            Pronamic_Cookies.blocker.config.dom = {
                'button': jQuery('.jBlockerAccept')
            };

            Pronamic_Cookies.blocker.binds();
        },
        binds: function() {
            Pronamic_Cookies.blocker.config.dom.button.click(Pronamic_Cookies.blocker.set_and_go);
        },
        set_and_go: function(e) {
            e.preventDefault();

            Pronamic_Cookies.cookie.make({
                'name': 'pcl_viewed',
                'value': 1
            });
            document.location.reload(true);
        }
    },
    dynamic: {
        config: {},
        ready: function() {
            Pronamic_Cookies.dynamic.config.dom = {
                'button': jQuery('.jAcceptCookieDynamic'),
                'verified_content': jQuery('.jPCLDynamicContent')
            };

            Pronamic_Cookies.dynamic.binds();
            Pronamic_Cookies.dynamic.dynamic_run();
        },
        check_it: function( name ) {

            if(Pronamic_Cookies.cookie.all[name]){ return Pronamic_Cookies.cookie.all[name]; }

            c = document.cookie.split('; ');
            Pronamic_Cookies.cookie.all = {};

            for(i=c.length-1; i>=0; i--){
               C = c[i].split('=');
               Pronamic_Cookies.cookie.all[C[0]] = C[1];
            }

            if(Pronamic_Cookies.cookie.all[name] != undefined ) {
                return true;
            } else {
                return false;
            }
        },
        binds: function() {
            Pronamic_Cookies.dynamic.config.dom.button.click(Pronamic_Cookies.dynamic.set_and_replace);
        },
        set_and_replace: function(e) {
            e.preventDefault();

            var container = jQuery(this).data('container'),
                name = jQuery(this).data('name');

            Pronamic_Cookies.dynamic.fill_it( container );

            Pronamic_Cookies.cookie.make({
                'name': 'pcl_section_' + name,
                'value': 1
            });

            Pronamic_Cookies.section.hide_modal();
        },

        fill_it: function( container ) {
            jQuery('.' + container).empty().html(Pronamic_Cookies.dynamic.config.dom.verified_content.val());
        },
        dynamic_run: function() {
            jQuery.each(Pronamic_Cookies.dynamic.config.dom.verified_content, function() {
                var container = jQuery(this).data('container'),
                    name = jQuery(this).data('name');

                if(Pronamic_Cookies.dynamic.check_it('pcl_section_' + name))
                    Pronamic_Cookies.dynamic.fill_it(container)
            });
        }
    },
    cookie: {
        all:{},
        make: function( args ) {
            document.cookie = escape( args.name ) + '=' + escape( args.value ) + "; path=" + Pronamic_Cookies_Vars.cookie.path + ';expires=' + Pronamic_Cookies_Vars.cookie.expires;
        }

    }
};

jQuery(Pronamic_Cookies.ready);