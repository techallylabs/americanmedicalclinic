<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Medel
 */

get_header(); ?>

	<main class="main-row">
		<div class="container">

		<?php
		if ( have_posts() ) : ?>

			
			<div class="site-content">
				<div class="heading-decor">
					<?php the_archive_title( '<h1>', '</h1>' ); ?>
				</div>
			</div>
			<?php
			/* Start the Loop */
			if(!class_exists('WPBakeryShortCode') || is_home()) {
				echo '<div class="post-items archive">';
			} else if(get_post_type() == 'pt-portfolio') {
				echo '<div class="portfolio-items row portfolio-type-grid portfolio_hover_type_1">';
			} else {
				echo '<div class="blog-items row blog-type-horizontal">';
			}

			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			echo '</div>';
			
			if (function_exists('medel_wp_corenavi')) {
				echo medel_wp_corenavi();
			} else {
				wp_link_pages(); 
			};

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</div>
	</main>

<?php
get_footer();
