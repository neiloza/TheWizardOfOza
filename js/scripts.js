/**
 * The Wizard of Oza - Main JavaScript
 */

(function ($) {
    'use strict';

    // Mobile Menu Toggle
    $('.menu-toggle').on('click', function () {
        $(this).toggleClass('active');
        $('.nav-menu').toggleClass('active');
        $('body').toggleClass('menu-open');
        $(this).attr('aria-expanded', $(this).hasClass('active'));
    });

    // Close menu when clicking outside
    $(document).on('click', function (event) {
        if (!$(event.target).closest('nav').length) {
            $('.menu-toggle').removeClass('active').attr('aria-expanded', false);
            $('.nav-menu').removeClass('active');
            $('body').removeClass('menu-open');
        }
    });

    // Close menu when clicking a menu link
    $('.nav-menu a').on('click', function () {
        $('.menu-toggle').removeClass('active').attr('aria-expanded', false);
        $('.nav-menu').removeClass('active');
        $('body').removeClass('menu-open');
    });

    // Smooth Scrolling for anchor links
    $('a[href^="#"]').on('click', function (event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({ scrollTop: target.offset().top - 100 }, 800);
        }
    });

    // Magical Sparkle Effect
    function createSparkle(x, y) {
        var sparkle = $('<div class="sparkle">✨</div>');
        sparkle.css({
            left: x + 'px',
            top: y + 'px',
            position: 'fixed',
            fontSize: Math.random() * 20 + 10 + 'px',
            zIndex: 9999
        });
        $('body').append(sparkle);
        setTimeout(function () { sparkle.remove(); }, 3000);
    }

    $('.cta-button, .card, .portfolio-item, .chronicle-card').on('click', function (e) {
        createSparkle(e.pageX - 10, e.pageY - 10);
    });

    // Intersection Observer fade-in animations
    if ('IntersectionObserver' in window) {
        var animateOnScroll = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        $('.card, .chronicle-card, .portfolio-item').each(function () {
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(30px)',
                'transition': 'opacity 0.6s ease, transform 0.6s ease'
            });
            animateOnScroll.observe(this);
        });
    }

    // Show contact success/error messages from URL params
    var params = new URLSearchParams(window.location.search);
    if (params.get('contact') === 'success') {
        $('#contact-success').show();
    }
    if (params.get('contact') === 'error') {
        $('#contact-error').show();
    }
    if (params.get('bulletin') === 'success') {
        $('#bulletin-success').show();
    }

    // Pre-select subject dropdown from URL param
    var subject = params.get('subject');
    if (subject) {
        $('#contact_subject').val(subject);
    }

    // Random floating particles
    function createFloatingParticle() {
        var particle = $('<div style="position:fixed;width:3px;height:3px;background:rgba(37,99,235,0.3);border-radius:50%;pointer-events:none;z-index:1;"></div>');
        var startX = Math.random() * window.innerWidth;
        var duration = Math.random() * 10000 + 10000;
        var endX = startX + (Math.random() - 0.5) * 200;
        particle.css({ left: startX + 'px', top: (window.innerHeight + 50) + 'px' });
        $('body').append(particle);
        particle.animate({ top: -50, left: endX, opacity: 0 }, duration, 'linear', function () {
            $(this).remove();
        });
    }

    setInterval(createFloatingParticle, 3000);

    $(window).on('load', function () { $('.loader').fadeOut('slow'); });

    console.log('%c✨ Welcome to The Wizard of Oza! ✨', 'color: #f59e0b; font-size: 20px; font-weight: bold;');
    console.log('%cLooking for something magical? Check out the source code!', 'color: #6b46c1; font-size: 14px;');

})(jQuery);
