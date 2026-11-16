<?php
$args = array(
    'post_type' => 'characters',
    'posts_per_page' => -1,
);
$characters_query = new WP_Query($args);
?>

<!-- Swiper -->
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php while ( $characters_query->have_posts() ) : $characters_query->the_post(); ?>
            <div class="swiper-slide">
                <?php // 'large' (1024 px) suffit : la slide fait 900 px maximum. ?>
                <?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                <p><?php the_title(); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_postdata(); ?>

