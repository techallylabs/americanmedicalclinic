<?php

// Element Description: PT Testimonials

class PT_Testimonials extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_testimonials_mapping' ) );
        add_shortcode( 'pt_testimonials', array( $this, 'pt_testimonials_html' ) );
        add_shortcode( 'pt_testimonials_item', array( $this, 'pt_testimonials_item_html' ) );
    }
     
    // Element Mapping
    public function pt_testimonials_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Testimonials", "medel"),
            "base" => "pt_testimonials",
            "as_parent" => array('only' => 'pt_testimonials_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-testimonials",
            "is_container" => true,
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "el_id",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                    "group"      => esc_html__("General", "medel"),
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
                    "param_name"  => "desktop_cols",
                    "value"      => array(
                        esc_html__( "Col 1", "medel" ) => "1",
                        esc_html__( "Col 2", "medel" ) => "2",
                        esc_html__( "Col 3", "medel" ) => "3",
                        esc_html__( "Col 4", "medel" ) => "4",
                    ),
                    "std" => '3',
                    "group"      => esc_html__("General", "medel"),
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
                    "group"      => esc_html__("General", "medel"),
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
                    "group"      => esc_html__("General", "medel"),
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
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Background Color", "medel" ),
                    "param_name" => "arrow_background_color",
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
            "name" => esc_html__("Testimonials item", "medel"),
            "base" => "pt_testimonials_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-testimonials",
            "as_child" => array('only' => 'pt_testimonials'),
            "params" => array(
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Background image", "medel"),
                    "param_name" => "image",
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Post", "medel"),
                    "param_name" => "post",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Text", "medel"),
                    "param_name" => "text",
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_testimonials_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'desktop_cols' => '3',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                    'carousel' => 'on',
                    'speed' => '500',
                    'autoplay' => 'on',
                    'autoplay_speed' => '3000',
                    'arrows' => 'on',
                    'arrow_color' => '',
                    'pauseohover' => 'on',
                ), 
                $atts
            )
        );

        $id = 'testimonials-'.$uniq_id;

        $category_class = $id;

        $html = "";

        // Fill $html var with data
        if(!empty($content)) {
            $content = str_replace('[pt_testimonials_item ', '[pt_testimonials_item carousel="'.$carousel.'" desktop_cols="'.$desktop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }

        $custom_css = "";

        if(isset($arrow_color) && !empty($arrow_color)) {
            $custom_css .= '.'.$id.' .owl-nav {
                color: '.$arrow_color.';
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
                    if(jQuery(this).find('.testimonial-item').length > 1){
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
                                768:{
                                    nav: ".esc_js($arrows).",
                                    items: ".esc_js($mobile_cols).",
                                },
                                980:{
                                    items: ".esc_js($tablet_cols).",
                                },
                                1200:{
                                    items: ".esc_js($desktop_cols).",
                                },
                            },
                        });
                    }
                });
            });");
        }

        $html = '<div class="testimonials row '.esc_attr($category_class).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_testimonials_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'desktop_cols' => '3',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                    'carousel' => 'on',
                    'image' => '',
                    'heading' => '',
                    'post' => '',
                    'text' => '',
                ), 
                $atts
            )
        );
        
        // Fill $html var with data

        $html = "";

        if($carousel != 'on') {
            $html .= '<div class="col-xs-'.esc_attr(12/$mobile_cols).' col-sm-'.esc_attr(12/$tablet_cols).' col-md-'.esc_attr(12/$desktop_cols).'">';
        }
            $html .= '<div class="testimonial-item">';
                $html .= '<div class="top">';
                    if(isset(wp_get_attachment_image_src($image, 'full')[0]) && !empty(wp_get_attachment_image_src($image, 'full')[0])) {
                        $html .= '<div class="image"><div style="background-image: url('.esc_url(wp_get_attachment_image_src($image, 'full')[0]).')"></div></div>';
                    }
                    $html .= '<div class="title"><div class="cell">';
                        if($heading) {
                            $html .= '<div class="h">'.wp_kses($heading, 'post').'</div>';
                        }
                        if($post) {
                            $html .= '<div class="post">'.wp_kses($post, 'post').'</div>';
                        }
                    $html .= '</div></div>';
                $html .= '</div>';
                if($text) {
                    $html .= '<div class="text">'.wp_kses($text, 'post').'</div>';
                }
            $html .= '</div>';
        if($carousel != 'on') {
            $html .= '</div>';
        }

        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Testimonials();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Testimonials extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Testimonials_Item extends WPBakeryShortCode {
    }
}

