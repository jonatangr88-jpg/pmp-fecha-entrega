<?php

if (!defined('ABSPATH')) {
    exit;
}

class PMP_Fecha_Entrega_Settings
{

    const OPTION_NAME = 'pmp_fecha_entrega_settings';

    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'menu']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function menu()
    {
        add_submenu_page(
            'woocommerce',
            'PMP Fecha de Entrega',
            'PMP Fecha de Entrega',
            'manage_woocommerce',
            'pmp-fecha-entrega',
            [__CLASS__, 'page']
        );
    }

    public static function register_settings()
    {
        register_setting(
            'pmp_fecha_entrega_group',
            self::OPTION_NAME
        );
    }

    public static function page()
    {

        $options = get_option(self::OPTION_NAME, []);

        $min = isset($options['min']) ? esc_attr($options['min']) : '';
        $max = isset($options['max']) ? esc_attr($options['max']) : '';

        $intervals = [];

        if (!empty($options['intervals']) && is_array($options['intervals'])) {
            $intervals = $options['intervals'];
        }

        ?>

        <div class="wrap">

            <h1>PMP Fecha de Entrega</h1>

            <form method="post" action="options.php">

                <?php
                settings_fields('pmp_fecha_entrega_group');
                ?>

                <table class="form-table">

                    <tr>

                        <th>Fecha mínima disponible</th>

                        <td>

                            <input
                                type="text"
                                id="pmp_min_date"
                                name="<?php echo self::OPTION_NAME; ?>[min]"
                                value="<?php echo $min; ?>"
                                class="regular-text">

                        </td>

                    </tr>

                    <tr>

                        <th>Fecha máxima disponible</th>

                        <td>

                            <input
                                type="text"
                                id="pmp_max_date"
                                name="<?php echo self::OPTION_NAME; ?>[max]"
                                value="<?php echo $max; ?>"
                                class="regular-text">

                        </td>

                    </tr>

                </table>

                <hr>

                <h2>Intervalos bloqueados</h2>

                <table
                    class="widefat"
                    id="pmp_interval_table">

                    <thead>

                    <tr>

                        <th>Desde</th>
                        <th>Hasta</th>
                        <th width="80"></th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    if (empty($intervals)) {
                        $intervals[] = [
                            'from' => '',
                            'to' => ''
                        ];
                    }

                    foreach ($intervals as $interval) {

                        ?>

                        <tr>

                            <td>

                                <input
                                    type="text"
                                    class="pmp_interval_from"
                                    name="<?php echo self::OPTION_NAME; ?>[intervals][][from]"
                                    value="<?php echo esc_attr($interval['from']); ?>">

                            </td>

                            <td>

                                <input
                                    type="text"
                                    class="pmp_interval_to"
                                    name="<?php echo self::OPTION_NAME; ?>[intervals][][to]"
                                    value="<?php echo esc_attr($interval['to']); ?>">

                            </td>

                            <td>

                                <button
                                    type="button"
                                    class="button pmp_remove_interval">

                                    Eliminar

                                </button>

                            </td>

                        </tr>

                        <?php

                    }

                    ?>

                    </tbody>

                </table>

                <p>

                    <button
                        type="button"
                        class="button button-secondary"
                        id="pmp_add_interval">

                        Añadir intervalo

                    </button>

                </p>

                <?php submit_button(); ?>

            </form>

        </div>

        <script>

        document.addEventListener("DOMContentLoaded",function(){

            function iniciarCalendarios(){

                flatpickr("#pmp_min_date",{
                    locale:"es",
                    dateFormat:"Y-m-d"
                });

                flatpickr("#pmp_max_date",{
                    locale:"es",
                    dateFormat:"Y-m-d"
                });

                document.querySelectorAll(".pmp_interval_from").forEach(function(el){

                    if(!el._flatpickr){

                        flatpickr(el,{
                            locale:"es",
                            dateFormat:"Y-m-d"
                        });

                    }

                });

                document.querySelectorAll(".pmp_interval_to").forEach(function(el){

                    if(!el._flatpickr){

                        flatpickr(el,{
                            locale:"es",
                            dateFormat:"Y-m-d"
                        });

                    }

                });

            }

            iniciarCalendarios();

            document.getElementById("pmp_add_interval").addEventListener("click",function(){

                let tbody=document.querySelector("#pmp_interval_table tbody");

                tbody.insertAdjacentHTML("beforeend",`

<tr>

<td>

<input
type="text"
class="pmp_interval_from"
name="<?php echo self::OPTION_NAME; ?>[intervals][][from]">

</td>

<td>

<input
type="text"
class="pmp_interval_to"
name="<?php echo self::OPTION_NAME; ?>[intervals][][to]">

</td>

<td>

<button
type="button"
class="button pmp_remove_interval">

Eliminar

</button>

</td>

</tr>

`);

                iniciarCalendarios();

            });

            document.addEventListener("click",function(e){

                if(e.target.classList.contains("pmp_remove_interval")){

                    e.target.closest("tr").remove();

                }

            });

        });

        </script>

        <?php

    }

}