<?php

// Element Description: PT Blog

class PT_Blog_Items extends WPBakeryShortCode {

  public static $g_array = array(
    'index' => '0',
    'paged' => '1',
    'count' => '0',
  );

  // Element Init
  public function __construct() {
    add_action('init', array($this, 'pt_blog_mapping'));
    add_shortcode('pt_blog', array($this, 'pt_blog_html'));
    add_action('wp_ajax_loadmore_blog', array($this, 'loadmore'));
    add_action('wp_ajax_nopriv_loadmore_blog', array($this, 'loadmore'));
  }

  public static function get_all_blog_category() {
    $taxonomy = 'category';
    $args = array(
      'hide_empty' => true,
    );

    $terms = get_terms($taxonomy, $args);
    $result = array();
    $result[0] = "";

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        $name = get_category_parents($term->term_id);
        if (empty($name)) {
          $name = $term->name;
        }
        $name = trim($name, '/');
        $result['ID [' . $term->term_id . '] ' . $name] = $term->term_id;
      }
    }

    return $result;
  }

  public static function get_all_blog_items($param = 'All') {
    $result = array();

    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => '10000',
    );

    $blog_array = new WP_Query($args);
    $result[0] = "";

    if (!empty($blog_array->posts)) {
      foreach ($blog_array->posts as $item) {
        $result['ID [' . $item->ID . '] ' . $item->post_title] = $item->ID;
      }
    }

    return $result;
  }

  // Element Mapping
  public function pt_blog_mapping() {

    // Stop all if VC is not enabled
    if (!defined('WPB_VC_VERSION')) {
      return;
    }

    // Map the block with vc_map()
    vc_map(array(
      "name" => esc_html__("Blog", "medel"),
      "base" => "pt_blog",
      "show_settings_on_create" => true,
      "icon" => "shortcode-icon-blog",
      "is_container" => true,
      "category" => esc_html__("By PT", "medel"),
      "params" => array(
        array(
          "type" => "textfield",
          "heading" => esc_html__("Uniq ID", "medel"),
          "param_name" => "uniq_id",
          "value" => uniqid(),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "number",
          "heading" => esc_html__("Count items", "medel"),
          "param_name" => "count_items",
          "value" => '9',
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Type", "medel"),
          "param_name" => "type",
          "value" => array(
            esc_html__("Grid", "medel") => "grid",
            esc_html__("Masonry", "medel") => "masonry",
            esc_html__("Horizontal", "medel") => "horizontal",
          ),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Carousel mode", "medel"),
          "param_name" => "carousel_mode",
          "value" => "off",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => false,
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Colums", "medel"),
          "param_name" => "cols",
          "value" => array(
            esc_html__("Col 1", "medel") => "1",
            esc_html__("Col 2", "medel") => "2",
            esc_html__("Col 3", "medel") => "3",
            esc_html__("Col 4", "medel") => "4",
          ),
          "std" => '3',
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Filter buttons", "medel"),
          "param_name" => "filter_buttons",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Filter buttons align", "medel"),
          "param_name" => "filter_buttons_align",
          "value" => array(
            esc_html__('Left', 'medel') => 'tal',
            esc_html__('Center', 'medel') => 'tac',
            esc_html__('Right', 'medel') => 'tar',
          ),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Navigation", "medel"),
          "param_name" => "navigation",
          "value" => array(
            esc_html__("None", "medel") => "none",
            esc_html__("Load More", "medel") => "load_more",
            esc_html__("Pagination", "medel") => "pagination",
          ),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Navigation buttons", "medel"),
          "param_name" => "nav_buttons",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Autoplay", "medel"),
          "param_name" => "autoplay",
          "value" => "off",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => false,
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "number",
          "heading" => esc_html__("Autoplay timeout", "medel"),
          "param_name" => "autoplay_timeout",
          "value" => '5000',
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Colums on desktop", "medel"),
          "param_name" => "cols_on_desktop",
          "value" => array(
            esc_html__("Col 1", "medel") => "1",
            esc_html__("Col 2", "medel") => "2",
            esc_html__("Col 3", "medel") => "3",
            esc_html__("Col 4", "medel") => "4",
          ),
          "std" => '4',
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Colums on tablet", "medel"),
          "param_name" => "cols_on_tablet",
          "value" => array(
            esc_html__("Col 1", "medel") => "1",
            esc_html__("Col 2", "medel") => "2",
            esc_html__("Col 3", "medel") => "3",
            esc_html__("Col 4", "medel") => "4",
          ),
          "std" => '3',
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Colums on mobile", "medel"),
          "param_name" => "cols_on_mobile",
          "value" => array(
            esc_html__("Col 1", "medel") => "1",
            esc_html__("Col 2", "medel") => "2",
            esc_html__("Col 3", "medel") => "3",
            esc_html__("Col 4", "medel") => "4",
          ),
          "std" => '2',
          "dependency" => Array("element" => "carousel_mode", "value" => array("on")),
          "group" => esc_html__("Carousel settings", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Image", "medel"),
          "param_name" => "show_image",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "group" => esc_html__("Fields", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Date", "medel"),
          "param_name" => "show_date",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "group" => esc_html__("Fields", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Heading", "medel"),
          "param_name" => "show_heading",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "group" => esc_html__("Fields", "medel"),
        ),
        array(
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Read more", "medel"),
          "param_name" => "show_read_more",
          "value" => "on",
          "options" => array(
            "on" => array(
              "on" => esc_html__("On", "medel"),
              "off" => esc_html__("Off", "medel"),
            ),
          ),
          "default_set" => true,
          "group" => esc_html__("Fields", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Order by", "medel"),
          "param_name" => "orderby",
          "value" => array(
            esc_html__('Default', 'medel') => 'post__in',
            esc_html__('Author', 'medel') => 'author',
            esc_html__('Category', 'medel') => 'category',
            esc_html__('Date', 'medel') => 'date',
            esc_html__('ID', 'medel') => 'ID',
            esc_html__('Title', 'medel') => 'title',
          ),
          "group" => esc_html__("Sorting", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Order", "medel"),
          "param_name" => "order",
          "value" => array(
            esc_html__('Ascending order', 'medel') => 'ASC',
            esc_html__('Descending order', 'medel') => 'DESC',
          ),
          "group" => esc_html__("Sorting", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Source", "medel"),
          "param_name" => "source",
          "value" => array(
            esc_html__("---", "medel") => "",
            esc_html__("Items", "medel") => "items",
            esc_html__("Categories", "medel") => "categories",
          ),
          "group" => esc_html__("Source", "medel"),
        ),
        array(
          "type" => "dropdown_multi",
          "heading" => esc_html__("Items", "medel"),
          "param_name" => "items",
          "dependency" => Array("element" => "source", "value" => array("items")),
          "value" => PT_Blog_Items::get_all_blog_items(),
          "group" => esc_html__("Source", "medel"),
        ),
        array(
          "type" => "dropdown_multi",
          "heading" => esc_html__("Category", "medel"),
          "param_name" => "categories",
          "dependency" => Array("element" => "source", "value" => array("categories")),
          "value" => PT_Blog_Items::get_all_blog_category(),
          "group" => esc_html__("Source", "medel"),
        ),
      ),
    ));
  }

  // Element HTML
  public function pt_blog_html($atts, $content = null) {

    // Params extraction
    extract(
      $atts = shortcode_atts(
        array(
          'uniq_id' => uniqid(),
          'count_items' => '9',
          'type' => 'grid',
          'cols' => '3',
          'filter_buttons' => 'on',
          'filter_buttons_align' => 'tal',
          'navigation' => 'none',
          'show_image' => 'on',
          'show_date' => 'on',
          'show_heading' => 'on',
          'show_desc' => 'on',
          'show_categories' => 'on',
          'show_read_more' => 'on',
          'orderby' => 'post__in',
          'order' => 'ASC',
          'source' => '',
          'items' => '',
          'categories' => '',
          'source' => '',
          'carousel_mode' => 'off',
          'nav_buttons' => 'on',
          'autoplay' => 'off',
          'autoplay_timeout' => '5000',
          'cols_on_desktop' => '4',
          'cols_on_tablet' => '3',
          'cols_on_mobile' => '2',
        ),
        $atts
      )
    );

    self::$g_array['index'] = '0';
    self::$g_array['paged'] = '1';
    self::$g_array['count'] = '0';

    $wrap_id = 'blog-' . $uniq_id;

    self::$g_array['count'] = $count_items;

    if (is_front_page()) {
      $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    $tax_query = array();

    $categories_s = '';
    if (!empty($categories) && $categories != '0') {
      $categories_s = explode(',', $categories);
      $tax_query = array(
        array(
          'taxonomy' => 'category',
          'field' => 'id',
          'terms' => $categories_s,
        ),
      );
    }
    if ($items) {
      $items = explode(',', $items);
    } else {
      $items = '';
    }
    $args = array(
      'post__in' => $items,
      'posts_per_page' => $count_items,
      'paged' => $paged,
      'orderby' => $orderby,
      'order' => $order,
      'post_type' => 'post',
      'post_status' => 'publish',
      'tax_query' => $tax_query,
    );

    $blog_array = new WP_Query($args);

    $args = array(
      'post__in' => $items,
      'posts_per_page' => -1,
      'paged' => $paged,
      'orderby' => $orderby,
      'order' => $order,
      'post_type' => 'post',
      'post_status' => 'publish',
      'tax_query' => $tax_query,
    );

    $blog_l_array = new WP_Query($args);

    $loadmore_array = array();

    if (is_object($blog_l_array) && count($blog_l_array->posts) > 0) {
      foreach ($blog_l_array->posts as $key => $item) {
        $loadmore_array[$key] = array(
          'id' => $item->ID,
        );

        foreach (wp_get_post_terms($item->ID, 'category') as $s_item) {
          $loadmore_array[$key]['cat'][] = $s_item->slug;
        }
      }
    }

    $loadmore_array = array_slice($loadmore_array, $count_items);
    $loadmore_array = json_encode($loadmore_array);

    $max_num_pages = 0;
    $max_num_pages = $blog_array->max_num_pages;

    $html = '';

    if ($type != 'horizontal') {
      switch ($cols) {
      case '1':
        $item_col = "col-xs-12";
        break;
      case '2':
        $item_col = "col-xs-12 col-sm-6";
        break;
      case '3':
        $item_col = "col-xs-12 col-sm-4";
        break;
      case '4':
        $item_col = "col-xs-12 col-sm-4 col-md-3";
        break;

      default:
        $item_col = "";
        break;
      }
    } else {
      switch ($cols) {
      case '1':
        $item_col = "col-xs-12";
        break;
      case '2':
        $item_col = "col-xs-12 col-md-6";
        break;
      case '3':
        $item_col = "col-xs-12 col-md-4";
        break;
      case '4':
        $item_col = "col-xs-12 col-md-6 col-lg-3";
        break;

      default:
        $item_col = "";
        break;
      }
    }

    $item_num = 0;

    $category_array = array();
    if ($items) {
      $i = 0;
      while ($blog_array->have_posts()): $blog_array->the_post();
        $id = get_the_ID();
        $category_array[$i] = array();
        foreach (wp_get_post_terms($id, 'category') as $key2 => $s_item) {
          $category_array[$i][$key2] = array('slug' => $s_item->slug, 'name' => $s_item->name);
        }
        $i++;
      endwhile;

      $arrOut = array();
      foreach ($category_array as $subArr) {
        $arrOut = array_merge($arrOut, $subArr);
      }

      $category_array = array_map('unserialize', array_unique(array_map('serialize', $arrOut)));
    } elseif (is_array($categories_s) && count($categories_s) > 0) {
      $args = array(
        'hide_empty' => true,
        'include' => $categories_s,
      );
      $taxonomy = 'category';
      $terms = get_terms($taxonomy, $args);
      if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $s_item) {
          $category_array[] = array('slug' => $s_item->slug, 'name' => $s_item->name);
        }
      }
    } else {
      $args = array(
        'hide_empty' => true,
      );
      $taxonomy = 'category';
      $terms = get_terms($taxonomy, $args);
      if (!empty($terms)) {
        foreach ($terms as $s_item) {
          $category_array[] = array('slug' => $s_item->slug, 'name' => $s_item->name);
        }
      }
    }

    $wrap_classes = "";

    if ($navigation == "load_more") {
      $wrap_classes .= ' load-wrap';
    }

    $html = '<div class="blog-block">';

    if (isset($carousel_mode) && $carousel_mode == "on") {
      $filter_buttons = "off";
      $item_col = '';

      if ($nav_buttons == 'on') {
        $arrows = 'true';
      } else {
        $arrow = 'false';
      }

      if ($autoplay == 'on') {
        $autoplay = 'true';
      } else {
        $autoplay = 'false';
      }

      $wrap_classes .= ' disable-iso';

      $navigation = 'disable';

      wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
      wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), true);
      wp_enqueue_script('medel-script', get_template_directory_uri() . '/js/script.js');

      wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
                jQuery('." . esc_attr($wrap_id) . "').each(function(){
                    var head_slider = jQuery(this);
                    if(jQuery(this).find('.blog-item').length > 1){
                        head_slider.addClass('owl-carousel').owlCarousel({
                            loop:true,
                            items:1,
                            nav: " . esc_js($arrows) . ",
                            dots: false,
                            autoplay: " . esc_js($autoplay) . ",
                            autoplayTimeout: " . esc_js($autoplay_timeout) . ",
                            autoplayHoverPause: true,
                            navClass: ['owl-prev ui-super-basic-previous','owl-next ui-super-basic-next'],
                            navText: false,
                            responsive:{
                                0:{
                                    nav: false,
                                    items: 1
                                },
                                768:{
                                    nav: " . esc_js($arrows) . ",
                                    items: " . esc_js($cols_on_mobile) . "
                                },
                                992:{
                                    items: " . esc_js($cols_on_tablet) . "
                                },
                                1200:{
                                    items: " . esc_js($cols_on_desktop) . "
                                },
                            },
                        });
                    }
                });
            });");
    }

    if (is_array($blog_array->posts) && count($blog_array->posts) > 0) {
      if (is_array($category_array) && $filter_buttons == "on" && count($category_array) > 1) {
        $html .= '<div class="filter-button-group ' . esc_attr($filter_buttons_align) . '">';
        $html .= '<button data-filter="*" class="active">' . pt_tr('tr_all', esc_html__('All', 'medel')) . '</button>';
        foreach ($category_array as $item) {
          $name = $item["name"];
          $slug = $item["slug"];
          $html .= '<button data-filter=".category-' . esc_attr($slug) . '">' . esc_html($name) . '</button>';
        }
        $html .= '</div>';
      }
      $html .= '<div class="blog-items row blog-type-' . $type . ' ' . $wrap_id . ' ' . $wrap_classes . '">';
      while ($blog_array->have_posts()): $blog_array->the_post();
        $html .= self::render_grid($atts);
      endwhile;
      wp_reset_postdata();
      $html .= '</div>';
    }

    if ($navigation == "pagination") {
      if (function_exists('medel_wp_corenavi')) {
        $html .= medel_wp_corenavi($max_num_pages);
      } else {
        $html .= wp_link_pages();
      };
    }
    if (is_array($blog_array->posts) && $navigation == "load_more" && $max_num_pages > 1) {
      $html .= '<div class="loadmore-button-block tac">
        <a class="loadmore-button button-style2" data-type="' . esc_attr($type) . '" data-action="blog" data-array="' . esc_attr($loadmore_array) . '" data-count="' . esc_attr($count_items) . '" data-atts="' . esc_attr(json_encode($atts)) . '" data-magic-cursor="link">
          <span>' . pt_tr('tr_load_more', esc_html('Load more', 'medel')) . '</span>
        </a>
      </div>';
    }
    $html .= '</div>';

    return $html;

  }

  public function yprm_item_array($atts) {
    $id = get_the_ID();
    if (empty($id) && isset($atts['id'])) {
      $id = $atts['id'];
    }

    $item = get_post($id);
    $css_class = $array = $categories = $category_links_html = array();

    if (is_array($cat_array = get_the_terms($item, 'category'))) {
      foreach ($cat_array as $category_item) {
        $css_class[] = 'category-' . $category_item->slug;
        $categories[] = $category_item->name;
        $category_links_html[] = '<a href="' . get_term_link($category_item->term_id) . '">' . $category_item->name . '</a>';
      }
    }

    self::$g_array['index']++;

    if (self::$g_array['paged'] > 1) {
      $index_num = self::$g_array['index'] + self::$g_array['paged'] * self::$g_array['count'] - self::$g_array['count'];
    } else {
      $index_num = self::$g_array['index'];
    }

    if ($atts['type'] != 'standart') {
      switch ($atts['cols']) {
      case '1':
        $item_col = "col-xs-12";
        break;
      case '2':
        $item_col = "col-xs-12 col-sm-6";
        break;
      case '3':
        $item_col = "col-xs-12 col-sm-4";
        break;
      case '4':
        $item_col = "col-xs-12 col-sm-4 col-md-3";
        break;

      default:
        $item_col = "";
        break;
      }
    } else {
      switch ($atts['cols']) {
      case '1':
        $item_col = "col-xs-12";
        break;
      case '2':
        $item_col = "col-xs-12 col-md-6";
        break;
      case '3':
        $item_col = "col-xs-12 col-md-4";
        break;
      case '4':
        $item_col = "col-xs-12 col-md-6 col-lg-3";
        break;

      default:
        $item_col = "";
        break;
      }
    }

    if($atts['carousel_mode'] == 'on') {
      $item_col = "";
    }

    if($atts['type'] == 'horizontal') {
      $item_col = "col-xs-12";
    }

    if (!empty($atts['short_desc_size'])) {
      $count = $atts['short_desc_size'];
    } elseif ($atts['type'] == 'grid' || $atts['type'] == 'masonry') {
      $count = '130';
    } elseif ($atts['type'] == 'horizontal') {
      $count = '420';
    }

    if (function_exists('get_field') && get_field('short_desc', $id)) {
      $desc = get_field('short_desc', $id);
    } else {
      $desc = strip_tags(strip_shortcodes($item->post_content));
    }

    $thumb = get_post_meta($id, '_thumbnail_id', true);

    $array['id'] = $id;
    $array['index'] = self::$g_array['index'];
    $array['index_num'] = $index_num;
    $array['cols'] = $item_col;
    $array['category_links_html'] = yprm_implode($category_links_html, '', ', ');
    $array['post_title'] = $item->post_title;
    $array['post_content'] = mb_strimwidth($desc, 0, $count, '...');
    $array['post_categories'] = yprm_implode($categories, '', ' \ ');
    $array['categories'] = yprm_implode($categories, '');
    $array['post_date'] = get_the_date('', $id);
    $array['permalink'] = get_the_permalink($id);
    $array['image_array'] = wp_get_attachment_image_src($thumb, 'large');
    $array['image_html'] = wp_get_attachment_image($thumb, 'large');
    $array['full_image_array'] = wp_get_attachment_image_src($thumb, 'full');

    $array['settings'] = $atts;
    $array['link_attr'] = '';

    if(is_array($array['image_array']) && !empty($thumb)) {
      $css_class[] = 'with-image';
    }

    $array['css_class'] = yprm_implode($css_class, '');

    return $array;
  }

  public function render_grid($atts) {
    extract(self::yprm_item_array($atts));

    $html = '<article class="blog-item ' . esc_attr($css_class . ' ' . $cols) . '">';
    $html .= '<div class="wrap">';
    if (isset($image_array[0]) && !empty($image_array[0])) {
      if ($settings['type'] == 'masonry') {
        $html .= '<div class="img"><a href="' . esc_url(get_permalink($id)) . '"><img width="' . esc_attr($image_array[1]) . '" height="' . esc_attr($image_array[2]) . '" src="' . esc_url($image_array[0]) . '" alt="' . esc_html($post_title) . '"></a></div>';
      } else {
        $html .= '<div class="img"><a href="' . esc_url(get_permalink($id)) . '" style="background-image: url(' . esc_url($image_array[0]) . ');"></a></div>';
      }
    }
    $html .= '<div class="content">';
    if ($settings['show_heading'] == 'on') {
      $html .= '<h4><a href="' . esc_url(get_permalink($id)) . '">' . esc_html($post_title) . '</a></h4>';
    }
    if ($settings['show_date'] == 'on') {
      $html .= '<div class="date">' . get_the_date('', $id) . '</div>';
    }
    if ($settings['show_desc'] == 'on' && !empty($post_content)) {
      $html .= '<div class="text">' . wp_kses($post_content, 'post') . '</div>';
    }
    if ($settings['show_read_more'] == 'on') {
      $html .= '<a class="read-more-link" href="' . esc_url(get_permalink($id)) . '">' . pt_tr('tr_read_more', esc_html__('read more', 'medel')) . '</a>';
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</article>';

    return $html;
  }

  public function loadmore() {
    $array = $_POST['array'];
    $atts = $_POST['atts'];

    if (is_array($array) && count($array) > 0) {
      foreach ($array as $item) {
        $atts['id'] = $item['id'];

        echo self::render_grid($atts);
      }
    } else {
      echo array(
        'return' => 'error',
      );
    }

    wp_die();
  }

} // End Element Class

// Element Class Init
new PT_Blog_Items();