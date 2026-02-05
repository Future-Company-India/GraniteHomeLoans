<?php
/**
 * Plugin Name: My Custom Fonts Advanced
 * Description: Adds custom fonts with multiple weights to Elementor
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit;
}

function my_custom_fonts_css() {
    ?>
<style>
@font-face {
    font-family: 'avenir-light';
    src: url(<?php echo get_stylesheet_directory() . '/assets/fonts/avenir-lt-w01_35-light1475496.woff2'?>) format("woff2");
    font-weight: 300;
    font-style: normal;
    font-display: swap;
}

@font-face {
    font-family: 'avenir-heavy';
    src: url(<?php echo get_stylesheet_directory() . '/assets/fonts/avenir-lt-w01_85-heavy1475544.woff2'?>) format("woff2");
    font-weight: 800;
    font-style: normal;
    font-display: swap;
}
</style>
<?php
}
add_action('elementor/editor/before_enqueue_scripts', 'my_custom_fonts_css');

add_filter( 'elementor/fonts/groups', function( $font_groups ) {
	$new_font_group = array( 'avenir' => __( 'Avenir' ));
	return array_merge( $new_font_group, $font_groups );
} );

/**
 * Add fonts to the new font group
 */
add_filter( 'elementor/fonts/additional_fonts', function( $additional_fonts ) {
	//Font name/font group
	$additional_fonts['avenir-light'] = 'avenir';
	$additional_fonts['avenir-heavy'] = 'avenir';
	return $additional_fonts;
} );