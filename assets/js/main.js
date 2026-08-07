/**
 * Muskiforge — global front-end behaviour.
 * No build step: plain ES modules-free JS, loaded after Bootstrap's bundle.
 */
(function () {
  'use strict';

  /* Animated stat counters, triggered once each enters the viewport. */
  function initCounters() {
    var counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    var animate = function (el) {
      var target = parseInt(el.getAttribute('data-counter'), 10) || 0;
      var suffix = el.getAttribute('data-suffix') || '';
      var duration = 1400;
      var start = performance.now();

      function tick(now) {
        var progress = Math.min((now - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.round(eased * target) + suffix;
        if (progress < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    };

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animate(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { observer.observe(el); });
  }

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

  document.addEventListener('DOMContentLoaded', function () {
    initCounters();
    initAjaxForms();
  });
})();
