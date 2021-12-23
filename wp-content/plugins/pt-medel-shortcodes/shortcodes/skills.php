<?php

// Element Description: PT Skills

class PT_Skills_Items extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_skills_mapping' ) );
        add_shortcode( 'pt_skills', array( $this, 'pt_skills_html' ) );
    }
     
    // Element Mapping
    public function pt_skills_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Skills", "medel"),
            "base" => "pt_skills",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-skills",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Style", "medel" ),
                    "param_name"  => "style",
                    "admin_label" => true,
                    "value"      => array(
                        esc_html__( "Style 1", "medel" ) => "style_1",
                        esc_html__( "Style 2", "medel" ) => "style_2",
                    ),
                ),
                array(
                    "type"        => "slider",
                    "heading"     => esc_html__( "Skill level", "medel" ),
                    "param_name"  => "skill_level",
                    "min"         => "0",
                    "max"         => "100",
                    "step"        => "1",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "vc_link",
                    "heading"     => esc_html__( "Link", "medel" ),
                    "param_name"  => "link",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "textarea",
                    "heading"     => esc_html__( "Heading", "medel" ),
                    "param_name"  => "heading",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "textarea",
                    "heading"     => esc_html__( "Description", "medel" ),
                    "param_name"  => "desc",
                ),
                array(
                    "type" => "animation_style",
                    "heading" => __( "Animation In", "medel" ),
                    "param_name" => "animation",
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_skills_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'style' => 'style1',
                    'skill_level' => '',
                    'link' => '',
                    'heading' => '',
                    'desc' => '',
                    'animation' => '',
                ), 
                $atts
            )
        );

        $html = $block_css = '';

        if(isset(vc_build_link($link)['url']) && !empty(vc_build_link($link)['url'])) {
            $link = vc_build_link($link);
        }

        $block_css = 'block-'.$style;

        $animation = $this->getCSSAnimation($animation);
        if($skill_level) {
            $html = '<div class="skill-item '.esc_attr($block_css.' '.$animation).'">';
                if($style == 'style1') {
                    $html .= '<figure class="chart" data-percent="'.esc_attr($skill_level).'">';
                        $html .= '<figcaption>'.esc_attr($skill_level).'%</figcaption>';
                        $html .= '<svg width="158" height="158">';
                            $html .= '<circle class="line" cx="111" cy="79" r="75" transform="rotate(-90, 95, 95)"/>';
                            $html .= '<circle class="outer" cx="111" cy="79" r="75" transform="rotate(-90, 95, 95)"/>';
                        $html .= '</svg>';
                    $html .= '</figure>';
                    $html .= '<div class="text"><div class="cell">';
                        if($heading) {
                            if(!empty($link) && !empty($link['url'])) {
                                if(empty($link['target'])) {
                                    $link['target'] = '_self';
                                }
                                $html .= '<h6><a href="'.esc_url($link['url']).'" target="'.esc_attr($link['target']).'"><span>'.wp_kses($heading, 'post').'</span> <i class="ui-super-basic-right-arrow"></i></a></h6>';
                            } else {
                                $html .= '<h6>'.wp_kses($heading, 'post').'</h6>';
                            }
                        }
                        if($desc) {
                            $html .= '<p>'.wp_kses($desc, 'post').'</p>';
                        }
                    $html .= '</div></div>';
                } else {
                    if($heading) {
                        if(!empty($link) && !empty($link['url'])) {
                            if(empty($link['target'])) {
                                $link['target'] = '_self';
                            }
                            $html .= '<h6><a href="'.esc_url($link['url']).'" target="'.esc_attr($link['target']).'"><span>'.wp_kses($heading, 'post').'</span></a></h6>';
                        } else {
                            $html .= '<h6>'.wp_kses($heading, 'post').'</h6>';
                        }
                    }
                    $html .= '<div class="rating-line" data-percent="'.esc_attr($skill_level).'">
                        <div class="line" style="width: '.esc_attr($skill_level).'%"></div>
                        <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        </div>
                        <span>'.esc_attr($skill_level).'%</span>
                    </div>';
                    if($desc) {
                        $html .= '<p>'.wp_kses($desc, 'post').'</p>';
                    }
                }
            $html .= '</div>';
        }

        return $html;
         
    }

    
     
} // End Element Class
 
 
// Element Class Init
new PT_Skills_Items();