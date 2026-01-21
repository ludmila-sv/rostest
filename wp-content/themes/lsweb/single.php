<?php
/**
 * Single blog post.
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

the_post();

?>

<div role="article" class="blog-single" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="identifier" content="<?php echo esc_attr( get_the_ID() ); ?>">
	<div class="container">
		<div class="blog-single__header">
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div class="blog-single__breadcrumbs" id="breadcrumbs">', '</div>' );
			}
			?>

			<h1 class="blog-single__title" itemprop="headline"><?php the_title(); ?></h1>
			<?php if ( ! empty( get_the_category() ) ) { ?>

				<div class="blog-single__categories">
					<span class="blog-single__categories__title"><?php esc_html_e( 'Categories', 'lsweb' ); ?>: </span>
					<span class="blog-single__categories__list">
						<?php the_category( ', ', ' ', '' ); ?>

					</span>
				</div>
			<?php } ?>

		</div>

		<div class="blog-single__meta">
			<div class="blog-single__date"><?php the_date(); ?></div>

			<div class="blog-single__views"><?php esc_html_e( 'views:', 'lsweb' ); ?> <?php echo do_shortcode( '[WPeCounter]' ); ?></div>
		</div>

		<?php if ( has_post_thumbnail() ) { ?>

			<div class="blog-single__thumbnail">
				<?php the_post_thumbnail( 'large', array( 'itemprop' => 'image' ) ); ?>

			</div>
		<?php } ?>


		<div class="blog-single__content content" itemprop="articleBody">
			<?php the_content(); ?>

		</div>

		<div class="blog-single__footer">
			<div class="blog-single__share">
				<div class="blog-single__share__title">Поделиться этой статьёй</div>

				<?php get_template_part( 'partials/share' ); ?>

			</div>
		</div>
	</div>
</div>

<?php
get_footer();
