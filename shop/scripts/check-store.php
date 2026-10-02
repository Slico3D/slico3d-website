<?php
/** Integration checks against a disposable, empty local installation. */
function slico_check($condition, $message) {
    if (!$condition) { WP_CLI::error($message); }
    WP_CLI::log('OK: ' . $message);
}
slico_check(wp_get_environment_type() === 'local', 'Local environment');
slico_check(get_locale() === 'de_DE', 'German language');
slico_check(class_exists('WooCommerce') && class_exists('WC_Germanized'), 'Both shop plugins active');
slico_check(get_stylesheet() === 'slico3d', 'SLICO3D theme active');
slico_check(get_option('woocommerce_currency') === 'EUR', 'EUR currency');
slico_check(get_option('woocommerce_enable_guest_checkout') === 'yes', 'Guest checkout enabled');
slico_check(get_option('blog_public') === '0', 'Search indexing disabled');
slico_check((int) wp_count_posts('product')->publish === 0, 'No published products');
slico_check((int) wp_count_posts('product')->draft === 0, 'No draft product cards');
foreach (array('shop', 'cart', 'checkout', 'myaccount') as $key) {
    $id = wc_get_page_id($key);
    slico_check($id > 0 && get_post_status($id) === 'publish', $key . ' page exists');
}
foreach (array('impressum', 'datenschutz', 'widerruf', 'agb', 'versand-zahlung') as $slug) {
    $page = get_page_by_path($slug);
    slico_check($page && $page->post_status === 'draft', $slug . ' remains an unpublished draft');
}
foreach (WC()->payment_gateways()->payment_gateways() as $gateway) {
    slico_check($gateway->enabled !== 'yes', 'No live gateway: ' . $gateway->id);
}
slico_check(wp_mail('nobody@example.invalid', 'SLICO3D local test', 'Local mail delivery test.'), 'Test mail sent to local inbox');
WP_CLI::success('Empty shop integration checks passed.');
