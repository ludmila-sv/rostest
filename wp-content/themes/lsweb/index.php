<?php
/**
 * Blog archive page
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="blog-archive__header<?php if ( is_home() ) { // phpcs:ignore ?> blog-archive__header--home<?php } ?>">
	<div class="container">
		<?php if ( is_home() ) { ?>

			<h1><?php the_field( 'blog_title', 'option' ); ?></h1>
		<?php } elseif ( is_category() || is_tag() ) { ?>

			<div class="blog-archive__category"><?php esc_html_e( 'Category', 'lsweb' ); ?></div>
				<h1><?php single_cat_title(); ?></h1>
			<div class="blog-archive__all-posts"><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All Posts', 'lsweb' ); ?></a></div>

		<?php } elseif ( is_search() ) { ?>

			<h1><?php esc_html_e( 'Search results for:', 'lsweb' ); ?> <span><?php echo esc_html( get_search_query() ); ?></span></h1>
			<div class="blog-archive__all-posts"><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All Posts', 'lsweb' ); ?></a></div>
		<?php } ?>

	</div>
</div>

<div class="blog-archive__body">
	<div class="container">

		<?php if ( false ) { // is_home(). ?>

			<div class="blog-archive__controls">
				<div class="blog-archive__categories">
					<div class="blog-archive__categories__title"><?php esc_html_e( 'By Category', 'lsweb' ); ?></div>

					<?php get_template_part( 'partials/category-filter' ); ?>

				</div>
				<div class="blog-archive__search">
					<?php get_search_form( true ); ?>
				</div>
				<div class="blog-archive__controls__title"><span><?php esc_html_e( 'Filter', 'lsweb' ); ?></span><span class="blog-archive__controls__toggler"></span></div>
			</div>

		<?php } ?>

		<?php
		if ( have_posts() ) {
			?>

			<div class="row blog-archive__posts" itemscope itemtype="https://schema.org/ItemList">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<div class="col-lg-4 blog-archive__post">
						<?php get_template_part( 'partials/post' ); ?>

					</div>

				<?php endwhile; ?>

			</div>

			<?php
			$nav = get_the_posts_pagination(
				array(
					'prev_text'          => '',
					'next_text'          => '',
					'screen_reader_text' => __( 'Blog pagination', 'lsweb' ),
				)
			);
			$nav = preg_replace( '/\<h2[^>]+\>(.*)\<\/h2\>/', '', $nav );
			$nav = str_replace( ' role="navigation"', '', $nav );
			echo $nav; //phpcs:ignore
			?>
		<?php } else { ?>
			<?php if ( is_search() ) { ?>

				<p class="blog-archive__no-results"><?php esc_html_e( 'There are no results for this search. Please try again.', 'lsweb' ); ?></p>

			<?php } elseif ( is_category() || is_tag() ) { ?>

				<p class="blog-archive__no-results"><?php esc_html_e( 'No posts in this category.', 'lsweb' ); ?></p>

			<?php } else { ?>

				<p class="blog-archive__no-results"><?php esc_html_e( 'Blog content is comming soon.', 'lsweb' ); ?></p>

			<?php } ?>
		<?php } ?>

	</div>
</div>

<?php get_footer(); ?>
