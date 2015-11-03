<?php get_template_part( 'templates/head' ); ?>
<body data-spy="scroll" data-target=".bs-sidebar" <?php body_class(); ?>>

    <!--[if lt IE 8]>
        <div class="alert alert-warning">
    <?php _e( 'You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'wedocs' ); ?>
        </div>
    <![endif]-->

    <?php
    do_action( 'get_header' );
    // Use Bootstrap's navbar if enabled in config.php
    if ( current_theme_supports( 'bootstrap-top-navbar' ) ) {
        get_template_part( 'templates/header-top-navbar' );
    } else {
        get_template_part( 'templates/header' );
    }
    ?>

    <div class="wrap container" role="document">
        <div class="content row">


            <?php if ( wedocs_display_sidebar() ) : ?>
                <aside class="sidebar <?php echo wedocs_sidebar_class(); ?>" role="complementary">
                    <?php include roots_sidebar_path(); ?>
                </aside><!-- /.sidebar -->
            <?php endif; ?>
            <main class="main <?php echo wedocs_main_class(); ?>" role="main">
                <?php include roots_template_path(); ?>
            </main><!-- /.main -->
        </div><!-- /.content -->
    </div><!-- /.wrap -->

    <?php get_template_part( 'templates/footer' ); ?>

</body>
</html>
