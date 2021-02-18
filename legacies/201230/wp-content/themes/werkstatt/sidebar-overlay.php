<?php
/**
 * The overlay widget area
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0.1
 */
?>

<?php
	/* Check, if one of the overlay sidebar widget area has widgets.
	 *
	 * If none of the sidebar widget areas have widgets, let's bail early.
	 */
	if (   ! is_active_sidebar( 'sidebar-1' )
		&& ! is_active_sidebar( 'sidebar-2' )
		&& ! is_active_sidebar( 'sidebar-3' )
		&& ! is_active_sidebar( 'sidebar-4' )
		)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div class="flex cf">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="col1" class="sidebar-one widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- end .sidebar-one -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="col2" class="sidebar-two widget-area" role="complementary">
		<div class="col-wrap">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</div><!-- end .sidebar-two -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="col3" class="sidebar-three widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- end .sidebar-three -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="col4" class="sidebar-four widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>

		<ul class="credit">
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
	</div><!-- end .sidebar-four -->
	<?php endif; ?>
</div><!-- end .flex -->
