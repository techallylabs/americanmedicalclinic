<?php

// Element Description: PT Team

class PT_Team extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_team_mapping' ) );
        add_shortcode( 'pt_team', array( $this, 'pt_team_html' ) );
        add_shortcode( 'pt_team_item', array( $this, 'pt_team_item_html' ) );
    }
     
    // Element Mapping
    public function pt_team_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Team", "medel"),
            "base" => "pt_team",
            "as_parent" => array('only' => 'pt_team_item'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-price-list-2",
            "is_container" => true,
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "el_id",
                    "heading"     => esc_html__( "Uniq ID", "medel" ),
                    "param_name"  => "uniq_id",
                    "value"       => uniqid(),
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => esc_html__( "Style", "medel" ),
                    "param_name"  => "style",
                    "value"      => array(
                        esc_html__( "Style 1", "medel" ) => "style1",
                        esc_html__( "Style 2", "medel" ) => "style2",
                    ),
                    "std" => 'style1',
                    "group"       => esc_html__("General", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Carousel", "medel" ),
                    "param_name" => "carousel",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "default_set" => true,
                    "group"      => esc_html__("General", "medel"),
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
                        esc_html__( "Col 5", "medel" ) => "5",
                    ),
                    "std" => '3',
                    "group"       => esc_html__("Cols", "medel"),
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
                        esc_html__( "Col 5", "medel" ) => "5",
                    ),
                    "std" => '2',
                    "group"       => esc_html__("Cols", "medel"),
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
                        esc_html__( "Col 5", "medel" ) => "5",
                    ),
                    "std" => '1',
                    "group"       => esc_html__("Cols", "medel"),
                ),
                array(
                    "type"        => "number",
                    "class"       => "",
                    "heading"     => esc_html__( "Transition speed", "medel" ),
                    "param_name"  => "speed",
                    "value"       => "300",
                    "min"         => "100",
                    "max"         => "10000",
                    "step"        => "100",
                    "suffix"      => "ms",
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Autoplay Slides", "medel" ),
                    "param_name"  => "autoplay",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "label" => esc_html__( "Enable Autoplay", "medel" ),
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "dependency"  => "",
                    "default_set" => true,
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "number",
                    "heading"    => esc_html__( "Autoplay Speed", "medel" ),
                    "param_name" => "autoplay_speed",
                    "value"      => "5000",
                    "min"        => "100",
                    "max"        => "10000",
                    "step"       => "10",
                    "suffix"     => "ms",
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"        => "switch",
                    "class"       => "",
                    "heading"     => esc_html__( "Navigation Arrows", "medel" ),
                    "param_name"  => "arrows",
                    "value"       => "on",
                    "options"     => array(
                        "on" => array(
                            "label" => esc_html__( "Display next / previous navigation arrows", "medel" ),
                            "on"    => "On",
                            "off"   => "Off",
                        ),
                    ),
                    "default_set" => true,
                    "dependency" => Array( "element" => "carousel", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Color", "medel" ),
                    "param_name" => "arrow_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Arrow Background Color", "medel" ),
                    "param_name" => "arrow_background_color",
                    "dependency" => Array( "element" => "arrows", "value" => array( "on" ) ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
                array(
                    "type"       => "switch",
                    "heading"    => esc_html__( "Pause on hover", "medel" ),
                    "param_name" => "pauseohover",
                    "value"      => "on",
                    "options"    => array(
                        "on" => array(
                            "label" => esc_html__( "Pause the slider on hover", "medel" ),
                            "on"    => "Yes",
                            "off"   => "No",
                        ),
                    ),
                    "dependency" => Array("element" => "autoplay", "value" => "on" ),
                    "group"       => esc_html__("Carousel settings", "medel"),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
        vc_map( array(
            "name" => esc_html__("Team item", "medel"),
            "base" => "pt_team_item",
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-price-list-2",
            "as_child" => array('only' => 'pt_team'),
            "params" => array(
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Image", "medel"),
                    "param_name" => "image",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Name", "medel"),
                    "param_name" => "name",
                    "admin_label" => true,
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Post", "medel"),
                    "param_name" => "post",
                    "admin_label" => true,
                ),
                array(
                    "type" => "vc_link",
                    "heading" => esc_html__("Profile link", "medel"),
                    "param_name" => "profile_link",
                    "admin_label" => true,
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Top Background Color", "medel" ),
                    "param_name" => "background_color",
                ),
                array(
                    "type"       => "colorpicker",
                    "heading"    => esc_html__( "Top Text Color", "medel" ),
                    "param_name" => "color",
                ),
                array(
                    "type" => "textarea",
                    "heading" => esc_html__("Working time", "medel"),
                    "param_name" => "work_time",
                    "description" => esc_html__("New per row. Example: Mon - Fri {8:00 - 21:00}", "medel"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Phone", "medel"),
                    "param_name" => "phone",
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
            )
        ) );
    }
     
     
    // Element HTML
    public function pt_team_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'uniq_id' => uniqid(),
                    'style' => 'style1',
                    'carousel' => 'on',
                    'speed' => '500',
                    'autoplay' => 'on',
                    'autoplay_speed' => '3000',
                    'arrows' => 'on',
                    'arrow_color' => '',
                    'pauseohover' => 'on',
                    'desktop_cols' => '3',
                    'tablet_cols' => '2',
                    'mobile_cols' => '1',
                ), 
                $atts
            )
        );

        $id = 'team-'.$uniq_id;

        $item_class = $id.' block-'.$style;

        $custom_css = "";

        if(isset($arrow_color) && !empty($arrow_color)) {
            $custom_css .= '.'.$id.' .owl-nav {
                color: '.$arrow_color.';
            }';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        if($carousel == "on") {
            if($autoplay == 'on') {
                $autoplay = 'true';
            } else {
                $autoplay = 'false';
            }
            if($arrows == 'on') {
                $arrows = 'true';
            } else {
                $arrows = 'false';
            }
            if($pauseohover == 'on') {
                $pauseohover = 'true';
            } else {
                $pauseohover = 'false';
            }

            wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
            wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery') );
            wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

            wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
                jQuery('.".esc_attr($id)."').each(function(){
                    var head_slider = jQuery(this);
                    if(jQuery(this).find('.item').length > 1){
                        head_slider.addClass('owl-carousel').owlCarousel({
                            loop:true,
                            items:1,
                            nav: ".esc_js($arrows).",
                            dots: false,
                            autoplay: ".esc_js($autoplay).",
                            autoplayTimeout: ".esc_js($autoplay_speed).",
                            autoplayHoverPause: ".esc_js($pauseohover).",
                            smartSpeed: ".esc_js($speed).",
                            navClass: ['owl-prev free-basic-ui-elements-left-arrow','owl-next free-basic-ui-elements-right-arrow'],
                            navText: false,
                            margin: 30,
                            responsive:{
                                0:{
                                    nav: false,
                                    items: 1,
                                },
                                768:{
                                    nav: ".esc_js($arrows).",
                                    items: ".esc_js($mobile_cols).",
                                },
                                980:{
                                    items: ".esc_js($tablet_cols).",
                                },
                                1200:{
                                    items: ".esc_js($desktop_cols).",
                                },
                            },
                        });
                    }
                });
            });");
        }


        if(!empty($content)) {
            $content = str_replace('[pt_team_item ', '[pt_team_item style="'.$style.'" carousel="'.$carousel.'" desktop_cols="'.$desktop_cols.'" tablet_cols="'.$tablet_cols.'" mobile_cols="'.$mobile_cols.'" ', $content);
        }
         
        // Fill $html var with data
        $html = '<div class="team-items row '.esc_attr($item_class).'">';
        $html .= do_shortcode($content);
        $html .= '</div>';
         
        return $html;
         
    }

    // Element HTML
    public function pt_team_item_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
					'image' => '',
                    'style' => 'style1',
                    'name' => '',
                    'post' => '',
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
                    'carousel' => 'on',
                    'desktop_cols' => '3',
                    'tablet_cols' => '2',
                    'mobile_cols' => '1',
                    'profile_link' => '',
                    'background_color' => '',
                    'color' => '',
                    'phone' => '',
                    'work_time' => '',
                ), 
                $atts
            )
        );
         
        // Fill $html var with data

        $link = $custom_css = $social_buttons_html = '';
        $item_class = $item_id = uniqid('team-item-');

        if((!empty($social_icon_1) && !empty($social_link_1)) || (!empty($social_icon_2) && !empty($social_link_2)) || (!empty($social_icon_3) && !empty($social_link_3)) || (!empty($social_icon_4) && !empty($social_link_4)) || (!empty($social_icon_5) && !empty($social_link_5))) {
            $social_buttons_html = '<div class="team-social-buttons"><div>';

                if(!empty($social_icon_1) && !empty($social_link_1)) {
                    $array = explode(',', $social_icon_1);
                    $social_buttons_html .= '<a href="'.esc_url($social_link_1).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_2) && !empty($social_link_2)) {
                    $array = explode(',', $social_icon_2);
                    $social_buttons_html .= '<a href="'.esc_url($social_link_2).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_3) && !empty($social_link_3)) {
                    $array = explode(',', $social_icon_3);
                    $social_buttons_html .= '<a href="'.esc_url($social_link_3).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_4) && !empty($social_link_4)) {
                    $array = explode(',', $social_icon_4);
                    $social_buttons_html .= '<a href="'.esc_url($social_link_4).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }
                if(!empty($social_icon_5) && !empty($social_link_5)) {
                    $array = explode(',', $social_icon_5);
                    $social_buttons_html .= '<a href="'.esc_url($social_link_5).'"><i class="'.esc_attr($array[0]).'"></i> <span>'.esc_html($array[1]).'</span></a>';
                }

            $social_buttons_html .= '</div></div>';
        }

        if($carousel != 'on') {
            $item_class .= ' col-xs-'.(12/$mobile_cols).' col-sm-'.(12/$tablet_cols).' col-md-'.(12/$desktop_cols);
        }

        if(isset(vc_build_link($profile_link)['url']) && !empty(vc_build_link($profile_link)['url'])) {
            $link = vc_build_link($profile_link);
        }

        if(!empty($background_color)) {
            $custom_css .= '.'.$item_id.'.team-item .top { background-color:'.$background_color.'}';
        }

        if(!empty($color)) {
            $custom_css .= '.'.$item_id.'.team-item .top { color:'.$color.'}';
        }

        wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
        wp_add_inline_style( 'medel-custom-style', $custom_css );

        if($style == 'style2') {
            $html = '<div class="team-item-style2 item '.esc_attr($item_class).'">';
                $html .= '<div class="wrap">';
                    if(!empty($image)) {
                        $html .= '<div class="image"><div style="background-image: url('.wp_get_attachment_image_src($image, 'full')[0].')"></div></div>';
                    }
                    if(!empty($name) || !empty($post)) {
                        $html .= '<div class="top"><div class="cell">';
                            if(!empty($name)) {
                                if(!empty($link)) {
                                    $html .= '<div class="name"><a href="'.esc_url($link['url']).'">'.wp_kses($name,'post').'</a></div>';
                                } else {
                                    $html .= '<div class="name">'.wp_kses($name,'post').'</div>';
                                }
                            }
                            if(!empty($post)) {
                                $html .= '<div class="post">'.wp_kses($post,'post').'</div>';
                            }
                        $html .= '</div></div>';
                    }
                    $html .= '<div class="bottom">';
                        if(!empty($phone)) {
                            $html .= '<div class="phone">'.strip_tags($phone).'</div>';
                        }
                        if(!empty($social_buttons_html)) {
                            $html .= $social_buttons_html;
                        }
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';
        } else {
            $html = '<div class="team-item item '.esc_attr($item_class).'">';
                $html .= '<div class="wrap">';
                    if(!empty($image)) {
                        $html .= '<div class="image"><div style="background-image: url('.wp_get_attachment_image_src($image, 'full')[0].')">'.wp_kses($social_buttons_html,'post').'</div></div>';
                    }
                    if(!empty($name) || !empty($post)) {
                        $html .= '<div class="top"><div class="cell">';
                            if(!empty($name)) {
                                $html .= '<div class="name">'.wp_kses($name,'post').'</div>';
                            }
                            if(!empty($post)) {
                                $html .= '<div class="post">'.wp_kses($post,'post').'</div>';
                            }
                        $html .= '</div></div>';
                    }
                    if(!empty($work_time)) {
                        $work_time = preg_split('/\r\n|[\r\n]/', $work_time);
                        $working_time_html = '';
                        foreach ($work_time as $working_time_item) {
                            $working_time_item = str_replace(array('{', '}'), array('<span>', '</span>'), $working_time_item);
                            $working_time_html .= '<div class="o-row">'.$working_time_item.'</div>';
                        }
                        $html .= '<div class="time">'.wp_kses($working_time_html, 'post').'</div>';
                    }
                    if(!empty($link)) {
                        if(empty($link['title'])) {
                            $link['title'] = esc_html__('Read profile', 'medel');
                        }
                        $html .= '<a href="'.esc_url($link['url']).'">'.strip_tags($link['title']).'</a>';
                    }
                $html .= '</div>';
            $html .= '</div>';
        }
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Team();    
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_PT_Team extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_PT_Team_Item extends WPBakeryShortCode {
    }
}

