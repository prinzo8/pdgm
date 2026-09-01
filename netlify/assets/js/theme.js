/* Design: calm micro-interactions, real actions only, keyboard-friendly modal behavior. */
(function(){'use strict';
 const header=document.querySelector('[data-header]');
 const toggle=document.querySelector('.menu-toggle'); const nav=document.querySelector('.primary-nav');
 const onScroll=()=>header&&header.classList.toggle('scrolled',window.scrollY>30); window.addEventListener('scroll',onScroll,{passive:true}); onScroll();
 if(toggle&&nav){toggle.addEventListener('click',()=>{const open=nav.classList.toggle('open');toggle.setAttribute('aria-expanded',String(open));});nav.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{nav.classList.remove('open');toggle.setAttribute('aria-expanded','false');}));}
 const revealElements=document.querySelectorAll('.reveal');
 if('IntersectionObserver' in window){
   const observer=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target)}}),{threshold:.14});
   revealElements.forEach(el=>observer.observe(el));
 }else{
   revealElements.forEach(el=>el.classList.add('visible'));
 }
 let lastFocus=null; const openModal=(name)=>{const modal=document.querySelector('[data-modal="'+name+'"]');if(!modal)return;lastFocus=document.activeElement;modal.hidden=false;document.body.style.overflow='hidden';const close=modal.querySelector('[data-modal-close]');if(close)close.focus();}; const closeModal=()=>{const modal=document.querySelector('.modal:not([hidden])');if(!modal)return;modal.hidden=true;document.body.style.overflow='';if(lastFocus)lastFocus.focus();};
 document.querySelectorAll('[data-modal-open]').forEach(b=>b.addEventListener('click',()=>openModal(b.dataset.modalOpen)));document.querySelectorAll('[data-modal-close]').forEach(b=>b.addEventListener('click',closeModal));document.addEventListener('keydown',e=>{if(e.key==='Escape')closeModal();});
 document.querySelectorAll('a[href^="#"]').forEach(a=>a.addEventListener('click',e=>{const id=a.getAttribute('href');if(id.length>1){const target=document.querySelector(id);if(target){e.preventDefault();target.scrollIntoView({behavior:'smooth',block:'start'});}}}));
 const dot=document.querySelector('.cursor-dot'),ring=document.querySelector('.cursor-ring');if(dot&&ring&&window.matchMedia('(pointer:fine)').matches){window.addEventListener('pointermove',e=>{dot.style.left=e.clientX+'px';dot.style.top=e.clientY+'px';ring.style.left=e.clientX+'px';ring.style.top=e.clientY+'px'});document.querySelectorAll('a,button').forEach(el=>{el.addEventListener('mouseenter',()=>ring.classList.add('hover'));el.addEventListener('mouseleave',()=>ring.classList.remove('hover'));});}
})();

/* Section back navigation */
document.addEventListener('DOMContentLoaded', function () {
    const sectionBack = document.querySelector('.section-back');

    if (!sectionBack) return;

    const sections = Array.from(
        document.querySelectorAll('main > section[id]')
    );

    if (!sections.length) return;

    const updateSectionBack = () => {
        const currentScroll = window.scrollY + (window.innerHeight * 0.35);
        let currentIndex = 0;

        sections.forEach((section, index) => {
            if (section.offsetTop <= currentScroll) {
                currentIndex = index;
            }
        });

        if (currentIndex >= 1) {
            sectionBack.classList.add('visible');
            sectionBack.dataset.previousSection = sections[currentIndex - 1].id;
        } else {
            sectionBack.classList.remove('visible');
            sectionBack.removeAttribute('data-previous-section');
        }
    };

    sectionBack.addEventListener('click', () => {
        const previousId = sectionBack.dataset.previousSection;

        if (!previousId) return;

        const previousSection = document.getElementById(previousId);

        if (previousSection) {
            previousSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });

    window.addEventListener('scroll', updateSectionBack, { passive: true });
    window.addEventListener('resize', updateSectionBack);

    updateSectionBack();
});

/* Site reading progress */
document.addEventListener('DOMContentLoaded', function () {
    const progressBar = document.querySelector('.site-progress-bar');

    if (!progressBar) return;

    const updateProgress = () => {
        const scrollTop = window.scrollY;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;

        const progress = scrollHeight > 0
            ? (scrollTop / scrollHeight) * 100
            : 0;

        progressBar.style.width = progress + '%';
    };

    window.addEventListener('scroll', updateProgress, { passive: true });
    window.addEventListener('resize', updateProgress);

    updateProgress();
});

/* =========================================
   Cookie settings — Complianz
   ========================================= */

document.addEventListener('click', function (event) {

    if (!trigger) return;

    event.preventDefault();

    /*
     * Complianz expose généralement cette fonction
     * pour rouvrir le panneau de préférences.
     */
    if (typeof cmplz_show_preferences === 'function') {
        cmplz_show_preferences();
        return;
    }

    /*
     * Fallback : clic sur le bouton de gestion
     * si Complianz utilise son interface standard.
     */
    const preferencesButton = document.querySelector(
    );

    if (preferencesButton) {
        preferencesButton.click();
    }
});


/* =========================================
   Custom cookie consent
   ========================================= */

document.addEventListener('DOMContentLoaded', function () {


    if (!banner) return;


    const settingsButtons = document.querySelectorAll(
    );

    function showBanner() {
        banner.hidden = false;

        requestAnimationFrame(function () {
            banner.classList.add('visible');
        });
    }

    function hideBanner() {
        banner.classList.remove('visible');

        setTimeout(function () {
            banner.hidden = true;
        }, 350);
    }

    function saveConsent(value) {
        localStorage.setItem(COOKIE_KEY, value);
        hideBanner();
    }

    /*
     * Affiche la bannière uniquement si aucun choix
     * n'a encore été enregistré.
     */
    if (!localStorage.getItem(COOKIE_KEY)) {
        showBanner();
    }

    if (acceptButton) {
        acceptButton.addEventListener('click', function () {
            saveConsent('accepted');
        });
    }

    if (refuseButton) {
        refuseButton.addEventListener('click', function () {
            saveConsent('refused');
        });
    }

    /*
     * Le bouton "Paramétrer" permet de rouvrir
     * la bannière après un choix précédent.
     */
    settingsButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();

            showBanner();
        });

    });

});


/* =========================================
   PGM — Cookie consent
   ========================================= */

document.addEventListener('DOMContentLoaded', function () {


    if (!banner) return;



    const footerSettings = document.querySelectorAll(
    );

    function showBanner() {

        banner.hidden = false;

        requestAnimationFrame(function () {
            banner.classList.add('visible');
        });
    }

    function hideBanner() {

        banner.classList.remove('visible');

        setTimeout(function () {
            banner.hidden = true;
        }, 350);
    }

    function saveConsent(value) {

        try {
            localStorage.setItem(COOKIE_KEY, value);
        } catch (error) {
            console.warn('Impossible d’enregistrer le consentement cookies.');
        }

        hideBanner();
    }

    /*
     * Première visite :
     * aucun consentement enregistré = affichage de la bannière.
     */
    let consent = null;

    try {
        consent = localStorage.getItem(COOKIE_KEY);
    } catch (error) {
        console.warn('Impossible de lire le consentement cookies.');
    }

    if (
        consent !== 'accepted' &&
        consent !== 'refused'
    ) {
        setTimeout(showBanner, 500);
    }

    /*
     * Accepter
     */
    if (acceptButton) {

        acceptButton.addEventListener('click', function () {
            saveConsent('accepted');
        });

    }

    /*
     * Refuser
     */
    if (refuseButton) {

        refuseButton.addEventListener('click', function () {
            saveConsent('refused');
        });

    }

    /*
     * Paramétrer depuis la bannière
     *
     * Pour l'instant, ce bouton permet de maintenir
     * la bannière ouverte afin de choisir.
     */
    if (settingsButton) {

        settingsButton.addEventListener('click', function () {
            showBanner();
        });

    }

    /*
     * Paramètres des cookies depuis le footer
     *
     * Ce bouton permet volontairement de rouvrir
     * la bannière même si un choix existe déjà.
     */
    footerSettings.forEach(function (button) {

        button.addEventListener('click', function (event) {

            event.preventDefault();

            showBanner();

        });

    });

});


/* =========================================
   Medication availability search
   ========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const search = document.getElementById('pgm-medication-search');
    const results = document.getElementById('pgm-medication-results');
    const noResults = document.getElementById('pgm-medication-no-results');
    const status = document.getElementById('pgm-medication-status');

    if (!search || !results) {
        return;
    }

    const cards = Array.from(
        results.querySelectorAll('.medication-card')
    );

    /*
     * Normalisation permettant de rechercher sans tenir
     * compte des accents ou des majuscules.
     */
    function normalize(value) {
        return value
            .toLocaleLowerCase('fr-FR')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    }

    /*
     * Classement alphabétique.
     */
    cards.sort(function (a, b) {

        const nameA = a.dataset.medicationName || '';
        const nameB = b.dataset.medicationName || '';

        return normalize(nameA).localeCompare(
            normalize(nameB),
            'fr',
            {
                sensitivity: 'base'
            }
        );
    });

    cards.forEach(function (card) {
        results.appendChild(card);
    });

    function filterMedications() {

        const query = normalize(search.value.trim());

        let visibleCount = 0;

        cards.forEach(function (card) {

            const name = normalize(
                card.dataset.medicationName || ''
            );

            const matches =
                query === '' ||
                name.includes(query);

            card.hidden = !matches;

            if (matches) {
                visibleCount++;
            }
        });

        if (query === '') {

            noResults.hidden = true;
            status.textContent = '';

            return;
        }

        if (visibleCount === 0) {

            noResults.hidden = false;

            status.textContent =
                'Aucun résultat pour « ' +
                search.value.trim() +
                ' ».';

            return;
        }

        noResults.hidden = true;

        status.textContent =
            visibleCount +
            (
                visibleCount > 1
                    ? ' médicaments trouvés.'
                    : ' médicament trouvé.'
            );
    }

    search.addEventListener(
        'input',
        filterMedications
    );

    filterMedications();
});


/* =========================================
   Medicaments live search
   ========================================= */

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('pgm-medicament-search');
    const results = document.getElementById('pgm-medicament-results');
    const empty = document.getElementById('pgm-medicament-empty');

    if (!input || !results || !empty) {
        return;
    }

    /*
     * Les médicaments sont récupérés depuis les éléments
     * générés par WordPress.
     *
     * Ils ne sont volontairement PAS affichés avant
     * qu'une recherche soit effectuée.
     */

    const sourceItems = Array.from(
        document.querySelectorAll('[data-medicament]')
    );

    const medicines = sourceItems.map(function (item) {

        return {
            name: (item.dataset.medicament || item.textContent || '').trim(),
            available: item.dataset.available !== 'false'
        };

    }).filter(function (item) {
        return item.name.length > 0;
    });


    /*
     * Normalisation :
     * - majuscules/minuscules ignorées
     * - accents ignorés
     */

    function normalize(value) {

        return value
            .toLocaleLowerCase('fr-FR')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .trim();

    }


    /*
     * Tri alphabétique permanent.
     */

    medicines.sort(function (a, b) {

        return normalize(a.name).localeCompare(
            normalize(b.name),
            'fr-FR',
            {
                sensitivity: 'base'
            }
        );

    });


    function render(query) {

        const normalizedQuery = normalize(query);

        results.innerHTML = '';
        results.classList.remove('has-results');
        empty.hidden = true;


        /*
         * IMPORTANT :
         * aucune liste si le champ est vide.
         */

        if (!normalizedQuery) {
            return;
        }


        const matches = medicines.filter(function (medicine) {

            return normalize(medicine.name)
                .startsWith(normalizedQuery);

        });


        /*
         * On autorise aussi une recherche à l'intérieur
         * du nom si aucune correspondance par préfixe
         * n'existe.
         */

        const finalMatches = matches.length
            ? matches
            : medicines.filter(function (medicine) {

                return normalize(medicine.name)
                    .includes(normalizedQuery);

            });


        if (!finalMatches.length) {
            empty.hidden = false;
            return;
        }


        finalMatches.forEach(function (medicine) {

            const row = document.createElement('div');

            row.className =
                'pgm-medicament-result' +
                (medicine.available ? '' : ' is-unavailable');


            const name = document.createElement('span');

            name.className = 'pgm-medicament-result-name';
            name.textContent = medicine.name;


            const status = document.createElement('span');

            status.className = 'pgm-medicament-result-status';

            status.textContent = medicine.available
                ? 'Disponible'
                : 'Indisponible';


            row.appendChild(name);
            row.appendChild(status);

            results.appendChild(row);

        });


        results.classList.add('has-results');

    }


    input.addEventListener('input', function () {

        render(input.value);

    });

});

