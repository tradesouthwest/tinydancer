<?php 
/**
 * Template Name: Wide Banner Top
 * 
 * @package tinydancer
 * @since 1.0.0
 */
get_header(); ?>

<div class="tinydancer-hero">

    <?php do_action( 'tinydancer_render_hero' ); ?>

</div>
    
    <main class="main-padded with-hero-page">
        <section class="section-content">
        
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
        
            <div class="post-content">
                <div class="inner_content">

                <?php the_content( '', true ); ?>

                </div>
            </div>
        
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
