<?php

if(!class_exists('medel_Slider_Param'))
{
    class medel_Slider_Param
    {
        function __construct()
        {
            add_action('admin_enqueue_scripts',array($this,'admin_scripts'));
            if(defined('WPB_VC_VERSION') && version_compare(WPB_VC_VERSION, 4.8) >= 0) {
                if(function_exists('vc_add_shortcode_param'))
                {
                    vc_add_shortcode_param('slider' , array(&$this, 'slider_settings_field' ));
                }
            }
            else {
                if(function_exists('add_shortcode_param'))
                {
                    add_shortcode_param('slider' , array(&$this, 'slider_settings_field' ));
                }
            }
        }

        function admin_scripts($hook){
            wp_register_script("rangeSlider", plugins_url('pt-medel-shortcodes') . '/include/js/ion.rangeSlider.min.js',array('jquery'));
            wp_register_script("jqueryui", 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',array('jquery'));

            if ( $hook == "post.php" || $hook == "post-new.php" ) {
                wp_enqueue_script('rangeSlider');
                //wp_enqueue_script('jqueryui');
            }
        }

        function slider_settings_field($settings, $value)
        {
            $dependency = '';
            $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
            $type       = isset($settings['type']) ? $settings['type'] : '';
            $min        = isset($settings['min']) ? $settings['min'] : '';
            $max        = isset($settings['max']) ? $settings['max'] : '';
            $step       = isset($settings['step']) ? $settings['step'] : '';
            $class      = isset($settings['class']) ? $settings['class'] : '';
            $output = '<input type="slider" class="wpb_vc_param_value ' . esc_attr( $param_name ) . ' ' . esc_attr( $type ) . ' ' . esc_attr( $class ) . '" name="' . esc_attr( $param_name ) . '" value="'.esc_attr( $value ).'" />';
            ?>
            <link rel="stylesheet" href="<?php echo plugins_url('pt-medel-shortcodes') . '/include/css/ion.rangeSlider.css' ?>" type="text/css" media="all">
            <link rel="stylesheet" href="<?php echo plugins_url('pt-medel-shortcodes') . '/include/css/ion.rangeSlider.skinNice.css' ?>" type="text/css" media="all">
            <script>
                jQuery(document).ready(function(jQuery) {
                    jQuery(".slider.<?php echo esc_js($settings['param_name']) ?>").ionRangeSlider({
                        grid: true,
                        min: <?php echo esc_js($min); ?>,
                        max: <?php echo esc_js($max); ?>,
                        step: <?php echo esc_js($step); ?>,
                    }); 
                });
            </script>
            <?php
            return $output;
        }

    }
}

if(class_exists('medel_Slider_Param'))
{
    $medel_Slider_Param = new medel_Slider_Param();
}