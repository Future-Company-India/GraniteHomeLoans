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


// add_filter('wp_get_attachment_url', 'replace_asset_domain_local_to_prod');
// add_filter('content_url', 'replace_asset_domain_local_to_prod');
// add_filter('upload_dir', 'replace_upload_dir_local_to_prod');

// function replace_asset_domain_local_to_prod($url) {
//     $local_domain = 'https://fc-havenview.ddev.site'; 
//     $prod_domain  = 'https://havenviewstg.wpengine.com';

//     return str_replace($local_domain, $prod_domain, $url);
// }

// function replace_upload_dir_local_to_prod($upload) {
//     $local_domain = 'https://fc-havenview.ddev.site';
//     $prod_domain  = 'https://havenviewstg.wpengine.com';

//     $upload['url'] = str_replace($local_domain, $prod_domain, $upload['url']);
//     $upload['baseurl'] = str_replace($local_domain, $prod_domain, $upload['baseurl']);

//     return $upload;
// }