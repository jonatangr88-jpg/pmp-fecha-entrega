<?php

if (!defined('ABSPATH')) {
    exit;
}

class PMP_Fecha_Entrega_Product
{

    const META_KEY = '_pmp_requires_delivery_date';

    public static function init()
    {
        add_action(
            'woocommerce_product_options_general_product_data',
            [__CLASS__, 'field']
        );

        add_action(
            'woocommerce_process_product_meta',
            [__CLASS__, 'save']
        );
    }

    public static function field()
    {

        echo '<div class="options_group">';

        woocommerce_wp_checkbox([
            'id'          => self::META_KEY,
            'label'       => 'Este producto requiere selección de fecha de entrega',
            'description' => 'Si está marcado, el cliente deberá seleccionar una fecha antes de añadir el producto al carrito.'
        ]);

        echo '</div>';

    }

    public static function save($product_id)
    {

        $value = isset($_POST[self::META_KEY]) ? 'yes' : 'no';

        update_post_meta(
            $product_id,
            self::META_KEY,
            $value
        );

    }

    public static function requires_date($product_id)
    {

        return get_post_meta(
            $product_id,
            self::META_KEY,
            true
        ) === 'yes';

    }

}