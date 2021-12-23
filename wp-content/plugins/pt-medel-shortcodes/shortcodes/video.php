<?php

// Element Description: PT Video

class PT_Video extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_video_mapping' ) );
        add_shortcode( 'pt_video', array( $this, 'pt_video_html' ) );
    }
     
    // Element Mapping
    public function pt_video_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Video", "medel"),
            "base" => "pt_video",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-video",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Video url", "medel" ),
                    "param_name"  => "video_url",
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Video Cover Image", "medel"),
                    "param_name" => "video_cover_image",
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Heading", "medel" ),
                    "param_name"  => "heading",
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Font size", "medel" ),
                    "param_name"  => "font_size",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Content color", "medel" ),
                    "param_name"  => "content_color",
                    "value"      => array(
                        esc_html__( "White", "medel" ) => "white",
                        esc_html__( "Black", "medel" ) => "black",
                        esc_html__( "Custom", "medel" ) => "custom",
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Text color", "medel"),
                    "param_name" => "content_color_hex",
                    "dependency" => Array("element" => "content_color", "value" => "custom" ),
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Width", "medel" ),
                    "param_name"  => "width",
                ),
                array(
                    "type"        => "textfield",
                    "heading"     => esc_html__( "Height", "medel" ),
                    "param_name"  => "height",
                ),
                array(
                    "type" => "animation_style",
                    "heading" => esc_html__( "Animation In", "medel" ),
                    "param_name" => "animation",
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_video_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'video_url' => '',
                    'heading' => '',
                    'font_size' => '',
                    'video_cover_image' => 'white',
                    'content_color' => '',
                    'content_color_hex' => '',
                    'animation' => '',
                    'width' => '',
                    'height' => '',
                ), 
                $atts
            )
        );

        $class = $id = uniqid('video-block-');

        $custom_css = $style_attr = '';

        if(!empty($video_cover_image)) {
            $style_attr = 'background-image: url('.esc_url(wp_get_attachment_image_src($video_cover_image, 'full')[0]).');';
        }

        if(!empty($width)) {
            $style_attr .= 'width: '.$width.'px;';
        }

        if(!empty($height)) {
            $style_attr .= 'height: '.$height.'px;';
            $class .= ' fix-height';
        }

        if(isset($content_color) && $content_color != 'custom') {
            $class .= ' '.$content_color;
        }

        if(isset($content_color) && $content_color == 'custom') {
            $custom_css .= '.'.$id.' {
                color: '.$content_color_hex.';
            }';
        }

        if(isset($font_size) && !empty($font_size)) {
            $custom_css .= '.'.$id.' .h {
                font-size: '.$font_size.';
            }';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        $html = '';
        $animation = $this->getCSSAnimation($animation);

        if($video_url) {
            $html .= '<div class="video-block '.esc_attr($class).' popup-gallery '.esc_attr($animation).'">';
                $html .= '<div class="popup-item">';
                    $html .= '<a href="#" data-type="video" style="'.esc_attr($style_attr).'" data-size="960x640" data-video=\'<div class="wrapper"><div class="video-wrapper"><iframe class="pswp__video" width="960" height="640" src="'.esc_url(VideoUrlParser::get_url_embed($video_url)).'" frameborder="0" allowfullscreen></iframe></div></div>\'><div>';
                        if(!empty($heading)) {
                            $html .= '<div class="h">'.wp_kses($heading ,'post').'</div>';
                        }
                    $html .= '<i class="social-icons-youtube-symbol"></i></div></a>';
                $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
         
    }

    
     
} // End Element Class
 
 
// Element Class Init
new PT_Video();