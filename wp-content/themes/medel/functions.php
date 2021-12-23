<?php
/**
 * medel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package medel
 */

if ( ! function_exists( 'medel_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function medel_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on medel, use a find and replace
	 * to change 'medel' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'medel', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'navigation' => esc_html__( 'Primary navigation', 'medel' ),
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add theme support for WooCommerce.
	add_theme_support( 'woocommerce' );

	if ( ! isset( $content_width ) ) $content_width = 900;
}
endif;
add_action( 'after_setup_theme', 'medel_setup' ); 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'medel' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'medel' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer col 2', 'medel' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'medel' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer col 3', 'medel' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'medel' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer col 4', 'medel' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'medel' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'medel_widgets_init' );

/*
Remove default woocommerce css
*/
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

/**
 * Add Google fonts.
 */
if(!class_exists('WPBakeryShortCode')) {
	function medel_fonts_url() {
	    $font_url = '';
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'medel' ) ) {
	        $font_url = add_query_arg( 'family', 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
}

/**
 * Enqueue scripts and styles.
 */
function medel_scripts() {
	wp_enqueue_style( 'medel-style-default', get_stylesheet_uri() );

	if(!class_exists('WPBakeryShortCode')) {
		wp_enqueue_style( 'medel-fonts', medel_fonts_url(), array(), '1.0.0' );
	}

	if(function_exists('vc_icon_element_fonts_enqueue')) {
		vc_icon_element_fonts_enqueue( 'fontawesome' );
	} else {
		wp_enqueue_style( 'medel-font-awesomesd', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style( 'medel-iconsss', get_template_directory_uri() . '/css/iconfont.css');
	}

	wp_enqueue_style( 'medel-frontend-grid', get_template_directory_uri() . '/css/frontend-grid.css');

	wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/css/photoswipe.css');

	wp_enqueue_style( 'photoswipe-default-skin', get_template_directory_uri() . '/css/default-skin.css');

	wp_enqueue_style( 'medel-circle-animations', get_template_directory_uri() . '/css/circle_animations.css');

	wp_enqueue_style( 'medel-style', get_template_directory_uri() . '/css/style.css');

	wp_enqueue_style( 'woocommerce-general', get_template_directory_uri() . '/css/woocommerce.css');

	wp_enqueue_style( 'woocommerce-layout', get_template_directory_uri() . '/css/woocommerce-layout.css');

	wp_add_inline_style( 'medel-style', do_action('inline_css') );

	wp_enqueue_style( 'medel-mobile', get_template_directory_uri() . '/css/mobile.css');

	wp_enqueue_script( 'medel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '', true );

	wp_enqueue_script( 'medel-load-posts', get_template_directory_uri() . '/js/load-posts.js', array('jquery'), '', true );

	wp_enqueue_script( 'imagesloaded' );

	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'photoswipe', get_template_directory_uri() . '/js/photoswipe.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'photoswipe-ui-default', get_template_directory_uri() . '/js/photoswipe-ui-default.min.js', array('jquery'), '', true );

	wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'medel_scripts', 100 );

function medel_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/css/style.css' );
}
add_action( 'current_screen', 'medel_add_editor_styles' );

add_action( 'admin_enqueue_scripts', 'load_admin_styles', 1000 );
function load_admin_styles() {
	wp_enqueue_style( 'medel-font-awesomesd', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style( 'medel-backend', get_template_directory_uri() . '/css/admin.css', array(), '1.0', false );
	wp_enqueue_style( 'medel-shortcode-icons', get_template_directory_uri() . '/css/shortcode-icons.css', array(), '1.0', false );

  wp_enqueue_script('medel-admin', get_parent_theme_file_uri() . '/js/admin.js', array('jquery'), null, true);
}

/**
 * Admin Pages
 */
require get_template_directory() . '/inc/admin-pages.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM file.
 */
require get_template_directory() . '/tgm/tgm.php';

/**
 * Load ACF.
 */
require get_template_directory() . '/inc/acf.php';
define( 'ACF_LITE', true );

/**
 * Load Theme Settings.
 */
require get_template_directory() . '/theme-settings/config.php';

/**
 * Hooks
 */
require get_template_directory() . '/inc/v-hook.php';

/**
 * Setup Wizard
 */

if (is_admin()) {
  require_once get_template_directory() . '/inc/setup-wizard/envato_setup_init.php';
  require_once get_template_directory() . '/inc/setup-wizard/envato_setup.php';
}

/**
 * Site pagination.
 */
function medel_wp_corenavi($max_count = '') {
	global $wp_query;
	$pages = '';
	if(isset($max_count) && $max_count > 0) {
		$max = $max_count;
	} else {
		$max = $wp_query->max_num_pages;
	}

	if(get_query_var('paged') != 0) {
		$paged = get_query_var('paged');
	} else {
		$paged = get_query_var('page');
	}

	if (!$current = $paged) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$a['total'] = $max;
	$a['current'] = $current;

	$a['mid_size'] = 5;
	$a['end_size'] = 1;
	$a['prev_text'] = '<i class="free-basic-ui-elements-left-arrow"></i>';
	$a['next_text'] = '<i class="free-basic-ui-elements-right-arrow"></i>';

	$html = "";
	if ($max > 1) $html .= '<div class="pagination col-xs-12">';
	$html .= paginate_links($a);
	if ($max > 1) $html .= '</div>';

	return $html;
}

add_action( 'admin_init', 'medel_hide_editor' );

function medel_hide_editor() {

        // Get the Post ID.
        if ( isset ( $_GET['post'] ) )
        $post_id = $_GET['post'];
        else if ( isset ( $_POST['post_ID'] ) )
        $post_id = $_POST['post_ID'];

    if( !isset ( $post_id ) || empty ( $post_id ) )
        return;

    // Get the name of the Page Template file.
    $template_file = get_post_meta($post_id, '_wp_page_template', true);

    if($template_file == 'page-coming-soon.php'){ // edit the template name
        remove_post_type_support('page', 'editor');
    }

}

add_filter('get_the_excerpt', 'shortcode_unautop');
add_filter('get_the_excerpt', 'do_shortcode');

add_action( 'vc_before_init', 'medel_vc_before_init_actions' );
 
function medel_vc_before_init_actions() {
    if( function_exists('vc_set_shortcodes_templates_dir') ){ 
        vc_set_shortcodes_templates_dir( get_template_directory() . '/vc-elements' );
    }
}

function medel_load_custom_fonts($init) {
	global $medel_theme;

	$array = '';

	if ( isset($medel_theme) && !empty($medel_theme) ) {
		if(isset($medel_theme['body-font-face']['font-family']) && !empty($medel_theme['body-font-face']['font-family'])) {
			$array .= $medel_theme['body-font-face']['font-family'].'='.$medel_theme['body-font-face']['font-family'].';';
		}
		if(isset($medel_theme['additional-font-face']['font-family']) && !empty($medel_theme['additional-font-face']['font-family'])) {
			$array .= $medel_theme['additional-font-face']['font-family'].'='.$medel_theme['additional-font-face']['font-family'].';';
		}
		if(isset($medel_theme['additional-font-face2']['font-family']) && !empty($medel_theme['additional-font-face2']['font-family'])) {
			$array .= $medel_theme['additional-font-face2']['font-family'].'='.$medel_theme['additional-font-face2']['font-family'].';';
		}
		if(isset($medel_theme['additional-font-face3']['font-family']) && !empty($medel_theme['additional-font-face3']['font-family'])) {
			$array .= $medel_theme['additional-font-face3']['font-family'].'='.$medel_theme['additional-font-face3']['font-family'].';';
		}
		if(isset($medel_theme['additional-font-face4']['font-family']) && !empty($medel_theme['additional-font-face4']['font-family'])) {
			$array .= $medel_theme['additional-font-face4']['font-family'].'='.$medel_theme['additional-font-face4']['font-family'].';';
		}
	}

    $font_formats = isset($init['font_formats']) ? $init['font_formats'] : 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
	
	$init['fontsize_formats'] = "10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 23px 24px 25px 26px 27px 28px 29px 30px 32px 33px 34px 35px 36px 37px 38px 39px 40px";

	if(isset($array) && !empty($array)) {
		trim($array, ';');
		$custom_fonts = ';'.$array;

	    $init['font_formats'] = $font_formats . $custom_fonts;

	    return $init;
	} else {
		return false;
	}
}
add_filter('tiny_mce_before_init', 'medel_load_custom_fonts');

function medel_styles() {
	global $medel_theme;

	$style = array();
	$style['color_scheme'] = 'scheme1';

	$style['header_color_mode'] = 'light';
	$style['header_color_mode_404'] = 'light';
	$style['header_color_mode_coming_soon'] = 'light';
	$style['header_container'] = 'container';
	$style['navigation_type'] = 'visible_menu';
	$style['css_classes'] = '';
	
	$style['working_time'] = '';
	$style['phone_number'] = '';

	$style['logo_content'] = get_bloginfo( 'name' );
	$style['logo_default_url'] = '';
	$style['logo_light_url'] = '';
	$style['logo_dark_url']  = '';
	$style['logo_dark_url_scheme2']  = '';

	$style['google_maps_api_key'] = '';

	$style['search'] = 'yes';
	$style['cart'] = 'yes';
	$style['header_space'] = 'yes';
	$style['footer'] = 'show';
	$style['footer_logo'] = 'show';
	$style['footer_color_mode'] = 'dark';
	$style['copyright_text']  = '';
	$style['minified_copyright_text']  = '';
	$style['show_social_buttons'] = '1';


	$style['social_target'] = '_self';
	$style['social_buttons_content'] = '';


	$style['footer_col_1'] = '3';
	$style['footer_col_2'] = '3';
	$style['footer_col_3'] = '3';
	$style['footer_col_4'] = '3';


	$style['404_bg'] = '';
	$style['404_page_heading'] = __('<span>404 error</span>', 'medel');
	$style['404_page_desc'] = esc_html__('You are on a non existings page', 'medel');

	$style['coming_soon_bg'] = '';
	$style['coming_soon_heading'] = esc_html__('Coming soon', 'medel');
	$style['coming_soon_subscribe_desc'] = esc_html__('Subscribe and get the latest information about us.', 'medel');
	$style['coming_soon_subscribe_code'] = '';

	$style['project_style'] = 'slider';
	$style['project_image'] = 'full';

	$style['blog_feature_image'] = 'show';
	$style['blog_date'] = 'show';

	$style['preloader_show'] = '0';
	$style['preloader_img'] = '';

	if ( isset($medel_theme) && !empty($medel_theme) ) {
		if(isset($medel_theme['show_search']) && $medel_theme['show_search'] == '1') {
			$style['search'] = 'yes';
		} else {
			$style['search'] = 'no';
		}

		if(isset($medel_theme['show_cart']) && $medel_theme['show_cart'] == '1') {
			$style['cart'] = 'yes';
		} else {
			$style['cart'] = 'no';
		}

		if(isset($medel_theme['default_logo']['background-image']) && $medel_theme['default_logo']['background-image']) { 
			$style['logo_default_url'] = $medel_theme['default_logo']['background-image'];
		} 
		if(isset($medel_theme['dark_logo']['background-image']) && $medel_theme['dark_logo']['background-image']) {
			$style['logo_dark_url'] = $medel_theme['dark_logo']['background-image'];
		} 
 		if(isset($medel_theme['light_logo']['background-image']) && $medel_theme['light_logo']['background-image']) {
			$style['logo_light_url'] = $medel_theme['light_logo']['background-image'];
		} 
 		if(isset($medel_theme['dark_logo_scheme2']['background-image']) && $medel_theme['dark_logo_scheme2']['background-image']) {
			$style['logo_dark_url_scheme2'] = $medel_theme['dark_logo_scheme2']['background-image'];
		} 

		if(!empty($style['logo_light_url']) && !empty($style['logo_dark_url']) && !empty($style['logo_dark_url_scheme2'])) {
			$style['logo_content'] = '<img class="light" src="'.esc_url($style['logo_light_url']).'" alt="'.get_bloginfo( 'name' ).'"><img class="dark" src="'.esc_url($style['logo_dark_url']).'" alt="'.get_bloginfo( 'name' ).'"><img class="dark-scheme2" src="'.esc_url($style['logo_dark_url_scheme2']).'" alt="'.get_bloginfo( 'name' ).'">';
		} elseif(!empty($style['logo_light_url']) || !empty($style['logo_dark_url']) || !empty($style['logo_dark_url_scheme2'])) {
			if(!empty($style['logo_light_url'])) {
				$style['logo_content'] = '<img src="'.esc_url($style['logo_light_url']).'" alt="'.get_bloginfo( 'name' ).'">';
			}
			if(!empty($style['logo_dark_url'])) {
				$style['logo_content'] = '<img src="'.esc_url($style['logo_dark_url']).'" alt="'.get_bloginfo( 'name' ).'">';
			}
			if(!empty($style['logo_dark_url_scheme2'])) {
				$style['logo_content'] = '<img src="'.esc_url($style['logo_dark_url_scheme2']).'" alt="'.get_bloginfo( 'name' ).'">';
			}
		} elseif(!empty($style['logo_default_url'])) {
			$style['logo_content'] = '<img src="'.esc_url($style['logo_default_url']).'" alt="'.get_bloginfo( 'name' ).'">';
		} elseif(isset($medel_theme['logo_text']) && $medel_theme['logo_text']) {
			$style['logo_content'] = esc_html($medel_theme['logo_text']);
		} else {
			$style['logo_content'] = get_bloginfo( 'name' );
		}

		if(isset($medel_theme['color_scheme']) && !empty($medel_theme['color_scheme'])) {
			$style['color_scheme'] = $medel_theme['color_scheme'];
		}

		if(isset($medel_theme['working_time']) && !empty($medel_theme['working_time'])) {
			$style['working_time'] = $medel_theme['working_time'];
		}

		if(isset($medel_theme['google_maps_api_key']) && !empty($medel_theme['google_maps_api_key'])) {
			$style['google_maps_api_key'] = $medel_theme['google_maps_api_key'];
		}

		if(isset($medel_theme['phone_number']) && !empty($medel_theme['phone_number'])) {
			$style['phone_number'] = $medel_theme['phone_number'];
		}

		if(isset($medel_theme['navigation_type']) && !empty($medel_theme['navigation_type'])) {
			$style['navigation_type'] = $medel_theme['navigation_type'];
		}

		if(isset($medel_theme['header_container']) && !empty($medel_theme['header_container'])) {
			$style['header_container'] = $medel_theme['header_container'];
		}

		if(isset($medel_theme['header_color_mode']) && !empty($medel_theme['header_color_mode'])) {
			$style['header_color_mode'] = $medel_theme['header_color_mode'];
		}

		if(isset($medel_theme['header_color_mode_404']) && !empty($medel_theme['header_color_mode_404'])) {
			$style['header_color_mode_404'] = $medel_theme['header_color_mode_404'];
		}

		if(isset($medel_theme['header_color_mode_coming_soon']) && !empty($medel_theme['header_color_mode_coming_soon'])) {
			$style['header_color_mode_coming_soon'] = $medel_theme['header_color_mode_coming_soon'];
		}

		if(isset($medel_theme['copyright_text']) && !empty($medel_theme['copyright_text'])) {
			$style['copyright_text'] = $medel_theme['copyright_text'];
		}

		if(isset($medel_theme['minified_copyright_text']) && !empty($medel_theme['minified_copyright_text'])) {
			$style['minified_copyright_text'] = $medel_theme['minified_copyright_text'];
		}

		if(isset($medel_theme['footer']) && $medel_theme['footer']) {
			$style['footer'] = $medel_theme['footer'];
		}

		if(isset($medel_theme['footer_logo']) && $medel_theme['footer_logo']) {
			$style['footer_logo'] = $medel_theme['footer_logo'];
		}

		if(isset($medel_theme['footer_color_mode']) && $medel_theme['footer_color_mode']) {
			$style['footer_color_mode'] = $medel_theme['footer_color_mode'];
		}

		if(isset($medel_theme['footer_col_1']) && $medel_theme['footer_col_1']) {
			$style['footer_col_1'] = $medel_theme['footer_col_1'];
		}

		if(isset($medel_theme['footer_col_2']) && $medel_theme['footer_col_2']) {
			$style['footer_col_2'] = $medel_theme['footer_col_2'];
		}

		if(isset($medel_theme['footer_col_3']) && $medel_theme['footer_col_3']) {
			$style['footer_col_3'] = $medel_theme['footer_col_3'];
		}

		if(isset($medel_theme['footer_col_4']) && $medel_theme['footer_col_4']) {
			$style['footer_col_4'] = $medel_theme['footer_col_4'];
		}

		if(isset($medel_theme['404_bg']) && !empty($medel_theme['404_bg'])) {
			$style['404_bg'] = "background-image: url(".$medel_theme['404_bg']['background-image'].")";
		}

		if(isset($medel_theme['coming_soon_bg']) && !empty($medel_theme['coming_soon_bg'])) {
			$style['coming_soon_bg'] = "background-image: url(".$medel_theme['coming_soon_bg']['background-image'].")";
		}

		if(isset($medel_theme['404_page_heading'])) {
			$style['404_page_heading'] = $medel_theme['404_page_heading'];
		}

		if(isset($medel_theme['404_page_desc'])) {
			$style['404_page_desc'] = $medel_theme['404_page_desc'];
		}

		if(isset($medel_theme['coming_soon_heading'])) {
			$style['coming_soon_heading'] = $medel_theme['coming_soon_heading'];
		}

		if(isset($medel_theme['coming_soon_subscribe_desc'])) {
			$style['coming_soon_subscribe_desc'] = $medel_theme['coming_soon_subscribe_desc'];
		}

		if(isset($medel_theme['coming_soon_subscribe_code']) && $medel_theme['coming_soon_subscribe_code']) {
			$style['coming_soon_subscribe_code'] = $medel_theme['coming_soon_subscribe_code'];
		}

		if(isset($medel_theme['project_style']) && $medel_theme['project_style']) {
			$style['project_style'] = $medel_theme['project_style'];
		}

		if(isset($medel_theme['project_image']) && $medel_theme['project_image']) {
			$style['project_image'] = $medel_theme['project_image'];
		}

		if(isset($medel_theme['preloader_show']) && $medel_theme['preloader_show']) {
			$style['preloader_show'] = $medel_theme['preloader_show'];
		}
		
		if(isset($medel_theme['preloader_img']) && $medel_theme['preloader_img']) {
			$style['preloader_img'] = $medel_theme['preloader_img'];
		}

		if(isset($medel_theme['show_social_buttons']) && $medel_theme['show_social_buttons']) {
			$style['show_social_buttons'] = $medel_theme['show_social_buttons'];
		}

		if(isset($medel_theme['blog_feature_image']) && $medel_theme['blog_feature_image']) {
			$style['blog_feature_image'] = $medel_theme['blog_feature_image'];
		}

		if(isset($medel_theme['blog_date']) && $medel_theme['blog_date']) {
			$style['blog_date'] = $medel_theme['blog_date'];
		}

		if(isset($medel_theme['social_target']) && $medel_theme['social_target']) {
			$style['social_target'] = $medel_theme['social_target'];
		}

		if(isset($medel_theme['social_icon1']) && isset($medel_theme['social_link1']) && $medel_theme['social_icon1'] && $medel_theme['social_link1']) {
			$social_array = explode(',', $medel_theme['social_icon1']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link1']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon2']) && isset($medel_theme['social_link2']) && $medel_theme['social_icon2'] && $medel_theme['social_link2']) {
			$social_array = explode(',', $medel_theme['social_icon2']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link2']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon3']) && isset($medel_theme['social_link3']) && $medel_theme['social_icon3'] && $medel_theme['social_link3']) {
			$social_array = explode(',', $medel_theme['social_icon3']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link3']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon4']) && isset($medel_theme['social_link4']) && $medel_theme['social_icon4'] && $medel_theme['social_link4']) {
			$social_array = explode(',', $medel_theme['social_icon4']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link4']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon5']) && isset($medel_theme['social_link5']) && $medel_theme['social_icon5'] && $medel_theme['social_link5']) {
			$social_array = explode(',', $medel_theme['social_icon5']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link5']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon6']) && isset($medel_theme['social_link6']) && $medel_theme['social_icon6'] && $medel_theme['social_link6']) {
			$social_array = explode(',', $medel_theme['social_icon6']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link6']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}

		if(isset($medel_theme['social_icon7']) && isset($medel_theme['social_link7']) && $medel_theme['social_icon7'] && $medel_theme['social_link7']) {
			$social_array = explode(',', $medel_theme['social_icon7']);
			$style['social_buttons_content'] .= '<a href="'.esc_url($medel_theme['social_link7']).'" target="'.esc_attr($style['social_target']).'"><i class="'.esc_attr($social_array[0]).'"></i> <span>'.esc_html($social_array[1]).'</span></a>';
		}
	}

	if(function_exists("get_field")) {

		if(get_field('header_container') == 'container') {
			$style['header_container'] = 'container';
		} elseif(get_field('header_container') == 'container-fluid') {
			$style['header_container'] = 'container-fluid';
		}

		if(get_field('header_color_mode') == 'light') {
			$style['header_color_mode'] = 'light';
		}

		if(get_field('header_color_mode') == 'dark') {
			$style['header_color_mode'] = 'dark';
		}

		if(get_field('header_space')) {
			$style['header_space'] = get_field('header_space');
		}

		if(get_field('color_scheme') && get_field('color_scheme') != 'default') {
			$style['color_scheme'] = get_field('color_scheme');
		}

		if(get_field('navigation_type') && get_field('navigation_type') != 'default') {
			$style['navigation_type'] = get_field('navigation_type');
		}

		if(get_field('search') && get_field('search') != 'default') {
			$style['search'] = get_field('search');
		}

		if(get_field('cart') && get_field('search') != 'default') {
			$style['cart'] = get_field('cart');
		}

		if(get_field('header_container') && get_field('header_container') != 'default') {
			$style['header_container'] = get_field('header_container');
		}

		if(get_field('footer_social_buttons') && get_field('footer_social_buttons') != 'default') {
			$style['footer_social_buttons'] = get_field('footer_social_buttons');
		}

		if(get_field('footer') && get_field('footer') != 'default') {
			$style['footer'] = get_field('footer');
		}

		if(get_field('project_style') && get_field('project_style') != 'default') {
			$style['project_style'] = get_field('project_style');
		}

		if(get_field('project_image') && get_field('project_image') != 'default') {
			$style['project_image'] = get_field('project_image');
		}

		if(get_field('footer_color_mode') && get_field('footer_color_mode') != 'default') {
			$style['footer_color_mode'] = get_field('footer_color_mode');
		}
	}

	if(is_404()) {
		$style['css_classes'] .= ' '.$style['header_color_mode_404'];
	} else if(is_page_template('page-coming-soon.php')) {
		$style['css_classes'] .= ' '.$style['header_color_mode_coming_soon'];
	} else {
		$style['css_classes'] .= ' '.$style['header_color_mode'];
	}

	if (is_404() || is_page_template('page-coming-soon.php')) {
		$style['header_space'] = 'yes';
	}

	if($style['header_space'] == 'yes') {
		$style['css_classes'] .= ' header-space-on';
	}

	return $style;
}

add_filter( 'body_class', 'medel_custom_body_classes');
function medel_custom_body_classes( $classes ) {
	global $medel_theme;
	$site_mode = 'light';

	$classes[] = 'header_type_'.medel_styles()['navigation_type'];
	$classes[] = 'color-'.medel_styles()['color_scheme'];

	if(!class_exists('WPBakeryShortCode')) {
		$classes[] = 'site-nav-arr';
	}

    $classes[] = $site_mode;
 
    return $classes;
}

/**
 * Portfolio widget
 */
class medel_portfolio_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct(
			'portfolio', 
			'Portfolio'
		);
	}
 
	public function widget( $args, $instance ) {
		$title = $instance['title'];
		$amount = $instance['amount'];
		$cols = $instance['cols'];
 
		switch ($cols) {
			case '1':
			$class = "col-xs-12";
			break;
			case '2':
			$class = "col-xs-6 col-sm-6";
			break;
			case '3':
			$class = "col-xs-4";
			break;
			case '4':
			$class = "col-xs-6 col-md-3";
			break;

			default:
			$class = "";
			break;
		}

		$porfolio_array = get_posts( array(
			'numberposts'     => $amount,
			'post_type'       => 'pt-portfolio',
			'post_status'     => 'publish'
			)
		);

		echo wp_kses_post($args['before_widget']);
		if ( ! empty( $title ) ) echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		?>
		<div class="gallery-module row">
			<?php foreach ($porfolio_array as $item) {
				setup_postdata($item);
				$id = $item->ID;
				$name = $item->post_title;

				$thumb = get_post_meta( $id, '_thumbnail_id', true );

				$link = get_permalink($id);
			?>
			<div class="<?php echo esc_attr($class) ?> item"><a href="<?php echo esc_url($link) ?>"><?php echo wp_get_attachment_image( $thumb , 'thumbnail', true, array('title'=>$name) ) ?></a></div>
			<?php } ?>
		</div>
		<?php
		echo wp_kses_post($args['after_widget']);
	}
 
	public function form( $instance ) {
		$title = "";
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		$amount = "";
		if ( isset( $instance[ 'amount' ] ) ) {
			$amount = $instance[ 'amount' ];
		}
		$cols = "";
		if ( isset( $instance[ 'cols' ] ) ) {
			$cols = $instance[ 'cols' ];
		}
		?>
		<p>
			<label for="<?php echo esc_html($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Heading:', 'medel') ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_html($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_html($this->get_field_id( 'amount' )); ?>"><?php esc_html_e( 'Amount:', 'medel') ?></label> 
			<input id="<?php echo esc_html($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_html($this->get_field_name( 'amount' )); ?>" type="text" value="<?php echo ($amount) ? esc_attr( $amount ) : '9'; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo esc_html($this->get_field_id( 'cols' )); ?>"><?php esc_html_e( 'Cols:', 'medel') ?></label> 
			<input id="<?php echo esc_html($this->get_field_id( 'cols' )); ?>" name="<?php echo esc_html($this->get_field_name( 'cols' )); ?>" type="text" value="<?php echo ($cols) ? esc_attr( $cols ) : '3'; ?>" size="3" />
		</p>
		<?php 
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['amount'] = ( is_numeric( $new_instance['amount'] ) ) ? $new_instance['amount'] : '8';
		$instance['cols'] = ( is_numeric( $new_instance['cols'] ) ) ? $new_instance['cols'] : '5';
		return $instance;
	}
}

function medel_portfolio_widget() {
	register_widget( 'medel_portfolio_widget' );
}
add_action( 'widgets_init', 'medel_portfolio_widget' );

function fb_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'thin',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '100',
            )
        ),
        array(
            'title' => 'extra-light',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '200',
            )
        ),
        array(
            'title' => 'light',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '300',
            )
        ),
        array(
            'title' => 'regular',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '400',
            )
        ),
        array(
            'title' => 'medium',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '500',
            )
        ),
        array(
            'title' => 'semi-bold',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '600',
            )
        ),
        array(
            'title' => 'bold',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '700',
            )
        ),
        array(
            'title' => 'extra-bold',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '800',
            )
        ),
        array(
            'title' => 'black',
            'inline' => 'span',
            'styles' => array(
                'fontWeight'    => '900',
            )
        ),
        array(
            'title' => 'UPPERCASE',
            'inline' => 'span',
            'styles' => array(
                'textTransform'    => 'uppercase',
            )
        ),
        array(
            'title' => 'Button style 1',
            'inline' => 'a',
            'classes' => 'button-style1',
			'wrapper' => true,
        ),
        array(
            'title' => 'Button style 1 (transparent)',
            'inline' => 'a',
            'classes' => 'button-style1 transperent',
			'wrapper' => true,
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}
add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );

if(function_exists('vc_remove_param')) {
	vc_remove_param( 'vc_btn', 'color' );
}

if(function_exists('vc_add_param')) {
	vc_add_params( 'vc_custom_heading', array(
		array(
		    "type"        => "switch",
		    "class"       => "",
		    "heading"     => esc_html__( "Uppercase", "medel" ),
		    "param_name"  => "uppercase",
		    "value"       => "off",
		    "options"     => array(
		        "on" => array(
		            "on"    => "On",
		            "off"   => "Off",
		        ),
		    ),
		    "dependency"  => "",
		    "default_set" => false,
		),
		array(
		    "type"        => "switch",
		    "class"       => "",
		    "heading"     => esc_html__( "Decor line", "medel" ),
		    "param_name"  => "decor_line",
		    "value"       => "off",
		    "options"     => array(
		        "on" => array(
		            "on"    => "On",
		            "off"   => "Off",
		        ),
		    ),
		    "dependency"  => "",
		    "default_set" => false,
		),
	));

	vc_add_params("vc_row", array(
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Custom text color', 'medel' ),
			'param_name' => 'custom_text_color',
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__( "Background position", "medel" ),
			"param_name" => "background_position",
			"value" => array(
				'' => 'None',
				"center center" => "center center",
				"center top" => "center top",
				"center bottom" => "center bottom"
			)
		),
        array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Gradient background', 'medel' ),
			'param_name' => 'show_background_gradient',
		),
		array(
			'type' => 'gradient',
			'heading' => esc_html__( 'Gradient', 'medel' ),
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'show_background_gradient',
				'not_empty' => true,
			),
		),
        array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Color overlay', 'medel' ),
			'param_name' => 'color_overlay',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Color overlay hex', 'medel' ),
			'param_name' => 'color_overlay_color',
			'dependency' => array(
				'element' => 'color_overlay',
				'not_empty' => true,
			),
		),
	));

	vc_remove_param( "vc_icon", "background_color" );
	vc_remove_param( "vc_icon", "custom_color" );
	vc_remove_param( "vc_icon", "background_style" );
	vc_remove_param( "vc_icon", "background_color" );
	vc_remove_param( "vc_icon", "custom_background_color" );
	vc_remove_param( "vc_icon", "size" );
	vc_remove_param( "vc_icon", "align" );
	vc_remove_param( "vc_icon", "link" );
	vc_remove_param( "vc_icon", "el_id" );
	vc_remove_param( "vc_icon", "el_class" );
	vc_remove_param( "vc_icon", "css" );

	if(function_exists('vc_get_shared')) {
		vc_add_params("vc_icon", array(
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Custom color', 'medel' ),
				'param_name' => 'custom_color',
				'description' => esc_html__( 'Select custom icon color.', 'medel' ),
				'dependency' => array(
					'element' => 'color',
					'value' => 'custom',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background shape', 'medel' ),
				'param_name' => 'background_style',
				'value' => array(
					__( 'None', 'medel' ) => '',
					__( 'Circle', 'medel' ) => 'rounded',
					__( 'Square', 'medel' ) => 'boxed',
					__( 'Rounded', 'medel' ) => 'rounded-less',
					__( 'Outline Circle', 'medel' ) => 'rounded-outline',
					__( 'Outline Square', 'medel' ) => 'boxed-outline',
					__( 'Outline Rounded', 'medel' ) => 'rounded-less-outline',
				),
				'description' => esc_html__( 'Select background shape and style for icon.', 'medel' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Background color', 'medel' ),
				'param_name' => 'background_color',
				'value' => array_merge( vc_get_shared( 'colors' ), array( esc_html__( 'Custom color', 'js_composer' ) => 'custom' ) ),
				'std' => 'grey',
				'description' => esc_html__( 'Select background color for icon.', 'medel' ),
				'param_holder_class' => 'vc_colored-dropdown',
				'dependency' => array(
					'element' => 'background_style',
					'not_empty' => true,
				),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Custom background color', 'medel' ),
				'param_name' => 'custom_background_color',
				'description' => esc_html__( 'Select custom icon background color.', 'medel' ),
				'dependency' => array(
					'element' => 'background_color',
					'value' => 'custom',
				),
			),
			array(
				'type' => 'gradient',
				'heading' => esc_html__( 'Custom background gradient', 'medel' ),
				'param_name' => 'custom_background_gradient',
				'dependency' => array(
					'element' => 'background_color',
					'value' => 'gradient',
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Size', 'medel' ),
				'param_name' => 'size',
				'value' => array_merge( vc_get_shared( 'sizes' ), array( 'Extra Large' => 'xl' ) ),
				'std' => 'md',
				'description' => esc_html__( 'Icon size.', 'medel' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon alignment', 'medel' ),
				'param_name' => 'align',
				'value' => array(
					__( 'Left', 'medel' ) => 'left',
					__( 'Right', 'medel' ) => 'right',
					__( 'Center', 'medel' ) => 'center',
				),
				'description' => esc_html__( 'Select icon alignment.', 'medel' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'medel' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to icon.', 'medel' ),
			),
			vc_map_add_css_animation(),
			array(
				'type' => 'el_id',
				'heading' => esc_html__( 'Element ID', 'medel' ),
				'param_name' => 'el_id',
				'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'medel' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'medel' ),
				'param_name' => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'medel' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'CSS box', 'medel' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design Options', 'medel' ),
			),
		));
	}

	vc_remove_param( "vc_tta_accordion", "no_fill" );
	vc_remove_param( "vc_tta_accordion", "spacing" );
	vc_remove_param( "vc_tta_accordion", "gap" );
	vc_remove_param( "vc_tta_accordion", "c_align" );
	vc_remove_param( "vc_tta_accordion", "autoplay" );
	vc_remove_param( "vc_tta_accordion", "collapsible_all" );
	vc_remove_param( "vc_tta_accordion", "c_icon" );
	vc_remove_param( "vc_tta_accordion", "c_position" );
	vc_remove_param( "vc_tta_accordion", "active_section" );
	vc_remove_param( "vc_tta_accordion", "el_id" );
	vc_remove_param( "vc_tta_accordion", "el_class" );
	vc_remove_param( "vc_tta_accordion", "css" );

	vc_add_params("vc_tta_accordion", array(
        array(
            "type" => "gradient",
            "base_gradient" => "#ff6884 0%,#620044 100%",
            "base_orientation" => "horizontal",
            "heading" => esc_html__("Gradient on active", "medel"),
            "param_name" => "active_gradient",
			'dependency' => array(
				'element' => 'style',
				'value' => 'classic',
			),
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Text color active block", "medel"),
            "param_name" => "active_color",
			'dependency' => array(
				'element' => 'style',
				'value' => 'classic',
			),
        ),
		array(
			'type' => 'checkbox',
			'param_name' => 'no_fill',
			'heading' => esc_html__( 'Do not fill content area?', 'medel' ),
			'description' => esc_html__( 'Do not fill content area with color.', 'medel' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'spacing',
			'value' => array(
				__( 'None', 'medel' ) => '',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'heading' => esc_html__( 'Spacing', 'medel' ),
			'description' => esc_html__( 'Select accordion spacing.', 'medel' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'gap',
			'value' => array(
				__( 'None', 'medel' ) => '',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'heading' => esc_html__( 'Gap', 'medel' ),
			'description' => esc_html__( 'Select accordion gap.', 'medel' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_align',
			'value' => array(
				__( 'Left', 'medel' ) => 'left',
				__( 'Right', 'medel' ) => 'right',
				__( 'Center', 'medel' ) => 'center',
			),
			'heading' => esc_html__( 'Alignment', 'medel' ),
			'description' => esc_html__( 'Select accordion section title alignment.', 'medel' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'autoplay',
			'value' => array(
				__( 'None', 'medel' ) => 'none',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
			),
			'std' => 'none',
			'heading' => esc_html__( 'Autoplay', 'medel' ),
			'description' => esc_html__( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'medel' ),
		),
		array(
			'type' => 'checkbox',
			'param_name' => 'collapsible_all',
			'heading' => esc_html__( 'Allow collapse all?', 'medel' ),
			'description' => esc_html__( 'Allow collapse all accordion sections.', 'medel' ),
		),
		// Control Icons
		array(
			'type' => 'dropdown',
			'param_name' => 'c_icon',
			'value' => array(
				__( 'None', 'medel' ) => '',
				__( 'Chevron', 'medel' ) => 'chevron',
				__( 'Plus', 'medel' ) => 'plus',
				__( 'Triangle', 'medel' ) => 'triangle',
			),
			'std' => 'plus',
			'heading' => esc_html__( 'Icon', 'medel' ),
			'description' => esc_html__( 'Select accordion navigation icon.', 'medel' ),
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'c_position',
			'value' => array(
				__( 'Left', 'medel' ) => 'left',
				__( 'Right', 'medel' ) => 'right',
			),
			'dependency' => array(
				'element' => 'c_icon',
				'not_empty' => true,
			),
			'heading' => esc_html__( 'Position', 'medel' ),
			'description' => esc_html__( 'Select accordion navigation icon position.', 'medel' ),
		),
		// Control Icons END
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => esc_html__( 'Active section', 'medel' ),
			'value' => 1,
			'description' => esc_html__( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'medel' ),
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'medel' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'medel' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'medel' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'medel' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'medel' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'medel' ),
		),
	));
}

add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {
    if( function_exists('vc_set_shortcodes_templates_dir') ){
        vc_set_shortcodes_templates_dir( get_template_directory() . '/vc_templates' );
    }
}

add_filter( 'jpeg_quality', 'medel_filter_theme_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'medel_filter_theme_image_full_quality' );

function medel_filter_theme_image_full_quality( $quality ) {
    return 100;
}

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'medel_woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_shop_loop_item_title', 'medel_woocommerce_template_loop_product_title', 10);


/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'medel_woocommerce_template_loop_product_thumbnail' ) ) {
	function medel_woocommerce_template_loop_product_title() {
		echo medel_woocommerce_get_product_title();
	} 
}

/**
 * WooCommerce Product Thumbnail
 **/
if ( ! function_exists( 'medel_woocommerce_get_product_title' ) ) {
	
	function medel_woocommerce_get_product_title() {
		global $post, $woocommerce,$product;
		$product_cat_name = "";

		$terms = get_the_terms( $product->get_id(), 'product_cat' );

		$output = '<div class="name">'.$product->get_name().'</div>';

		if( !empty( $terms ) && !is_wp_error( $terms ) ) {
			$output .= '<div class="category">';
				foreach ($terms  as $term  ) {
		            $product_cat_name .= $term->name.', ';
		        }
		        $output .= trim($product_cat_name, ', ');
	        $output .= '</div>';
	    }

	    if ( $price_html = $product->get_price_html() ) {
			$price_class = '';
			if($product->is_type( 'variable' )) {
				$price_class = ' variable';
			}
			$output .= '<span class="price'.esc_attr($price_class).'">'.wp_kses($price_html, 'post').'</span>';
		}

		return $output;
	}
}

/**
 * WooCommerce Loop Product Thumbs
 **/
if ( ! function_exists( 'medel_woocommerce_template_loop_product_thumbnail' ) ) {
	function medel_woocommerce_template_loop_product_thumbnail() {
		echo medel_woocommerce_get_product_thumbnail();
	} 
}

/**
 * WooCommerce Product Thumbnail
 **/
if ( ! function_exists( 'medel_woocommerce_get_product_thumbnail' ) ) {
	
	function medel_woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce,$product;
		if ( ! $placeholder_width )
			$placeholder_width = wc_get_image_size( 'shop_catalog' )['width'];
		if ( ! $placeholder_height )
			$placeholder_height = wc_get_image_size( 'shop_catalog' )['height'];

		$class = implode( ' ', array_filter( array(
                'button',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
        ) ) );

		$output = '<div class="image">';

			$output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><span>%s</span></a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $quantity ) ? $quantity : 1 ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					esc_attr( $class ),
					esc_html( $product->add_to_cart_text() )
				),
			$product );
		
			$output .= '<a href="'.get_the_permalink().'">';
			if ( has_post_thumbnail() ) {

				$output .= get_the_post_thumbnail( $post->ID, $size );
				if($attachment_ids = $product->get_gallery_image_ids() ) {
					if(isset($attachment_ids[1])){
						$output .= wp_get_attachment_image( $attachment_ids[1] , 'shop_catalog', '', array('class'=>'show') );
					}
				}

			} else {
				
				$output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
				
			}

			$output .= '</a>';

		$output .= '</div>';

		return $output;
	}
}

/**
 * WooCommerce Single Meta
 **/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'medel_woocommerce_template_single_meta_remove_category', 5 );

function medel_woocommerce_template_single_meta_remove_category(){    

	global $post, $product;

	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

	?>
	<div class="product_meta">

	  <?php do_action( 'woocommerce_product_meta_start' ); ?>

	  <?php if ( wc_product_sku_enabled() && $product->get_sku() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

	    <span class="sku_wrapper"><?php _e( 'SKU:', 'medel' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( '---', 'medel' ); ?></span></span>

	  <?php endif; ?>

	 
	  <?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>

<?php }

function medel_related_products_limit() {
    global $product;
    $orderby = '';
    $columns = 4;
    $related = $product->get_related( 4 );
    $args = array(
        'post_type'           => 'product',
        'no_found_rows'       => 1,
        'posts_per_page'      => 4,
        'ignore_sticky_posts' => 1,
        'orderby'             => $orderby,
        'post__in'            => $related,
        'post__not_in'        => array($product->get_id())
    );
    return $args;
}
add_filter( 'woocommerce_related_products_args', 'medel_related_products_limit' );


/**
 * The order of the blocks
 **/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<div class="header-minicart woocommerce header-minicart-medel">
		<?php $count = $woocommerce->cart->cart_contents_count;
		if($count == 0) { ?>
		<div class="hm-cunt"><i class="fa fa-shopping-cart"></i><span><?php echo esc_html($count) ?></span></div>
		<?php } else { ?>
		<a class="hm-cunt" href="<?php echo esc_url(wc_get_cart_url()) ?>"><i class="fa fa-shopping-cart"></i><span><?php echo esc_html($count) ?></span></a>
		<?php } ?>
		<div class="minicart-wrap">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
	<?php
	$fragments['.header-minicart-medel'] = ob_get_clean();

	return $fragments;
}

class Child_Wrap extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\"><li class=\"back ui-super-basic-previous\"></li>\n";
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
}

add_action( 'vc_before_init', 'medel_vcSetAsTheme' );
function medel_vcSetAsTheme() {
	if(function_exists('vc_set_as_theme')) {
    	vc_set_as_theme();
	}
}


/**
 * Blog post widget
 */
class medel_blog_post_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct(
			'blog_post', 
			'Blog post'
		);
	}
 
	public function widget( $args, $instance ) {
		$title = $instance['title'];
		$amount = $instance['amount'];
		$orderby = $instance['orderby'];
		$order = $instance['order'];
		$display_image = $instance['display_image'];
		$display_date = $instance['display_date'];


		$post_array = get_posts( array(
			'numberposts'     => $amount,
			'orderby'         => $orderby,
			'order'           => $order,
			'post_type'       => 'post',
			'post_status'     => 'publish'
			)
		);

		if ( ! empty( $title ) ) echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		?>
		<div class="blog-post-widget widget">
			<?php foreach ($post_array as $item) {
				setup_postdata($item);
				$id = $item->ID;
				$name = $item->post_title;

				$thumb = get_post_meta( $id, '_thumbnail_id', true );
				$image_array = wp_get_attachment_image_src( $thumb , 'thumbnail' )[0];
			?>
			<div class="item">
				<?php if($display_image == "yes" && isset($image_array) && !empty($image_array)) { ?>
				<a href="<?php echo esc_url(get_permalink($id)) ?>" class="image" style="background-image: url(<?php echo esc_url($image_array) ?>)"></a>
				<?php } ?>
				<div class="text">
					<div class="cell">
						<a href="<?php echo esc_url(get_permalink($id)) ?>" class="name"><?php echo esc_html($name) ?></a>
						<?php if($display_date == "yes") { ?>
							<div class="blog-detail"><span><?php echo get_the_date('', $id) ?></span></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
	}
 
	public function form( $instance ) {
		$title = "";
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		$amount = "";
		if ( isset( $instance[ 'amount' ] ) ) {
			$amount = $instance[ 'amount' ];
		}
		$orderby = "";
		if ( isset( $instance[ 'orderby' ] ) ) {
			$orderby = $instance[ 'orderby' ];
		}
		$order = "";
		if ( isset( $instance[ 'order' ] ) ) {
			$order = $instance[ 'order' ];
		}
		$display_image = "";
		if ( isset( $instance[ 'display_image' ] ) ) {
			$display_image = $instance[ 'display_image' ];
		}
		$display_date = "";
		if ( isset( $instance[ 'display_date' ] ) ) {
			$display_date = $instance[ 'display_date' ];
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Heading:', 'medel') ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>"><?php esc_html_e( 'Number posts:', 'medel') ?></label> 
			<input id="<?php echo esc_attr($this->get_field_id( 'amount' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'amount' )); ?>" type="number" value="<?php echo ($amount) ? esc_attr( $amount ) : '3'; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>"><?php esc_html_e( 'Order by:', 'medel') ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>">
				<option value="date" <?php echo ($orderby =='date')?'selected':''; ?>><?php echo esc_html__('Date' ,'medel') ?></option>
				<option value="author" <?php echo ($orderby =='author')?'selected':''; ?>><?php echo esc_html__('Author' ,'medel') ?></option>
				<option value="category" <?php echo ($orderby =='category')?'selected':''; ?>><?php echo esc_html__('Category' ,'medel') ?></option>
				<option value="ID" <?php echo ($orderby =='ID')?'selected':''; ?>><?php echo esc_html__('ID' ,'medel') ?></option>
				<option value="title" <?php echo ($orderby =='title')?'selected':''; ?>><?php echo esc_html__('Title' ,'medel') ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php esc_html_e( 'Order:', 'medel') ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'order' )); ?>">
				<option value="DESC"<?php echo ($order =='DESC')?'selected':''; ?>><?php echo esc_html__('Descending order' ,'medel') ?></option>
				<option value="ASC"<?php echo ($order =='ASC')?'selected':''; ?>><?php echo esc_html__('Ascending order' ,'medel') ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'display_image' )); ?>"><?php esc_html_e( 'Image:', 'medel') ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'display_image' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'display_image' )); ?>">
				<option value="yes"<?php echo ($display_image =='yes')?'selected':''; ?>><?php echo esc_html__('Yes' ,'medel') ?></option>
				<option value="no"<?php echo ($display_image =='no')?'selected':''; ?>><?php echo esc_html__('No' ,'medel') ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'display_date' )); ?>"><?php esc_html_e( 'Date:', 'medel') ?></label>
			<select name="<?php echo esc_attr($this->get_field_name( 'display_date' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'display_date' )); ?>">
				<option value="yes"<?php echo ($display_date =='yes')?'selected':''; ?>><?php echo esc_html__('Yes' ,'medel') ?></option>
				<option value="no"<?php echo ($display_date =='no')?'selected':''; ?>><?php echo esc_html__('No' ,'medel') ?></option>
			</select>
		</p>

		<?php 
	}
 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['amount'] = ( is_numeric( $new_instance['amount'] ) ) ? $new_instance['amount'] : '2';
		$instance['orderby'] = ( is_numeric( $new_instance['orderby'] ) ) ? $new_instance['orderby'] : 'date';
		$instance['order'] = ( is_numeric( $new_instance['order'] ) ) ? $new_instance['order'] : 'DESC';
		$instance['display_image'] = ( is_numeric( $new_instance['display_image'] ) ) ? $new_instance['display_image'] : 'yes';
		$instance['display_date'] = ( is_numeric( $new_instance['display_date'] ) ) ? $new_instance['display_date'] : 'yes';
		return $instance;
	}
}

function medel_blog_post_widget() {
	register_widget( 'medel_blog_post_widget' );
}
add_action( 'widgets_init', 'medel_blog_post_widget' );

function medel_phpinfo2array() {
    $entitiesToUtf8 = function($input) {
        // http://php.net/manual/en/function.html-entity-decode.php#104617
        return preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $input);
    };
    $plainText = function($input) use ($entitiesToUtf8) {
        return trim(html_entity_decode($entitiesToUtf8(strip_tags($input))));
    };
    $titlePlainText = function($input) use ($plainText) {
        return '# '.$plainText($input);
    };
    
    ob_start();
    phpinfo(-1);
    
    $phpinfo = array('phpinfo' => array());

    // Strip everything after the <h1>Configuration</h1> tag (other h1's)
    if (!preg_match('#(.*<h1[^>]*>\s*Configuration.*)<h1#s', ob_get_clean(), $matches)) {
        return array();
    }
    
    $input = $matches[1];
    $matches = array();

    if(preg_match_all(
        '#(?:<h2.*?>(?:<a.*?>)?(.*?)(?:<\/a>)?<\/h2>)|'.
        '(?:<tr.*?><t[hd].*?>(.*?)\s*</t[hd]>(?:<t[hd].*?>(.*?)\s*</t[hd]>(?:<t[hd].*?>(.*?)\s*</t[hd]>)?)?</tr>)#s',
        $input, 
        $matches, 
        PREG_SET_ORDER
    )) {
        foreach ($matches as $match) {
            $fn = strpos($match[0], '<th') === false ? $plainText : $titlePlainText;
            if (strlen($match[1])) {
                $phpinfo[$match[1]] = array();
            } elseif (isset($match[3])) {
                $keys1 = array_keys($phpinfo);
                $phpinfo[end($keys1)][$fn($match[2])] = isset($match[4]) ? array($fn($match[3]), $fn($match[4])) : $fn($match[3]);
            } else {
                $keys1 = array_keys($phpinfo);
                $phpinfo[end($keys1)][] = $fn($match[2]);
            }

        }
    }
    
    return $phpinfo;
}

function medel_let_to_num( $size ) {
	$l    = substr( $size, -1 );
	$ret  = substr( $size, 0, -1 );
	$byte = 1024;

	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}
	return $ret;
}