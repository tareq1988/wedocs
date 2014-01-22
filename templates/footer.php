<footer class="content-info" role="contentinfo">
    <div class="container">
        <div class="row">

            <div class="widget-area clearfix">
                <?php dynamic_sidebar('sidebar-footer'); ?>
            </div>

            <div class="col-md-12 copyright">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
