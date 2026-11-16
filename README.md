# Koukaki — Fleurs d'oranger & chats errants

Site vitrine animé pour le court-métrage d'un studio d'animation fictif.

**Démo :** _lien à venir_

## Contexte

Projet de la formation Développeur WordPress d'OpenClassrooms, repris et amélioré ensuite.
Le but : animer une page WordPress existante (thème `foce`) en suivant une maquette.

## Ce que j'ai fait

- Thème enfant `foce-child` (Sass, JavaScript)
- Animations : apparition des titres, parallaxe des nuages, vidéo d'en-tête
- Carrousel des personnages avec Swiper (effet coverflow)
- Menu burger plein écran

## Améliorations après la formation

- Poids de la page divisé par 5 (images en WebP, vidéo compressée, polices hébergées sur le site)
- Scripts chargés seulement là où ils servent
- Accessibilité : navigation au clavier, focus visible, respect de « réduire les animations »
- Sécurité : textes échappés, enregistrement des personnages protégé (nonce, droits)
- Dimensions des images pour éviter les sauts de mise en page

## Structure

- `themes/foce` : thème de départ fourni par la formation
- `themes/foce-child` : mon thème enfant
- `mu-plugins` : type de contenu « personnages »
- `docs` : version statique du site, publiée avec GitHub Pages

## Lancer le projet en local

1. Installer WordPress (par exemple avec Local).
2. Copier `themes` et `mu-plugins` dans `wp-content`.
3. Activer le thème `foce-child`.
4. Pour le Sass : `npm install` puis `npm run sass:watch` dans `themes/foce-child`.