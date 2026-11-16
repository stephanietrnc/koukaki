// Menu plein écran : compléments au script du thème parent (foce/js/navigation.js),
// qui ouvre et ferme le menu (classe .toggled) au clic sur le bouton.
(() => {
    const siteNavigation = document.getElementById('site-navigation');
    const menuButton = document.querySelector('.menu-toggle');
    const menuLinks = document.querySelectorAll('.menu-fullscreen a');

    if (!siteNavigation || !menuButton) {
        return;
    }

    const isOpen = () => siteNavigation.classList.contains('toggled');

    const closeMenu = () => {
        siteNavigation.classList.remove('toggled');       // retirer la classe
        menuButton.setAttribute('aria-expanded', 'false'); // accessibilité, comme le parent
    };

    // Fermer le menu quand on clique sur un lien du menu
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // À l'ouverture au clavier, le focus va sur le premier lien du menu.
    // e.detail vaut 0 quand le « clic » vient du clavier (Entrée ou Espace),
    // et 1 ou plus quand il vient de la souris : à la souris, on ne déplace pas le focus.
    // requestAnimationFrame : on attend que le script du parent ait ajouté .toggled.
    menuButton.addEventListener('click', (e) => {
        if (e.detail !== 0) {
            return;
        }
        window.requestAnimationFrame(() => {
            if (isOpen() && menuLinks.length) {
                menuLinks[0].focus();
            }
        });
    });

    document.addEventListener('keydown', (e) => {
        if (!isOpen()) {
            return;
        }

        // Échap : fermer le menu, et rendre le focus au bouton
        if (e.key === 'Escape') {
            closeMenu();
            menuButton.focus();
            return;
        }

        // Tab : le focus tourne en boucle dans le menu ouvert (bouton + liens),
        // au lieu de partir sur la page cachée derrière.
        if (e.key === 'Tab') {
            const focusables = [menuButton, ...menuLinks];
            const first = focusables[0];
            const last = focusables[focusables.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
})();
