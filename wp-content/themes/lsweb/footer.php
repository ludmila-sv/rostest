<?php
/**
 * Footer.
 *
 * @package lsweb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		<footer class="footer">
			<div class="container">

				<div class="footer__bottom">
					<div class="footer__copyright">&copy; 2020-<?php echo esc_html( gmdate( 'Y' ) ); ?></div>

				</div>
			</div>
		</footer>

	</div>
</main>

<?php wp_footer(); ?>

</body>
</html>
