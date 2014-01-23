<?php
/**
 * wedocs customizer
 *
 * @author WeDevs
 */
class WeDocs_Customizer {

    function __construct() {
        add_action( 'customize_register', array($this, 'register_control') );
        add_action( 'wp_head', array($this, 'generate_styles'), 99 );
    }

    function register_control( $wp_customize ) {

        // logo
        $wp_customize->add_section( 'wedocs_logo_section', array(
            'title' => __( 'Theme Logo', 'wedocs' ),
            'priority' => 9,
            'description' => __( 'Upload your logo to replace the default Logo (dimension : 220 X 45)', 'wedocs' ),
        ) );

        $wp_customize->add_setting( 'wedocs_logo' );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wedocs_logo', array(
            'label' => __( 'Upload Logo', 'wedocs' ),
            'section' => 'wedocs_logo_section',
            'settings' => 'wedocs_logo',
        ) ) );

        // homepage and footer
        $wp_customize->add_section( 'wedocs_text_section', array(
            'title' => __( 'weDocs Options', 'wedocs' )
        ) );

        // homepage text
        $wp_customize->add_setting( 'wedocs_home_text', array(
           'capability' => 'edit_theme_options',
            'default' => ''
        ) );

        $wp_customize->add_control( 'wedocs_home_text', array(
            'label' => __( 'Homepage Text - header', 'wedocs' ),
            'section' => 'wedocs_text_section',
            'type' => 'text'
        ));

        // homepage text
        $wp_customize->add_setting( 'wedocs_home_text_tag', array(
            'capability' => 'edit_theme_options',
            'default' => ''
        ) );

        $wp_customize->add_control( 'wedocs_home_text_tag', array(
            'label' => __( 'Homepage Text - tagline', 'wedocs' ),
            'section' => 'wedocs_text_section',
            'type' => 'text'
        ));

        // footer text
        $wp_customize->add_setting( 'wedocs_footer_text', array(
            'capability' => 'edit_theme_options',
            'default' => sprintf( __( '&copy; %d. All rights are reserved.', 'wedocs' ), date( 'Y' ) )
        ));

        $wp_customize->add_control('wedocs_footer_text', array(
            'label' => __( 'Footer Text', 'wedocs' ),
            'section' => 'wedocs_text_section',
            'type' => 'text'
        ));
    }

    function generate_styles() {
        ?>
        <style type="text/css">

            <?php if ( $logo = get_theme_mod( 'wedocs_logo' ) ) : ?>
                .banner .navbar-header .navbar-brand {
                    background: url("<?php echo esc_url( $logo ); ?>") no-repeat;
                    background-size(contain);
                    min-width: 250px;
                    margin-left: 0;
                    display: block;
                    text-indent: -9999px;
                }
            <?php endif; ?>
        </style>
        <?php
    }
}

new WeDocs_Customizer();