<?php

// Element Description: PT Portfolio

class PT_Portfolio_Horizontal_Items extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_portfolio_horizontal_mapping' ) );
        add_shortcode( 'pt_portfolio_horizontal', array( $this, 'pt_portfolio_horizontal_html' ) );
    }

    public static function get_all_portfolio_horizontal_category() {
        $taxonomy = 'pt-portfolio-category';
        $args     = array(
            'hide_empty' => true,
        );

        $terms     = get_terms( $taxonomy, $args );
        $result    = array();
        $result[0] = "";

        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $name = get_category_parents($term->term_id);
                $name = trim($name, '/');
                $result[ 'ID ['.$term->term_id.'] '.$name ] = $term->term_id;
            }
        }

        return $result;
    }

    public static function get_all_portfolio_horizontal_items( $param = 'All' ) {
        $result    = array();
        
        $args = array(
            'post_type'       => 'pt-portfolio',
            'post_status'     => 'publish',
            'posts_per_page'    => '10000'
        );

        $porfolio_array = new WP_Query( $args );
        $result[0] = "";

        if ( ! empty( $porfolio_array->posts ) ) {
            foreach ( $porfolio_array->posts as $item ) {
                $result[ 'ID ['.$item->ID.'] '. $item->post_title ] = $item->ID;
            }
        }

        return $result;
    }
     
    // Element Mapping
    public function pt_portfolio_horizontal_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Portfolio Horizontal", "medel"),
            "base" => "pt_portfolio_horizontal",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-portfolio-horizontal",
            "is_container" => true,
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                    "group"       => esc_html__( "General", "medel" ),
                ),
                array(
                    "type"        => "number",
                    "heading"     => esc_html__( "Count items", "medel" ),
                    "param_name"  => "count_items",
                    "value"       => '9',
                    "admin_label" => true,
                    "group"       => esc_html__( "General", "medel" ),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Spacing between elements", "medel" ),
                    "param_name"  => "spacing_between_elements",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "on"    => esc_html__( "On", "medel" ),
                            "off"   => esc_html__( "Off", "medel" ),
                        ),
                    ),
                    "default_set" => true,
                    "group"       => esc_html__( "General", "medel" ),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Sub Heading", "medel"),
                    "param_name" => "sub_heading",
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Text", "medel"),
                    "param_name" => "text",
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Link", "medel"),
                    "param_name" => "link",
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link Text", "medel"),
                    "param_name" => "link_text",
                    "value"  => esc_html__('work with me', 'medel'),
                    "group"      => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Order by", "medel" ),
                    "param_name"  => "orderby",
                    "value"      => array(
                        esc_html__('Default', 'medel') => 'post__in',
                        esc_html__('Author', 'medel') => 'author',
                        esc_html__('Category', 'medel') => 'category',
                        esc_html__('Date', 'medel') => 'date',
                        esc_html__('ID', 'medel') => 'ID',
                        esc_html__('Title', 'medel') => 'title',
                    ),
                    "group"       => esc_html__( "Sorting", "medel" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Order", "medel" ),
                    "param_name"  => "order",
                    "value"      => array(
                        esc_html__('Ascending order', 'medel') => 'ASC',
                        esc_html__('Descending order', 'medel') => 'DESC',
                    ),
                    "group"       => esc_html__( "Sorting", "medel" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Source", "medel" ),
                    "param_name"  => "source",
                    "value"      => array(
                        esc_html__( "---", "medel" ) => "",
                        esc_html__( "Items", "medel" ) => "items",
                        esc_html__( "Categories", "medel" ) => "categories",
                    ),
                    "group"       => esc_html__( "Source", "medel" ),
                ),
                array(
                    "type"        => "dropdown_multi",
                    "heading"     => esc_html__( "Items", "medel" ),
                    "param_name"  => "items",
                    "dependency"  => Array( "element" => "source", "value" => array( "items" ) ),
                    "value"       => PT_Portfolio_Horizontal_Items::get_all_portfolio_horizontal_items(),
                    "group"       => esc_html__( "Source", "medel" ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Category", "medel" ),
                    "param_name"  => "categories",
                    "dependency"  => Array( "element" => "source", "value" => array( "categories" ) ),
                    "value"       => PT_Portfolio_Horizontal_Items::get_all_portfolio_horizontal_category(),
                    "group"       => esc_html__( "Source", "medel" ),
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_portfolio_horizontal_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'count_items' => '9',
                    'spacing_between_elements' => 'on',
                    'orderby' => 'post__in',
                    'heading' => '',
                    'sub_heading' => '',
                    'text' => '',
                    'link' => '',
                    'link_text' => esc_html__('work with me', 'medel'),
                    'order' => 'ASC',
                    'source' => '',
                    'items' => '',
                    'categories' => '',
                ), 
                $atts
            )
        );

        $wrap_id = 'portfolio-'.$uniq_id;

        $tax_query = array();

        if ( !empty($categories) && $categories != '0' ) {
            $tax_query = array(
                array(
                    'taxonomy' => 'pt-portfolio-category',
                    'field'    => 'id',
                    'terms'    => $categories
                )
            );
        }
        if($items) {
            $items = explode(',', $items);
        } else {
            $items = '';
        }
        $args = array(
            'post__in'        => $items,
            'posts_per_page'  => $count_items,
            'orderby'         => $orderby,
            'order'           => $order,
            'post_type'       => 'pt-portfolio',
            'post_status'     => 'publish',
            'tax_query'       => $tax_query
        );

        $porfolio_array = new WP_Query( $args );

        $html = '';

        if($spacing_between_elements == 'on') {
            $margin = 30;
        } else {
            $margin = 0;
        }

        wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
        wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), true );
        wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

        wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
            jQuery('.".esc_attr($wrap_id)." .ph-slider').each(function(){
                var head_slider = jQuery(this);
                if(jQuery(this).find('.item').length > 1){
                    head_slider.addClass('owl-carousel').owlCarousel({
                        loop:true,
                        items:1,
                        autoWidth: true,
                        nav: true,
                        dots: false,
                        autoplay: false,
                        margin: $margin,
                        navClass: ['owl-prev ui-super-basic-previous','owl-next ui-super-basic-next'],
                        navText: false
                    });
                }
            });
        });");

        $html = "";

        $html .= '<div class="portfolio-h '.esc_attr($wrap_id).'">';
            $html .= '<div class="text"><div class="cell">';
                if(!empty($sub_heading)) {
                    $html .= '<div class="heading-decor tal type-h5 uppercase"><h5 class="sub-h"><div>'.wp_kses($sub_heading, 'post').'</div></h5></div>';
                }
                if(!empty($heading)) {
                    $html .= '<h3 class="h uppercase">'.wp_kses($heading, 'post').'</h3>';
                }
                if(!empty($text)) {
                    $html .= '<p>'.wp_kses($text, 'post').'</p>';
                }
                if(isset(vc_build_link($link)['url']) && !empty(vc_build_link($link)['url'])) {
                    if(empty(vc_build_link($link)['target'])) {
                        $link['target'] = '_self';
                    } else {
                        $link['target'] = vc_build_link($link);
                    }
                    $html .= '<a href="'.vc_build_link($link)['url'].'" target="'.$link['target'].'" class="button-style1 transperent">'.wp_kses($link_text, 'post').'</a>';
                }
            $html .= '</div></div>';
            $html .= '<div class="ph-slider-area">';
                $html .= '<div class="ph-slider popup-gallery">';
                    while ( $porfolio_array->have_posts() ) : $porfolio_array->the_post();
                        $id = get_the_ID();
                        $item = get_post($id);
                        $name = $item->post_title;
                        $thumb = get_post_meta( $id, '_thumbnail_id', true );
                        $image = wp_get_attachment_image_src( $thumb , 'full' );

                        $link = $image[0];

                        if(!empty($link)) {
                            $html .= '<div class="item">';
                                $html .= '<a href="'.esc_url($link).'" data-size="'.esc_attr($image[1].'x'.$image[2]).'"><img width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" src="'.esc_url($image[0]).'" alt="'.esc_html($name).'"></a>';
                            $html .= '</div>';
                        }
                    endwhile;
                    wp_reset_postdata();
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';

        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Portfolio_Horizontal_Items();