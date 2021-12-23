<?php

// Element Description: PT Google map

class PT_Google_Maps extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'pt_google_map_mapping' ) );
        add_shortcode( 'pt_google_map', array( $this, 'pt_google_map_html' ) );
    }
     
    // Element Mapping
    public function pt_google_map_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( array(
            "name" => esc_html__("Google map", "medel"),
            "base" => "pt_google_map",
            "show_settings_on_create" => true,
            "icon" => "shortcode-icon-google-map",
            "category" => esc_html__("By PT", "medel"),
            "params" => array(
                array(
                    "type"        => "switch",
                    "heading"     => esc_html__( "Include Contact Form", "medel" ),
                    "param_name"  => "include_contact_form",
                    "value"       => "off",
                    "options"     => array(
                        "on" => array(
                            "on"    => esc_html__( "On", "medel" ),
                            "off"   => esc_html__( "Off", "medel" ),
                        ),
                    ),
                    "default_set" => false,
                    "group"       => esc_html__( "General", "medel" ),
                ),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Background image", "medel"),
                    "param_name" => "background_image",
                    "dependency" => Array( "element" => "include_contact_form", "value" => array( "on" ) ),
                    "group"      => esc_html__("Contact Form", "medel"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => esc_html__("Text color", "medel"),
                    "param_name" => "text_color",
                    "dependency" => Array( "element" => "include_contact_form", "value" => array( "on" ) ),
                    "group"      => esc_html__( "Contact Form", "medel" ),
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => esc_html__("Heading", "medel"),
                    "param_name" => "heading",
                    "group" => esc_html__('Contact Form', 'medel'),
                    "dependency" => Array( "element" => "include_contact_form", "value" => array( "on" ) ),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Shortcode", "medel"),
                    "param_name" => "shortcode",
                    "group" => esc_html__('Contact Form', 'medel'),
                    "dependency" => Array( "element" => "include_contact_form", "value" => array( "on" ) ),
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Width", "medel"),
                    "descroption" => esc_html__("in %", "medel"),
                    "param_name" => "width",
                    "admin_label" => true,
                    "value" => "100",
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Height", "medel"),
                    "descroption" => esc_html__("in px", "medel"),
                    "param_name" => "height",
                    "admin_label" => true,
                    "value" => "345",
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type" => "dropdown",
                    "class" => "",
                    "heading" => esc_html__("Map type", "medel"),
                    "param_name" => "map_type",
                    "admin_label" => true,
                    "value" => array(
                        esc_html__("Roadmap", "medel") => "ROADMAP", 
                        esc_html__("Satellite", "medel") => "SATELLITE", 
                        esc_html__("Hybrid", "medel") => "HYBRID", 
                        esc_html__("Terrain", "medel") => "TERRAIN"
                    ),
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Latitude", "medel"),
                    "param_name" => "lat",
                    "admin_label" => true,
                    "description" => '<a href="http://labs.mondeca.com/geo/anyplace.html" target="_blank">'.esc_html__('Here is a tool','medel').'</a> '.esc_html__('where you can find Latitude & Longitude of your location', 'medel'),
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => esc_html__("Longitude", "medel"),
                    "param_name" => "lng",
                    "admin_label" => true,
                    "description" => '<a href="http://labs.mondeca.com/geo/anyplace.html" target="_blank">'.esc_html__('Here is a tool','medel').'</a> '.esc_html__('where you can find Latitude & Longitude of your location', "medel"),
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Map Zoom", "medel"),
                    "param_name" => "zoom",
                    "value" => array(
                        esc_html__("16 - Default", "medel") => 16, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
                    ),
                    "group" => esc_html__('General', 'medel')
                ),
                array(
                    "type"        => "switch",
                    "heading"     => esc_html__( "Mouse wheel scroll", "medel" ),
                    "param_name"  => "scrollwheel",
                    "value"       => "off",
                    "options"     => array(
                        "on" => array(
                            "on"    => esc_html__( "On", "medel" ),
                            "off"   => esc_html__( "Off", "medel" ),
                        ),
                    ),
                    "default_set" => false,
                    "group"       => esc_html__( "General", "medel" ),
                ),
            ),
        ) );
    }
     
     
    // Element HTML
    public function pt_google_map_html( $atts, $content = null ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'include_contact_form' => 'off',
                    'background_image' => '',
                    'text_color' => '',
                    'heading' => '',
                    'shortcode' => '',
                    'width' => '100',
                    'height' => '345',
                    'map_type' => 'ROADMAP',
                    'lat' => '',
                    'lng' => '',
                    'zoom' => '16',
                    'scrollwheel' => 'off',
                ), 
                $atts
            )
        );

        $id = 'map-'.uniqid();

        $html = $style = "";

        if($scrollwheel == "on") {
            $scrollwheel = "true";
        } else {
            $scrollwheel = "false";
        }

        if(!empty($background_image) && isset(wp_get_attachment_image_src($background_image, 'full')[0])) {
            $style = 'background-image: url('.esc_url(wp_get_attachment_image_src($background_image, 'full')[0]).');';
        }

        if(!empty($text_color)) {
            $style .= 'color: '.$text_color.';';
        }

        if(!empty($lat) && !empty($lng)) {

            if(!empty(medel_styles()['google_maps_api_key'])) {
                if($include_contact_form == 'on') {
                    $html .= '<div class="map-area">';
                        $html .= '<div class="map" id="'.esc_attr($id).'" style="width: '.esc_attr($width).'%;"></div>';
                        if(!empty($shortcode)) {
                            $html .= '<div class="container">';
                                $html .= '<div class="map-form" style="'.esc_attr($style).'">';
                                    if(!empty($heading)) {
                                        $html .= '<div class="heading-decor"><h3>'.wp_kses($heading, 'post').'</h3></div>';
                                    }
                                    $html .= do_shortcode(str_replace(array('``', '`{`', '`}`'), array('"', '[', ']'), $shortcode));
                                $html .= '</div>';
                            $html .= '</div>';
                        }
                    $html .= '</div>';
                } else {
                    $html .= '<div class="map" id="'.esc_attr($id).'" style="width: '.esc_attr($width).'%; height: '.esc_attr($height).'px;"></div>';
                }
            } else {
                $html = esc_html__('No Api Keys,', 'medel').' <a href="'.admin_url('admin.php?page=Medel').'">'.esc_html__('Add key in Theme Options').'</a>';
            }

            wp_enqueue_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key='.medel_styles()['google_maps_api_key'].'&amp;sensor=false', array('jquery') );
            wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

            wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
                jQuery('#".esc_attr($id)."').each(function(){
                    function initialize() {
                        var myLatlng = new google.maps.LatLng(".$lat.",".$lng.");
                        var mapOptions = {
                            zoom: ".$zoom.",
                            center: myLatlng,
                            disableDefaultUI: true,
                            scrollwheel: ".$scrollwheel.",
                            mapTypeId: google.maps.MapTypeId.".$map_type.",
                        }
                        var map = new google.maps.Map(document.getElementById('".$id."'), mapOptions);

                        var myLatLng = new google.maps.LatLng(".$lat.",".$lng.");
                        var beachMarker = new google.maps.Marker({
                            position: myLatLng,
                            icon: '".get_template_directory_uri() . '/images/marker.png'."',
                            map: map
                        });
                        google.maps.event.addDomListener(window, 'resize', function() {
                            var center = map.getCenter();
                            google.maps.event.trigger(map, 'resize');
                            map.setCenter(center); 
                        });
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                });
            });");
        }

        

        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new PT_Google_Maps();