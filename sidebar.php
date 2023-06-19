<div id="sidebar-right" role="complementary">
    <div class="inner-sidebar">
    
    <?php if (is_active_sidebar('sidebar-page')) { ?>
        <?php dynamic_sidebar( 'sidebar-page' ); ?>
    <?php } else { the_widget( 'WP_Widget_Recent_Posts' ); } ?>    
    
    </div>
</div>