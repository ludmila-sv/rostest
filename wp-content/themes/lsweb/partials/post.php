<?php
/**
 *  Blog archive page - single post block
 *
 * @package lsweb
 */

if ( ! empty( $args ) ) {
	$post = $args;
}

$current_post_id = isset( $post->ID ) ? $post->ID : 1;
?>

<div class="post" itemprop="itemListElement" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="identifier" content="<?php echo esc_attr( $current_post_id ); ?>">
	<meta itemprop="url" content="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>">

	<a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>" class="post__thumbnail" aria-label="<?php esc_html_e( 'Main post image', 'lsweb' ); ?>">
		<?php
		if ( has_post_thumbnail( $current_post_id ) ) {
			echo get_the_post_thumbnail( $current_post_id, 'large', array( 'class' => 'img-fit', 'itemprop' => 'image' ) ); // phpcs:ignore
		}
		?>

	</a>

	<div class="post__body">
		<div class="post__category"><?php the_category( ' ', '', $current_post_id ); // the_category( ', ', '', $current_post_id ). ?></div>
		<h3 class="post__title" itemprop="headline"><a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>"><?php echo esc_html( get_the_title( $current_post_id ) ); ?></a></h3>

		<div class="post__excerpt" itemprop="articleBody"><?php echo esc_html( get_the_excerpt( $current_post_id ) ); ?></div>

		<div class="post__link">
			<a href="<?php echo esc_url( get_the_permalink( $current_post_id ) ); ?>"><?php esc_html_e( 'Read more', 'lsweb' ); ?></a>
			<div class="post__views"><?php esc_html_e( 'views:', 'lsweb' ); ?> <?php echo do_shortcode( '[WPeCounter]' ); ?></div>
		</div>
	</div>
</div>
