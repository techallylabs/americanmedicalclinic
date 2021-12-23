<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medel
 */


$class = "";

$type = 'horizontal';

$id = get_the_ID(); 
$item = get_post($id);
setup_postdata($item);
$name = $item->post_title;
$thumb = get_post_meta( $id, '_thumbnail_id', true );
$link = get_permalink($id);

$desc_size = '455';

$desc = strip_tags(strip_shortcodes($item->post_content));
$desc = substr($desc, 0, $desc_size);
$desc = rtrim($desc, "!,.-");
$desc = substr($desc, 0, strrpos($desc, ' '))."...";

$class = "";
if(!empty($thumb)) {
	$class = " with-image";
} else {
	$class = " with-out-image";
}

$category = "";
for ($i=0; $i < count(wp_get_post_terms( $id, 'category')); $i++) {
    $category .= wp_get_post_terms( $id, 'category')[$i]->name.' \ ';
}
$category = trim($category, ' \ ');
if(!class_exists('WPBakeryShortCode') || is_home()) {
?>
	<div id="post-<?php the_ID(); ?>" <?php post_class() ?>>
		<div class="site-content">
			<div class="heading-decor">
				<h1 class="h3"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a></h1>
			</div>
			<?php if(!empty($thumb)) { ?>
				<div class="post-img"><?php echo wp_kses_post(wp_get_attachment_image($thumb, '')); ?></div>
			<?php } ?>
			<div class="date">
				<?php if(is_sticky()) { ?>
					<div class="sticky-a"><i class="fa fa-lock"></i> <span><?php echo esc_html__('Sticky ', 'medel') ?></span></div>
				<?php } ?>
				<?php echo get_the_date() ?>
			</div>
			<div class="post-content">
				<div class="clearfix">
					<?php the_content(''); ?>
				</div>
				<?php if(function_exists('wp_link_pages')) { ?>
					<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>','link_before' => '<span>','link_after' => '</span>',)); ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } else { ?> 
	<article id="post-<?php the_ID(); ?>" <?php post_class('blog-item col-xs-12'.$class) ?>>
		<div class="wrap">
			<?php if(!empty($thumb)) { ?>
			<div class="img"><a href="<?php echo esc_url($link); ?>" style="background-image: url(<?php echo esc_url(wp_get_attachment_image_src($thumb, 'large')[0]) ?>);"></a></div>
			<?php } ?>
			<div class="content">
				<h4><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a></h4>
				<div class="date">
					<?php if(is_sticky()) { ?>
					<div class="sticky-a"><i class="fa fa-lock"></i> <span><?php echo esc_html__('Sticky ', 'medel') ?></span></div>
					<?php } ?>
					<?php echo get_the_date() ?>
				</div>
				<?php if(!class_exists('WPBakeryShortCode')) { ?>
				<div class="text"><?php the_content(); ?></div>
				<?php } else { ?>
				<p><?php echo esc_html($desc); ?></p>
				<?php } if(function_exists('wp_link_pages')) { ?>
				<?php wp_link_pages(array('before' => '<div class="pagination">', 'after' => '</div>')); ?>
				<?php } ?>
				<a href="<?php echo esc_url(get_permalink($id)) ?>" class="button-style2 white"><?php echo esc_html__('read more','medel') ?></a>
			</div>
		</div>
	</article>
<?php } wp_reset_postdata(); ?>