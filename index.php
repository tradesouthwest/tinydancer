<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress | ClassicPress
 * @subpackage ClassicSixteen
 * @since ClassicSixteen 1.0
 */

get_header(); ?>

<main class="main-padded default-blog">
    <section class="section-content">

    <?php if ( have_posts() ) : ?><?php while ( have_posts() ) : 
        the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope 
                itemtype="https://schema.org/Article">
        <h3 class="article-heading">
        <?php the_title(
              sprintf( '<span class="post-title"><a href="%s" rel="bookmark">', 
                       esc_attr( esc_url( get_permalink() ) ) 
                    ), '</a></span>' ); ?>

        </h3>
            <div class="inner_content">

                <?php the_content( '', true ); ?>

            </div>
        </article>
    <?php endwhile; ?>
    <?php else : ?>
            
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