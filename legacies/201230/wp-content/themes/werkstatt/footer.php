<?php
/**
 * The template for displaying the footer.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0.1
 */
?>

<footer id="colophon" class="site-footer cf">
	<div id="site-info">
		<ul class="credit" role="contentinfo">
		<?php if ( get_theme_mod( 'werkstatt_credit' ) ) : ?>
			<li><?php echo wp_kses_post( get_theme_mod( 'werkstatt_credit' ) ); ?></li>
		<?php else : ?>
			<li class="copyright">&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ); ?>"><?php bloginfo(); ?></a></li>
			<?php
					/* Include Privacy Policy link. */
					if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '<li>', '</li>', 'werkstatt');
					}
				?>
			<li class="wp-credit"><?php esc_html_e('Powered by', 'werkstatt') ?> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'werkstatt' ) ); ?>" ><?php esc_html_e( 'WordPress.', 'werkstatt' ); ?></a></li>
			<li class="theme-author"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'werkstatt' ), 'Werkstatt', '<a href="https://www.elmastudio.de/en/" rel="designer">Elmastudio</a>' ); ?></li>
		<?php endif; ?>
		</ul><!-- end .credit -->
	</div><!-- end #site-info -->
</footer><!-- end #colophon -->

</div><!-- end #container -->

</div><!-- end .wrap -->
<?php wp_footer(); ?>

</body>
</html>
