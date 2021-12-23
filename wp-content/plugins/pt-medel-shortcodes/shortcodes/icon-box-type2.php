<?php

// Element Description: PT Icon Box Type 2

class PT_Icon_Box_Type2 extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_icon_box_type2_mapping' ) );
        add_shortcode( 'pt_icon_box_type2', array( $this, 'pt_icon_box_type2_html' ) );
        add_shortcode( 'pt_icon_box_type2_item', array( $this, 'pt_icon_box_type2_item_html' ) );
    }
     
    // Element Mapping
    public function pt_icon_box_type2_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Icon Box Type 2", "medel"),
            "base" => "pt_icon_box_type2",
            "as_parent" => array('only' => 'pt_icon_box_type2_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-icon-box-type2",
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
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Icons Border color", "medel"),
                    "param_name" => "icon_border_color",
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Border color", "medel"),
                    "param_name" => "border_color",
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Icon Box Type 2 item", "medel"),
            "base" => "pt_icon_box_type2_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-icon-box",
            "as_child" => array('only' => 'pt_icon_box_type2'),
            "params" => array(
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
                ),
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_icon_box_type2_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'style' => 'style1',
                    'desktop_cols' => '4',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                    'icon_border_color' => '',
                    'border_color' => '',
                ), 
                $atts
            )
        );

        $html = $custom_css = '';

        $classes = $wrap_id = uniqid('icon-box-items-type2-');

        // Fill $html var with data
        if(!empty($content)) {
            $content = str_replace('[pt_icon_box_type2_item ', '[pt_icon_box_type2_item style="'.$style.'" desktop_cols="'.$desktop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }

        if(!empty($wrap_text_color)) {
            $custom_css .= '.'.$wrap_id.' .icon-box-item-wrap-type2 { border-color:'.$wrap_text_color.'}';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        $html = '<div class="icon-box-items-type2 row '.esc_attr($style).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_icon_box_type2_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'type' => 'fontawesome',
                    'style' => 'style1',
                    'icon_fontawesome' => 'fa fa-adjust',
                    'icon_openiconic' => 'vc-oi vc-oi-dial',
                    'icon_typicons' => 'typcn typcn-adjust-brightness',
                    'icon_entypo' => 'entypo-icon entypo-icon-note',
                    'icon_linecons' => 'vc_li vc_li-heart',
                    'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
                    'icon_material' => 'vc-material vc-material-cake',
                    'desktop_cols' => '3',
					'tablet_cols' => '2',
					'mobile_cols' => '1',
                    'heading' => '',
                    'text' => '',
                ), 
                $atts
            )
        );
        
        // Fill $html var with data

        $html = "";

        $item_id = uniqid('icon-box-');

        $icon = 'icon_'.$type;

        $html .= '<div class="icon-box-item-wrap-type2 col-xs-'.esc_attr(12/$mobile_cols).' col-sm-'.esc_attr(12/$tablet_cols).' col-md-'.esc_attr(12/$desktop_cols).'">';
            $html .= '<div class="icon-box-item-type2 '.esc_attr($item_id).'">';
            	if($style == 'style2') {
            		$html .= '<div class="top">';
		                if(!empty($$icon)) {
		                    $html .= '<div class="icon"><i class="'.esc_attr($$icon).'"></i></div>';
		                }
		                if($heading) {
		                    $html .= '<h6 class="h"><span class="cell">'.wp_kses($heading, 'post').'</span></h6>';
		                }
		            $html .= '</div>';
	            } else {
	                if(!empty($$icon)) {
	                    $html .= '<div class="icon"><i class="'.esc_attr($$icon).'"></i></div>';
	                }
	                if($heading) {
	                    $html .= '<h6 class="h">'.wp_kses($heading, 'post').'</h6>';
	                }
	            }
                if($text) {
                    $html .= '<div class="text">'.wp_kses($text, 'post').'</div>';
                }
            $html .= '</div>';
        $html .= '</div>';
        

         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Icon_Box_Type2();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Icon_Box_Type2 extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Icon_Box_Type2_Item extends WPBakeryShortCode {
    }
}
