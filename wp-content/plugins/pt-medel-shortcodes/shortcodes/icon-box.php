<?php

// Element Description: PT Icon Box

class PT_Icon_Box extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_icon_box_mapping' ) );
        add_shortcode( 'pt_icon_box', array( $this, 'pt_icon_box_html' ) );
        add_shortcode( 'pt_icon_box_item', array( $this, 'pt_icon_box_item_html' ) );
    }
     
    // Element Mapping
    public function pt_icon_box_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Icon Box", "medel"),
            "base" => "pt_icon_box",
            "as_parent" => array('only' => 'pt_icon_box_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-icon-box",
            "is_container" => true,
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Style", "medel" ),
                    "param_name"  => "style",
                    "value"      => array(
                        esc_html__( "Style 1", "medel" ) => "style1",
                        esc_html__( "Style 2", "medel" ) => "style2",
                    ),
                    "std" => 'style1',
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Overlay on the previous layer", "medel" ),
                    "param_name"  => "prev_layer",
                    "value"      => array(
                        esc_html__( "No", "medel" ) => "no",
                        esc_html__( "Yes", "medel" ) => "yes",
                    ),
                    "std" => 'no',
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
                    "std" => '4',
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
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Icon Box item", "medel"),
            "base" => "pt_icon_box_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-icon-box",
            "as_child" => array('only' => 'pt_icon_box'),
            "params" => array(
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Content type", "medel" ),
                    "param_name"  => "content_type",
                    "value"      => array(
                        esc_html__( "Text", "medel" ) => "text",
                        esc_html__( "Working time", "medel" ) => "working_time",
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Icon library', 'medel' ),
                    'value' => array(
                        esc_html__( 'Font Awesome', 'medel' ) => 'fontawesome',
                        esc_html__( 'Open Iconic', 'medel' ) => 'openiconic',
                        esc_html__( 'Typicons', 'medel' ) => 'typicons',
                        esc_html__( 'Entypo', 'medel' ) => 'entypo',
                        esc_html__( 'Linecons', 'medel' ) => 'linecons',
                        esc_html__( 'Mono Social', 'medel' ) => 'monosocial',
                        esc_html__( 'Material', 'medel' ) => 'material',
                    ),
                    'admin_label' => true,
                    'param_name' => 'type',
                    'description' => esc_html__( 'Select icon library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_fontawesome',
                    'value' => 'fa fa-adjust',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'fontawesome',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_openiconic',
                    'value' => 'vc-oi vc-oi-dial',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'openiconic',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'openiconic',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_typicons',
                    'value' => 'typcn typcn-adjust-brightness',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'typicons',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'typicons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_entypo',
                    'value' => 'entypo-icon entypo-icon-note',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'entypo',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'entypo',
                    ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_linecons',
                    'value' => 'vc_li vc_li-heart',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'linecons',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'linecons',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_monosocial',
                    'value' => 'vc-mono vc-mono-fivehundredpx',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'monosocial',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'monosocial',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon', 'medel' ),
                    'param_name' => 'icon_material',
                    'value' => 'vc-material vc-material-cake',
                    // default value to backend editor admin_label
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'material',
                        'iconsPerPage' => 4000,
                        // default 100, how many icons per/page to display
                    ),
                    'dependency' => array(
                        'element' => 'type',
                        'value' => 'material',
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'medel' ),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Text", "medel"),
                    "param_name" => "text",
                    "dependency" => Array( "element" => "content_type", "value" => array( "text" ) ),
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Link", "medel"),
                    "param_name" => "link",
                    "admin_label" => true,
                    "dependency" => Array( "element" => "content_type", "value" => array( "text" ) ),
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Working time", "medel"),
                    "param_name" => "working_time",
                    "dependency" => Array( "element" => "content_type", "value" => array( "working_time" ) ),
                    "description" => esc_html__("New per row. Example: Mon - Fri {8:00 - 21:00}", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Top Background color", "medel"),
                    "param_name" => "top_background_color",
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Top Text color", "medel"),
                    "param_name" => "top_text_color",
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Wrap Background color", "medel"),
                    "param_name" => "wrap_background_color",
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Wrap Text color", "medel"),
                    "param_name" => "wrap_text_color",
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_icon_box_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'style' => 'style1',
                    'prev_layer' => 'no',
                    'desktop_cols' => '4',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                ), 
                $atts
            )
        );

        $html = $classes = "";

        // Fill $html var with data
        if(!empty($content)) {
            $content = str_replace('[pt_icon_box_item ', '[pt_icon_box_item style="'.$style.'" desktop_cols="'.$desktop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }

        $classes .= ' '.$style;

        if($prev_layer == 'yes') {
            $classes .= ' prev-layer';
        }

        $html = '<div class="icon-box-items row'.esc_attr($classes).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_icon_box_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'content_type' => 'text',
                    'type' => 'fontawesome',
                    'icon_fontawesome' => 'fa fa-adjust',
                    'icon_openiconic' => 'vc-oi vc-oi-dial',
                    'icon_typicons' => 'typcn typcn-adjust-brightness',
                    'icon_entypo' => 'entypo-icon entypo-icon-note',
                    'icon_linecons' => 'vc_li vc_li-heart',
                    'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
                    'icon_material' => 'vc-material vc-material-cake',
                    'style' => 'style1',
                    'desktop_cols' => '3',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                    'heading' => '',
                    'link' => '',
                    'text' => '',
                    'working_time' => '',
                    'top_background_color' => '',
                    'wrap_background_color' => '',
                    'top_text_color' => '',
                    'wrap_text_color' => '',
                ), 
                $atts
            )
        );
        
        // Fill $html var with data

        $html = $custom_css = "";

        $item_id = uniqid('icon-box-');

        $icon = 'icon_'.$type;

        if(isset(vc_build_link($link)['url']) && !empty(vc_build_link($link)['url'])) {
            $link = vc_build_link($link);
        }

        if(!empty($top_background_color)) {
            $custom_css .= '.'.$item_id.'.icon-box-item .top { background-color:'.$top_background_color.'}';
        }
        if(!empty($wrap_background_color)) {
            $custom_css .= '.'.$item_id.'.icon-box-item .wrap { background-color:'.$wrap_background_color.'}';
        }

        if(!empty($top_text_color)) {
            $custom_css .= '.'.$item_id.'.icon-box-item .top { color:'.$top_text_color.'}';
        }
        if(!empty($wrap_text_color)) {
            $custom_css .= '.'.$item_id.'.icon-box-item .wrap { color:'.$wrap_text_color.'}';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        $html .= '<div class="icon-box-item-wrap col-xs-'.esc_attr(12/$mobile_cols).' col-sm-'.esc_attr(12/$tablet_cols).' col-md-'.esc_attr(12/$desktop_cols).'">';
            $html .= '<div class="icon-box-item '.esc_attr($item_id).'">';
                if(!empty($heading)) {
                    $html .= '<div class="top">';
                        $html .= '<i class="'.esc_attr($$icon).'"></i>';
                        $html .= '<div><div class="cell">'.wp_kses($heading ,'post').'</div></div>';
                    $html .= '</div>';
                }
                $html .= '<div class="wrap">';
                    if($content_type == 'text') {
                        if($text) {
                            $html .= '<div class="text">'.wp_kses($text, 'post').'</div>';
                        }
                        if(!empty($link)) {
                            if(empty($link['target'])) {
                                $link['target'] = '_self';
                            }
                            $html .= '<a href="'.esc_url($link['url']).'" target="'.esc_attr($link['target']).'" class="link">'.wp_kses($link['title'], 'post').'</a>';
                        }
                    } else if(!empty($working_time)) {
                        $working_time = preg_split('/\r\n|[\r\n]/', $working_time);
                        $working_time_html = '';
                        foreach ($working_time as $working_time_item) {
                            $working_time_item = str_replace(array('{', '}'), array('<span>', '</span>'), $working_time_item);
                            $working_time_html .= '<div class="o-row">'.$working_time_item.'</div>';
                        }
                        $html .= '<div class="time">'.wp_kses($working_time_html, 'post').'</div>';
                    }
                    if($style == 'style2') {
                        $html .= '<i class="s-icon '.esc_attr($$icon).'"></i>';
                    }
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        

         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Icon_Box();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Icon_Box extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Icon_Box_Item extends WPBakeryShortCode {
    }
}
