<?php
/**
 * Default page template.
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

the_post();
?>

<div role="article" class="content" itemscope itemtype="http://schema.org/Article">
	<meta itemprop="identifier" content="<?php echo esc_attr( get_the_ID() ); ?>">
	<div class="container" itemprop="articleBody">

		<?php the_content(); ?>

	</div>
</div>

<?php

get_footer();
