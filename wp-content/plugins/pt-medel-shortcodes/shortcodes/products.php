<?php

// Element Description: PT Product
if(class_exists( 'WooCommerce' )) {
    class PT_Product_Items extends WPBakeryShortCode {
         
        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'pt_product_mapping' ) );
            add_shortcode( 'pt_product', array( $this, 'pt_product_html' ) );
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
                    $result[ 'ID ['.$term->term_id.'] '.$name ] = $term->slug;
                }
            }

            return $result;
        }

        public static function get_all_product_items( $param = 'All' ) {
            $result    = array();
            
            $args = array(
                'post_type'       => 'product',
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
        public function pt_product_mapping() {
             
            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
             
            // Map the block with vc_map()
            vc_map( array(
                "name" => esc_html__("Product", "medel"),
                "base" => "pt_product",
                "show_settings_on_create" => true,
                "icon" => "shortcode-icon-product",
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
                        "group"       => esc_html__( "General", "medel" ),
                    ),
                    array(
                        "type"        => "dropdown",
                        "heading"     => esc_html__( "Colums", "medel" ),
                        "param_name"  => "cols",
                        "value"      => array(
                            esc_html__( "Col 1", "medel" ) => "1",
                            esc_html__( "Col 2", "medel" ) => "2",
                            esc_html__( "Col 3", "medel" ) => "3",
                            esc_html__( "Col 4", "medel" ) => "4",
                        ),
                        "std" => '3',
                        "group"       => esc_html__( "General", "medel" ),
                    ),
                    array(
                        "type"        => "dropdown",
                        "heading"     => esc_html__( "Products", "medel" ),
                        "param_name"  => "sort_type",
                        "value"      => array(
                            esc_html__("Simple Products", "medel") => "d",
                            esc_html__("Featured Products", "medel") => "fp",
                            esc_html__("Sale Products", "medel") => "sp",
                            esc_html__("New Products", "medel") => "rp",
                            esc_html__("Best-Selling Products", "medel") => "bsp",
                            esc_html__("Top Rated Products", "medel") => "trp",
                        ),
                        "std" => 'd',
                        "group"       => esc_html__( "General", "medel" ),
                    ),
                    array(
                        "type"        => "switch",
                        "class"       => "",
                        "heading"     => esc_html__( "Show categories", "medel" ),
                        "param_name"  => "show_categories",
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
                        "type"        => "dropdown",
                        "heading"     => esc_html__( "Category buttons align", "medel" ),
                        "param_name"  => "category_buttons_align",
                        "value"      => array(
                            esc_html__('Left', 'medel') => 'tal',
                            esc_html__('Center', 'medel') => 'tac',
                            esc_html__('Right', 'medel') => 'tar',
                        ),
                        "group"       => esc_html__( "General", "medel" ),
                    ),
                    array(
                        "type"        => "dropdown",
                        "heading"     => esc_html__( "Navigation", "medel" ),
                        "param_name"  => "navigation",
                        "value"      => array(
                            esc_html__( "None", "medel" ) => "none",
                            esc_html__( "Pagination", "medel" ) => "pagination",
                        ),
                        "group"       => esc_html__( "General", "medel" ),
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
                        "value"       => PT_Product_Items::get_all_product_items(),
                        "group"       => esc_html__( "Source", "medel" ),
                    ),
                    array(
                        "type"        => "dropdown",
                        "heading"     => esc_html__( "Category", "medel" ),
                        "param_name"  => "categories",
                        "dependency"  => Array( "element" => "source", "value" => array( "categories" ) ),
                        "value"       => PT_Product_Items::get_all_product_category(),
                        "group"       => esc_html__( "Source", "medel" ),
                    ),
                ),
            ) );
        }

        private static function product_loop( $query_args, $atts, $loop_name ) {
            global $woocommerce_loop;
            $columns                     = absint( $atts['columns'] );
            $woocommerce_loop['columns'] = $columns;
            $woocommerce_loop['name']    = $loop_name;
            $query_args                  = apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, $loop_name );
            $transient_name              = 'wc_loop' . substr( md5( json_encode( $query_args ) . $loop_name ), 28 ) . WC_Cache_Helper::get_transient_version( 'product_query' );
            $products                    = get_transient( $transient_name );
            if ( false === $products || ! is_a( $products, 'WP_Query' ) ) {
                $products = new WP_Query( $query_args );
                set_transient( $transient_name, $products, DAY_IN_SECONDS * 30 );
            }
            woocommerce_reset_loop();
            wp_reset_postdata();
            return $products;
        }

        private static function _maybe_add_category_args( $args, $category, $operator ) {
            if ( ! empty( $category ) ) {
                if ( empty( $args['tax_query'] ) ) {
                    $args['tax_query'] = array();
                }
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'product_cat',
                        'terms'    => array_map( 'sanitize_title', explode( ',', $category ) ),
                        'field'    => 'slug',
                        'operator' => $operator,
                    ),
                );
            }
            return $args;
        }

        public static function featured_products( $atts ) {
            $atts = shortcode_atts( array(
                'per_page' => '12',
                'columns'  => '4',
                'orderby'  => 'date',
                'order'    => 'desc',
                'category' => '',  // Slugs
                'paged' => '1',
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'featured_products' );
            $meta_query  = WC()->query->get_meta_query();
            $tax_query   = WC()->query->get_tax_query();
            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            );
            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $atts['per_page'],
                'orderby'             => $atts['orderby'],
                'order'               => $atts['order'],
                'paged'               => $atts['paged'],
                'meta_query'          => $meta_query,
                'tax_query'           => $tax_query,
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            return self::product_loop( $query_args, $atts, 'featured_products' );
        }

        public static function recent_products( $atts ) {
            $atts = shortcode_atts( array(
                'per_page' => '12',
                'columns'  => '4',
                'orderby'  => 'date',
                'order'    => 'desc',
                'category' => '',  // Slugs
                'paged' => '1',
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'recent_products' );
            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $atts['per_page'],
                'orderby'             => $atts['orderby'],
                'order'               => $atts['order'],
                'paged'               => $atts['paged'],
                'meta_query'          => WC()->query->get_meta_query(),
                'tax_query'           => WC()->query->get_tax_query(),
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            return self::product_loop( $query_args, $atts, 'recent_products' );
        }

        public static function sale_products( $atts ) {
            $atts = shortcode_atts( array(
                'per_page' => '12',
                'columns'  => '4',
                'orderby'  => 'title',
                'order'    => 'asc',
                'category' => '', // Slugs
                'paged' => '1',
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'sale_products' );
            $query_args = array(
                'posts_per_page' => $atts['per_page'],
                'orderby'        => $atts['orderby'],
                'order'          => $atts['order'],
                'paged'          => $atts['paged'],
                'no_found_rows'  => 1,
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'meta_query'     => WC()->query->get_meta_query(),
                'tax_query'      => WC()->query->get_tax_query(),
                'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            return self::product_loop( $query_args, $atts, 'sale_products' );
        }

        public static function best_selling_products( $atts ) {
            $atts = shortcode_atts( array(
                'per_page' => '12',
                'columns'  => '4',
                'category' => '',  // Slugs
                'paged' => '1',
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'best_selling_products' );
            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'posts_per_page'      => $atts['per_page'],
                'paged'               => $atts['paged'],
                'meta_key'            => 'total_sales',
                'orderby'             => 'meta_value_num',
                'meta_query'          => WC()->query->get_meta_query(),
                'tax_query'           => WC()->query->get_tax_query(),
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            return self::product_loop( $query_args, $atts, 'best_selling_products' );
        }

        public static function top_rated_products( $atts ) {
            $atts = shortcode_atts( array(
                'per_page' => '12',
                'columns'  => '4',
                'orderby'  => 'title',
                'order'    => 'asc',
                'paged' => '1',
                'category' => '',  // Slugs
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'top_rated_products' );
            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => $atts['orderby'],
                'order'               => $atts['order'],
                'paged'               => $atts['paged'],
                'posts_per_page'      => $atts['per_page'],
                'meta_query'          => WC()->query->get_meta_query(),
                'tax_query'           => WC()->query->get_tax_query(),
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            add_filter( 'posts_clauses', array( __CLASS__, 'order_by_rating_post_clauses' ) );
            $return = self::product_loop( $query_args, $atts, 'top_rated_products' );
            remove_filter( 'posts_clauses', array( __CLASS__, 'order_by_rating_post_clauses' ) );
            return $return;
        }

        public static function products( $atts ) {
            $atts = shortcode_atts( array(
                'columns' => '4',
                'per_page' => '12',
                'paged' => '1',
                'orderby' => 'title',
                'order'   => 'asc',
                'ids'     => '',
                'skus'    => '',
                'category' => '',  // Slugs
                'operator' => 'IN', // Possible values are 'IN', 'NOT IN', 'AND'.
            ), $atts, 'products' );
            $query_args = array(
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => $atts['orderby'],
                'order'               => $atts['order'],
                'paged'               => $atts['paged'],
                'posts_per_page'      => $atts['per_page'],
                'meta_query'          => WC()->query->get_meta_query(),
                'tax_query'           => WC()->query->get_tax_query(),
            );
            $query_args = self::_maybe_add_category_args( $query_args, $atts['category'], $atts['operator'] );
            if ( ! empty( $atts['skus'] ) ) {
                $query_args['meta_query'][] = array(
                    'key'     => '_sku',
                    'value'   => array_map( 'trim', explode( ',', $atts['skus'] ) ),
                    'compare' => 'IN',
                );
            }
            if ( ! empty( $atts['ids'] ) ) {
                $query_args['post__in'] = array_map( 'trim', explode( ',', $atts['ids'] ) );
            }
            return self::product_loop( $query_args, $atts, 'products' );
        }

        public function return_get_template_part() {

           ob_start();
           wc_get_template_part( 'content', 'product' );    
           $content = ob_get_contents();
           ob_end_clean();

           return $content;
        }
         
         
        // Element HTML
        public function pt_product_html( $atts, $content = null ) {
             
            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'uniq_id' => uniqid(),
                        'count_items' => '9', 
                        'type' => 'grid',
                        'cols' => '3',
                        'show_categories' => 'on',
                        'category_buttons_align' => 'tal',
                        'navigation' => 'none',
                        'orderby' => 'post__in',
                        'order' => 'ASC',
                        'source' => '',
                        'items' => '',
                        'categories' => '',
                        'sort_type' => 'd'
                    ), 
                    $atts
                )
            );

            $wrap_id = 'product-'.$uniq_id;

            if(is_front_page()) {
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            } else {
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            }
            if($source = 'items' && $items) {
                $items = $items;
            } else {
                $items = '';
            }

            if($source = 'categories' && $categories) {
                $categories = $categories;
            } else {
                $categories = '';
            }

            $html = '';

            $atts_array = array(
                'per_page' => $count_items,
                'paged' => $paged,
                'columns' => $cols,
                'ids' => $items,
                'category' => $categories,
                'orderby' => $orderby,
                'order' => $order,
            );

            if(empty($items)) {
                switch ($sort_type) {
                    case 'd':
                    $products = PT_Product_Items::products($atts_array);
                    break;
                    case 'fp':
                    $products = PT_Product_Items::featured_products($atts_array);
                    break;
                    case 'sp':
                    $products = PT_Product_Items::sale_products($atts_array);
                    break;
                    case 'bsp':
                    $products = PT_Product_Items::best_selling_products($atts_array);
                    break;
                    case 'trp':
                    $products = PT_Product_Items::top_rated_products($atts_array);
                    break;
                    case 'rp':
                    $products = PT_Product_Items::recent_products($atts_array);
                    break;

                    default:

                    break;
                } 
            } else {
                $products = PT_Product_Items::products($atts_array);
            }

            $max_num_pages = $products->max_num_pages;

            $html .= '<div class="woocommerce">';
                if($show_categories == "on") {
                    $html .= '<div class="category-buttons '.esc_attr($category_buttons_align).'">';
                        $args     = array(
                            'hide_empty' => true,
                        );
                        $taxonomy = 'product_cat';
                        $terms     = get_terms( $taxonomy, $args );
                        if(!empty($terms) && !is_wp_error( $terms )) {
                            foreach($terms as $item) { 
                                $html .= '<a href="'.esc_url(get_category_link($item->term_id)).'">'.esc_html($item->name).'</a>';
                            }
                        }
                    $html .= '</div>';
                }
                $html .= '<div class="products filter-items row">';
                    global $woocommerce_loop;
                    $woocommerce_loop['columns'] = $cols;

                    if ( $products->have_posts() ) {

                        while ( $products->have_posts() ) : $products->the_post();

                        $html .= PT_Product_Items::return_get_template_part();

                        endwhile;

                    }
                    woocommerce_reset_loop();
                    wp_reset_postdata();

                $html .= '</div>';

            $html .= '</div>';

            if($navigation == "pagination") {
                if (function_exists('medel_wp_corenavi')) {
                    $html .= medel_wp_corenavi($max_num_pages);
                } else {
                    $html .= wp_link_pages();
                };
            }

            return $html;

        }
         
    } // End Element Class
     
     
    // Element Class Init
    new PT_Product_Items();
}