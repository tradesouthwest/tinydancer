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
 * @package tinyDancer
 * @since 1.0
 */

get_header(); ?>

<main class="main-padded default-blog">
    <section class="section-content">
    
        <?php if ( have_posts() ) : ?>
        <div class="dancer-loop">
            <?php while ( have_posts() ) : 
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

                <?php if ( is_home() || ( is_category() || is_archive() ) ) { ?>
                    
                    <?php if ( has_post_thumbnail() ) { ?>
                    
                    <div class="maxheight-sm">

                        <?php do_action( 'tinydancer_excerpt_attachment' ); ?>

                    </div>

                    <?php the_excerpt(); ?>
                    <?php } else { ?>

                        <?php the_excerpt(); ?>

                    <?php } 
                    // Ends if has thumbnail ?>

                    <div class="aftr-excrpt">
                        <hr>
                    </div>
                    
                    <?php } else { ?>
                
                    <?php the_content( '', true ); ?>
                
                <?php } 
                // Ends is blog or archive ?>

                </div>
            </article>
            <?php endwhile; 
            // Ends looping thru posts, or print page ?>
        </div>
            <nav class="pagination-nav">
                <?php do_action( 'tinydancer_check_pagination' ); ?>
                
                <div class="nav-previous alignleft">
                    <?php previous_posts_link( '<span class="prvpst-nav"> < </span>' ); ?>
                </div>
                <div class="nav-next alignright">
                    <?php next_posts_link( '<span class="nxtpst-nav"> > </span>' ); ?>
                </div>
            </nav>
        <?php else : 
            // if no content found ?>
            
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