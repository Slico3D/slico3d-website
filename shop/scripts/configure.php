<?php
/** Idempotent local bootstrap. Does not create products or legal declarations. */
if (wp_get_environment_type() !== 'local') {
    WP_CLI::error('This setup is for a local environment only.');
}
if (!class_exists('WooCommerce') || !class_exists('WC_Germanized')) {
    WP_CLI::error('WooCommerce and Germanized must both be active.');
}

// Later reruns preserve changes made in the admin UI.
if (get_option('slico_local_configured')) {
    WP_CLI::success('Existing local configuration preserved.');
    return;
}

function slico_create_page($slug, $title, $content = '', $status = 'publish') {
    $existing = get_page_by_path($slug);
    if ($existing) {
        return (int) $existing->ID;
    }
    $id = wp_insert_post(array(
        'post_type' => 'page', 'post_status' => $status,
        'post_name' => $slug, 'post_title' => $title, 'post_content' => $content,
    ), true);
    if (is_wp_error($id)) {
        WP_CLI::error($id->get_error_message());
    }
    return (int) $id;
}

$options = array(
    'blogname' => 'SLICO3D',
    'blogdescription' => 'Praktische 3D-Lösungen. Gedruckt in Bayern.',
    'timezone_string' => 'Europe/Berlin',
    'blog_public' => '0',
    'default_comment_status' => 'closed',
    'woocommerce_currency' => 'EUR',
    'woocommerce_default_country' => 'DE',
    'woocommerce_currency_pos' => 'right_space',
    'woocommerce_price_decimal_sep' => ',',
    'woocommerce_price_thousand_sep' => '.',
    'woocommerce_weight_unit' => 'kg',
    'woocommerce_dimension_unit' => 'cm',
    'woocommerce_allowed_countries' => 'specific',
    'woocommerce_specific_allowed_countries' => array('DE'),
    'woocommerce_ship_to_countries' => 'specific',
    'woocommerce_specific_ship_to_countries' => array('DE'),
    'woocommerce_enable_guest_checkout' => 'yes',
    'woocommerce_enable_signup_and_login_from_checkout' => 'no',
    'woocommerce_enable_myaccount_registration' => 'no',
    'woocommerce_manage_stock' => 'yes',
    'woocommerce_allow_tracking' => 'no',
    'woocommerce_store_pages' => 'no',
    'woocommerce_coming_soon' => 'no',
);
foreach ($options as $key => $value) {
    update_option($key, $value);
}

// Core sample content is removed only from this new, dedicated local install.
$sample_post = get_post(1);
if ($sample_post && $sample_post->post_type === 'post'
    && in_array($sample_post->post_name, array('hello-world', 'hallo-welt'), true)) {
    wp_delete_post($sample_post->ID, true);
}
$sample_page = get_page_by_path('sample-page');
if ($sample_page) { wp_delete_post($sample_page->ID, true); }

$pages = array(
    'shop' => slico_create_page('shop', 'Shop'),
    'cart' => slico_create_page('warenkorb', 'Warenkorb', '[woocommerce_cart]'),
    'checkout' => slico_create_page('kasse', 'Kasse', '[woocommerce_checkout]'),
    'myaccount' => slico_create_page('mein-konto', 'Mein Konto', '[woocommerce_my_account]'),
    'home' => slico_create_page('start', 'Start'),
    'blog' => slico_create_page('blog', 'Blog'),
    'about' => slico_create_page('ueber-slico3d', 'Über SLICO3D', '<p>Praktische Lösungen aus dem 3D-Druck. Gefertigt in Bayern.</p>'),
    'contact' => slico_create_page('kontakt', 'Kontakt', '<p>Du hast Fragen? Schreib uns an <a href="mailto:kontakt@slico3d.de">kontakt@slico3d.de</a>.</p>'),
);
foreach (array('shop', 'cart', 'checkout', 'myaccount') as $key) {
    update_option('woocommerce_' . $key . '_page_id', $pages[$key]);
}
update_option('show_on_front', 'page');
update_option('page_on_front', $pages['home']);
update_option('page_for_posts', $pages['blog']);

// Drafts are placeholders in admin, not published or presented as valid legal text.
foreach (array(
    'impressum' => 'Impressum', 'datenschutz' => 'Datenschutz',
    'widerruf' => 'Widerrufsbelehrung', 'agb' => 'AGB',
    'versand-zahlung' => 'Versand & Zahlung',
) as $slug => $title) {
    slico_create_page($slug, $title, '', 'draft');
}

$menu_name = 'SLICO3D Navigation';
$menu = wp_get_nav_menu_object($menu_name);
$menu_id = $menu ? $menu->term_id : wp_create_nav_menu($menu_name);
if (is_wp_error($menu_id)) { WP_CLI::error($menu_id->get_error_message()); }
if (!wp_get_nav_menu_items($menu_id)) {
    foreach (array('home', 'shop', 'blog', 'about', 'contact') as $key) {
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-object-id' => $pages[$key], 'menu-item-object' => 'page',
            'menu-item-type' => 'post_type', 'menu-item-status' => 'publish',
        ));
    }
}
set_theme_mod('nav_menu_locations', array('primary' => $menu_id, 'handheld' => $menu_id));

// No gateway, bank account, tax status or carrier is configured at this stage.
update_option('slico_local_configured', gmdate('c'));
WP_CLI::success('Empty German shop configured. Product count unchanged.');
