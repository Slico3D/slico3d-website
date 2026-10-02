<?php
/**
 * Plugin Name: SLICO3D Local Environment
 * Description: Local mail capture and indexing protection. Does nothing in production.
 */

defined('ABSPATH') || exit;

if (wp_get_environment_type() !== 'local') {
    return;
}

add_filter('pre_option_blog_public', static function () { return '0'; });
add_filter('wp_headers', static function ($headers) {
    $headers['X-Robots-Tag'] = 'noindex, nofollow';
    return $headers;
});

// All WordPress mail is delivered to the local inbox, never to real recipients.
// localhost alone is not a valid sender domain for PHPMailer.
add_filter('wp_mail_from', static function () { return 'shop@slico3d.test'; });
add_filter('wp_mail_from_name', static function () { return 'SLICO3D'; });
add_action('phpmailer_init', static function ($mailer) {
    $mailer->isSMTP();
    $mailer->Host = 'mailpit';
    $mailer->Port = 1025;
    $mailer->SMTPAuth = false;
    $mailer->SMTPSecure = '';
    $mailer->SMTPAutoTLS = false;
});

// Skip WooCommerce's onboarding upsells while building a local empty shop.
add_filter('woocommerce_enable_setup_wizard', '__return_false');
add_filter('woocommerce_show_admin_notice', static function ($show, $notice) {
    return $notice === 'install' ? false : $show;
}, 10, 2);
