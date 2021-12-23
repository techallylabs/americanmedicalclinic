<?php

// Element Description: PT Price_List

class PT_Accordion extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_accordion_mapping' ) );
        add_shortcode( 'pt_accordion', array( $this, 'pt_accordion_html' ) );
        add_shortcode( 'pt_accordion_item', array( $this, 'pt_accordion_item_html' ) );
    }
     
    // Element Mapping
    public function pt_accordion_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Accordion", "medel"),
            "base" => "pt_accordion",
            "as_parent" => array('only' => 'pt_accordion_item'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "icon" => "shortcode-icon-accordion",
            "is_container" => true,
            "category" => esc_html__("By PT", "medel"),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Accordion item", "medel"),
            "base" => "pt_accordion_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-accordion",
            "as_child" => array('only' => 'pt_accordion'),
            "params" => array(
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Text", "medel"),
                    "param_name" => "text",
                    "admin_label" => true,
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_accordion_html( $atts, $content = null ) {
         
        // Params extraction
        /*
        extract(
            shortcode_atts(
                array(
                ), 
                $atts
            )
        );
        */

        // Fill $html var with data
        $html = '<div class="accordion-items">';
            $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_accordion_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'heading' => '',
                    'text' => '',
                ), 
                $atts
            )
        );
         
        // Fill $html var with data

        $html = '';

        if(!empty($heading) && !empty($text)) {
            $html .= '<div class="item">';
                $html .= '<div class="top"><div class="t"></div><div class="cell">'.wp_kses_post($heading).'</div></div>';
                $html .= '<div class="wrap">'.wp_kses_post($text).'</div>';
            $html .= '</div>';
        }
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Accordion();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Accordion extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Accordion_Item extends WPBakeryShortCode {
    }
}

