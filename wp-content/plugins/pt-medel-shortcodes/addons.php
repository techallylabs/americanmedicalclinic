<?php
/*
Plugin Name: PT Medel Shortcodes
Plugin URI: #
Version: 1.1.2
Author: Promo Theme
Author URI: #
 */

if (!class_exists('WPBakeryShortCode')) {
  return false;
}

if(get_option('enable_full_version')) {
  add_action('plugins_loaded', 'pt_medel_shortcodes_init');
}  else {
  add_action('admin_menu', function() {
    remove_menu_page( 'ai1wm_export' );
  }, 99099);
}

add_action('plugins_loaded', 'pt_functions');
add_action('admin_enqueue_scripts', 'pt_admin_scripts', 400);

function pt_medel_shortcodes_init() {
  // Include Params

  $dir = dirname(__FILE__) . "/params";
  $dh = opendir($dir);
  while ($filename = readdir($dh)) {
    if (($filename !== '.') && ($filename !== '..')) {
      $filename = $dir . "/" . $filename;
      include_once $filename;
    }
  }

  closedir($dh);

  // Include Shortcodes

  $dir = dirname(__FILE__) . "/shortcodes";
  $dh = opendir($dir);
  while ($filename = readdir($dh)) {
    if (($filename !== '.') && ($filename !== '..')) {
      $filename = $dir . "/" . $filename;
      include_once $filename;
    }
  }

  closedir($dh);
}

function pt_admin_scripts() {
  wp_register_style('pt-admin', plugins_url('pt-medel-shortcodes') . '/include/css/admin.css', false, '1.0.0');
  wp_register_script('pt-admin', plugins_url('pt-medel-shortcodes') . '/include/js/admin.js', array('jquery'), '1.0.0', true);

  wp_enqueue_script('pt-admin');
  wp_localize_script('pt-admin', 'yprm_ajax',
    array(
      'url' => admin_url('admin-ajax.php'),
    )
  );

  wp_enqueue_style('pt-admin');
}

function medel_scripts2() {
	wp_deregister_script( 'jquery-core' );
  wp_deregister_script( 'jquery-migrate' );
  wp_register_script( 'jquery-core', "https://code.jquery.com/jquery-1.12.4.min.js", array(), '1.12.4' );
  wp_register_script( 'jquery-migrate', "https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.4.1/jquery-migrate.min.js", array(), '1.4.1' );

  wp_register_script('pt-scripts', plugins_url('pt-medel-shortcodes') . '/include/js/scripts.js', array('jquery'), '1.0.0', true);

  if (!is_admin()) {
    wp_deregister_script('wpb_composer_front_js');
    wp_dequeue_script('wpb_composer_front_js');
  }

  wp_enqueue_script('js_composer_front', get_template_directory_uri() . '/js/js_composer_front.min.js', array('jquery'), '', true);

  wp_enqueue_script('pt-scripts');
  wp_localize_script('pt-scripts', 'yprm_ajax',
    array(
      'url' => admin_url('admin-ajax.php'),
    )
  );
}
add_action('wp_enqueue_scripts', 'medel_scripts2', 100);

function pt_functions() {
  function yprm_implode($array = array(), $before = ' ', $separator = ' ') {
    return $before.implode($separator, $array);
  }
}

require dirname(__FILE__) . '/include/video-parser.php';

add_action('after_setup_theme', 'pt_redux', 0);

if(!function_exists('pt_tr')) {
  function pt_tr($word, $default = '') {
    global $medel_theme;

    if(isset($medel_theme[$word]) && !empty($medel_theme[$word])) {
      return $medel_theme[$word];
    } else {
      return $default;
    }
  }
}

if(!function_exists('pt_redux')) {
  function pt_redux() {
    if(class_exists('Redux')) {
      $opt_name = "medel_theme";
      $opt_name = apply_filters('medel_theme/opt_name', $opt_name);
    
      Redux::setSection($opt_name, array(
        'title' => esc_html__('Translations', 'medel'),
        'id' => 'translations',
        'customizer_width' => '400px',
        'icon' => 'fa fa-language',
        'fields' => array(
          array(
            'id' => 'tr_load_more',
            'type' => 'text',
            'title' => esc_html__('Load More', 'medel'),
          ),
          array(
            'id' => 'tr_all',
            'type' => 'text',
            'title' => esc_html__('All', 'medel'),
          ),
          array(
            'id' => 'tr_read_more',
            'type' => 'text',
            'title' => esc_html__('Read More', 'medel'),
          ),
        ),
      ));
    }
  }
}