// Fonction englobante : évite le conflit avec la constante reduceMotion de animations.js.
(() => {
    // Réglage « réduire les animations » du système : pas de défilement automatique
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const petitEcran = window.matchMedia('(max-width: 480px)').matches;

    if (document.querySelector('.mySwiper')) {
      var swiper = new Swiper('.mySwiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        rewind: true, // revient au début après le dernier slide
        autoplay: reduceMotion ? false : {
          delay: 2000,                 // le temps de lire le nom du personnage
          disableOnInteraction: false, // continue l'autoplay même après une interaction
          pauseOnMouseEnter: true,     // pause tant que la souris est sur le carrousel
        },
        keyboard: { enabled: true },   // flèches du clavier
        a11y: {                        // annonces pour les lecteurs d'écran
          enabled: true,
          prevSlideMessage: 'Personnage précédent',
          nextSlideMessage: 'Personnage suivant',
          slideLabelMessage: '{{index}} sur {{slidesLength}}',
        },
        coverflowEffect: {
          rotate: petitEcran ? 80 : 50,   // plus de rotation sur mobile
          stretch: 0,
          depth: petitEcran ? 60 : 100,   // moins de profondeur sur mobile
          modifier: 1,
          slideShadows: false,
        },
      });
    }
})();
