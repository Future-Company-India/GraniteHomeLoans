<?php
/**
 * Plugin Name: Custom Elementor Widgets
 * Description: Custom Elementor widgets (Broker Banner, Dynamic Rows, Icon Heading, Granite Slider, Team Members, Calculator Columns, Custom Accordion)
 * Version: 1.1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Custom Widgets
 */
function cew_register_widgets( $widgets_manager ) {
    // Register Broker Banner Widget
    require_once __DIR__ . '/widgets/broker-banner.php';
    $widgets_manager->register( new \Broker_Banner_Widget() );
    
    // Register Dynamic Rows Widget
    require_once __DIR__ . '/widgets/highlight-section-with-row.php';
    $widgets_manager->register( new \Dynamic_Rows_Widget() );
    
    // Register Icon Heading Widget
    require_once __DIR__ . '/widgets/icon-with-text.php';
    $widgets_manager->register( new \Icon_Heading_Widget() );
    
    // Register Granite Slider Widget
    require_once __DIR__ . '/widgets/granite-slider.php';
    $widgets_manager->register( new \Granite_Slider_Widget() );
    
    // Register Team Members Widget
    require_once __DIR__ . '/widgets/team-member.php';
    $widgets_manager->register( new \Team_Members_Widget() );
    
    // Register Calculator Columns Widget
    require_once __DIR__ . '/widgets/calculator-columns.php';
    $widgets_manager->register( new \Calculator_Columns_Widget() );
    
    // Register Custom Accordion Widget
    require_once __DIR__ . '/widgets/accordion.php';
    $widgets_manager->register( new \Custom_Accordion_Widget() );

    // Register Document List Widget
    require_once __DIR__ . '/widgets/doc-list-widget.php';
	$widgets_manager->register( new \EDLW_Doc_List_Widget() );
}
add_action( 'elementor/widgets/register', 'cew_register_widgets' );

/**
 * Enqueue All Styles
 */
function cew_enqueue_all_styles() {
    // Broker Banner CSS
    wp_enqueue_style(
        'cew-broker-banner-css',
        plugins_url( 'assets/css/broker-banner.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Highlight Section with Row CSS
    wp_enqueue_style(
        'cew-highlight-section-css',
        plugins_url( 'assets/css/highlight-section-with-row.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Icon with text CSS
    wp_enqueue_style(
        'cew-icon-with-text-css',
        plugins_url( 'assets/css/icon-with-text.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Granite Slider CSS
    wp_enqueue_style(
        'cew-granite-slider-css',
        plugins_url( 'assets/css/granite-slider.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Team Members CSS
    wp_enqueue_style(
        'cew-team-members-css',
        plugins_url( 'assets/css/team-member.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Calculator Columns CSS
    wp_enqueue_style(
        'cew-calculator-columns-css',
        plugins_url( 'assets/css/calculator-columns.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
    
    // Custom Accordion CSS
    wp_enqueue_style(
        'cew-custom-accordion-css',
        plugins_url( 'assets/css/accordion.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );

    // Custom Document List CSS
    wp_enqueue_style(
        'cew-custom-doc-list-widget-css',
        plugins_url( 'assets/css/doc-list-widget.css', __FILE__ ),
        [],
        DEPLOYMENT_VERSION
    );
}

// Load CSS on frontend
add_action( 'wp_enqueue_scripts', 'cew_enqueue_all_styles' );

// Load CSS in Elementor editor
add_action( 'elementor/editor/before_enqueue_scripts', 'cew_enqueue_all_styles' );

// Load CSS in Elementor preview
add_action( 'elementor/preview/enqueue_styles', 'cew_enqueue_all_styles' );

/**
 * Enqueue All Scripts
 */
function cew_enqueue_all_scripts() {
    // Granite Slider JavaScript
    wp_enqueue_script(
        'cew-granite-slider-js',
        plugins_url( 'js/granite-slider.js', __FILE__ ),
        [ 'jquery' ],
        DEPLOYMENT_VERSION,
        true
    );
    
    // Custom Accordion JavaScript
    wp_enqueue_script(
        'cew-custom-accordion-js',
        plugins_url( 'js/accordion.js', __FILE__ ),
        [ 'jquery' ],
        DEPLOYMENT_VERSION,
        true
    );
}

// Load JS on frontend
add_action( 'wp_enqueue_scripts', 'cew_enqueue_all_scripts' );

// Load JS in Elementor editor
add_action( 'elementor/editor/before_enqueue_scripts', 'cew_enqueue_all_scripts' );

// Load JS in Elementor preview
add_action( 'elementor/preview/enqueue_scripts', 'cew_enqueue_all_scripts' );

/**
 * Add Widget Categories
 */
function cew_add_widget_categories( $elements_manager ) {
    // Broker Elements Category
    $elements_manager->add_category(
        'broker-elements',
        [
            'title' => esc_html__( 'Broker Elements', 'cew' ),
            'icon' => 'fa fa-plug',
        ]
    );
    
    // Custom Elements Category
    $elements_manager->add_category(
        'custom-elements',
        [
            'title' => esc_html__( 'Custom Elements', 'cew' ),
            'icon' => 'fa fa-puzzle-piece',
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'cew_add_widget_categories' );