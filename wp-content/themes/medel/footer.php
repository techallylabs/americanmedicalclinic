
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medel
 */
?>
			<?php if(medel_styles()['footer'] == 'minified') { ?>
				<footer class="minified-footer <?php echo esc_attr(medel_styles()['footer_color_mode']) ?> main-row">
					<div class="container">
						<?php if(medel_styles()['minified_copyright_text']) { ?>
							<div class="copyright">
								<?php echo wp_kses(medel_styles()['minified_copyright_text'], 'post') ?>
							</div>
						<?php } ?>
					</div>
				</footer>
			<?php } else if(medel_styles()['footer'] == 'show') { ?>
				<footer class="site-footer <?php echo esc_attr(medel_styles()['footer_color_mode']) ?> main-row">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-md-<?php echo esc_attr(medel_styles()['footer_col_1']) ?>">
								<?php if(medel_styles()['footer_logo'] == 'show') { ?>
									<div class="logo"><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo wp_kses(medel_styles()['logo_content'], 'post') ?></a></div>
								<?php } if(medel_styles()['copyright_text']) { ?>
									<div class="copyright">
										<?php echo wp_kses(medel_styles()['copyright_text'], 'post') ?>
									</div>
								<?php } if(medel_styles()['show_social_buttons'] && !empty(medel_styles()['social_buttons_content'])) { ?>
									<div class="social-buttons">
										<?php echo wp_kses(medel_styles()['social_buttons_content'] ,'post'); ?>
									</div>
								<?php } ?>
							</div>
							<?php if(is_active_sidebar('footer-2')) { ?>
							<div class="col-xs-12 col-sm-6 col-md-<?php echo esc_attr(medel_styles()['footer_col_2']) ?>">
								<?php dynamic_sidebar('footer-2'); ?>
							</div>
							<?php } if(is_active_sidebar('footer-3')) { ?>
							<div class="col-xs-12 col-sm-6 col-md-<?php echo esc_attr(medel_styles()['footer_col_3']) ?>">
								<?php dynamic_sidebar('footer-3'); ?>
							</div>
							<?php } if(is_active_sidebar('footer-4')) { ?>
							<div class="col-xs-12 col-sm-6 col-md-<?php echo esc_attr(medel_styles()['footer_col_4']) ?>">
								<?php dynamic_sidebar('footer-4'); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</footer>
			<?php } ?>
		</div>
		
		<?php wp_footer(); ?>

	</body>
</html>
