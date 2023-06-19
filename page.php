<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package ClassicPress
 * @subpackage ClassicSixteen
 * @since ClassicSixteen 1.0
 */

get_header(); ?>
  
<main class="main-padded default-page">
    <section class="section-content">
    <?php if ( have_posts() ) : ?><?php while ( have_posts() ) : 
        the_post(); ?>
     <?php 
        do_action( 'tinydancer_render_attachment' ); 
        ?>
        <div class="inner_content">

        <?php the_content( '', true ); ?>

        </div>
    <?php endwhile; ?><?php else : ?>
            
            <div class="post-content">
		        
            <?php echo esc_url( home_url('/') ); ?>
            
            </div>

		    <?php endif; ?>
    </section>
    
    <section class="section-sidebar">

        <?php get_sidebar(); ?>

    </section>
</main>

<?php get_footer(); ?>