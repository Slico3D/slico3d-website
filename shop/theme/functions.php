<?php
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', static function () {
    wp_enqueue_style('slico3d-style', get_stylesheet_uri(), array('storefront-style'), wp_get_theme()->get('Version'));
});

add_action('after_setup_theme', static function () {
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_footer', 'storefront_credit', 20);
    add_action('storefront_header', 'slico3d_branding', 20);
    add_action('storefront_footer', 'slico3d_footer', 20);
}, 20);

function slico3d_branding() {
    echo '<div class="site-branding"><a class="slico-brand" href="' . esc_url(home_url('/')) . '" aria-label="SLICO3D Startseite">';
    echo '<img src="' . esc_url(get_stylesheet_directory_uri() . '/assets/logotyp.svg') . '" width="400" height="100" alt="SLICO3D">';
    echo '</a></div>';
}

function slico3d_footer() {
    echo '<div class="slico-footer"><p>© ' . esc_html(wp_date('Y')) . ' SLICO3D · Gedruckt in Bayern.</p>';
    echo '<a href="' . esc_url(home_url('/kontakt/')) . '">Kontakt</a></div>';
}

add_filter('body_class', static function ($classes) {
    $classes[] = 'storefront-full-width-content';
    return $classes;
});
add_action('wp', static function () {
    remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
});
