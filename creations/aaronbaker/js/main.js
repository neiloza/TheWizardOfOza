/**
 * Aaron Baker Campaign Theme — Main JavaScript
 * Handles: mobile nav, sticky header, email popup, cookie consent,
 *          AJAX forms, smooth scroll, animations
 */
(function () {
  'use strict';

  /* ============================================================
   * UTILITY HELPERS
   * ============================================================ */
  function setCookie(name, value, days) {
    var d = new Date();
    d.setTime(d.getTime() + days * 86400000);
    document.cookie = name + '=' + value + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax';
  }

  function getCookie(name) {
    var v = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
    return v ? v.pop() : '';
  }

  function debounce(fn, wait) {
    var t;
    return function () {
      clearTimeout(t);
      t = setTimeout(fn, wait);
    };
  }

  /* ============================================================
   * STICKY HEADER — shrink on scroll
   * ============================================================ */
  function initStickyHeader() {
    var header = document.querySelector('.site-header');
    if (!header) return;

    var scrolled = false;
    var threshold = 60;

    function onScroll() {
      var y = window.pageYOffset || document.documentElement.scrollTop;
      if (y > threshold && !scrolled) {
        scrolled = true;
        header.classList.add('header--scrolled');
      } else if (y <= threshold && scrolled) {
        scrolled = false;
        header.classList.remove('header--scrolled');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ============================================================
   * MOBILE NAVIGATION
   * ============================================================ */
  function initMobileNav() {
    var toggle = document.querySelector('.mobile-nav-toggle');
    var drawer = document.querySelector('.nav-drawer');
    var overlay = document.querySelector('.nav-overlay');
    var body = document.body;

    if (!toggle || !drawer) return;

    // Create overlay if it doesn't exist
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.className = 'nav-overlay';
      document.body.appendChild(overlay);
    }

    function openNav() {
      drawer.classList.add('nav-drawer--open');
      overlay.classList.add('nav-overlay--visible');
      body.classList.add('nav-open');
      toggle.setAttribute('aria-expanded', 'true');
      toggle.innerHTML = '✕';
    }

    function closeNav() {
      drawer.classList.remove('nav-drawer--open');
      overlay.classList.remove('nav-overlay--visible');
      body.classList.remove('nav-open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.innerHTML = '<span></span><span></span><span></span>';
    }

    toggle.addEventListener('click', function () {
      var isOpen = drawer.classList.contains('nav-drawer--open');
      isOpen ? closeNav() : openNav();
    });

    overlay.addEventListener('click', closeNav);

    // Close on link click
    drawer.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeNav);
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeNav();
    });
  }

  /* ============================================================
   * EMAIL POPUP — shows once after delay
   * ============================================================ */
  function initEmailPopup() {
    var popup = document.getElementById('email-popup');
    if (!popup) return;

    // Don't show if already dismissed
    if (getCookie('ab_popup_dismissed') === '1') return;

    var closeBtn = popup.querySelector('.popup-close');
    var form = popup.querySelector('.popup-form');

    function showPopup() {
      popup.classList.add('popup--visible');
      document.body.classList.add('popup-open');
    }

    function hidePopup() {
      popup.classList.remove('popup--visible');
      document.body.classList.remove('popup-open');
      setCookie('ab_popup_dismissed', '1', 14); // Don't show for 14 days
    }

    // Show after 7 seconds
    setTimeout(showPopup, 7000);

    if (closeBtn) closeBtn.addEventListener('click', hidePopup);

    // Close on overlay click
    popup.addEventListener('click', function (e) {
      if (e.target === popup) hidePopup();
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && popup.classList.contains('popup--visible')) hidePopup();
    });

    // Handle popup form submission
    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var emailInput = form.querySelector('input[type="email"]');
        if (!emailInput || !emailInput.value) return;

        submitEmailSignup(emailInput.value, form, function () {
          var formArea = popup.querySelector('.popup-form-area');
          if (formArea) {
            formArea.innerHTML = '<div class="form-success"><p style="font-size:1.25rem;font-weight:700;color:var(--navy);">Welcome aboard! 🇺🇸</p><p style="margin-top:8px;color:var(--text-mid);">Thank you for joining the campaign.</p></div>';
          }
          setTimeout(hidePopup, 3000);
        });
      });
    }
  }

  /* ============================================================
   * COOKIE CONSENT BANNER
   * ============================================================ */
  function initCookieBanner() {
    var banner = document.getElementById('cookie-banner');
    if (!banner) return;
    if (getCookie('ab_cookies_accepted') === '1') {
      banner.remove();
      return;
    }

    banner.style.display = 'flex';

    var acceptBtn = banner.querySelector('.cookie-accept');
    if (acceptBtn) {
      acceptBtn.addEventListener('click', function () {
        setCookie('ab_cookies_accepted', '1', 365);
        banner.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
        banner.style.transform = 'translateY(100%)';
        banner.style.opacity = '0';
        setTimeout(function () { banner.remove(); }, 300);
      });
    }
  }

  /* ============================================================
   * AJAX EMAIL SIGNUP (footer + inline forms)
   * ============================================================ */
  function submitEmailSignup(email, form, onSuccess) {
    var btn = form.querySelector('button[type="submit"]');
    var origText = btn ? btn.textContent : 'Join';

    if (btn) {
      btn.disabled = true;
      btn.textContent = 'Joining…';
    }

    var formData = new FormData();
    formData.append('action', 'ab_email_signup');
    formData.append('nonce', abData.nonce);
    formData.append('email', email);

    fetch(abData.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      body: formData
    })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (data.success) {
          if (typeof onSuccess === 'function') onSuccess();
          else {
            form.innerHTML = '<p class="form-success" style="color:var(--green,#2a7d2e);font-weight:600;">✓ You\'re on the list! Thank you.</p>';
          }
        } else {
          showFormError(form, data.data || 'Something went wrong. Please try again.');
          if (btn) { btn.disabled = false; btn.textContent = origText; }
        }
      })
      .catch(function () {
        showFormError(form, 'Network error. Please try again.');
        if (btn) { btn.disabled = false; btn.textContent = origText; }
      });
  }

  function initEmailForms() {
    document.querySelectorAll('.email-form').forEach(function (form) {
      // Skip popup form (handled separately)
      if (form.closest('#email-popup')) return;

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var emailInput = form.querySelector('input[type="email"]');
        if (!emailInput || !emailInput.value) return;
        submitEmailSignup(emailInput.value, form);
      });
    });
  }

  /* ============================================================
   * CONTACT FORM
   * ============================================================ */
  function initContactForm() {
    var form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var btn = form.querySelector('button[type="submit"]');
      var origText = btn ? btn.textContent : 'Send';
      if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }

      var formData = new FormData(form);
      formData.append('action', 'ab_contact_form');
      formData.append('nonce', abData.nonce);

      fetch(abData.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            form.innerHTML = '<div class="form-success" style="text-align:center;padding:40px 0;"><p style="font-size:1.25rem;font-weight:700;color:var(--navy);">Message Sent!</p><p style="margin-top:8px;color:var(--text-mid);">Thank you for reaching out. We\'ll respond as soon as possible.</p></div>';
          } else {
            showFormError(form, data.data || 'Something went wrong.');
            if (btn) { btn.disabled = false; btn.textContent = origText; }
          }
        })
        .catch(function () {
          showFormError(form, 'Network error. Please try again.');
          if (btn) { btn.disabled = false; btn.textContent = origText; }
        });
    });
  }

  /* ============================================================
   * VOLUNTEER FORM
   * ============================================================ */
  function initVolunteerForm() {
    var form = document.getElementById('volunteer-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var btn = form.querySelector('button[type="submit"]');
      var origText = btn ? btn.textContent : 'Sign Up';
      if (btn) { btn.disabled = true; btn.textContent = 'Submitting…'; }

      var formData = new FormData(form);
      formData.append('action', 'ab_volunteer_form');
      formData.append('nonce', abData.nonce);

      // Collect checkbox values for interests
      var interests = [];
      form.querySelectorAll('input[name="interests[]"]:checked').forEach(function (cb) {
        interests.push(cb.value);
      });
      formData.delete('interests[]');
      formData.append('interests', interests.join(', '));

      fetch(abData.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            form.innerHTML = '<div class="form-success" style="text-align:center;padding:40px 0;"><p style="font-size:1.25rem;font-weight:700;color:var(--navy);">You\'re In! 🇺🇸</p><p style="margin-top:8px;color:var(--text-mid);">Welcome to Team Baker. We\'ll be in touch with next steps.</p></div>';
          } else {
            showFormError(form, data.data || 'Something went wrong.');
            if (btn) { btn.disabled = false; btn.textContent = origText; }
          }
        })
        .catch(function () {
          showFormError(form, 'Network error. Please try again.');
          if (btn) { btn.disabled = false; btn.textContent = origText; }
        });
    });
  }

  /* ============================================================
   * EVENT REQUEST FORM
   * ============================================================ */
  function initEventRequestForm() {
    var form = document.getElementById('event-request-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var btn = form.querySelector('button[type="submit"]');
      var origText = btn ? btn.textContent : 'Submit Request';
      if (btn) { btn.disabled = true; btn.textContent = 'Submitting…'; }

      var formData = new FormData(form);
      formData.append('action', 'ab_contact_form');
      formData.append('nonce', abData.nonce);
      // Re-use contact handler — prepend subject
      formData.set('subject', 'Event Request: ' + (formData.get('event_name') || 'New Event'));

      fetch(abData.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            form.innerHTML = '<div class="form-success" style="text-align:center;padding:32px 0;"><p style="font-size:1.125rem;font-weight:700;color:var(--navy);">Request Received!</p><p style="margin-top:8px;color:var(--text-mid);">We\'ll review your event request and follow up soon.</p></div>';
          } else {
            showFormError(form, data.data || 'Something went wrong.');
            if (btn) { btn.disabled = false; btn.textContent = origText; }
          }
        })
        .catch(function () {
          showFormError(form, 'Network error. Please try again.');
          if (btn) { btn.disabled = false; btn.textContent = origText; }
        });
    });
  }

  /* ============================================================
   * FORM ERROR HELPER
   * ============================================================ */
  function showFormError(form, msg) {
    // Remove existing error
    var existing = form.querySelector('.form-error');
    if (existing) existing.remove();

    var div = document.createElement('div');
    div.className = 'form-error';
    div.style.cssText = 'color:#c41230;background:#fff0f0;padding:12px 16px;border-radius:6px;margin-top:12px;font-size:0.9rem;';
    div.textContent = msg;
    form.appendChild(div);

    setTimeout(function () {
      if (div.parentNode) div.remove();
    }, 6000);
  }

  /* ============================================================
   * SMOOTH SCROLL — anchor links
   * ============================================================ */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        var id = this.getAttribute('href');
        if (id === '#' || id.length < 2) return;

        var target = document.querySelector(id);
        if (target) {
          e.preventDefault();
          var headerH = document.querySelector('.site-header')
            ? document.querySelector('.site-header').offsetHeight
            : 0;
          var top = target.getBoundingClientRect().top + window.pageYOffset - headerH - 20;
          window.scrollTo({ top: top, behavior: 'smooth' });
        }
      });
    });
  }

  /* ============================================================
   * SCROLL REVEAL ANIMATIONS
   * ============================================================ */
  function initScrollReveal() {
    if (!('IntersectionObserver' in window)) return;

    var elements = document.querySelectorAll(
      '.issue-card, .news-card, .event-item, .value-card, .about-sidebar, .form-section, .donate-option'
    );

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.1, rootMargin: '0px 0px -40px 0px' }
    );

    elements.forEach(function (el) {
      el.classList.add('reveal-item');
      observer.observe(el);
    });
  }

  /* ============================================================
   * NEWSROOM CATEGORY FILTERS
   * ============================================================ */
  function initNewsFilters() {
    var filters = document.querySelectorAll('.news-filter-btn');
    if (!filters.length) return;

    filters.forEach(function (btn) {
      btn.addEventListener('click', function () {
        // Remove active state from all
        filters.forEach(function (f) { f.classList.remove('active'); });
        btn.classList.add('active');

        var cat = btn.getAttribute('data-category');
        var cards = document.querySelectorAll('.news-card[data-category]');

        cards.forEach(function (card) {
          if (cat === 'all' || card.getAttribute('data-category') === cat) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  /* ============================================================
   * BACK TO TOP BUTTON
   * ============================================================ */
  function initBackToTop() {
    var btn = document.createElement('button');
    btn.className = 'back-to-top';
    btn.innerHTML = '↑';
    btn.setAttribute('aria-label', 'Back to top');
    btn.style.cssText = 'position:fixed;bottom:24px;right:24px;width:48px;height:48px;border-radius:50%;background:var(--navy);color:#fff;border:none;font-size:20px;cursor:pointer;opacity:0;visibility:hidden;transition:all 0.3s ease;z-index:999;box-shadow:0 2px 12px rgba(0,0,0,0.2);';
    document.body.appendChild(btn);

    window.addEventListener('scroll', debounce(function () {
      if (window.pageYOffset > 500) {
        btn.style.opacity = '1';
        btn.style.visibility = 'visible';
      } else {
        btn.style.opacity = '0';
        btn.style.visibility = 'hidden';
      }
    }, 100), { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ============================================================
   * FORM VALIDATION — lightweight client-side
   * ============================================================ */
  function initFormValidation() {
    document.querySelectorAll('form[data-validate]').forEach(function (form) {
      form.addEventListener('submit', function (e) {
        var valid = true;
        form.querySelectorAll('[required]').forEach(function (input) {
          input.classList.remove('input-error');
          if (!input.value.trim()) {
            input.classList.add('input-error');
            valid = false;
          }
          if (input.type === 'email' && input.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
            input.classList.add('input-error');
            valid = false;
          }
        });
        if (!valid) {
          e.preventDefault();
          var first = form.querySelector('.input-error');
          if (first) first.focus();
        }
      });
    });
  }

  /* ============================================================
   * INITIALIZE EVERYTHING
   * ============================================================ */
  function init() {
    initStickyHeader();
    initMobileNav();
    initEmailPopup();
    initCookieBanner();
    initEmailForms();
    initContactForm();
    initVolunteerForm();
    initEventRequestForm();
    initSmoothScroll();
    initScrollReveal();
    initNewsFilters();
    initBackToTop();
    initFormValidation();
  }

  // Run on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
