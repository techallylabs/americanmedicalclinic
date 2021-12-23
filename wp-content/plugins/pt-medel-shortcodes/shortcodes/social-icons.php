<?php

// Element Description: PT Social Icons

class PT_Social_Icons extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_social_icons_mapping' ) );
        add_shortcode( 'pt_social_icons', array( $this, 'pt_social_icons_html' ) );
    }
     
    // Element Mapping
    public function pt_social_icons_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Social Icons", "medel"),
            "base" => "pt_social_icons",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-social-icons",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "switch",
                    "heading"     => esc_html__( "Show label", "medel" ),
                    "param_name"  => "show_label",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "on"    => "On",
                            "off"   => "Off",
                        ),
                    ),
                    "default_set" => true,
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Align", "medel"),
                    "param_name" => "align",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__("Left", "medel") => "tal", 
                        esc_html__("Center", "medel") => "tac", 
                        esc_html__("Right", "medel") => "tar", 
                    ),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Social icon 1", "medel" ),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name"  => "social_icon_1",
                    "value"      => array(
                        esc_html__('---', 'medel') => "",
                        esc_html__('App.net', 'medel') => "fa fa-adn,App.net",
                        esc_html__('Bitbucket', 'medel') => "fa fa-bitbucket,Bitbucket",
                        esc_html__('Dropbox', 'medel') => "fa fa-dropbox,Dropbox",
                        esc_html__('Facebook', 'medel') => "fa fa-facebook,Facebook",
                        esc_html__('Flickr', 'medel') => "fa fa-flickr,Flickr",
                        esc_html__('Foursquare', 'medel') => "fa fa-foursquare,Foursquare",
                        esc_html__('GitHub', 'medel') => "fa fa-github,GitHub",
                        esc_html__('Google', 'medel') => "fa fa-google,Google",
                        esc_html__('Instagram', 'medel') => "fa fa-instagram,Instagram",
                        esc_html__('LinkedIn', 'medel') => "fa fa-linkedin,LinkedIn",
                        esc_html__('Windows', 'medel') => "fa fa-windows,Windows",
                        esc_html__('Odnoklassniki', 'medel') => "fa fa-odnoklassniki,Odnoklassniki",
                        esc_html__('OpenID', 'medel') => "fa fa-openid,OpenID",
                        esc_html__('Pinterest', 'medel') => "fa fa-pinterest,Pinterest",
                        esc_html__('Reddit', 'medel') => "fa fa-reddit,Reddit",
                        esc_html__('SoundCloud', 'medel') => "fa fa-soundcloud,SoundCloud",
                        esc_html__('Tumblr', 'medel') => "fa fa-tumblr,Tumblr",
                        esc_html__('Twitter', 'medel') => "fa fa-twitter,Twitter",
                        esc_html__('Vimeo', 'medel') => "fa fa-vimeo-square,Vimeo",
                        esc_html__('VK', 'medel') => "fa fa-vk,VK",
                        esc_html__('Yahoo', 'medel') => "fa fa-yahoo,Yahoo",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social link 1", "medel"),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name" => "social_link_1",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Social icon 2", "medel" ),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name"  => "social_icon_2",
                    "value"      => array(
                        esc_html__('---', 'medel') => "",
                        esc_html__('App.net', 'medel') => "fa fa-adn,App.net",
                        esc_html__('Bitbucket', 'medel') => "fa fa-bitbucket,Bitbucket",
                        esc_html__('Dropbox', 'medel') => "fa fa-dropbox,Dropbox",
                        esc_html__('Facebook', 'medel') => "fa fa-facebook,Facebook",
                        esc_html__('Flickr', 'medel') => "fa fa-flickr,Flickr",
                        esc_html__('Foursquare', 'medel') => "fa fa-foursquare,Foursquare",
                        esc_html__('GitHub', 'medel') => "fa fa-github,GitHub",
                        esc_html__('Google', 'medel') => "fa fa-google,Google",
                        esc_html__('Instagram', 'medel') => "fa fa-instagram,Instagram",
                        esc_html__('LinkedIn', 'medel') => "fa fa-linkedin,LinkedIn",
                        esc_html__('Windows', 'medel') => "fa fa-windows,Windows",
                        esc_html__('Odnoklassniki', 'medel') => "fa fa-odnoklassniki,Odnoklassniki",
                        esc_html__('OpenID', 'medel') => "fa fa-openid,OpenID",
                        esc_html__('Pinterest', 'medel') => "fa fa-pinterest,Pinterest",
                        esc_html__('Reddit', 'medel') => "fa fa-reddit,Reddit",
                        esc_html__('SoundCloud', 'medel') => "fa fa-soundcloud,SoundCloud",
                        esc_html__('Tumblr', 'medel') => "fa fa-tumblr,Tumblr",
                        esc_html__('Twitter', 'medel') => "fa fa-twitter,Twitter",
                        esc_html__('Vimeo', 'medel') => "fa fa-vimeo-square,Vimeo",
                        esc_html__('VK', 'medel') => "fa fa-vk,VK",
                        esc_html__('Yahoo', 'medel') => "fa fa-yahoo,Yahoo",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social link 2", "medel"),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name" => "social_link_2",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Social icon 3", "medel" ),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name"  => "social_icon_3",
                    "value"      => array(
                        esc_html__('---', 'medel') => "",
                        esc_html__('App.net', 'medel') => "fa fa-adn,App.net",
                        esc_html__('Bitbucket', 'medel') => "fa fa-bitbucket,Bitbucket",
                        esc_html__('Dropbox', 'medel') => "fa fa-dropbox,Dropbox",
                        esc_html__('Facebook', 'medel') => "fa fa-facebook,Facebook",
                        esc_html__('Flickr', 'medel') => "fa fa-flickr,Flickr",
                        esc_html__('Foursquare', 'medel') => "fa fa-foursquare,Foursquare",
                        esc_html__('GitHub', 'medel') => "fa fa-github,GitHub",
                        esc_html__('Google', 'medel') => "fa fa-google,Google",
                        esc_html__('Instagram', 'medel') => "fa fa-instagram,Instagram",
                        esc_html__('LinkedIn', 'medel') => "fa fa-linkedin,LinkedIn",
                        esc_html__('Windows', 'medel') => "fa fa-windows,Windows",
                        esc_html__('Odnoklassniki', 'medel') => "fa fa-odnoklassniki,Odnoklassniki",
                        esc_html__('OpenID', 'medel') => "fa fa-openid,OpenID",
                        esc_html__('Pinterest', 'medel') => "fa fa-pinterest,Pinterest",
                        esc_html__('Reddit', 'medel') => "fa fa-reddit,Reddit",
                        esc_html__('SoundCloud', 'medel') => "fa fa-soundcloud,SoundCloud",
                        esc_html__('Tumblr', 'medel') => "fa fa-tumblr,Tumblr",
                        esc_html__('Twitter', 'medel') => "fa fa-twitter,Twitter",
                        esc_html__('Vimeo', 'medel') => "fa fa-vimeo-square,Vimeo",
                        esc_html__('VK', 'medel') => "fa fa-vk,VK",
                        esc_html__('Yahoo', 'medel') => "fa fa-yahoo,Yahoo",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social link 3", "medel"),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name" => "social_link_3",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Social icon 4", "medel" ),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name"  => "social_icon_4",
                    "value"      => array(
                        esc_html__('---', 'medel') => "",
                        esc_html__('App.net', 'medel') => "fa fa-adn,App.net",
                        esc_html__('Bitbucket', 'medel') => "fa fa-bitbucket,Bitbucket",
                        esc_html__('Dropbox', 'medel') => "fa fa-dropbox,Dropbox",
                        esc_html__('Facebook', 'medel') => "fa fa-facebook,Facebook",
                        esc_html__('Flickr', 'medel') => "fa fa-flickr,Flickr",
                        esc_html__('Foursquare', 'medel') => "fa fa-foursquare,Foursquare",
                        esc_html__('GitHub', 'medel') => "fa fa-github,GitHub",
                        esc_html__('Google', 'medel') => "fa fa-google,Google",
                        esc_html__('Instagram', 'medel') => "fa fa-instagram,Instagram",
                        esc_html__('LinkedIn', 'medel') => "fa fa-linkedin,LinkedIn",
                        esc_html__('Windows', 'medel') => "fa fa-windows,Windows",
                        esc_html__('Odnoklassniki', 'medel') => "fa fa-odnoklassniki,Odnoklassniki",
                        esc_html__('OpenID', 'medel') => "fa fa-openid,OpenID",
                        esc_html__('Pinterest', 'medel') => "fa fa-pinterest,Pinterest",
                        esc_html__('Reddit', 'medel') => "fa fa-reddit,Reddit",
                        esc_html__('SoundCloud', 'medel') => "fa fa-soundcloud,SoundCloud",
                        esc_html__('Tumblr', 'medel') => "fa fa-tumblr,Tumblr",
                        esc_html__('Twitter', 'medel') => "fa fa-twitter,Twitter",
                        esc_html__('Vimeo', 'medel') => "fa fa-vimeo-square,Vimeo",
                        esc_html__('VK', 'medel') => "fa fa-vk,VK",
                        esc_html__('Yahoo', 'medel') => "fa fa-yahoo,Yahoo",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social link 4", "medel"),
                    "edit_field_class" => "vc_col-xs-6",
                    "param_name" => "social_link_4",
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Social icon 5", "medel" ),
                    "param_name"  => "social_icon_5",
                    "edit_field_class" => "vc_col-xs-6",
                    "value"      => array(
                        esc_html__('---', 'medel') => "",
                        esc_html__('App.net', 'medel') => "fa fa-adn,App.net",
                        esc_html__('Bitbucket', 'medel') => "fa fa-bitbucket,Bitbucket",
                        esc_html__('Dropbox', 'medel') => "fa fa-dropbox,Dropbox",
                        esc_html__('Facebook', 'medel') => "fa fa-facebook,Facebook",
                        esc_html__('Flickr', 'medel') => "fa fa-flickr,Flickr",
                        esc_html__('Foursquare', 'medel') => "fa fa-foursquare,Foursquare",
                        esc_html__('GitHub', 'medel') => "fa fa-github,GitHub",
                        esc_html__('Google', 'medel') => "fa fa-google,Google",
                        esc_html__('Instagram', 'medel') => "fa fa-instagram,Instagram",
                        esc_html__('LinkedIn', 'medel') => "fa fa-linkedin,LinkedIn",
                        esc_html__('Windows', 'medel') => "fa fa-windows,Windows",
                        esc_html__('Odnoklassniki', 'medel') => "fa fa-odnoklassniki,Odnoklassniki",
                        esc_html__('OpenID', 'medel') => "fa fa-openid,OpenID",
                        esc_html__('Pinterest', 'medel') => "fa fa-pinterest,Pinterest",
                        esc_html__('Reddit', 'medel') => "fa fa-reddit,Reddit",
                        esc_html__('SoundCloud', 'medel') => "fa fa-soundcloud,SoundCloud",
                        esc_html__('Tumblr', 'medel') => "fa fa-tumblr,Tumblr",
                        esc_html__('Twitter', 'medel') => "fa fa-twitter,Twitter",
                        esc_html__('Vimeo', 'medel') => "fa fa-vimeo-square,Vimeo",
                        esc_html__('VK', 'medel') => "fa fa-vk,VK",
                        esc_html__('Yahoo', 'medel') => "fa fa-yahoo,Yahoo",
                    ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Social link 5", "medel"),
                    "param_name" => "social_link_5",
                    "edit_field_class" => "vc_col-xs-6",
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
    public function pt_social_icons_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'show_label'    => 'on',
                    'align'         => 'tal',
                    'social_icon_1' => '',
                    'social_link_1' => '',
                    'social_icon_2' => '',
                    'social_link_2' => '',
                    'social_icon_3' => '',
                    'social_link_3' => '',
                    'social_icon_4' => '',
                    'social_link_4' => '',
                    'social_icon_5' => '',
                    'social_link_5' => '',
                    'animation'     => '',
                ), 
                $atts
            )
        );

        $html = '';

        $animation = $this->getCSSAnimation($animation);

        if((!empty($social_icon_1) && !empty($social_link_1)) || (!empty($social_icon_2) && !empty($social_link_2)) || (!empty($social_icon_3) && !empty($social_link_3)) || (!empty($social_icon_4) && !empty($social_link_4)) || (!empty($social_icon_5) && !empty($social_link_5))) {
            $html = '<div class="social-buttons '.esc_attr($animation.' '.$align).' label-'.esc_attr($show_label).'">';

                if(!empty($social_icon_1) && !empty($social_link_1)) {
                    $array = explode(',', $social_icon_1);
                    $html .= '<a href="'.esc_url($social_link_1).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_2) && !empty($social_link_2)) {
                    $array = explode(',', $social_icon_2);
                    $html .= '<a href="'.esc_url($social_link_2).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_3) && !empty($social_link_3)) {
                    $array = explode(',', $social_icon_3);
                    $html .= '<a href="'.esc_url($social_link_3).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_4) && !empty($social_link_4)) {
                    $array = explode(',', $social_icon_4);
                    $html .= '<a href="'.esc_url($social_link_4).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_5) && !empty($social_link_5)) {
                    $array = explode(',', $social_icon_5);
                    $html .= '<a href="'.esc_url($social_link_5).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }

            $html .= '</div>';
        }
        

        return $html;
         
    }

    
     
} // End Element Class
 
 
// Element Class Init
new PT_Social_Icons();