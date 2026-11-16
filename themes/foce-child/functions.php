<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Get customizer options form parent theme
if ( get_stylesheet() !== get_template() ) {
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
        update_option( 'theme_mods_' . get_template(), $value );
        return $old_value; // prevent update to child theme mods
    }, 10, 2 );
    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
}


// Scripts du thème enfant
function enqueue_child_scripts() {
    $dir = get_stylesheet_directory();      // chemin du dossier sur le disque
    $uri = get_stylesheet_directory_uri();  // adresse du dossier pour le navigateur

    // Menu plein écran : sur toutes les pages.
    wp_enqueue_script(
        'foce-child-navigation',
        esc_url( $uri . '/js/navigation.js' ),
        array(),
        filemtime( $dir . '/js/navigation.js' ),
        true
    );

    // Animations et carrousel : seulement sur l'accueil, la seule page qui a ces sections.
    // Ailleurs, ils chercheraient des éléments absents (#place, .mySwiper) et provoqueraient des erreurs.
    if ( ! is_front_page() ) {
        return;
    }

    wp_enqueue_script(
        'foce-child-animations',
        esc_url( $uri . '/js/animations.js' ),
        array(),
        filemtime( $dir . '/js/animations.js' ),
        true
    );

    wp_enqueue_style(
        'swiper-slider-style',
        esc_url( $uri . '/assets/vendor/swiper/swiper-bundle.min.css' ),
        array(),
        '1.0.0'
    );
    wp_enqueue_script(
        'swiper-slider-script',
        esc_url( $uri . '/assets/vendor/swiper/swiper-bundle.min.js' ),
        array(),
        '1.0.0',
        true
    );
    wp_enqueue_script(
        'foce-child-swiper',
        esc_url( $uri . '/js/swiper.js' ),
        array( 'swiper-slider-script' ),  // dépendance : Swiper doit être chargé avant
        filemtime( $dir . '/js/swiper.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'enqueue_child_scripts' );


// Recharge style.css dès qu'il change (version = date de modification du fichier)
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'foce-style' );
	wp_deregister_style( 'foce-style' );
	wp_enqueue_style(
		'foce-style',
		get_stylesheet_uri(),
		array(),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
}, 20 );

// Polices hébergées dans le thème (assets/fonts, déclarées dans sass/components/_fonts.scss) :
// on retire celles que le thème parent charge depuis Google Fonts (plus rapide, et pas d'IP envoyée à Google).
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'foce-google-fonts-quicksand' );
	wp_dequeue_style( 'foce-google-fonts-roboto-mono' );
}, 20 );

/**
 * Renvoie width="…" height="…" pour une image du dossier assets/images.
 * PHP lit la vraie taille du fichier : si tu changes une image, les
 * dimensions se mettent à jour toutes seules.
 * Le navigateur réserve ainsi la place de l'image avant qu'elle charge :
 * la page ne « saute » plus (CLS).
 */
function koukaki_img_dims( $fichier ) {
	$chemin = get_stylesheet_directory() . '/assets/images/' . $fichier;
	$taille = file_exists( $chemin ) ? wp_getimagesize( $chemin ) : false;

	if ( ! $taille ) {
		return '';
	}

	return sprintf( ' width="%d" height="%d"', $taille[0], $taille[1] );
}
