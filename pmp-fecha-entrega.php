<?php
/**
 * Plugin Name: PMP Fecha de Entrega
 * Description: Selector de fecha de entrega para productos WooCommerce.
 * Version: 1.0.0
 * Author: Pilar Merello
 * Text Domain: pmp-fecha-entrega
 */

if (!defined('ABSPATH')) {
    exit;
}

define('PMP_FECHA_ENTREGA_VERSION', '1.0.0');
define('PMP_FECHA_ENTREGA_PATH', plugin_dir_path(__FILE__));
define('PMP_FECHA_ENTREGA_URL', plugin_dir_url(__FILE__));

add_action('plugins_loaded', 'pmp_fecha_entrega_init');

function pmp_fecha_entrega_init()
{
    if (!class_exists('WooCommerce')) {
        return;
    }

    require_once PMP_FECHA_ENTREGA_PATH . 'includes/class-utils.php';
    require_once PMP_FECHA_ENTREGA_PATH . 'includes/class-settings.php';
    require_once PMP_FECHA_ENTREGA_PATH . 'includes/class-product.php';
    require_once PMP_FECHA_ENTREGA_PATH . 'includes/class-calendar.php';

    PMP_Fecha_Entrega_Settings::init();
    PMP_Fecha_Entrega_Product::init();
    PMP_Fecha_Entrega_Calendar::init();
}

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

add_action('wp_enqueue_scripts', function () {

    if (!is_product()) {
        return;
    }

    wp_enqueue_style('pmp-flatpickr', PMP_FECHA_ENTREGA_URL . 'assets/css/flatpickr.min.css', [], PMP_FECHA_ENTREGA_VERSION);
    wp_enqueue_style('pmp-style', PMP_FECHA_ENTREGA_URL . 'assets/css/style.css', ['pmp-flatpickr'], PMP_FECHA_ENTREGA_VERSION);

    wp_enqueue_script('pmp-flatpickr', PMP_FECHA_ENTREGA_URL . 'assets/js/flatpickr.min.js', [], PMP_FECHA_ENTREGA_VERSION, true);
    wp_enqueue_script('pmp-flatpickr-es', PMP_FECHA_ENTREGA_URL . 'assets/js/l10n/es.js', ['pmp-flatpickr'], PMP_FECHA_ENTREGA_VERSION, true);
    wp_enqueue_script('pmp-calendar', PMP_FECHA_ENTREGA_URL . 'assets/js/calendar.js', ['jquery', 'pmp-flatpickr', 'pmp-flatpickr-es'], PMP_FECHA_ENTREGA_VERSION, true);

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

add_action('admin_enqueue_scripts', function ($hook) {

    if (
        strpos($hook, 'woocommerce_page_pmp-fecha-entrega') === false &&
        $hook !== 'post.php' &&
        $hook !== 'post-new.php'
    ) {
        return;
    }

    wp_enqueue_style('pmp-flatpickr', PMP_FECHA_ENTREGA_URL . 'assets/css/flatpickr.min.css', [], PMP_FECHA_ENTREGA_VERSION);

    wp_enqueue_script('pmp-flatpickr', PMP_FECHA_ENTREGA_URL . 'assets/js/flatpickr.min.js', [], PMP_FECHA_ENTREGA_VERSION, true);

    wp_enqueue_script('pmp-flatpickr-es', PMP_FECHA_ENTREGA_URL . 'assets/js/l10n/es.js', ['pmp-flatpickr'], PMP_FECHA_ENTREGA_VERSION, true);

});