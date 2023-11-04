<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package tinydancer
 * @since tinydancer 1.0.7
 */

get_header(); ?>
  
<main class="main-padded default-page">

    <section class="section-content">
   
        <?php while ( have_posts() ) : the_post(); ?>
            <h2 class="article-heading"><?php the_title(); ?></h2>
            
                <?php do_action( 'tinydancer_render_attachment' ); ?>

            <div class="inner_content">

                <?php the_content( ); ?>
                <p><?php wp_link_pages(	array(
				'before' => '<div class="page-link"><span>' . __( 'Pages:', 'tinydancer' ) . '</span>',
				'after'  => '</div>', 
                ) ); ?></p>

            </div>

            <aside class="after-content">
                <p class="after-cats"><span><small><?php esc_html_e('By: ', 'tinydancer'); ?></span> <em><?php the_author(); ?></em></small>
                | <span><small><?php esc_html_e('Categorized as: ', 'tinydancer'); ?></span> <em><?php the_category( ' &bull; ' ); ?></em></small>
                | <span><small><?php esc_html_e('Keys: ', 'tinydancer'); ?></span> <em><?php the_tags( ' ' ); ?></em></small>
                | <span><small><?php esc_html_e('Added on: ', 'tinydancer'); ?></span> <em><?php the_date(); ?></em></small></p>
                

            </aside>
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
