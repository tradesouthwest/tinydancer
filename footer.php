<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tinydancer
 * @since   1.0
 */
?>

<footer class="page-footer">
    <?php if ( is_active_sidebar( 'footer-two' ) ) { ?>
    <div class="section-third">
        <div class="footer-block">
        
            <?php dynamic_sidebar( 'footer-one' ); ?>
        </div>
    </div>
    <?php } ?>

    <?php if ( is_active_sidebar( 'footer-two' ) ) { ?>
    <div class="section-third">
        <div class="footer-block">
    
            <?php dynamic_sidebar( 'footer-two' ); ?>
    
        </div>
    </div>
    <?php } ?>

    <?php if ( is_active_sidebar( 'footer-three' ) ) { ?>
    <div class="section-third">
        <div class="footer-block">

            <?php dynamic_sidebar( 'footer-three' ); ?>
        </div>
    </div>
    <?php } ?>
</footer>
    <div class="footer-base">
        <div class="site-copyright">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php 
        printf( '<small>%s &copy; %s</small>',
            bloginfo( 'name' ),
            date( 'Y' )
        ); ?></a>
        </div>
        <div class="upto">
            <a class="back_to_top" title="<?php echo esc_attr('Top of page link', 'tinydancer'); ?>"><sup>^</sup></a>
        </div>
    </div>

</div><!-- ends page wrapper -->

<?php wp_footer(); ?>
</body>
</html>