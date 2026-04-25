/**
 * fastest_fj Main JavaScript
 */

(function($) {
    'use strict';

    // Mobile Menu
    var mobileMenuBtn = document.getElementById('mobileMenuBtn');
    var mobileMenu = document.getElementById('mobileMenu');
    var mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    var closeMobileMenu = document.getElementById('closeMobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.add('open');
            if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    }

    if (closeMobileMenu && mobileMenu) {
        closeMobileMenu.addEventListener('click', function() {
            mobileMenu.classList.remove('open');
            if (mobileMenuOverlay) mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }

    if (mobileMenuOverlay && mobileMenu) {
        mobileMenuOverlay.addEventListener('click', function() {
            mobileMenu.classList.remove('open');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }

    // Scroll to Top
    var scrollTopBtn = document.getElementById('scrollTop');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Filter Sidebar (Mobile)
    var filterToggle = document.getElementById('filterToggle');
    var filterSidebar = document.getElementById('filterSidebar');
    var closeFilter = document.getElementById('closeFilter');

    if (filterToggle && filterSidebar) {
        filterToggle.addEventListener('click', function() {
            filterSidebar.classList.add('open');
        });
    }
    if (closeFilter && filterSidebar) {
        closeFilter.addEventListener('click', function() {
            filterSidebar.classList.remove('open');
        });
    }

    // Product Gallery Thumbnails
    $(document).on('click', '.thumbnail', function(e) {
        e.preventDefault();
        var newSrc = $(this).data('image');
        $('#main-product-image').attr('src', newSrc);
        $('.thumbnail').removeClass('active').addClass('border-transparent').removeClass('border-brand-gold');
        $(this).addClass('active').removeClass('border-transparent').addClass('border-brand-gold');
    });

    // Product Tabs
    $(document).on('click', '.tab-btn', function(e) {
        e.preventDefault();
        var target = $(this).data('tab');
        $('.tab-content').addClass('hidden');
        $('#tab-' + target).removeClass('hidden');
        $('.tab-btn').removeClass('active').addClass('text-gray-500');
        $(this).addClass('active').removeClass('text-gray-500');
    });

    // Sticky Header Shadow on Scroll
    $(window).on('scroll', function() {
        var header = $('#masthead');
        if ($(window).scrollTop() > 10) {
            header.addClass('shadow-md');
        } else {
            header.removeClass('shadow-md');
        }
    });

    // Smooth Scroll for Anchor Links
    $('a[href*="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 600);
        }
    });

    // Lazy Loading Images
    if ('IntersectionObserver' in window) {
        var lazyImages = document.querySelectorAll('img[data-src]');
        var imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    }

    // Newsletter Form AJAX
    $(document).on('submit', '.newsletter-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var email = form.find('input[name="email"]').val();
        var button = form.find('button[type="submit"]');
        var originalText = button.text();

        button.prop('disabled', true).text(fastest_fj_ajax.strings.added_to_cart || '...');

        $.ajax({
            url: fastest_fj_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fastest_fj_newsletter_subscribe',
                email: email,
                nonce: fastest_fj_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    form.html('<p class="text-green-600 font-semibold text-center">' + response.data.message + '</p>');
                } else {
                    button.prop('disabled', false).text(originalText);
                    alert(response.data.message || 'Something went wrong. Please try again.');
                }
            },
            error: function() {
                button.prop('disabled', false).text(originalText);
                alert('Something went wrong. Please try again.');
            }
        });
    });

})(jQuery);
