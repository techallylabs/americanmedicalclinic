<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Medel
 */

get_header(); ?>

	<section class="main-row">
		<div class="container-fluid no-padding">
			<!-- Banner -->
			<div class="banner-area">
				<div class="banner banner-404">
					<div class="item" style="<?php echo esc_attr(medel_styles()['404_bg']) ?>">
					<div class="container">
						<div class="cell middle">
							<?php if(!empty(medel_styles()['404_page_heading'])) { ?>
								<h1 class="b-404-heading"><?php echo wp_kses_post(medel_styles()['404_page_heading']) ?></h1>
							<?php } if(!empty(medel_styles()['404_page_desc'])) { ?>
								<div class="text uppercase"><?php echo wp_kses_post(medel_styles()['404_page_desc']) ?></div>
							<?php } ?>
							<a href="<?php echo esc_url(home_url('/')) ?>" class="button-style1"><?php echo esc_html__('get back home', 'medel') ?></a>
						</div>
					</div>
				</div>
			</div>
			<!-- END Banner -->
		</div>
	</section>

<?php
get_footer('empty');
