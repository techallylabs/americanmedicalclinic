<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Medel
 */

if(medel_styles()['project_style'] != 'horizontal') {
	$container = 'container';
} else {
	$container = 'project-horizontal';
}

if(medel_styles()['project_image'] == 'adaptive') {
	$container .= ' adaptive-img';
}

get_header(); ?>

	<main class="main-row">
		<div class="<?php echo esc_attr($container) ?>">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
				<?php 
					$id = get_the_ID();

					$item = get_post($id);

					$thumb = get_post_meta( $id, '_thumbnail_id', true );

					$category = "";
					$category_name = "";
					$category_links_html = "";
					if(is_array(wp_get_post_terms( $id, 'pt-portfolio-category')) && count(wp_get_post_terms( $id, 'pt-portfolio-category')) > 0 && wp_get_post_terms( $id, 'pt-portfolio-category')) {
						foreach (wp_get_post_terms( $id, 'pt-portfolio-category') as $item) {
							$category .= $item->slug.' ';
							$category_name .= $item->name.' / ';
							$category_links_html .= '<a href="'.esc_url(get_category_link($item->cat_ID)).'">'.esc_html($item->name).'</a>, ';
						}
						$category_links_html = trim($category_links_html, ', ');
					}

					$tags_html = "";
					if(is_array(get_the_tags($id)) && count(get_the_tags($id)) > 0 && get_the_tags($id)) {
						foreach (get_the_tags($id) as $tag){
							$tag_link = get_tag_link($tag->term_id);

							$tags_html .= '<a href="'.$tag_link.'">'.$tag->name.'</a>, ';
						}
						$tags_html = trim($tags_html, ', ');
					}

					$desc = strip_tags(strip_shortcodes($item->post_content));
					if(iconv_strlen ($desc, 'UTF-8') > 200) {
						$desc = substr($desc, 0, 200);
					}

					$prev = get_permalink(get_adjacent_post(false,'',false));
					$next = get_permalink(get_adjacent_post(false,'',true));
					
					$thumbnails = get_post_meta( $id, 'pt_gallery', true );
					
					if(medel_styles()['project_style'] != 'horizontal') { ?>
					<div class="site-content">
						<div class="heading-decor">
							<h1 class="h2"><?php echo esc_html(single_post_title()); ?></h1>
						</div>
						<?php if(!empty($thumb) && empty($thumbnails)) { ?>
							<div class="post-img"><?php echo wp_get_attachment_image($thumb, ''); ?></div>
						<?php } if(is_array($thumbnails) && !empty($thumbnails) && count($thumbnails) > 0) { ?>
							<?php if(medel_styles()['project_style'] == 'masonry') { ?>
								<div class="post-gallery-masonry row popup-gallery">
									<?php foreach($thumbnails as $thumb) { ?>
										<div class="col-xs-12 col-sm-6 popup-item"><a href="<?php echo esc_url(wp_get_attachment_image_src($thumb, '')[0]); ?>" data-size="<?php echo esc_attr(wp_get_attachment_image_src($thumb, '')[1]); ?>x<?php echo esc_attr(wp_get_attachment_image_src($thumb, '')[2]); ?>"><?php echo wp_kses_post(wp_get_attachment_image($thumb, '')); ?></a></div>
									<?php } ?>
								</div>
							<?php } else if(medel_styles()['project_style'] == 'slider') { 
								wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
						        wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery') );
						    ?>
						    	<div class="project-slider">
						    		<?php foreach($thumbnails as $thumb) { ?>
						    			<div class="item"><div class="cell"><?php echo wp_kses_post(wp_get_attachment_image($thumb, '')); ?></div></div>
						    		<?php } ?>
						    	</div>
						    	<div class="project-slider-carousel">
						    		<?php foreach($thumbnails as $thumb) { ?>
						    			<div class="item" style="background-image: url(<?php echo esc_url(wp_get_attachment_image_src($thumb, '')[0]); ?>);"></div>
						    		<?php } ?>
						    	</div>
							<?php } ?>
						<?php } ?>
						<div class="date"><?php the_date() ?></div>
						<div class="post-content">
							<?php the_content(''); ?>
							<?php if(function_exists('wp_link_pages')) { ?>
								<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>','link_before' => '<span>','link_after' => '</span>',)); ?>
							<?php } ?>
						</div>
					</div>
					<div class="post-bottom">
						<div class="post-nav">
							<?php if(get_permalink() != $prev ) { ?>
							<a href="<?php echo esc_url($prev); ?>"><i class="free-basic-ui-elements-left-arrow"></i> <span><?php echo esc_html__('prev', 'medel') ?></span></a>
							<?php } ?>
							<?php if(get_permalink() != $next ) { ?>
							<a href="<?php echo esc_url($next); ?>"><span><?php echo esc_html__('next', 'medel') ?></span> <i class="free-basic-ui-elements-right-arrow"></i></a>
							<?php } ?>
						</div>
					</div>
				<?php } else if(medel_styles()['project_style'] == 'horizontal') { ?>
					<div class="content">
						<h1 class="h3"><?php echo esc_html(single_post_title()); ?></h1>
						<div class="date"><?php the_date() ?></div>
						<?php if($desc) { ?>
							<div class="text"><?php echo esc_html($desc) ?></div>
						<?php } ?>
					</div>
					<?php if(!empty($thumb) && empty($thumbnails)) { ?>
						<div class="project-horizontal-img" style="background-image: url(<?php echo esc_url(wp_get_attachment_image_src($thumb, '')[0]); ?>)"></div>
					<?php } if(is_array($thumbnails) && !empty($thumbnails) && count($thumbnails) > 0) {
						wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css');
				        wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery') );
				    ?>
				    	<div class="project-horizontal-slider">
				    		<?php foreach($thumbnails as $thumb) { ?>
				    			<div class="item"><?php echo wp_kses_post(wp_get_attachment_image($thumb, '')); ?></div>
				    		<?php } ?>
				    		<?php if(get_permalink() != $next ) { ?>
					    		<div class="item">
					    			<div class="cell">
										<a href="<?php echo esc_url($next); ?>"><span><?php echo esc_html__('next post', 'medel') ?></span> <i class="free-basic-ui-elements-right-arrow"></i></a>
									</div>
					    		</div>
							<?php } ?>
				    	</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php endwhile; ?>

		</div>
	</main>

<?php
get_footer();
