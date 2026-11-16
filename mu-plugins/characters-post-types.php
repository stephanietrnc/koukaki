<?php
function face_characters_post_types() {
    register_post_type('characters', array(
        'rewrite' => array('slug' => 'characters'),
        'has_archive' => false,
        'public' => true,
        'show_in_rest' => false,

        'labels' => array(
            'name' => 'Personnages',
            'add_new_item' => 'Ajouter un nouveau Personnage',
            'edit_item' => 'Modifier  Personnage',
            'all_items' => 'Tous les personnages',
            'singular_name' => 'Personnage'
        ),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-pets'
    ));
}
add_action('init', 'face_characters_post_types');
function face_add_custom_box() {
    $screens = [ 'characters' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'face_box_character',                 // Unique ID
            'Main Character',      // Box title
            'face_custom_box_html',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}
function face_custom_box_html( $post ) {
    // Jeton de sécurité : prouve, à l'enregistrement, que le formulaire vient bien de l'admin.
    wp_nonce_field( 'face_save_char', 'face_char_nonce' );
    $value = get_post_meta( $post->ID, '_main_char_field', true );
    ?>

    <input type="checkbox" <?php checked( $value, 'on' ); ?> name="main_char_field" id="main_char_field" class="postbox">
    <label for="main_char_field">Is Main Character</label>
    <?php
}
add_action( 'add_meta_boxes', 'face_add_custom_box' );

function face_save_postdata( $post_id, $post ) {
    if ( 'characters' !== $post->post_type ) {
        return; // seulement les personnages, pas les articles ni les pages
    }
    if ( ! isset( $_POST['face_char_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['face_char_nonce'] ), 'face_save_char' ) ) {
        return; // le formulaire ne vient pas de l'admin
    }
    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
        return; // sauvegarde automatique, ou pas le droit de modifier
    }
    // Valeur toujours « on » ou vide, jamais ce que le formulaire a envoyé.
    update_post_meta( $post_id, '_main_char_field', isset( $_POST['main_char_field'] ) ? 'on' : '' );
}
add_action( 'save_post', 'face_save_postdata', 10, 2 );
