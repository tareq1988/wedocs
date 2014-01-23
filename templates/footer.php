<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">

            <div class="widget-area clearfix">
                <?php dynamic_sidebar('sidebar-footer'); ?>
            </div>

            <div class="col-md-12 copyright clearfix">
                <span class="copy-text">
                    <?php if ( $footer_text = get_theme_mod( 'wedocs_footer_text' ) ) {
                        echo esc_html( $footer_text );
                    } else { ?>
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                    <?php } ?>
                </span>

                <?php $credit = get_theme_mod( 'wedocs_footer_credit', true ); ?>
                <?php do_action( 'wedocs_credits' ); ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
