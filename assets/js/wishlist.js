/**
 * fastest_fj Wishlist JavaScript
 */

(function($) {
    'use strict';

    // Toggle Wishlist
    $(document).on('click', '.add-to-wishlist', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $button = $(this);
        var productId = $button.data('product-id');
        var $icon = $button.find('.heart-icon');

        if (!productId) return;

        $button.prop('disabled', true);
        $icon.removeClass('far fas').addClass('fas fa-spinner fa-spin');

        $.ajax({
            url: fastest_fj_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fastest_fj_wishlist_toggle',
                product_id: productId,
                nonce: fastest_fj_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    if (response.data.status === 'added') {
                        $button.addClass('in-wishlist');
                        $icon.removeClass('far fa-spinner fa-spin').addClass('fas');
                        // Show notification
                        showNotification(fastest_fj_ajax.strings.added_wishlist, 'success');
                    } else {
                        $button.removeClass('in-wishlist');
                        $icon.removeClass('fas fa-spinner fa-spin').addClass('far');
                        showNotification(fastest_fj_ajax.strings.removed, 'info');
                    }

                    // Update wishlist count in header
                    if (response.data.count !== undefined) {
                        $('.wishlist-count').text(response.data.count);
                    }

                    // Refresh wishlist page if on it
                    if ($('body').hasClass('page-template-template-wishlist')) {
                        location.reload();
                    }
                }
                $button.prop('disabled', false);
            },
            error: function() {
                $icon.removeClass('fa-spinner fa-spin').addClass($button.hasClass('in-wishlist') ? 'fas' : 'far');
                $button.prop('disabled', false);
            }
        });
    });

    // Notification helper
    function showNotification(message, type) {
        var $notification = $('<div class="fixed top-24 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-sm font-semibold fade-in" style="animation: fadeIn 0.3s ease;">' + message + '</div>');

        if (type === 'success') {
            $notification.addClass('bg-green-500 text-white');
        } else if (type === 'info') {
            $notification.addClass('bg-blue-500 text-white');
        } else {
            $notification.addClass('bg-brand-gold text-white');
        }

        $('body').append($notification);
        setTimeout(function() {
            $notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

})(jQuery);
