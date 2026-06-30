<?php

if (!defined('ABSPATH')) {
    exit;
}

class PMP_Fecha_Entrega_Utils
{

    /**
     * Devuelve la configuración del plugin.
     */
    public static function get_settings()
    {
        return get_option('pmp_fecha_entrega_settings', []);
    }

    /**
     * Fecha mínima.
     */
    public static function get_min_date()
    {
        $settings = self::get_settings();

        return !empty($settings['min']) ? $settings['min'] : '';
    }

    /**
     * Fecha máxima.
     */
    public static function get_max_date()
    {
        $settings = self::get_settings();

        return !empty($settings['max']) ? $settings['max'] : '';
    }

    /**
     * Intervalos bloqueados.
     */
    public static function get_disabled_ranges()
    {

        $settings = self::get_settings();

        if (empty($settings['intervals'])) {
            return [];
        }

        $ranges = [];

        foreach ($settings['intervals'] as $interval) {

            if (
                empty($interval['from']) ||
                empty($interval['to'])
            ) {
                continue;
            }

            $ranges[] = [
                'from' => $interval['from'],
                'to'   => $interval['to']
            ];

        }

        return $ranges;

    }

}