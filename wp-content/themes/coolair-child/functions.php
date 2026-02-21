<?php
/*** Child Theme Function  ***/
function hv_enqueue_child_theme_styles() {
    wp_enqueue_style('hv-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('hv-style'));

    // Custom CSS
    wp_enqueue_style('hv-custom-style', get_stylesheet_directory_uri() . '/css/app.css', '', DEPLOYMENT_VERSION);
     wp_enqueue_script(
        'hv-custom-script',
        get_stylesheet_directory_uri() . '/js/scripts.js',
        ['jquery'],
        DEPLOYMENT_VERSION,
        true
    );

}
add_action('wp_enqueue_scripts', 'hv_enqueue_child_theme_styles');

/**
 * Reduce render-blocking: move jQuery to footer so it doesn't block LCP/FCP.
 * Priority 999 so it runs after plugins (e.g. Elementor) that might enqueue scripts.
 */
function hv_jquery_in_footer() {
    if ( ! is_admin() ) {
        wp_script_add_data( 'jquery', 'group', 1 );
    }
}
add_action( 'wp_enqueue_scripts', 'hv_jquery_in_footer', 999 );

/**
 * Add defer to non-critical scripts to break the network dependency chain and reduce critical path latency.
 * Scripts load in parallel and run in order after DOM parse instead of blocking.
 */
function hv_defer_noncritical_scripts( $tag, $handle, $src ) {
    if ( is_admin() ) {
        return $tag;
    }
    $defer_handles = [
        'jquery',
        'bootstrap',
        'swiper',
        'wow',
        'waypoints',
        'waypoints-sticky',
        'jquery-counterup',
        'jquery-magnific-popup',
        'coolair-main',
        'hv-custom-script',
    ];
    if ( in_array( $handle, $defer_handles, true ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    if ( strpos( $src, 'order-attribution' ) !== false || strpos( $src, 'sourcebuster' ) !== false ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    if ( strpos( $src, 'hooks.min.js' ) !== false || strpos( $src, 'i18n.min.js' ) !== false ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'hv_defer_noncritical_scripts', 10, 3 );

/**
 * Load all Google Fonts CSS asynchronously (theme + Elementor/plugins) so they don't block initial render.
 */
function hv_nonblocking_google_fonts( $html, $handle, $href, $media ) {
    if ( $href && strpos( $href, 'fonts.googleapis.com' ) !== false ) {
        $html = '<link rel="preload" href="' . esc_url( $href ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' .
            '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
    }
    return $html;
}
add_filter( 'style_loader_tag', 'hv_nonblocking_google_fonts', 10, 4 );

/**
 * Preconnect to Google Fonts origins so font requests start earlier.
 */
function hv_preconnect_google_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'hv_preconnect_google_fonts', 1 );

/**
 * Preload critical fonts to reduce layout shift (CLS) and start font requests earlier.
 */
function hv_preload_critical_fonts() {
    $fonts = [
        'avenir-lt-w01_35-light1475496.woff2',
        'avenir-lt-w01_85-heavy1475544.woff2',
    ];
    foreach ( $fonts as $file ) {
        $uri = get_stylesheet_directory_uri() . '/fonts/' . $file;
        echo '<link rel="preload" href="' . esc_url( $uri ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    }
}
add_action('wp_head', 'hv_preload_critical_fonts', 2);


// add_filter('wp_get_attachment_url', 'replace_asset_domain_local_to_prod');
// add_filter('content_url', 'replace_asset_domain_local_to_prod');
// add_filter('upload_dir', 'replace_upload_dir_local_to_prod');

// function replace_asset_domain_local_to_prod($url) {
//     $local_domain = 'https://fc-graniteloan.ddev.site'; 
//     $prod_domain  = 'https://graniteloanstg.wpengine.com';

//     return str_replace($local_domain, $prod_domain, $url);
// }

// function replace_upload_dir_local_to_prod($upload) {
//     $local_domain = 'https://fc-graniteloan.ddev.site';
//     $prod_domain  = 'https://graniteloanstg.wpengine.com';

//     $upload['url'] = str_replace($local_domain, $prod_domain, $upload['url']);
//     $upload['baseurl'] = str_replace($local_domain, $prod_domain, $upload['baseurl']);

//     return $upload;
// }