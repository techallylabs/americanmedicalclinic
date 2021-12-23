<?php

// Element Description: PT Benefits

class PT_Benefits extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_benefits_mapping' ) );
        add_shortcode( 'pt_benefits', array( $this, 'pt_benefits_html' ) );
    }
     
    // Element Mapping
    public function pt_benefits_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Benefits", "medel"),
            "base" => "pt_benefits",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-benefits",
            "category" => esc_html__("By PT", "medel"),
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
                    "type"        => "number",
                    "heading"     => esc_html__( "Number", "medel" ),
                    "param_name"  => "number",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "textarea",
                    "heading"     => esc_html__( "Heading", "medel" ),
                    "param_name"  => "heading",
                    "admin_label" => true,
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_benefits_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'type' => 'fontawesome',
                    'icon_fontawesome' => 'fa fa-adjust',
                    'icon_openiconic' => 'vc-oi vc-oi-dial',
                    'icon_typicons' => 'typcn typcn-adjust-brightness',
                    'icon_entypo' => 'entypo-icon entypo-icon-note',
                    'icon_linecons' => 'vc_li vc_li-heart',
                    'icon_monosocial' => 'vc-mono vc-mono-fivehundredpx',
                    'icon_material' => 'vc-material vc-material-cake',
                    'number' => '',
                    'heading' => '',
                ), 
                $atts
            )
        );

        $html = "";

        $icon = 'icon_'.$type;

        if(!empty($number) || !empty($heading)) {
            $html .= '<div class="benefit-item">';
                if(isset($$icon) && !empty($$icon)) {
                    $html .= '<div class="icon"><i class="'.esc_attr($$icon).'"></i></div>';
                }
                $html .= '<div class="text">';
                    $html .= '<div class="cell">';
                        $html .= '<div class="num">'.strip_tags($number).'</div>';
                        $html .= '<div class="h">'.wp_kses($heading,'post').'</div>';
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Benefits();