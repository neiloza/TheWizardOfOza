/**
 * The Wizard of Oza — main JavaScript
 */

(function ($) {
    'use strict';

    var $nav = $('.main-navigation');
    var $toggle = $('.menu-toggle');
    var $menu = $('.nav-menu');

    function closeMenu() {
        $toggle.removeClass('active').attr('aria-expanded', 'false');
        $menu.removeClass('active');
        $('body').removeClass('menu-open');
    }

    // Mobile sidebar
    $toggle.on('click', function (event) {
        event.stopPropagation();
        var open = !$(this).hasClass('active');
        $(this).toggleClass('active', open).attr('aria-expanded', String(open));
        $menu.toggleClass('active', open);
        $('body').toggleClass('menu-open', open);
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest('nav').length) {
            closeMenu();
        }
    });

    $(document).on('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });

    $('.nav-menu a').on('click', closeMenu);

    // Condense the navigation bar once the page scrolls
    function onScroll() {
        $nav.toggleClass('is-scrolled', window.scrollY > 40);
    }

    $(window).on('scroll', onScroll);
    onScroll();

    // Smooth scrolling for in-page anchors
    $('a[href^="#"]').on('click', function (event) {
        var hash = this.getAttribute('href');
        if (hash === '#' || hash.length < 2) {
            return;
        }
        var target = $(hash);
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({ scrollTop: target.offset().top - 120 }, 700);
        }
    });

    // Reveal on scroll
    var $reveals = $('.reveal');
    if ('IntersectionObserver' in window && $reveals.length) {
        document.documentElement.classList.add('reveal-ready');
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

        $reveals.each(function (index) {
            this.style.transitionDelay = Math.min(index % 6, 5) * 70 + 'ms';
            observer.observe(this);
        });
    }

    // Form success messages driven by the ?contact= / ?bulletin= query strings
    var params = new URLSearchParams(window.location.search);

    if (params.get('contact') === 'success') {
        $('#contact-success').removeClass('hidden');
    }

    if (params.get('bulletin') === 'success') {
        $('#bulletin-success').removeClass('hidden');
    }

    // Pre-select a subject when arriving from the Incantations page
    var subject = params.get('subject');
    if (subject) {
        $('#contact_subject option').each(function () {
            if (this.value.toLowerCase() === subject.replace(/\+/g, ' ').toLowerCase()) {
                this.selected = true;
            }
        });
    }

    // Keep the footer year current
    $('[data-year]').text(new Date().getFullYear());
})(jQuery);
