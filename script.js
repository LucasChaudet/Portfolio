(function () {
    'use strict';

    /* Année courante dans le footer */
    var yearEl = document.getElementById('year');
    if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
    }

    /* Menu mobile */
    var navToggle = document.getElementById('navToggle');
    var mainNav = document.getElementById('mainNav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            var isOpen = mainNav.classList.toggle('is-open');
            navToggle.classList.toggle('is-active', isOpen);
            navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        mainNav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                mainNav.classList.remove('is-open');
                navToggle.classList.remove('is-active');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* Thème clair / sombre, mémorisé dans localStorage */
    var themeToggle = document.getElementById('themeToggle');
    var THEME_KEY = 'portfolio-theme';

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        if (themeToggle) {
            var icon = themeToggle.querySelector('.theme-icon');
            if (icon) {
                icon.textContent = theme === 'light' ? '☀️' : '🌙';
            }
        }
    }

    var storedTheme = null;
    try {
        storedTheme = localStorage.getItem(THEME_KEY);
    } catch (e) {
        storedTheme = null;
    }

    var prefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
    applyTheme(storedTheme || (prefersLight ? 'light' : 'dark'));

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            var current = document.documentElement.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
            var next = current === 'light' ? 'dark' : 'light';
            applyTheme(next);
            try {
                localStorage.setItem(THEME_KEY, next);
            } catch (e) {
                /* stockage indisponible (navigation privée) : on ignore */
            }
        });
    }

    /* Animation d'apparition au scroll */
    var revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length) {
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            revealEls.forEach(function (el) {
                observer.observe(el);
            });
        } else {
            revealEls.forEach(function (el) {
                el.classList.add('is-visible');
            });
        }
    }

    /* Bouton retour en haut */
    var backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.classList.toggle('is-visible', window.scrollY > 400);
        });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* Validation en direct du formulaire de contact */
    var contactForm = document.getElementById('contact-form');
    if (contactForm) {
        var fields = {
            name: { el: document.getElementById('name'), message: 'Merci de renseigner votre nom (2 caractères minimum).' },
            email: { el: document.getElementById('email'), message: 'Merci de renseigner une adresse e-mail valide.' },
            subject: { el: document.getElementById('subject'), message: 'Merci de renseigner un sujet.' },
            message: { el: document.getElementById('message'), message: 'Votre message doit contenir au moins 10 caractères.' }
        };

        function showFieldError(field, text) {
            var row = field.el.closest('.form-row');
            if (!row) return;
            var existing = row.querySelector('.field-error');
            if (text) {
                if (!existing) {
                    existing = document.createElement('span');
                    existing.className = 'field-error';
                    row.appendChild(existing);
                }
                existing.textContent = text;
            } else if (existing) {
                existing.remove();
            }
        }

        function validateField(key) {
            var field = fields[key];
            if (!field.el) return true;
            var valid = field.el.checkValidity();
            showFieldError(field, valid ? '' : field.message);
            return valid;
        }

        Object.keys(fields).forEach(function (key) {
            var field = fields[key];
            if (!field.el) return;
            field.el.addEventListener('blur', function () {
                validateField(key);
            });
        });

        var formSuccess = document.getElementById('formSuccess');

        contactForm.addEventListener('submit', function (event) {
            event.preventDefault();

            var allValid = Object.keys(fields).every(validateField);
            if (!allValid) {
                var firstInvalid = Object.keys(fields)
                    .map(function (key) { return fields[key]; })
                    .find(function (field) { return field.el && !field.el.checkValidity(); });
                if (firstInvalid) {
                    firstInvalid.el.focus();
                }
                return;
            }

            var name = fields.name.el.value.trim();
            var email = fields.email.el.value.trim();
            var subject = fields.subject.el.value.trim();
            var message = fields.message.el.value.trim();

            var body = 'Nom : ' + name + '\nE-mail : ' + email + '\n\n' + message;
            var mailtoUrl = 'mailto:chaudetlucas@gmail.com'
                + '?subject=' + encodeURIComponent('[Portfolio] ' + subject)
                + '&body=' + encodeURIComponent(body);

            window.location.href = mailtoUrl;

            if (formSuccess) {
                formSuccess.hidden = false;
            }
            contactForm.reset();
        });
    }
})();
