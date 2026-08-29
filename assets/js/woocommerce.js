/**
 * fastest_fj WooCommerce JavaScript
 */

(function($) {
    'use strict';

    // AJAX Add to Cart
    $(document).on('click', '.fastest_fj_ajax_add_to_cart', function(e) {
        e.preventDefault();
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
                    $button.removeClass('loading').text(fastest_fj_ajax.strings.add_to_cart);

                    // Update cart count
                    if (response.data.cart_count !== undefined) {
                        $('.header-cart-count').text(response.data.cart_count);
                    }

                    // Trigger WooCommerce event
                    $(document.body).trigger('wc_fragment_refresh');
                    $(document.body).trigger('added_to_cart', [response.data.fragments, response.data.cart_hash]);

                    if (response.data.campaign) {
                        updateCampaignBar(response.data.campaign);
                    }
                } else {
                    $button.removeClass('loading').text(fastest_fj_ajax.strings.add_to_cart);
                    showCampaignWarning(response.data && response.data.message ? response.data.message : 'পণ্যটি কার্টে যোগ করা যায়নি।');
                }
            },
            error: function() {
                $button.removeClass('loading').text(fastest_fj_ajax.strings.add_to_cart);
            }
        });
    });

    function updateCampaignBar(status) {
        var $bar = $('#fastest-fj-campaign-bar');
        if (!$bar.length) return;

        var wasComplete = $bar.attr('data-complete') === '1';
        $bar.stop(true, true).removeClass('hidden').hide().fadeIn(200);
        if (status.complete) {
            $bar.attr('data-complete', '1')
                .removeClass('bg-amber-400 text-amber-950 bg-red-600')
                .addClass('bg-green-600 text-white');
            $bar.find('.campaign-message').html(
                '✅ <strong>আপনি <span class="campaign-amount">' + status.subtotal_text + '</span> টাকার প্রোডাক্ট যুক্ত করেছেন।</strong> ' +
                '<a class="block w-fit mx-auto mt-2.5 rounded bg-white px-4 py-1.5 font-bold text-green-700 sm:inline-block sm:w-auto sm:mx-0 sm:mt-0 sm:ml-3" href="' + status.checkout_url + '">অর্ডার সম্পন্ন করুন</a>'
            );
            if (!wasComplete) {
                playCampaignJoySound();
                showCampaignCelebration(status.subtotal_text);
            }
        } else {
            $bar.attr('data-complete', '0')
                .removeClass('bg-green-600 text-white bg-red-600')
                .addClass('bg-amber-400 text-amber-950');
            $bar.find('.campaign-message').html(
                '<strong>আপনি <span class="campaign-amount">' + status.subtotal_text + '</span> টাকার প্রোডাক্ট যুক্ত করেছেন, অর্ডার করতে আরও <span class="campaign-amount">' + status.remaining_text + '</span> টাকার পণ্য যোগ করুন।</strong>'
            );
        }
    }

    function showCampaignWarning(message) {
        var $bar = $('#fastest-fj-campaign-bar');
        if ($bar.length) {
            $bar.stop(true, true).removeClass('hidden').hide().fadeIn(200);
            $bar.removeClass('bg-amber-400 bg-green-600 text-amber-950').addClass('bg-red-600 text-white');
            $bar.find('.campaign-message').html('⚠️ <strong>' + $('<div>').text(message).html() + '</strong>');
            return;
        }
        var $notice = $('<div class="fixed bottom-5 left-1/2 z-[110] w-[calc(100%-2rem)] max-w-xl -translate-x-1/2 rounded bg-red-600 px-5 py-3 text-center font-semibold text-white shadow-lg"></div>').text(message);
        $('body').append($notice);
        setTimeout(function() { $notice.fadeOut(250, function() { $(this).remove(); }); }, 4000);
    }

    function playCampaignJoySound() {
        var AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        var context = new AudioContext();
        [523.25, 659.25, 783.99].forEach(function(frequency, index) {
            var oscillator = context.createOscillator();
            var gain = context.createGain();
            oscillator.connect(gain);
            gain.connect(context.destination);
            oscillator.frequency.value = frequency;
            gain.gain.setValueAtTime(0.0001, context.currentTime + index * 0.11);
            gain.gain.exponentialRampToValueAtTime(0.16, context.currentTime + index * 0.11 + 0.02);
            gain.gain.exponentialRampToValueAtTime(0.0001, context.currentTime + index * 0.11 + 0.28);
            oscillator.start(context.currentTime + index * 0.11);
            oscillator.stop(context.currentTime + index * 0.11 + 0.3);
        });
    }

    function showCampaignCelebration(totalText) {
        $('#fastest-fj-campaign-celebration').remove();
        var confetti = '';
        for (var i = 0; i < 28; i++) {
            confetti += '<i style="--x:' + (Math.random() * 100) + '%;--delay:' + (Math.random() * 0.5) + 's;--color:' + ['#fbbf24', '#22c55e', '#ec4899', '#38bdf8', '#ffffff'][i % 5] + '"></i>';
        }
        var $celebration = $(
            '<div id="fastest-fj-campaign-celebration" role="status">' +
                '<div class="campaign-celebration-flash"></div>' +
                '<div class="campaign-confetti">' + confetti + '</div>' +
                '<div class="campaign-celebration-card">' +
                    '<div class="campaign-celebration-icon">🎉</div>' +
                    '<strong>অভিনন্দন!</strong>' +
                    '<span>আপনি <b>' + totalText + '</b> টাকার অর্ডার পূর্ণ করেছেন</span>' +
                '</div>' +
            '</div>'
        );
        $('body').append($celebration);
        setTimeout(function() { $celebration.addClass('is-leaving'); }, 2200);
        setTimeout(function() { $celebration.remove(); }, 2800);
    }

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
