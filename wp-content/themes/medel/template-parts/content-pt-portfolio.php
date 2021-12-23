<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package medel
 */


$class = "";

$id = get_the_ID(); 
$item = get_post($id);
setup_postdata($item);
$name = $item->post_title;
$thumb = get_post_meta( $id, '_thumbnail_id', true );
$link = get_permalink($id);

$desc_size = '45';

$desc = strip_tags(strip_shortcodes($item->post_content));
$desc = substr($desc, 0, $desc_size);
$desc = rtrim($desc, "!,.-");
$desc = substr($desc, 0, strrpos($desc, ' '))."...";

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item col-xs-12 col-sm-6 col-md-4') ?>>
    <div class="a-img"><div style="background-image: url(<?php echo esc_url(wp_get_attachment_image_src($thumb, 'large')[0]) ?>);"></div></div>
    <div class="content">
    	<h5><?php echo esc_html($name) ?></h5>
    	<p><?php echo esc_html($desc); ?></p>
    </div>
    <a href="<?php echo esc_url($link) ?>"></a>
</article>
<?php wp_reset_postdata(); ?> 