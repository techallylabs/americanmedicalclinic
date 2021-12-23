<?php

// Element Description: PT Price_List

class PT_Price_List extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_price_list_mapping' ) );
        add_shortcode( 'pt_price_list', array( $this, 'pt_price_list_html' ) );
        add_shortcode( 'pt_price_list_item', array( $this, 'pt_price_list_item_html' ) );
    }
     
    // Element Mapping
    public function pt_price_list_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Price List", "medel"),
            "base" => "pt_price_list",
            "as_parent" => array('only' => 'pt_price_list_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-price-list",
            "is_container" => true,
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
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Style", "medel" ),
                    "param_name"  => "style",
                    "value"      => array(
                        esc_html__( "Style 1", "medel" ) => "style1",
                        esc_html__( "Style 2", "medel" ) => "style2",
                    ),
                    "std" => 'style1',
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Carousel", "medel" ),
                    "param_name" => "carousel",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Desktop", "medel" ),
                    "param_name"  => "desctop_cols",
                    "value"      => array(
                        esc_html__( "Col 1", "medel" ) => "1",
                        esc_html__( "Col 2", "medel" ) => "2",
                        esc_html__( "Col 3", "medel" ) => "3",
                        esc_html__( "Col 4", "medel" ) => "4",
                    ),
                    "std" => '3',
                    "group"       => esc_html__("Cols", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Tablet", "medel" ),
                    "param_name"  => "tablet_cols",
                    "value"      => array(
                        esc_html__( "Col 1", "medel" ) => "1",
                        esc_html__( "Col 2", "medel" ) => "2",
                        esc_html__( "Col 3", "medel" ) => "3",
                        esc_html__( "Col 4", "medel" ) => "4",
                    ),
                    "std" => '2',
                    "group"       => esc_html__("Cols", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Mobile", "medel" ),
                    "param_name"  => "mobile_cols",
                    "value"      => array(
                        esc_html__( "Col 1", "medel" ) => "1",
                        esc_html__( "Col 2", "medel" ) => "2",
                        esc_html__( "Col 3", "medel" ) => "3",
                        esc_html__( "Col 4", "medel" ) => "4",
                    ),
                    "std" => '1',
                    "group"       => esc_html__("Cols", "medel"),
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
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
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
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "dependency"  => "",
                    "default_set" => true,
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
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
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Navigation Arrows", "medel" ),
                    "param_name"  => "arrows",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "label" => esc_html__( "Display next / previous navigation arrows", "medel" ),
                            "on"    => "On",
                            "off"   => "Off",
                        ),
                    ),
                    "default_set" => true,
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Color", "medel" ),
                    "param_name" => "arrow_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Pause on hover", "medel" ),
                    "param_name" => "pauseohover",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "label" => esc_html__( "Pause the slider on hover", "medel" ),
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "dependency" => Array("element" => "autoplay", "value" => "on" ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Price List item", "medel"),
            "base" => "pt_price_list_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-price-list",
            "as_child" => array('only' => 'pt_price_list'),
            "params" => array(
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Background image", "medel"),
                    "param_name" => "image",
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Price", "medel"),
                    "param_name" => "price",
                    "admin_label" => true,
                    "description" => esc_html__("Exapmple: $ 80 {/ day}" ,'medel'),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Options", "medel"),
                    "param_name" => "options",
                    "description"      => esc_html__("Per row", "medel"),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Link Button", "medel" ),
                    "param_name" => "link_button",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Custom link", "medel"),
                    "param_name" => "custom_link",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link text", "medel"),
                    "param_name" => "link_text",
                    "value"      => esc_html__('purchase', 'medel'),
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Text color", "medel"),
                    "param_name" => "button_text_color",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("Button customize", "medel"),
                    "edit_field_class"      => "vc_col-sm-6"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Hover color", "medel"),
                    "param_name" => "button_text_color_hover",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("Button customize", "medel"),
                    "edit_field_class"      => "vc_col-sm-6"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Background color", "medel"),
                    "param_name" => "button_bg_color",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("Button customize", "medel"),
                    "edit_field_class"      => "vc_col-sm-6"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Hover color", "medel"),
                    "param_name" => "button_bg_color_hover",
                    "dependency" => Array("element" => "link_button", "value" => "on" ),
                    "group"      => esc_html__("Button customize", "medel"),
                    "edit_field_class"      => "vc_col-sm-6"
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_price_list_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'carousel' => 'on',
                    'style' => 'style1',
                    'cols' => '3',
                    'speed' => '500',
                    'autoplay' => 'on',
                    'autoplay_speed' => '3000',
                    'arrows' => 'on',
                    'arrow_color' => '',
                    'pauseohover' => 'on',
                    'desctop_cols' => '3',
                    'tablet_cols' => '2',
                    'mobile_cols' => '1',
                ), 
                $atts
            )
        );

        $id = 'price-list-'.$uniq_id;

        $category_class = $id;

        if($style) {
            $category_class .= ' '.$style;
        }

        $custom_css = "";

        if(isset($dots_color) && !empty($dots_color)) {
            $custom_css .= '.'.$id.' .owl-dots {
                color: '.$dots_color.';
            }';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        if($carousel == "on") {
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
            if($pauseohover == 'on') {
                $pauseohover = 'true';
            } else {
                $pauseohover = 'false';
            }

            wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
            wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery') );
            wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

            wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
                jQuery('.".esc_attr($id)."').each(function(){
                    var head_slider = jQuery(this);
                    if(jQuery(this).find('.item').length > 1){
                        head_slider.addClass('owl-carousel').owlCarousel({
                            loop:true,
                            items:1,
                            nav: ".esc_js($arrows).",
                            dots: false,
                            autoplay: ".esc_js($autoplay).",
                            autoplayTimeout: ".esc_js($autoplay_speed).",
                            autoplayHoverPause: ".esc_js($pauseohover).",
                            smartSpeed: ".esc_js($speed).",
                            navClass: ['owl-prev free-basic-ui-elements-left-arrow','owl-next free-basic-ui-elements-right-arrow'],
                            navText: false,
                            margin: 30,
                            responsive:{
                                0:{
                                    nav: false,
                                    items: 1,
                                },
                                480:{
                                    
                                },
                                768:{
                                    nav: ".esc_js($arrows).",
                                    items: ".esc_js($mobile_cols).",
                                },
                                980:{
                                    items: ".esc_js($tablet_cols).",
                                },
                                1200:{
                                    items: ".esc_js($desctop_cols).",
                                },
                            },
                        });
                    }
                });
            });");
        }

        // Fill $html var with data
        if(!empty($content)) {
            $content = str_replace('[pt_price_list_item ', '[pt_price_list_item carousel="'.$carousel.'" desctop_cols="'.$desctop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }

         
        // Fill $html var with data
        $html = '<div class="price-list row '.esc_attr($category_class).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_price_list_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'price' => '',
                    'image' => '',
                    'carousel' => 'on',
                    'options' => '',
                    'custom_link' => '',
                    'heading' => '',
                    'link_button' => 'on',
                    'link_text' => esc_html__('purchase','medel'),
                    'button_text_color' => '',
                    'button_text_color_hover' => '',
                    'button_bg_color' => '',
                    'button_bg_color_hover' => '',
                    'desctop_cols' => '3',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                ), 
                $atts
            )
        );
         
        // Fill $html var with data

        $heading_html = $link_html = $price_html = $custom_css = $link = $options_heading_html = $options_html = $style = "";

        $item_class = $item_id = uniqid('price-list-item-');

        if(!$heading) {
            $heading = '';
        }

        if($heading) {
            $heading_html = '<h6 class="h">'.$heading.'</h6>';
        }

        if(isset(wp_get_attachment_image_src($image, 'full')[0]) && !empty(wp_get_attachment_image_src($image, 'full')[0])) {
            $style = 'background-image: url('.esc_url(wp_get_attachment_image_src($image, 'full')[0]).');';
        }

        if($price) {
            $price_html = '<div class="price">'.str_replace(array('{','}'), array('<span>','</span>'), $price).'</div>';
        }

        if(isset(vc_build_link($custom_link)['url']) && !empty(vc_build_link($custom_link)['url'])) {
            $link = vc_build_link($custom_link)['url'];
        }

        if($link_button == 'on' && !empty($link) && !empty($link_text)) {
            $link_html = '<a href="'.esc_url($link).'" class="button-style1">'.esc_html($link_text).'</a>';
            if(!empty($button_text_color) || !empty($button_bg_color)) {
                $custom_css .= '.'.$item_id.' .button-style1 {';
                if(!empty($button_text_color)) {
                    $custom_css .= 'color: '.$button_text_color.';';
                }
                if(!empty($button_bg_color)) {
                    $custom_css .= 'background-color: '.$button_bg_color.';';
                }
                $custom_css .= '}';
            }

            if(!empty($button_text_color_hover) || !empty($button_bg_color_hover)) {
                $custom_css .= '.'.$item_id.' .button-style1:hover {';
                if(!empty($button_text_color_hover)) {
                    $custom_css .= 'color: '.$button_text_color_hover.';';
                }
                if(!empty($button_bg_color_hover)) {
                    $custom_css .= 'background-color: '.$button_bg_color_hover.';';
                }
                $custom_css .= '}';
            }
        }

        if($options) {
            $options = preg_split('/\r\n|[\r\n]/', $options);

            foreach ($options as $option) {
                $options_html .= '<div class="o-item">'.$option.'</div>';
            }
        }

        if(isset($text_color) && $text_color != 'custom') {
            $item_class .= ' '.$text_color;
        }

        if(isset($text_color) && $text_color == 'custom') {
            $custom_css .= '.'.$item_id.' {
                color: '.$text_color_hex.';
            }';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        if($carousel != 'on') {
        	$item_class .= ' col-xs-'.esc_attr(12/$mobile_cols).' col-sm-'.esc_attr(12/$tablet_cols).' col-md-'.esc_attr(12/$desctop_cols);
        }
        
        $html = '<div class="item '.esc_attr($item_class).'">
                    <div class="wrap">
                        <div class="top" style="'.esc_attr($style).'">
                            <div class="cell">
        	                    '.wp_kses($heading_html, 'post').'
        	                    '.wp_kses($price_html, 'post').'
                            </div>
                        </div>
	                    <div class="options">
                            '.wp_kses($options_html, 'post').'
                        </div>
	                    '.wp_kses($link_html, 'post').'
                    </div>
                </div>';
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Price_List();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Price_List extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Price_List_Item extends WPBakeryShortCode {
    }
}

