<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medel
 */

/*
Template Name: Coming soon page
*/

get_header(); 
$id = uniqid('countdown-');

if(get_field('date')) {
	$year = mysql2date('Y', get_field('date'));
	$month = mysql2date('m', get_field('date'))-1;
	$day = mysql2date('j', get_field('date'));
	$hour = mysql2date('H', get_field('date'));
	$minutes = mysql2date('i', get_field('date'));

	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.js' );
	wp_enqueue_script( 'medel-script', get_template_directory_uri() . '/js/script.js' );

	wp_add_inline_script('medel-script', "jQuery(document).ready(function(jQuery) {
	  	/*------------------------------------------------------------------
		[ Coming soon countdown ]
		*/

		var ts = new Date(".esc_js($year).", ".esc_js($month).", ".esc_js($day).", ".esc_js($hour).", ".esc_js($minutes).");

		if(jQuery('.".esc_js($id)."').length > 0){
			jQuery('.".esc_js($id)."').countdown({
				timestamp	: ts,
				callback	: function(days, hours, minutes, seconds){
				}
			});
		}
	});");
}
?>

<section class="main-row">
	<div class="container-fluid no-padding">
		<!-- Banner -->
		<div class="banner-area">
			<div class="banner banner-coming-soon content-align-right">
				<div class="item top" style="<?php echo esc_attr(medel_styles()['coming_soon_bg']); ?>">
					<div class="container">
						<div class="cell tac">
							<?php if(get_field('date')) { ?>
								<div id="countdown" class="<?php echo esc_attr($id) ?>"></div>
							<?php } if(!empty(medel_styles()['coming_soon_heading'])) { ?>
								<div class="heading-decor tac">
									<h1 class="h"><?php echo wp_kses_post(medel_styles()['coming_soon_heading']) ?></h1>
								</div>
							<?php } if(medel_styles()['coming_soon_subscribe_code']) { ?>
								<?php if(!empty(medel_styles()['coming_soon_subscribe_desc'])) { ?>
									<div class="text"><?php echo wp_kses_post(medel_styles()['coming_soon_subscribe_desc']) ?></div>
								<?php } ?>
								<div class="form"><?php echo do_shortcode(medel_styles()['coming_soon_subscribe_code']) ?></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Banner -->
	</div>
</section>
<?php get_footer('empty');
