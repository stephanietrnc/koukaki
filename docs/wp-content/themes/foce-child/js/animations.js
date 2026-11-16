// Tout le fichier est dans une fonction : ses constantes (reduceMotion…) ne se mélangent pas
// avec celles des autres scripts de la page.
(() => {
    // Réglage « réduire les animations » du système (Windows, macOS, iOS, Android)
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ---------- Vidéo d'en-tête : chargée seulement sur ordinateur ----------
    // Sur mobile (≤ 768 px) elle est cachée en CSS : inutile de télécharger ses Mo.
    const video = document.querySelector('.banner video');
    if (video && !reduceMotion && window.matchMedia('(min-width: 769px)').matches) {
        const source = video.querySelector('source[data-src]');
        if (source) {
            source.src = source.dataset.src;
            video.load(); // la vidéo lit la nouvelle source puis démarre (autoplay)
        }
    }

    // ---------- Titres : apparition mot par mot ----------
    // Sélection des titres
    const titles = document.querySelectorAll('.story h2, #studio h2, #characters h3, #place h3, .nomination-title h2');

    // Découpage de chaque titre en mots enveloppés dans des span
    titles.forEach(title => {
        const words = title.textContent.split(' ');
        title.innerHTML = words.map((word, index) =>
            `<span style="transition-delay: ${index * 0.2}s">${word}</span>`
        ).join(' ');
    });

    // On met un observer pour détecter le scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // une fois visible, plus besoin de le surveiller
            }
        });
    }, { threshold: 0.5 }); // <- se déclenche quand 50% de l'élément est visible

    // On dit à l'observer de surveiller chaque titre
    titles.forEach(title => {
        observer.observe(title);
    });

    // ---------- Parallaxe des nuages ----------
    const placeSection = document.querySelector('#place');
    const bigcloud = document.querySelector('.big-cloud');
    const littlecloud = document.querySelector('.little-cloud');

    // Sécurité : on ne lance la parallaxe que si les éléments existent (et si les animations sont permises)
    if (placeSection && bigcloud && littlecloud && !reduceMotion) {
        let ticking = false;

        const moveClouds = () => {
            const rect = placeSection.getBoundingClientRect();

            // Section hors de l'écran : rien à calculer
            if (rect.bottom > 0 && rect.top < window.innerHeight) {
                const progress = 1 - (rect.top / window.innerHeight);

                // amplitude adaptée à la largeur du viewport
                let amplitude = -300;
                if (window.innerWidth <= 1070)
                    amplitude = -250;
                if (window.innerWidth <= 960)
                    amplitude = -200;
                if (window.innerWidth <= 720)
                    amplitude = -120;

                const decalage = progress * amplitude;

                bigcloud.style.transform = `translateX(${decalage}px)`;
                littlecloud.style.transform = `translateX(${decalage}px)`;
            }
            ticking = false;
        };

        // Le scroll se déclenche des dizaines de fois par seconde :
        // requestAnimationFrame limite le calcul à une fois par image affichée.
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(moveClouds);
                ticking = true;
            }
        }, { passive: true });

        moveClouds(); // position correcte dès le chargement
    }
})();
