/**
 * Muskiforge — global front-end behaviour.
 * No build step: plain ES modules-free JS, loaded after Bootstrap's bundle.
 */
(function () {
  'use strict';

  /* Generic "submit via fetch, show inline status" handler for forms
     tagged data-ajax-form, used by the contact and newsletter forms. */
  function initAjaxForms() {
    var forms = document.querySelectorAll('[data-ajax-form]');

    forms.forEach(function (form) {
      var statusEl = form.querySelector('[data-form-status]');
      var submitBtn = form.querySelector('button[type="submit"]');

      form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.dataset.originalText = submitBtn.dataset.originalText || submitBtn.textContent;
          submitBtn.textContent = 'Sending…';
        }

        fetch(form.action, {
          method: 'POST',
          body: new FormData(form),
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        })
          .then(function (res) { return res.json(); })
          .then(function (data) {
            if (statusEl) {
              statusEl.textContent = data.message || (data.success ? 'Thank you!' : 'Something went wrong.');
              statusEl.className = 'form-status mt-2 ' + (data.success ? 'text-success' : 'text-danger');
            }
            if (data.success) form.reset();
          })
          .catch(function () {
            if (statusEl) {
              statusEl.textContent = 'Network error — please try again.';
              statusEl.className = 'form-status mt-2 text-danger';
            }
          })
          .finally(function () {
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.textContent = submitBtn.dataset.originalText;
            }
          });
      });
    });
  }

  /* Scroll-reveal: tags common content blocks with .reveal (see style.css)
     and flips them to .is-visible as they enter the viewport. Skipped
     entirely for prefers-reduced-motion so nothing is ever hidden from
     users who've asked for reduced motion. */
  function initScrollReveal() {
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced || !('IntersectionObserver' in window)) return;

    var selector = [
      '.card-service', '.card-why', '.testimonial-card',
      '.stat-panel', '.quote-panel', '.portfolio-card',
      '.blog-block', '.service-panel', '.process-step',
      '.tech-badge', '.accordion-item'
    ].join(',');

    var groups = {};
    document.querySelectorAll(selector).forEach(function (el) {
      var parent = el.parentElement;
      var key = parent ? Array.prototype.indexOf.call(document.querySelectorAll('section'), el.closest('section')) : 0;
      groups[key] = groups[key] || 0;
      el.classList.add('reveal');
      el.style.setProperty('--reveal-i', Math.min(groups[key], 6));
      groups[key]++;
    });

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach(function (el) {
      observer.observe(el);
    });
  }

  /* Client-side category filter for the portfolio grid (data-filter /
     data-category pairing set in portfolio.php). No-ops on other pages. */
  function initPortfolioFilter() {
    var buttons = document.querySelectorAll('.portfolio-filter-btn');
    var items = document.querySelectorAll('.portfolio-item');
    var emptyState = document.getElementById('portfolioEmpty');
    if (!buttons.length || !items.length) return;

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        buttons.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var filter = btn.dataset.filter;
        var visibleCount = 0;
        items.forEach(function (item) {
          var match = filter === 'all' || item.dataset.category === filter;
          item.classList.toggle('is-hidden', !match);
          if (match) visibleCount++;
        });
        if (emptyState) emptyState.classList.toggle('d-none', visibleCount !== 0);
      });
    });
  }

  /* Services dropdown: click-only (no :hover), same .has-dropdown/.open
     mechanism drives both the desktop flyout and the mobile in-page
     sublist, so there's one code path instead of two. */
  function initNavDropdown() {
    var items = document.querySelectorAll('.nav-menu .has-dropdown');
    if (!items.length) return;

    function closeAll(except) {
      items.forEach(function (item) {
        if (item === except) return;
        item.classList.remove('open');
        var toggle = item.querySelector(':scope > a');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
      });
    }

    items.forEach(function (item) {
      var toggle = item.querySelector(':scope > a');
      if (!toggle) return;

      toggle.addEventListener('click', function (event) {
        event.preventDefault();
        var isOpen = item.classList.contains('open');
        closeAll(item);
        item.classList.toggle('open', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
      });
    });

    document.addEventListener('click', function (event) {
      if (!event.target.closest('.has-dropdown')) closeAll();
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeAll();
    });
  }

  /* Hamburger: toggles the fixed slide-in .nav-menu (see RESPONSIVE in
     style.css), the dimmed .mobile-overlay behind it, and the bars-to-X
     icon animation — plain class toggles, no Bootstrap plugin involved. */
  function initMobileMenu() {
    var button = document.getElementById('hamburgerBtn');
    var menu = document.getElementById('navMenu');
    var overlay = document.getElementById('mobileOverlay');
    if (!button || !menu || !overlay) return;

    function close() {
      button.classList.remove('open');
      menu.classList.remove('open');
      overlay.classList.remove('show');
      button.setAttribute('aria-expanded', 'false');
    }

    button.addEventListener('click', function () {
      var isOpen = menu.classList.contains('open');
      button.classList.toggle('open', !isOpen);
      menu.classList.toggle('open', !isOpen);
      overlay.classList.toggle('show', !isOpen);
      button.setAttribute('aria-expanded', String(!isOpen));
    });

    overlay.addEventListener('click', close);
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') close();
    });

    /* A plain (non-dropdown) link tapped inside the open mobile panel
       should close it, same as any standard mobile nav. */
    menu.querySelectorAll('li:not(.has-dropdown) > a').forEach(function (link) {
      link.addEventListener('click', close);
    });
  }

  /* .navbar is position:sticky; .scrolled (see style.css) just deepens
     its shadow once the page has actually scrolled, so it reads as
     "landed" rather than floating over the very top of the page. */
  function initNavbarScrollState() {
    var header = document.getElementById('siteHeader');
    if (!header) return;

    var ticking = false;
    function apply() {
      header.classList.toggle('scrolled', window.scrollY > 8);
      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(apply);
    }, { passive: true });

    apply();
  }

  document.addEventListener('DOMContentLoaded', function () {
    initAjaxForms();
    initScrollReveal();
    initPortfolioFilter();
    initNavDropdown();
    initMobileMenu();
    initNavbarScrollState();
  });
})();
