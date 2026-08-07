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

  /* Counts a hero stat value up from 0 to its target, preserving the
     original string's decimal precision (e.g. "99.9" stays one decimal). */
  function animateHeroCount(el) {
    var original = el.getAttribute('data-hero-count');
    var target = parseFloat(original);
    if (isNaN(target)) return;

    var decimals = (original.split('.')[1] || '').length;
    var duration = 900;
    var start = performance.now();

    function tick(now) {
      var progress = Math.min((now - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = (eased * target).toFixed(decimals);
      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        el.textContent = original;
      }
    }
    requestAnimationFrame(tick);
  }

  /* Auto-rotating hero carousel (data-hero-carousel): crossfades slides,
     re-triggers each slide's staggered entrance animations and stat
     counters, drives Instagram-story-style progress dots, and offers a
     subtle mouse-parallax tilt on the dashboard visual. Respects
     prefers-reduced-motion and hover-incapable (touch) devices. */
  function initHeroCarousel() {
    var root = document.querySelector('[data-hero-carousel]');
    if (!root) return;

    var slides = Array.prototype.slice.call(root.querySelectorAll('.hc-slide'));
    var dots = Array.prototype.slice.call(root.querySelectorAll('[data-hero-goto]'));
    var prevBtn = root.querySelector('[data-hero-prev]');
    var nextBtn = root.querySelector('[data-hero-next]');
    if (slides.length < 2) return;

    var current = 0;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var canHover = window.matchMedia('(hover: hover)').matches;
    var intervalMs = 6500;
    var transitionMs = 400;
    var timer = null;
    var transitioning = false;

    function runCounters(slide) {
      if (reduceMotion) return;
      var values = slide.querySelectorAll('[data-hero-count]');
      values.forEach(function (el) { animateHeroCount(el); });
    }

    function updateDots(newIndex) {
      dots.forEach(function (dot, i) {
        dot.classList.toggle('active', i === newIndex);
        dot.classList.toggle('hc-nav-filled', i < newIndex);
      });
    }

    function goTo(index) {
      var newIndex = (index + slides.length) % slides.length;
      if (transitioning || newIndex === current) return;

      var oldSlide = slides[current];
      var newSlide = slides[newIndex];
      transitioning = true;

      if (reduceMotion) {
        oldSlide.classList.remove('active');
        newSlide.classList.add('active');
        current = newIndex;
        updateDots(current);
        runCounters(newSlide);
        transitioning = false;
        return;
      }

      oldSlide.classList.add('hc-leaving');
      window.setTimeout(function () {
        oldSlide.classList.remove('active', 'hc-leaving');
        newSlide.classList.add('active');
        current = newIndex;
        updateDots(current);
        runCounters(newSlide);
        transitioning = false;
      }, transitionMs);
    }

    function next() { goTo(current + 1); }
    function prev() { goTo(current - 1); }

    function start() {
      if (reduceMotion) return;
      stop();
      timer = window.setInterval(next, intervalMs);
    }
    function stop() {
      if (timer) { window.clearInterval(timer); timer = null; }
    }

    dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () { goTo(i); start(); });
    });
    prevBtn && prevBtn.addEventListener('click', function () { prev(); start(); });
    nextBtn && nextBtn.addEventListener('click', function () { next(); start(); });

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);
    root.addEventListener('focusin', stop);
    root.addEventListener('focusout', start);

    if (canHover && !reduceMotion) {
      root.addEventListener('mousemove', function (e) {
        var card = root.querySelector('.hc-slide.active .hc-card');
        if (!card) return;
        var rect = card.getBoundingClientRect();
        var x = (e.clientX - rect.left) / rect.width - 0.5;
        var y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = 'perspective(1000px) rotateX(' + (y * -8).toFixed(2) + 'deg) rotateY(' + (x * 8).toFixed(2) + 'deg)';
      });
      root.addEventListener('mouseleave', function () {
        var card = root.querySelector('.hc-card');
        if (card) card.style.transform = '';
      });
    }

    runCounters(slides[0]);
    start();
  }

  document.addEventListener('DOMContentLoaded', function () {
    initCounters();
    initAjaxForms();
    initHeroCarousel();
  });
})();
