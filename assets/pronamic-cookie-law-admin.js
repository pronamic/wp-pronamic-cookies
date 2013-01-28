var Pronamic_Cookies_Admin = {
    config: {},
    ready: function() {
        Pronamic_Cookies_Admin.uploader.ready();
    },
    uploader: {
        config: {},
        ready: function() {
            Pronamic_Cookies_Admin.uploader.config.dom = {
                button:jQuery('.jMediaUploader')
            };

            Pronamic_Cookies_Admin.uploader.binds();
        },
        binds: function() {
            Pronamic_Cookies_Admin.uploader.config.dom.button.click(
                Pronamic_Cookies_Admin.uploader.do_upload
            );
        },
        do_upload: function(e) {
            e.preventDefault();
            var self = jQuery(this),
                input = self.attr('id').replace('_button', '');

            wp.media.editor.send.attachment = function(props, attachment) {
                jQuery('#' + input).val(attachment.url);
            }

            wp.media.editor.open(self);
        }
    }
};

jQuery(Pronamic_Cookies_Admin.ready);