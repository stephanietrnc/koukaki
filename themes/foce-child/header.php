<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fleurs_d\'oranger_&_Chats_errants
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Aller au contenu', 'foce' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <button class="menu-toggle" aria-controls="menu-fullscreen" aria-expanded="false">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
            <div class="menu-fullscreen" id="menu-fullscreen">
                <div class="menu-decor" aria-hidden="true">
                        <img class="menu-toggled-logo" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.png'); ?>"<?php echo koukaki_img_dims( 'logo.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-orchid" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/orchid.png'); ?>"<?php echo koukaki_img_dims( 'orchid.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-sunflower" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/sunflower.png'); ?>"<?php echo koukaki_img_dims( 'sunflower.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-flower" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/flower.png'); ?>"<?php echo koukaki_img_dims( 'flower.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-hibiscus" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/hibiscus_footer.webp'); ?>"<?php echo koukaki_img_dims( 'hibiscus_footer.webp' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-random-flower" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/random_flower.png'); ?>"<?php echo koukaki_img_dims( 'random_flower.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-black-cat" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/black-cat.png'); ?>"<?php echo koukaki_img_dims( 'black-cat.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-purple-cat" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/purple-cat.png'); ?>"<?php echo koukaki_img_dims( 'purple-cat.png' ); ?> alt="" loading="lazy">
                        <img class="menu-decor-img menu-toggled-red-cat" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/red-cat.png'); ?>"<?php echo koukaki_img_dims( 'red-cat.png' ); ?> alt="" loading="lazy">
                    </div>
                <ul>
                    <li><a href="#story">Histoire</a></li>
                    <li><a href="#characters">Personnages</a></li>      
                    <li><a href="#place">Lieu</a></li>
                    <li><a href="#studio">Studio Koukaki</a></li>            
                </ul>
                <div class="menu-footer">
                    <p><a href="#studio">STUDIO KOUKAKI</a></p>
                </div>
            </div>
           

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
