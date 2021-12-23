<?php

// Element Description: PT Portfolio

class PT_Portfolio_Items extends WPBakeryShortCode {

  public static $g_array = array(
    'index' => '0',
    'paged' => '1',
    'count' => '0',
  );

  // Element Init
  public function __construct() {
    add_action('init', array($this, 'pt_portfolio_mapping'));
    add_shortcode('pt_portfolio', array($this, 'pt_portfolio_html'));
    add_action('wp_ajax_loadmore_portfolio', array($this, 'loadmore'));
    add_action('wp_ajax_nopriv_loadmore_portfolio', array($this, 'loadmore'));
  }

  public static function get_all_portfolio_category() {
    $taxonomy = 'pt-portfolio-category';
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

  public static function get_all_portfolio_items($param = 'All') {
    $result = array();

    $args = array(
      'post_type' => 'pt-portfolio',
      'post_status' => 'publish',
      'posts_per_page' => '10000',
    );

    $porfolio_array = new WP_Query($args);
    $result[0] = "";

    if (!empty($porfolio_array->posts)) {
      foreach ($porfolio_array->posts as $item) {
        $result['ID [' . $item->ID . '] ' . $item->post_title] = $item->ID;
      }
    }

    return $result;
  }

  // Element Mapping
  public function pt_portfolio_mapping() {

    // Stop all if VC is not enabled
    if (!defined('WPB_VC_VERSION')) {
      return;
    }

    // Map the block with vc_map()
    vc_map(array(
      "name" => esc_html__("Portfolio", "medel"),
      "base" => "pt_portfolio",
      "show_settings_on_create" => true,
      "icon" => "shortcode-icon-portfolio",
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
          "admin_label" => true,
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Type", "medel"),
          "param_name" => "type",
          "admin_label" => true,
          "value" => array(
            esc_html__("Grid", "medel") => "grid",
            esc_html__("Masonry", "medel") => "masonry",
            //esc_html__( "Horizontal", "medel" ) => "horizontal",
          ),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Colums", "medel"),
          "param_name" => "cols",
          "admin_label" => true,
          "value" => array(
            esc_html__("Col 1", "medel") => "1",
            esc_html__("Col 2", "medel") => "2",
            esc_html__("Col 3", "medel") => "3",
            esc_html__("Col 4", "medel") => "4",
          ),
          "std" => '3',
          "dependency" => Array("element" => "type", "value" => array("grid", "masonry")),
          "group" => esc_html__("General", "medel"),
        ),
        array(
          "type" => "dropdown",
          "heading" => esc_html__("Hover animation", "medel"),
          "param_name" => "hover",
          "admin_label" => true,
          "value" => array(
            esc_html__("Type 1", "medel") => "type_1",
            esc_html__("Type 2", "medel") => "type_2",
            esc_html__("Type 3", "medel") => "type_3",
            esc_html__("Type 4", "medel") => "type_4",
            esc_html__("Type 5", "medel") => "type_5",
            esc_html__("Type 6", "medel") => "type_6",
            esc_html__("Type 7", "medel") => "type_7",
            esc_html__("Type 8", "medel") => "type_8",
            esc_html__("Type 9", "medel") => "type_9",
          ),
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
          "heading" => esc_html__("Popup mode", "medel"),
          "param_name" => "popup_mode",
          "value" => "on",
          "admin_label" => true,
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
          "type" => "switch",
          "class" => "",
          "heading" => esc_html__("Spacing between elements", "medel"),
          "param_name" => "spacing_between_elements",
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
          "heading" => esc_html__("Description", "medel"),
          "param_name" => "show_desc",
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
          "value" => PT_Portfolio_Items::get_all_portfolio_items(),
          "group" => esc_html__("Source", "medel"),
        ),
        array(
          "type" => "dropdown_multi",
          "heading" => esc_html__("Category", "medel"),
          "param_name" => "categories",
          "dependency" => Array("element" => "source", "value" => array("categories")),
          "value" => PT_Portfolio_Items::get_all_portfolio_category(),
          "group" => esc_html__("Source", "medel"),
        ),
      ),
    ));
  }

  // Element HTML
  public function pt_portfolio_html($atts, $content = null) {

    // Params extraction
    extract(
      $atts = shortcode_atts(
        array(
          'uniq_id' => uniqid(),
          'count_items' => '9',
          'type' => 'grid',
          'cols' => '3',
          'hover' => 'type_1',
          'popup_mode' => 'on',
          'filter_buttons' => 'on',
          'filter_buttons_align' => 'tal',
          'navigation' => 'none',
          'spacing_between_elements' => 'on',
          'show_heading' => 'on',
          'show_desc' => 'on',
          'orderby' => 'post__in',
          'order' => 'ASC',
          'source' => '',
          'items' => '',
          'categories' => '',
          'source' => '',
        ),
        $atts
      )
    );

    self::$g_array['index'] = '0';
    self::$g_array['paged'] = '1';
    self::$g_array['count'] = '0';

    $wrap_id = 'portfolio-' . $uniq_id;

    self::$g_array['count'] = $count_items;

    if (is_front_page()) {
      self::$g_array['paged'] = $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
      self::$g_array['paged'] = $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    $tax_query = array();

    $categories_s = '';
    if (!empty($categories) && $categories != '0') {
      $categories_s = explode(',', $categories);
      $tax_query = array(
        array(
          'taxonomy' => 'pt-portfolio-category',
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
      'post_type' => 'pt-portfolio',
      'post_status' => 'publish',
      'tax_query' => $tax_query,
    );

    $porfolio_array = new WP_Query($args);

    $args = array(
      'post__in' => $items,
      'posts_per_page' => -1,
      'paged' => $paged,
      'orderby' => $orderby,
      'order' => $order,
      'post_type' => 'pt-portfolio',
      'post_status' => 'publish',
      'tax_query' => $tax_query,
    );

    $porfolio_l_array = new WP_Query($args);

    $loadmore_array = array();

    if (is_object($porfolio_l_array) && count($porfolio_l_array->posts) > 0) {
      foreach ($porfolio_l_array->posts as $key => $item) {
        $loadmore_array[$key] = array(
          'id' => $item->ID,
        );

        foreach (wp_get_post_terms($item->ID, 'pt-portfolio-category') as $s_item) {
          $loadmore_array[$key]['cat'][] = $s_item->slug;
        }
      }
    }

    $loadmore_array = array_slice($loadmore_array, $count_items);
    $loadmore_array = json_encode($loadmore_array);

    $max_num_pages = 0;
    $max_num_pages = $porfolio_array->max_num_pages;

    $html = '';

    switch ($cols) {
    case '1':
      $item_col = "col-xs-12";
      break;
    case '2':
      $item_col = "col-xs-12 col-sm-6 col-md-6";
      break;
    case '3':
      $item_col = "col-xs-12 col-sm-4 col-md-4";
      break;
    case '4':
      $item_col = "col-xs-12 col-sm-4 col-md-3";
      break;

    default:
      $item_col = "";
      break;
    }

    $item_num = 0;

    $category_array = array();
    if ($items) {
      $i = 0;
      while ($porfolio_array->have_posts()): $porfolio_array->the_post();
        $id = get_the_ID();
        $category_array[$i] = array();
        foreach (wp_get_post_terms($id, 'pt-portfolio-category') as $key2 => $s_item) {
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
      $taxonomy = 'pt-portfolio-category';
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
      $taxonomy = 'pt-portfolio-category';
      $terms = get_terms($taxonomy, $args);
      if (!empty($terms)) {
        foreach ($terms as $s_item) {
          $category_array[] = array('slug' => $s_item->slug, 'name' => $s_item->name);
        }
      }
    }

    $wrap_classes = "";

    if ($popup_mode == 'on') {
      $wrap_classes .= 'popup-gallery';
    }

    if ($navigation == "load_more") {
      $wrap_classes .= ' load-wrap';
    }

    $html = '<div class="portfolio-block">';

    if (is_array($porfolio_array->posts) && count($porfolio_array->posts) > 0) {
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
      $html .= '<div class="portfolio-items row portfolio-type-' . $type . ' space-' . $spacing_between_elements . ' portfolio_hover_' . $hover . ' ' . $wrap_id . ' ' . $wrap_classes . '">';
      $html .= '<div class="grid-sizer ' . esc_attr($item_col) . '"></div>';
      while ($porfolio_array->have_posts()): $porfolio_array->the_post();
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
    if (is_array($porfolio_array->posts) && $navigation == "load_more" && $max_num_pages > 1) {
      $html .= '<div class="loadmore-button-block tac">
        <a class="loadmore-button button-style1" data-type="' . esc_attr($type) . '" data-action="portfolio" data-array="' . esc_attr($loadmore_array) . '" data-count="' . esc_attr($count_items) . '" data-atts="' . esc_attr(json_encode($atts)) . '" data-magic-cursor="link">
          <span>' . esc_html('Load more', 'medel') . '</span>
        </a>
      </div>';
    }
    $html .= '</div>';

    return $html;

  }

  public function yprm_item_array($atts) {
    global $global_array;

    $id = get_the_ID();
    if (empty($id) && isset($atts['id'])) {
      $id = $atts['id'];
    }
    $item = get_post($id);

    $css_class = $array = $categories = array();

    if (is_array($cat_array = get_the_terms($id, 'pt-portfolio-category'))) {
      foreach ($cat_array as $category_item) {
        $css_class[] = 'category-' . $category_item->slug;
        $categories[] = $category_item->name;
      }
    }

    if ($atts['popup_mode'] == 'on') {
      $css_class[] = 'popup-item';
    }

    if (function_exists('get_field') && get_field('project_image_position', $id)) {
      $css_class[] = ' image-' . get_field('project_image_position', $id);
    }

    self::$g_array['index']++;

    if (self::$g_array['paged'] > 1) {
      $index_num = self::$g_array['index'] + self::$g_array['paged'] * self::$g_array['count'] - self::$g_array['count'];
    } else {
      $index_num = self::$g_array['index'];
    }

    switch ($atts['cols']) {
      case '1':
        $item_col = "col-xs-12";
        break;
      case '2':
        $item_col = "col-xs-12 col-sm-6 col-md-6";
        break;
      case '3':
        $item_col = "col-xs-12 col-sm-4 col-md-4";
        break;
      case '4':
        $item_col = "col-xs-12 col-sm-4 col-md-3";
        break;
  
      default:
        $item_col = "";
        break;
      }

      if($atts['type'] == 'carousel') {
        $item_col = '';
      }

    $thumb = get_post_meta($id, '_thumbnail_id', true);

    $array['id'] = $id;
    $array['index'] = self::$g_array['index'];
    $array['index_num'] = $index_num;
    $array['cols'] = $item_col;
    $array['name'] = $item->post_title;
    $array['post_content'] = mb_strimwidth(strip_tags(strip_shortcodes($item->post_content)), 0, 45);
    $array['post_categories'] = yprm_implode($categories, '', ', ');
    $array['categories'] = yprm_implode($categories, '');
    $array['post_date'] = $item->post_date;
    $array['thumb'] = $thumb;
    $array['video'] = false;
    $array['permalink'] = get_the_permalink($id);
    $array['image'] = wp_get_attachment_image_src($thumb, 'large');
    $array['image_html'] = wp_get_attachment_image($thumb, 'large');
    $array['full_image_array'] = wp_get_attachment_image_src($thumb, 'full');

    if (function_exists('get_field')) {
      $array['project_video_url'] = get_field('project_video_url', $id);
    }

    $array['settings'] = $atts;
    $array['link_attr'] = '';

    if ($array['settings']['popup_mode'] == 'on') {
      if (!empty($array['project_video_url'])) {
        $css_class[] = 'with-video';
        if (!empty($array['project_video_url'])) {
          $video_url = VideoUrlParser::get_url_embed($array['project_video_url']);
          $array['video'] = true;
        }
        $array['link_video_attr'] = 'data-type="video" data-size="1920x1080" data-video=\'<div class="wrapper"><div class="video-wrapper"><iframe class="pswp__video" width="1920" height="1080" src="' . esc_url($video_url) . '" frameborder="0" allowfullscreen></iframe></div></div>\'';
        $array['link_html'] = '<a href="#" class="link" ' . $array['link_video_attr'] . ' data-id="' . $array['index_num'] . '"><span></span></a>';
        $array['link_html_bg'] = '<a href="#" class="link" style="background-image: url(' . $array['image'][0] . ')" ' . $array['link_video_attr'] . ' data-id="' . $array['index_num'] . '"><span></span></a>';
      } else {
        $array['link_html'] = '<a href="' . esc_url($array['full_image_array'][0]) . '" class="link" data-size="' . esc_attr($array['full_image_array'][1] . 'x' . $array['full_image_array'][2]) . '" data-id="' . $array['index_num'] . '"><span></span></a>';
        $array['link_html_bg'] = '<a href="' . esc_url($array['full_image_array'][0]) . '" class="link" style="background-image: url(' . $array['image'][0] . ')" data-size="' . esc_attr($array['full_image_array'][1] . 'x' . $array['full_image_array'][2]) . '" data-id="' . $array['index_num'] . '"><span></span></a>';
      }
    } else {
      $array['link_html'] = '<a href="' . esc_url($array['permalink']) . '" class="link" data-id="' . $array['index_num'] . '"><span></span></a>';
      $array['link_html_bg'] = '<a href="' . esc_url($array['permalink']) . '" class="link" style="background-image: url(' . $array['image'][0] . ')" data-id="' . $array['index_num'] . '"><span></span></a>';
    }

    $array['css_class'] = yprm_implode($css_class, '');

    return $array;
  }

  public function render_grid($atts) {
    extract(self::yprm_item_array($atts));

    $html = '<article class="portfolio-item ' . esc_attr($css_class . ' ' . $cols) . '">';
      if ($settings['type'] == 'grid') {
        $html .= '<div class="a-img"><div style="background-image: url(' . esc_url($image[0]) . ');"></div></div>';
      } elseif ($settings['type'] == 'masonry') {
      $html .= '<div class="a-img"><img width="' . esc_attr($image[1]) . '" height="' . esc_attr($image[2]) . '" src="' . esc_url($image[0]) . '" alt="' . esc_html($name) . '"></div>';
    }
    $html .= '<div class="content">';
    if ($settings['show_heading'] == 'on') {
      $html .= '<h5><span>' . esc_html($name) . '</span></h5>';
    }if ($post_content && $settings['show_desc'] == 'on') {
      $html .= '<p>' . esc_html($post_content) . '</p>';
    }
    $html .= '</div>';
    $html .= $link_html;
    $html .= '</article>';

    return $html;
  }

  public function loadmore() {
    $array = $_POST['array'];
    $atts = $_POST['atts'];
    //$type = $atts['type'];
    //$style = $atts['style'];
    $start_index = $_POST['start_index'];

    self::$g_array['index'] = $start_index;

    if (is_array($array) && count($array) > 0) {
      foreach ($array as $item) {
        $atts['id'] = $item['id'];
        $atts['start_index'] = $start_index;

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
new PT_Portfolio_Items();