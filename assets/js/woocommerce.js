/**
 * fastest_fj WooCommerce JavaScript
 */

(function($) {
    'use strict';

    // AJAX Add to Cart
    $(document).on('click', '.ajax_add_to_cart', function(e) {
        var $button = $(this);
        if ($button.hasClass('loading')) return;

        $button.addClass('loading').text('...');

        var productId = $button.data('product_id');
        var quantity = $button.data('quantity') || 1;
        var variationId = $button.data('variation_id') || 0;

        $.ajax({
            url: fastest_fj_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fastest_fj_add_to_cart',
                product_id: productId,
                quantity: quantity,
                variation_id: variationId,
                nonce: fastest_fj_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    $button.removeClass('loading').text(fastest_fj_ajax.strings.view_cart);
                    $button.after('<a href="' + wc_add_to_cart_params.cart_url + '" class="block text-center text-brand-gold text-xs mt-1 hover:underline">' + fastest_fj_ajax.strings.view_cart + '</a>');

                    // Update cart count
                    if (response.data.cart_count !== undefined) {
                        $('.header-cart-count').text(response.data.cart_count);
                    }

                    // Trigger WooCommerce event
                    $(document.body).trigger('wc_fragment_refresh');
                    $(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash]);
                } else {
                    $button.removeClass('loading').text(fastest_fj_ajax.strings.add_to_cart);
                }
            },
            error: function() {
                $button.removeClass('loading').text(fastest_fj_ajax.strings.add_to_cart);
            }
        });
    });

    // Variation form handling
    $(document).on('found_variation', 'form.variations_form', function(event, variation) {
        var $form = $(this);
        var $button = $form.find('.single_add_to_cart_button');

        if (variation.is_purchasable && variation.is_in_stock) {
            $button.prop('disabled', false).removeClass('disabled');
        } else {
            $button.prop('disabled', true).addClass('disabled');
        }
    });

    // Quantity +/- buttons
    $(document).on('click', '.qty-minus', function(e) {
        e.preventDefault();
        var $input = $(this).siblings('input.qty');
        var val = parseInt($input.val());
        if (val > 1) {
            $input.val(val - 1).trigger('change');
        }
    });

    $(document).on('click', '.qty-plus', function(e) {
        e.preventDefault();
        var $input = $(this).siblings('input.qty');
        var val = parseInt($input.val());
        var max = parseInt($input.attr('max'));
        if (!max || val < max) {
            $input.val(val + 1).trigger('change');
        }
    });

    // Quick View Modal
    var quickViewModal = $('<div class="fixed inset-0 z-50 hidden items-center justify-center"><div class="absolute inset-0 bg-black/50 quickview-overlay"></div><div class="relative bg-white rounded-lg max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto"><button class="quickview-close absolute top-4 right-4 z-10 w-8 h-8 bg-white rounded-full shadow flex items-center justify-center hover:bg-gray-100"><i class="fas fa-times"></i></button><div class="quickview-content p-6"></div></div></div>');
    $('body').append(quickViewModal);

    $(document).on('click', '.quick-view-btn', function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        quickViewModal.removeClass('hidden').addClass('flex');
        quickViewModal.find('.quickview-content').html('<div class="text-center py-10"><i class="fas fa-spinner fa-spin text-brand-gold text-2xl"></i></div>');

        $.ajax({
            url: fastest_fj_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fastest_fj_quick_view',
                product_id: productId,
                nonce: fastest_fj_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    quickViewModal.find('.quickview-content').html(response.data.html);
                    if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                        quickViewModal.find('.variations_form').wc_variation_form();
                    }
                }
            }
        });
    });

    $(document).on('click', '.quickview-overlay, .quickview-close', function() {
        quickViewModal.addClass('hidden').removeClass('flex');
    });

    // Mini Cart Toggle
    $(document).on('click', '.mini-cart-toggle', function(e) {
        e.preventDefault();
        $('.mini-cart-dropdown').toggleClass('open');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.mini-cart-wrapper').length) {
            $('.mini-cart-dropdown').removeClass('open');
        }
    });

})(jQuery);
