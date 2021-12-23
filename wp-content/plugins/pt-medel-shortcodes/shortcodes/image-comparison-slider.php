<?php

// Element Description: PT Image Comparison Slider

class PT_Image_Comparison_Slider extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_image_comparison_slider_mapping' ) );
        add_shortcode( 'pt_image_comparison_slider', array( $this, 'pt_image_comparison_slider_html' ) );
    }
     
    // Element Mapping
    public function pt_image_comparison_slider_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Image Comparison Slider", "medel"),
            "base" => "pt_image_comparison_slider",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-image-comparison-slider",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Old", "medel"),
                    "param_name" => "old",
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("New", "medel"),
                    "param_name" => "new",
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Width", "medel" ),
                    "param_name"  => "width",
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Height", "medel" ),
                    "param_name"  => "height",
                ),
                array(
                    "type" => "animation_style",
                    "heading" => __( "Animation In", "medel" ),
                    "param_name" => "animation",
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_image_comparison_slider_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'old' => '',
                    'new' => '',
                    'width' => '',
                    'height' => '',
                    'animation' => '',
                ), 
                $atts
            )
        );

        $class = $id = uniqid('image-comparison-slider-');

        $custom_css = $old_style_attr = $new_style_attr = $style_attr = '';

        $animation = $this->getCSSAnimation($animation);

        if(!empty($old)) {
            $old_style_attr = 'background-image: url('.esc_url(wp_get_attachment_image_src($old, 'full')[0]).');';
        }

        if(!empty($new)) {
            $new_style_attr = 'background-image: url('.esc_url(wp_get_attachment_image_src($new, 'full')[0]).');';
        }

        if(!empty($width)) {
            $style_attr .= 'width: '.$width.'px;';
        }

        if(!empty($height)) {
            $style_attr .= 'height: '.$height.'px;';
        }

        $html = '';

        $html .= '<div class="image-comparison-slider '.esc_attr($animation).'" style="'.esc_attr($style_attr).'">';
            $html .= '<div class="new" style="'.esc_attr($new_style_attr).'"></div>';
            $html .= '<div class="resize"><div class="old" style="'.esc_attr($old_style_attr).'"></div></div>';
            $html .= '<div class="line"></div>';
        $html .= '</div>';

        return $html;
         
    }

    
     
} // End Element Class
 
 
// Element Class Init
new PT_Image_Comparison_Slider();