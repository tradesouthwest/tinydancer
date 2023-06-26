<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package tinydancer
 * @since tinydancer 1.0
 */

get_header(); ?>
  
<main class="main-padded default-page">

    <section class="section-content">
   
        <?php while ( have_posts() ) : the_post(); ?>
            <h3 class="article-heading"><?php the_title(); ?></h3>
            <?php 
                do_action( 'tinydancer_render_attachment' ); ?>

            <div class="inner_content">

                <?php the_content( ); ?>

            </div>
        <?php 
        // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			} ?>
            <?php endwhile; ?>
    </section>
    
    <section class="section-sidebar">

        <?php get_sidebar(); ?>

    </section>
</main>

<?php get_footer(); ?>