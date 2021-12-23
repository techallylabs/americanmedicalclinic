<?php

if(!class_exists('medel_Dorpdown_Multi_Param'))
{
    class medel_Dorpdown_Multi_Param
    {
        function __construct()
        {
            add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
            if(defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
                if(function_exists('vc_add_shortcode_param'))
                {
                    vc_add_shortcode_param('dropdown_multi' , array(&$this, 'dropdown_multi_settings_field' ));
                }
            }
            else {
                if(function_exists('add_shortcode_param'))
                {
                    add_shortcode_param('dropdown_multi' , array(&$this, 'dropdown_multi_settings_field' ));
                }
            }

        }

        function admin_scripts($hook){
            wp_register_script("chosen", plugins_url('pt-medel-shortcodes') . '/include/js/chosen.jquery.min.js',array('jquery'));
            wp_register_script("jqueryui", 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',array('jquery'));

            if ( $hook == "post.php" || $hook == "post-new.php" ) {
                wp_enqueue_script('chosen');
                //wp_enqueue_script('jqueryui');
            }
        }

        function dropdown_multi_settings_field($settings, $value)
        {
            $output = '';
            $css_option = str_replace( '#', 'hash-', vc_get_dropdown_option( $settings, $value ) );
            $output .= '<select multiple name="'
                       . $settings['param_name']
                       . '" class="wpb_vc_param_value '
                       . $settings['param_name']
                       . ' ' . $settings['type']
                       . ' ' . $css_option
                       . '" data-option="' . $css_option . '">';
            if ( is_array( $value ) ) {
                $value = isset( $value['value'] ) ? $value['value'] : array_shift( $value );
            }
            if ( ! empty( $settings['value'] ) ) {
                foreach ( $settings['value'] as $index => $data ) {
                    if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
                        $option_label = $data;
                        $option_value = $data;
                    } elseif ( is_numeric( $index ) && is_array( $data ) ) {
                        $option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
                        $option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
                    } else {
                        $option_value = $data;
                        $option_label = $index;
                    }
                    $selected = '';
                    $option_value_string = (string) $option_value;
                    $value_string = (string) $value;
                    $array = explode(',', $value_string);
                    if ( in_array($option_value_string,$array) && !empty($value_string)) {
                        $selected = ' selected="selected"';
                    }
                    $option_class = str_replace( '#', 'hash-', $option_value );
                    $output .= '<option class="' . esc_attr( $option_class ) . '" value="' . esc_attr( $option_value ) . '"' . $selected . '>'
                               . htmlspecialchars( $option_label ) . '</option>';
                }
            }
            $output .= '</select>';

            if(!empty($css_option)) {
                $css_option = str_replace(",", "','", $css_option);
            }
            ?>
            <link rel="stylesheet" href="<?php echo plugins_url('pt-medel-shortcodes') . '/include/css/chosen.css' ?>" type="text/css" media="all">
            <script>
                jQuery(document).ready(function(jQuery) {
                    jQuery(".dropdown_multi.<?php echo esc_js($settings['param_name']) ?>").each(function(){
                        jQuery(this).selectize({
                            plugins: ['remove_button', 'drag_drop'],
                            items: ['<?php echo wp_kses($css_option, 'post') ?>']
                        }); 
                    }); 
                });
            </script>
            <?php
            return $output;
        }

    }
}

if(class_exists('medel_Dorpdown_Multi_Param'))
{
    $medel_Dorpdown_Multi_Param = new medel_Dorpdown_Multi_Param();
}