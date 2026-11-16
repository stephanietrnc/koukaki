<?php

get_header();
?>

    <main id="primary" class="site-main">
        <section class="banner">
            <video 
                autoplay
                muted 
                loop 
                playsinline 
                poster="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/image-header-1.webp'); ?>">
                <?php // data-src : la vidéo n'est chargée que sur ordinateur (voir js/animations.js). ?>
                <source data-src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/videos/header-video.mp4'); ?>" type="video/mp4">
            </video>
            <img class="bg-image-fallback" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/image-header-1.webp'); ?>"<?php echo koukaki_img_dims( 'image-header-1.webp' ); ?> alt="">
            <div class="logo-container">
                <img class="logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.png' ); ?>"<?php echo koukaki_img_dims( 'logo.png' ); ?> alt="Fleurs d'oranger &amp; chats errants">
            </div>
        </section>
        <section id="story" class="story">
            <h2>L'histoire</h2>
            <article id="" class="story__article">
                <p><?php echo wp_kses_post( get_theme_mod( 'story' ) ); ?></p>
            </article>
            <article id="characters">
                <h3>Les personnages</h3>
                    <?php
                        get_template_part('template-parts/characters');
                    ?>
            </article>
            <article id="place">
                <img class="cloud big-cloud" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/big-cloud.png' ); ?>"<?php echo koukaki_img_dims( 'big-cloud.png' ); ?> alt="">
                <img class="cloud little-cloud" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/little-cloud.png' ); ?>"<?php echo koukaki_img_dims( 'little-cloud.png' ); ?> alt="">
                <div>
                    <h3>Le Lieu</h3>
                    <p><?php echo wp_kses_post( get_theme_mod( 'place' ) ); ?></p>
                </div>
            </article>
        </section>

        <div class="nomination-flowers-container">
            <section id="studio">
                <h2>Studio Koukaki</h2>
                <div>
                    <p>Acteur majeur de l’animation, Koukaki est un studio intégré fondé en 2012 qui créé, produit et distribue des programmes originaux dans plus de 190 pays pour les enfants et les adultes. Nous avons deux sections en activité : le long métrage et le court métrage. Nous développons des films fantastiques, principalement autour de la culture de notre pays natal, le Japon.</p>
                    <p>Avec une créativité et une capacité d’innovation mondialement reconnues, une expertise éditoriale et commerciale à la pointe de son industrie, le Studio Koukaki se positionne comme un acteur incontournable dans un marché en forte croissance. Koukaki construit chaque année de véritables succès et capitalise sur de puissantes marques historiques. Cette année, il vous présente “Fleurs d’oranger et chats errants”.</p>
                </div>
                </section>
        

            <!-- Section temporaire - nomination -->
            <?php get_template_part('template-parts/nomination'); ?>
        </div>
    </main><!-- #main -->

<?php
get_footer();
