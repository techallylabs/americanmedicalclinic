<?php

// Element Description: PT Category

class PT_Category extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_category_mapping' ) );
        add_shortcode( 'pt_category', array( $this, 'pt_category_html' ) );
        add_shortcode( 'pt_category_item', array( $this, 'pt_category_item_html' ) );
    }

    public static function get_all_portfolio_category() {
        $taxonomy = 'pt-portfolio-category';
        $args     = array(
            'hide_empty' => true,
        );

        $terms     = get_terms( $taxonomy, $args );
        $result    = array();
        $result[0] = "";

        if ( ! empty( $terms ) && !is_wp_error( $terms )  ) {
            foreach ( $terms as $term ) {
                $name = get_category_parents($term->term_id);
                $name = trim($name, '/');
                $result[ 'ID ['.$term->term_id.'] '.$name ] = $term->term_id;
            }
        }

        return $result;
    }

    public static function get_all_blog_category() {
        $taxonomy = 'category';
        $args     = array(
            'hide_empty' => true,
        );

        $terms     = get_terms( $taxonomy, $args );
        $result    = array();
        $result[0] = "";

        if ( ! empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $name = get_category_parents($term->term_id);
                $name = trim($name, '/');
                $result[ 'ID ['.$term->term_id.'] '.$name ] = $term->term_id;
            }
        }

        return $result;
    }

    public static function get_all_product_category() {
        $taxonomy = 'product_cat';
        $args     = array(
            'hide_empty' => true,
        );

        $terms     = get_terms( $taxonomy, $args );
        $result    = array();
        $result[0] = "";

        if ( ! empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $name = get_category_parents($term->term_id);
                $name = trim($name, '/');
                $result[ 'ID ['.$term->term_id.'] '.$name ] = $term->term_id;
            }
        }

        return $result;
    }
     
    // Element Mapping
    public function pt_category_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Category", "medel"),
            "base" => "pt_category",
            "as_parent" => array('only' => 'pt_category_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-category",
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
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Style", "medel" ),
                    "param_name"  => "style",
                    "value"      => array(
                        esc_html__( "Style 1", "medel" ) => "style1",
                        esc_html__( "Style 2", "medel" ) => "style2",
                    ),
                    "std" => "style1",
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
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Text Background Color", "medel" ),
                    "param_name" => "text_bg_color",
                    "group"       => esc_html__("Design", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Text Color", "medel" ),
                    "param_name" => "text_color",
                    "group"       => esc_html__("Design", "medel"),
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
            "name" => esc_html__("Category item", "medel"),
            "base" => "pt_category_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-category",
            "as_child" => array('only' => 'pt_category'),
            "params" => array(
                array(
                    "type"        => "el_id",
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
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Source", "medel" ),
                    "param_name"  => "source",
                    "admin_label" => true,
                    "value"      => array(
                        esc_html__( "Blog", "medel" ) => "blog",
                        esc_html__( "Portfolio", "medel" ) => "portfolio",
                        esc_html__( "Product", "medel" ) => "product",
                        esc_html__( "Custom link", "medel" ) => "custom_link",
                    ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Category", "medel" ),
                    "param_name"  => "category_portfolio",
                    "admin_label" => true,
                    "value"       => PT_Category::get_all_portfolio_category(),
                    "dependency" => Array("element" => "source", "value" => "portfolio" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Category", "medel" ),
                    "param_name"  => "category_blog",
                    "admin_label" => true,
                    "value"       => PT_Category::get_all_blog_category(),
                    "dependency" => Array("element" => "source", "value" => "blog" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Category", "medel" ),
                    "param_name"  => "category_product",
                    "admin_label" => true,
                    "value"       => PT_Category::get_all_product_category(),
                    "dependency" => Array("element" => "source", "value" => "product" ),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Custom link", "medel"),
                    "param_name" => "custom_link",
                    "dependency" => Array("element" => "source", "value" => "custom_link" ),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_category_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'style' => 'style1',
                    'desktop_cols' => '3',
                    'tablet_cols' => '2',
                    'mobile_cols' => '1',
                    'text_bg_color' => '',
                    'text_color' => '',
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

        $id = 'category-'.$uniq_id;

        $category_class = $id;

        $html = $custom_css = "";

        if(!empty($text_color)) {
            $custom_css .= '.'.$id.' .h {
                color: '.$text_color.';
            }';
        }

        if(!empty($arrow_color)) {
            $custom_css .= '.'.$id.' .owl-nav {
                color: '.$arrow_color.';
            }';
        }

        if(!empty($text_bg_color)) {
            $custom_css .= '.'.$id.' .h:before {
                background-color: '.$text_bg_color.';
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
                    if(jQuery(this).find('.category-item').length > 1){
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

        // Fill $html var with data
        if(!empty($content)) {
            $content = str_replace('[pt_category_item ', '[pt_category_item style="'.$style.'" carousel="'.$carousel.'" desktop_cols="'.$desktop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }

        $html = '<div class="category row '.esc_attr($category_class).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_category_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'style' => 'style1',
                    'carousel' => 'on',
                    'desktop_cols' => '3',
                    'tablet_cols' => '2',
                    'mobile_cols' => '1',
                    'image' => '',
                    'heading' => '',
                    'source' => 'blog',
                    'category_portfolio' => '',
                    'category_blog' => '',
                    'category_product' => '',
                    'custom_link' => '',
                ), 
                $atts
            )
        );

        $uniq_id = uniqid();

        if($source != 'custom_link') {
            if($category_portfolio) {
                $link = get_category_link($category_portfolio);
            }
            if($category_blog) {
                $link = get_category_link($category_blog);
            }
            if($category_product) {
                $link = get_category_link($category_product);
            }
        } else if($source == 'custom_link' && isset(vc_build_link($custom_link)['url']) && !empty(vc_build_link($custom_link)['url'])) {
            $link = vc_build_link($custom_link)['url'];
        }

        $html = "";

        if($carousel != 'on') {
            $html .= '<div class="col-xs-'.esc_attr(12/$mobile_cols).' col-sm-'.esc_attr(12/$tablet_cols).' col-md-'.esc_attr(12/$desktop_cols).'">';
        }
        if($style == 'style2') {
            $html .= '<div class="category-item-style2">';
                if(isset(wp_get_attachment_image_src($image, 'full')[0]) && !empty(wp_get_attachment_image_src($image, 'full')[0])) {
                    $html .= '<div class="image" style="background-image: url('.esc_url(wp_get_attachment_image_src($image, 'full')[0]).')"></div>';
                }
                if(!empty($heading)) {
                    $html .= '<div class="h"><div class="cell">'.wp_kses($heading, 'post').'</div></div>';
                }
                $html .= '<a href="'.esc_url($link).'"></a>';
            $html .= '</div>';
        } else {
            $html .= '<div class="category-item category-'.esc_attr($uniq_id).'">';
                if(isset(wp_get_attachment_image_src($image, 'full')[0]) && !empty(wp_get_attachment_image_src($image, 'full')[0])) {
                    $html .= '<div class="image" style="background-image: url('.esc_url(wp_get_attachment_image_src($image, 'full')[0]).')"></div>';
                }
                if(!empty($heading)) {
                    $html .= '<div class="h"><div class="cell">'.wp_kses($heading, 'post').'</div></div>';
                }
                $html .= '<a href="'.esc_url($link).'"></a>';
            $html .= '</div>';
        }
        if($carousel != 'on') {
            $html .= '</div>';
        }
        

         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Category();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Category extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Category_Item extends WPBakeryShortCode {
    }
}

