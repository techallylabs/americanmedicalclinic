<?php

// Element Description: PT Banner

class PT_Banner extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_banner_mapping' ) );
        add_shortcode( 'pt_banner', array( $this, 'pt_banner_html' ) );
        add_shortcode( 'pt_banner_item', array( $this, 'pt_banner_item_html' ) );
    }
     
    // Element Mapping
    public function pt_banner_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Banner", "medel"),
            "base" => "pt_banner",
            "as_parent" => array('only' => 'pt_banner_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "is_container" => true,
            "icon" => "shortcode-icon-banner",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "el_id",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Infinite loop", "medel" ),
                    "param_name"  => "infinite_loop",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "label" => esc_html__( "Restart the slider automatically as it passes the last slide.", "medel" ),
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "dependency"  => "",
                    "default_set" => true,
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "number",
                    "class"       => "",
                    "heading"     => esc_html__( "Transition speed", "medel" ),
                    "param_name"  => "speed",
                    "value"       => "300",
                    "min"         => "100",
                    "max"         => "10000",
                    "step"        => "100",
                    "suffix"      => "ms",
                    "description" => esc_html__( "Speed at which next slide comes.", "medel" ),
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Autoplay Slides", "medel" ),
                    "param_name"  => "autoplay",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "label" => esc_html__( "Enable Autoplay", "medel" ),
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "dependency"  => "",
                    "default_set" => true,
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "number",
                    "heading"    => esc_html__( "Autoplay Speed", "medel" ),
                    "param_name" => "autoplay_speed",
                    "value"      => "5000",
                    "min"        => "100",
                    "max"        => "10000",
                    "step"       => "10",
                    "suffix"     => "ms",
                    "dependency" => Array( "element" => "autoplay", "value" => array( "on" ) ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Adaptive Height", "medel" ),
                    "param_name" => "adaptive_height",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "label" => esc_html__( "Turn on Adaptive Height", "medel" ),
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "number",
                    "heading"    => esc_html__( "Height", "medel" ),
                    "param_name" => "height",
                    "min"        => "540",
                    "max"        => "1500",
                    "step"       => "10",
                    "suffix"     => "px",
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Social buttons", "medel" ),
                    "param_name" => "social_buttons",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Social buttons color", "medel"),
                    "param_name" => "social_buttons_color",
                    "dependency" => Array( "element" => "social_buttons", "value" => array( "on" ) ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Scroll next screen button", "medel" ),
                    "param_name" => "scroll_next",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Scroll next screen button color", "medel"),
                    "param_name" => "scroll_next_color",
                    "dependency" => Array( "element" => "scroll_next", "value" => array( "on" ) ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Navigation Arrows", "medel" ),
                    "param_name"  => "arrows",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"       => esc_html__("Navigation", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Background Color", "medel" ),
                    "param_name" => "arrow_background_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"      => esc_html__("Navigation", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Color", "medel" ),
                    "param_name" => "arrow_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"      => esc_html__("Navigation", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Navigation Numbers", "medel" ),
                    "param_name"  => "dots",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"       => esc_html__("Navigation", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Numbers Color", "medel" ),
                    "param_name" => "dots_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"      => esc_html__("Navigation", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Pause on hover", "medel" ),
                    "param_name" => "pauseohover",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "label" => esc_html__( "Pause the slider on hover", "medel" ),
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "dependency" => Array("element" => "autoplay", "value" => "on" ),
                    "group"      => esc_html__("Navigation", "medel"),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Banner item", "medel"),
            "base" => "pt_banner_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-banner",
            "as_child" => array('only' => 'pt_banner'),
            "params" => array(
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Background type", "medel" ),
                    "param_name"  => "background_type",
                    "value"      => array(
                        esc_html__( "Image", "medel" ) => "image",
                        esc_html__( "Gradient", "medel" ) => "gradient",
                        esc_html__( "Color", "medel" ) => "color",
                    ),
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Background image", "medel"),
                    "param_name" => "background_image",
                    "dependency" => Array("element" => "background_type", "value" => "image" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "gradient",
                    "base_gradient" => "#feb332 0%,#d38d14 100%",
                    "base_orientation" => "vertical",
                    "heading" => esc_html__("Background gradient", "medel"),
                    "param_name" => "background_gradient",
                    "dependency" => Array("element" => "background_type", "value" => "gradient" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Background color", "medel"),
                    "param_name" => "background_color",
                    "dependency" => Array("element" => "background_type", "value" => "color" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "description" => wp_kses(__('Wrap the text in { } if you want the text to be colored.<br>Example: Minds your work {level}','medel'),'post'),
                    "admin_label" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Text", "medel"),
                    "param_name" => "text",
                    "admin_label" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Link Button", "medel" ),
                    "param_name" => "link_button",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Link", "medel"),
                    "param_name" => "link",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link text", "medel"),
                    "param_name" => "link_text",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Link Button 2", "medel" ),
                    "param_name" => "link_button2",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => esc_html__("On", "medel"),
                            "off"   => esc_html__("Off", "medel"),
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Link", "medel"),
                    "param_name" => "link2",
                    "dependency" => Array("element" => "link_button2", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link text", "medel"),
                    "param_name" => "link_text2",
                    "dependency" => Array("element" => "link_button2", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Align", "medel" ),
                    "param_name"  => "content_align",
                    "value"      => array(
                        esc_html__( "Left", "medel" ) => "left",
                        esc_html__( "Center", "medel" ) => "center",
                        esc_html__( "Right", "medel" ) => "right",
                    ),
                    "group"       => esc_html__("Design", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Color overlay", "medel"),
                    "param_name" => "color_overlay",
                    "dependency" => Array("element" => "background_type", "value" => "image" ),
                    "group"      => esc_html__("Design", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Item color", "medel" ),
                    "param_name"  => "text_color",
                    "value"      => array(
                        esc_html__( "Black", "medel" ) => "black",
                        esc_html__( "White", "medel" ) => "white",
                        esc_html__( "Custom", "medel" ) => "custom",
                    ),
                    "group"       => esc_html__("Design", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Select Item color", "medel"),
                    "param_name" => "text_color_hex",
                    "dependency" => Array("element" => "text_color", "value" => "custom" ),
                    "group"      => esc_html__("Design", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Select heading decor color", "medel"),
                    "param_name" => "heading_color_hex",
                    "group"      => esc_html__("Design", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Select text color", "medel"),
                    "param_name" => "custom_text_color_hex",
                    "group"      => esc_html__("Design", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Heading size", "medel" ),
                    "param_name"  => "heading_size",
                    "value"      => array(
                        esc_html__( "H1", "medel" ) => "h1",
                        esc_html__( "H2", "medel" ) => "h2",
                        esc_html__( "H3", "medel" ) => "h3",
                        esc_html__( "H4", "medel" ) => "h4",
                        esc_html__( "H5", "medel" ) => "h5",
                        esc_html__( "H6", "medel" ) => "h6",
                    ),
                    "group"       => esc_html__("Design", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Custom heading size", "medel"),
                    "param_name" => "custom_heading_size",
                    "group"      => esc_html__("Design", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Text vertical align", "medel" ),
                    "param_name"  => "text_vertical_align",
                    "value"      => array(
                        esc_html__( "Top", "medel" ) => "top",
                        esc_html__( "Middle", "medel" ) => "middle",
                        esc_html__( "Bottom", "medel" ) => "bottom",
                    ),
                    "std" => 'middle',
                    "group"       => esc_html__("Design", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Button background type", "medel" ),
                    "param_name"  => "button_bg",
                    "value"      => array(
                        esc_html__( "Color", "medel" ) => "color",
                        esc_html__( "Gradient", "medel" ) => "gradient",
                        esc_html__( "Transparent", "medel" ) => "transparent",
                    ),
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"       => esc_html__( "Button Design", "medel" ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Button Bg color", "medel"),
                    "param_name" => "button_bg_color",
                    "dependency" => Array("element" => "button_bg", "value" => "color" ),
                    "group"      => esc_html__( "Button Design", "medel" ),
                ),
                array(
                    "type" => "gradient",
                    "base_gradient" => "#8c80ce 0%,#e04391 100%",
                    "base_orientation" => "vertical",
                    "heading" => esc_html__("Button Bg gradient", "medel"),
                    "param_name" => "button_bg_gradient",
                    "dependency" => Array("element" => "button_bg", "value" => "gradient" ),
                    "group"      => esc_html__("Button Design", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Button Text color", "medel"),
                    "param_name" => "button_text_color",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__( "Button Design", "medel" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Button background type", "medel" ),
                    "param_name"  => "button_bg2",
                    "value"      => array(
                        esc_html__( "Color", "medel" ) => "color",
                        esc_html__( "Gradient", "medel" ) => "gradient",
                        esc_html__( "Transparent", "medel" ) => "transparent",
                    ),
                    "dependency" => Array("element" => "link_button2", "value" => "on" ),
                    "group"       => esc_html__( "Button 2 Design", "medel" ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Button Bg color", "medel"),
                    "param_name" => "button_bg_color2",
                    "dependency" => Array("element" => "button_bg2", "value" => "color" ),
                    "group"      => esc_html__( "Button 2 Design", "medel" ),
                ),
                array(
                    "type" => "gradient",
                    "base_gradient" => "#8c80ce 0%,#e04391 100%",
                    "base_orientation" => "vertical",
                    "heading" => esc_html__("Button Bg gradient", "medel"),
                    "param_name" => "button_bg_gradient2",
                    "dependency" => Array("element" => "button_bg2", "value" => "gradient" ),
                    "group"      => esc_html__( "Button 2 Design", "medel" ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Button Text color", "medel"),
                    "param_name" => "button_text_color2",
                    "dependency" => Array("element" => "link_button2", "value" => "on" ),
                    "group"      => esc_html__( "Button 2 Design", "medel" ),
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_banner_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'infinite_loop' => 'on',
                    'speed' => '300',
                    'autoplay' => 'on',
                    'autoplay_speed' => '5000',
                    'adaptive_height' => 'on',
                    'height' => '',
                    'arrows' => 'on',
                    'arrow_color' => '',
                    'pauseohover' => 'on',
                    'social_buttons' => 'on',
                    'scroll_next' => 'on',
                    'social_buttons_color' => '',
                    'scroll_next_color' => '',
                    'arrow_background_color' => '',
                    'dots' => 'on',
                    'dots_color' => '',
                ), 
                $atts
            )
        );

        $banner_area_class = $id = 'banner-'.$uniq_id;
        $banner_class = '';
        $banner_style = '';

        if(!empty($height)) {
            $banner_style .= 'height: '.$height.'px;';
            $banner_class .= ' fixed-height';
        }

        if($autoplay == 'on') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }

        if($arrows == 'on') {
            $arrows = 'true';
        } else {
            $arrows = 'false';
        }

        if($dots == 'on') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }

        if($pauseohover == 'on') {
            $pauseohover = 'true';
        } else {
            $pauseohover = 'false';
        }

        wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
        wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), true );
        wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

        wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
            jQuery('.".esc_attr($id)." .banner').each(function(){
                var head_slider = jQuery(this);
                if(jQuery(this).find('.item').length > 1){
                    head_slider.addClass('owl-carousel').owlCarousel({
                        loop:true,
                        items:1,
                        nav: ".esc_js($arrows).",
                        dots: ".esc_js($dots).",
                        autoplay: ".esc_js($autoplay).",
                        autoplayTimeout: ".esc_js($autoplay_speed).",
                        autoplayHoverPause: ".esc_js($pauseohover).",
                        smartSpeed: ".esc_js($speed).",
                        navClass: ['owl-prev','owl-next'],
                        navText: ['<i class=\"free-basic-ui-elements-left-arrow\"></i>', '<i class=\"free-basic-ui-elements-right-arrow\"></i>'],
                        responsive:{
                            0:{
                                nav: false,
                            },
                            768:{
                                nav: ".esc_js($arrows).",
                                dots: ".esc_js($dots).",
                            },
                        },
                    });
                }
            });
        });");

        $custom_css = "";

        if(isset($social_buttons_color) && !empty($social_buttons_color)) {
            $custom_css .= '.'.$id.' .banner-social-buttons {
                color: '.$social_buttons_color.';
            }';
        }

        if(isset($scroll_next_color) && !empty($scroll_next_color)) {
            $custom_css .= '.'.$id.' .scroll-next-screen {
                color: '.$scroll_next_color.';
            }';
        }

        if(isset($arrow_color) && !empty($arrow_color)) {
            $custom_css .= '.'.$id.' .owl-prev, .'.$id.' .owl-next {
                color: '.$arrow_color.';
            }';
        }

        if(isset($arrow_background_color) && !empty($arrow_background_color)) {
            $custom_css .= '.'.$id.' .owl-prev, .'.$id.' .owl-next {
                background-color: '.$arrow_background_color.';
            }';
        }

        if(isset($dots_color) && !empty($dots_color)) {
            $custom_css .= '.'.$id.' .owl-dots {
                color: '.$dots_color.';
            }';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        $html = '<div class="banner-area '.esc_attr($banner_area_class).'">';
            if($social_buttons == 'on') {
                $html .= '<div class="banner-social-buttons"><div>'.wp_kses(medel_styles()['social_buttons_content'] ,'post').'</div></div>';
            }
            $html .= '<div class="banner '.esc_attr($banner_class).'" style="'.esc_attr($banner_style).'">';
                $html .= do_shortcode($content);
            $html .= '</div>';

            if($scroll_next == 'on') {
                $html .= '<div class="scroll-next-screen"></div>';
            }
        $html .= '</div>';

        return $html;
         
    }

    // Element HTML
    public function pt_banner_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'align' => 'left',
                    'background_type' => 'image',
                    'background_image' => '',
                    'background_gradient' => '',
                    'background_color' => '',
                    'heading' => '',
                    'text' => '',
                    'link_button' => 'on',
                    'link' => '',
                    'link_text' => '',
                    'link_button2' => 'on',
                    'link2' => '',
                    'link_text2' => '',
                    'content_align' => 'left',
                    'parallax_elements' => 'on',
                    'color_overlay' => '',
                    'text_color' => 'black',
                    'text_color_hex' => '',
                    'heading_color_hex' => '',
                    'heading_size' => 'h1',
                    'custom_heading_size' => '',
                    'text_vertical_align' => 'middle',
                    'button_bg' => 'color',
                    'button_bg_color' => '',
                    'button_bg_gradient' => '',
                    'button_text_color' => '',
                    'button_bg2' => 'color',
                    'button_bg_color2' => '',
                    'button_bg_gradient2' => '',
                    'button_text_color2' => '',
                    'custom_text_color_hex' => ''
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        $item_attr = '';
        $custom_css = '';

        $item_class = $id = "banner-item-".uniqid();

        if(isset(vc_build_link($link)['url']) && !empty(vc_build_link($link)['url'])) {
            $link = vc_build_link($link);
        }
        if(isset(vc_build_link($link2)['url']) && !empty(vc_build_link($link2)['url'])) {
            $link2 = vc_build_link($link2);
        }

        if($background_type == 'image' && isset(wp_get_attachment_image_src($background_image, 'full')[0])) {
            $item_attr = 'background-image: url('.esc_url(wp_get_attachment_image_src($background_image, 'full')[0]).');';
        }

        if($background_type == 'gradient' && !empty($background_gradient)) {
            $background_gradient = strip_tags(explode("||", $background_gradient)[1]);
            if(!empty($background_gradient)) {
                $item_attr = $background_gradient;
            }
        }

        if($background_type == 'color' && !empty($background_color)) {
            $item_attr = 'background-color: '.esc_attr($background_color).';';
        }

        if(isset($text_color) && $text_color != 'custom') {
            $item_class .= ' '.$text_color;
        }

        if(isset($content_align)) {
            $item_class .= ' content-align-'.$content_align;
        }

        if(!empty($text_vertical_align)) {
            $item_class .= ' '.$text_vertical_align;
        }

        if(isset($text_color) && $text_color == 'custom') {
            $custom_css .= '.'.$id.' {
                color: '.$text_color_hex.';
            }';
        }

        if(isset($custom_text_color_hex) && !empty($custom_text_color_hex)) {
            $custom_css .= '.'.$id.' .text {
                color: '.$custom_text_color_hex.';
            }';
        }

        if(!empty($color_overlay)) {
            $custom_css .= '.'.$id.' .overlay {
                background-color: '.$color_overlay.';
            }';
        }

        if(!empty($heading_color_hex)) {
            $custom_css .= '.'.$id.' .h span {';
                $custom_css .= 'color: '.$heading_color_hex.';';
            $custom_css .= '}';
        }

        if(!empty($custom_heading_size)) {
            $custom_css .= '.'.$id.' .h {';
                $custom_css .= 'font-size: '.$custom_heading_size.';';
            $custom_css .= '}';
        }

        if(!empty($button_bg_color) || !empty($button_bg_gradient) || !empty($button_text_color)) {
            $custom_css .= '.'.$id.' .button-style1.link1 {';
                if(!empty($button_bg_color)) {
                    $custom_css .= 'background: '.$button_bg_color.' !important;';
                }
                if(!empty($button_bg_gradient)) {
                    $button_bg_gradient = strip_tags(explode("||", $button_bg_gradient)[1]);
                    $custom_css .= $button_bg_gradient;
                }
                if(!empty($button_text_color)) {
                    $custom_css .= 'color: '.$button_text_color.';';
                }
            $custom_css .= '}';
        }

        if(!empty($button_bg_color2) || !empty($button_bg_gradient2) || !empty($button_text_color2)) {
            $custom_css .= '.'.$id.' .button-style1.link2 {';
                if(!empty($button_bg_color2)) {
                    $custom_css .= 'background: '.$button_bg_color2.' !important;';
                }
                if(!empty($button_bg_gradient2)) {
                    $button_bg_gradient = strip_tags(explode("||", $button_bg_gradient2)[1]);
                    $custom_css .= $button_bg_gradient2;
                }
                if(!empty($button_text_color2)) {
                    $custom_css .= 'color: '.$button_text_color2.';';
                }
            $custom_css .= '}';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );
        
        $html = '<div class="item '.esc_attr($item_class).'" style="'.esc_attr($item_attr).'">';
            if(!empty($color_overlay)) {
                $html .= '<div class="overlay"></div>';
            }
            $html .= '<div class="container">';
                if($content_align == "right") {
                    $html .= '<div class="content-right">';
                }
                $html .= '<div class="cell">';
                    if(!empty($heading)) {
                        $heading = str_replace(array('{', '}'), array('<span>', '</span>'), $heading);
                        $html .= '<'.esc_attr($heading_size).' class="h">'.wp_kses($heading, 'post').'</'.esc_attr($heading_size).'>';
                    }
                    if(!empty($text)) {
                        $html .= '<div class="text">'.wp_kses($text, 'post').'</div>';
                    }
                    $html .= '<div class="link-area">';
                        if($link_button == 'on' && !empty($link) && !empty($link_text)) {
                            if(empty($link['target'])) {
                                $link['target'] = '_self';
                            }
                            $html .= '<a href="'.esc_url($link['url']).'" class="button-style1 link1" title="'.esc_attr($link['title']).'" target="'.esc_attr($link['target']).'">'.esc_html($link_text).'</a>';
                        }
                        if($link_button2 == 'on' && !empty($link2) && !empty($link_text2)) {
                            if(empty($link2['target'])) {
                                $link2['target'] = '_self';
                            }
                            $html .= '<a href="'.esc_url($link2['url']).'" class="button-style1 link2" title="'.esc_attr($link2['title']).'" target="'.esc_attr($link2['target']).'">'.esc_html($link_text2).'</a>';
                        }
                    $html .= '</div>';
                $html .= '</div>';
                if($content_align == "right") {
                    $html .= '</div>';
                }
            $html .= '</div>';
        $html .= '</div>';

        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Banner();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Banner extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Banner_Item extends WPBakeryShortCode {
    }
}

