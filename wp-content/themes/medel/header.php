<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medel
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="all" class="site">
			<?php if(medel_styles()['preloader_show'] == '1' && isset(medel_styles()['preloader_img']['background-image']) && !empty(medel_styles()['preloader_img']['background-image'])) { ?>
				<div class="preloader-area">
					<div class="preloader_img"><img src="<?php echo esc_url(medel_styles()['preloader_img']['background-image']) ?>" alt="<?php echo get_bloginfo( 'name' ) ?>"></div>
				</div>
			<?php } else if(medel_styles()['preloader_show'] == '1') { ?>
				<div class="preloader-area">
					<div class="pulse"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 100"><polyline fill="none" stroke-width="3px" stroke="#000" points="2.4,58.7 70.8,58.7 76.1,46.2 81.1,58.7 89.9,58.7 93.8,66.5 102.8,22.7 110.6,78.7 115.3,58.7 126.4,58.7 134.4,54.7 142.4,58.7 197.8,58.7 "/></svg></div>
				</div>
			<?php } ?>
			<?php if(medel_styles()['navigation_type'] != 'side') { ?>
				<header class="site-header <?php echo esc_attr(medel_styles()['css_classes']) ?> main-row">
					<div class="header-top">
						<div class="container">
							<?php if(medel_styles()['show_social_buttons'] && !empty(medel_styles()['social_buttons_content'])) { ?>
								<div class="social-buttons">
									<?php echo wp_kses(medel_styles()['social_buttons_content'] ,'post'); ?>
								</div>
							<?php } ?>
							<div class="fr">
								<?php if(medel_styles()['working_time'] && !empty(medel_styles()['working_time'])) { ?>
									<div class="working-time"><i class="fa fa-clock-o"></i><span><?php echo wp_kses(medel_styles()['working_time'] ,'post'); ?></span></div>
								<?php } if(medel_styles()['phone_number'] && !empty(medel_styles()['phone_number'])) { ?>
									<div class="phone-number"><i class="fa fa-phone"></i><span><?php echo wp_kses(medel_styles()['phone_number'] ,'post'); ?></span></div>
								<?php } if(medel_styles()['search'] == 'yes') { ?>
									<div class="search-button"><i class="fa fa-search"></i></div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="<?php echo esc_attr(medel_styles()['header_container']) ?>">
						<div class="logo"><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo wp_kses(medel_styles()['logo_content'], 'post') ?></a></div>
						<div class="fr">
							<?php if(has_nav_menu('navigation') && medel_styles()['navigation_type'] != 'disabled') { ?>
								<nav class="navigation <?php echo esc_attr(medel_styles()['navigation_type']) ?>"><?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?></nav>
								<div class="butter-button nav-button <?php echo esc_attr(medel_styles()['navigation_type']) ?>">
									<div></div>
								</div>
							<?php } if(medel_styles()['cart'] == 'yes' && class_exists( 'WooCommerce' )) { ?>
								<div class="header-minicart woocommerce header-minicart-medel">
									<?php global $woocommerce;
									$count = $woocommerce->cart->cart_contents_count;
									if($count == 0) { ?>
									<div class="hm-cunt"><i class="material-design-shopping-cart"></i><span><?php echo esc_html($count) ?></span></div>
									<?php } else { ?>
									<a class="hm-cunt" href="<?php echo esc_url(wc_get_cart_url()) ?>"><i class="material-design-shopping-cart"></i><span><?php echo esc_html($count) ?></span></a>
									<?php } ?>
									<div class="minicart-wrap">
										<?php woocommerce_mini_cart(); ?>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
				</header>
			<?php } else { ?>
				<header class="site-header with-side <?php echo esc_attr(medel_styles()['css_classes']) ?> main-row">
					<div class="<?php echo esc_attr(medel_styles()['header_container']) ?>">
						<div class="logo"><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo wp_kses(medel_styles()['logo_content'], 'post') ?></a></div>
						<div class="fr">
							<?php if(has_nav_menu('navigation') && medel_styles()['navigation_type'] != 'disabled') { ?>
								<nav class="navigation hidden-menu"><?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?></nav>
								<div class="butter-button nav-button hidden_menu">
									<div></div>
								</div>
							<?php } if(medel_styles()['cart'] == 'yes' && class_exists( 'WooCommerce' )) { ?>
								<div class="header-minicart woocommerce header-minicart-medel">
									<?php global $woocommerce;
									$count = $woocommerce->cart->cart_contents_count;
									if($count == 0) { ?>
									<div class="hm-cunt"><i class="material-design-shopping-cart"></i><span><?php echo esc_html($count) ?></span></div>
									<?php } else { ?>
									<a class="hm-cunt" href="<?php echo esc_url(wc_get_cart_url()) ?>"><i class="material-design-shopping-cart"></i><span><?php echo esc_html($count) ?></span></a>
									<?php } ?>
									<div class="minicart-wrap">
										<?php woocommerce_mini_cart(); ?>
									</div>
								</div>
							<?php } if(medel_styles()['search'] == 'yes') { ?>
								<div class="search-button"><i class="ui-super-basic-search"></i></div>
							<?php } ?>
						</div>
					</div>
				</header>
				<div class="side-header main-row <?php echo esc_attr(medel_styles()['css_classes']) ?>">
					<div class="logo"><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo wp_kses(medel_styles()['logo_content'], 'post') ?></a></div>
					<div class="wrap">
						<div class="cell">
							<nav class="side-navigation"><?php wp_nav_menu( array( 'theme_location' => 'side-navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>', 'walker' => new Child_Wrap(), ) ); ?></nav>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if(medel_styles()['header_space'] == 'yes') { ?>
				<div class="header-space"></div>
			<?php } else { ?>
				<div class="header-space hide"></div>
			<?php } if(medel_styles()['search'] == 'yes') { ?>
				<div class="search-popup main-row">
					<div class="close free-basic-ui-elements-cancel"></div>
					<div class="centered-container"><?php get_search_form(); ?></div>
				</div>
			<?php } if(has_nav_menu('navigation') && medel_styles()['navigation_type']) { ?>
				<nav class="full-screen-nav main-row">
					<div class="close free-basic-ui-elements-cancel"></div>
					<div class="fsn-container">
						<?php wp_nav_menu( array( 'theme_location' => 'navigation', 'container' => 'ul', 'menu_class' => 'cell' ) ); ?>
					</div>
				</nav>
			<?php } ?>