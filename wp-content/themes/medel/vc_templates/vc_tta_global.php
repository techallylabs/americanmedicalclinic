<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $el_class
 * @var $el_id
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
$el_class = $css = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$id = 'block-'.uniqid();

$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

if(isset($active_gradient) && !empty($active_gradient)) {
	$active_gradient = strip_tags(explode('||', $active_gradient)[1]);

	$custom_css = '#'.$id.' .vc_tta-panel .vc_tta-panel-heading:before, #'.$id.' .vc_tta-panel .vc_tta-panel-body:before { '.$active_gradient.'}';

	if(isset($active_color) && !empty($active_color)) {
		$custom_css .= '#'.$id.' .vc_tta-panel.vc_active .vc_tta-panel-heading, #'.$id.' .vc_tta-panel.vc_active .vc_tta-panel-body { color: '.$active_color.' !important; }';
	}

    wp_enqueue_style('medel-custom-style', get_template_directory_uri() . '/css/custom_script.css');
    wp_add_inline_style( 'medel-custom-style', $custom_css );
}

$output = '<div ' . $this->getWrapperAttributes() . ' id="'.esc_attr($id).'">';
$output .= $this->getTemplateVariable( 'title' );
$output .= '<div class="' . esc_attr( $css_class ) . '">';
$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= '<div class="vc_tta-panels-container">';
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= '</div>';
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';

echo  $output;
