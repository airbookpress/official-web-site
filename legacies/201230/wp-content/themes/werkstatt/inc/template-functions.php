<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Werkstatt
 * @since 1.0.4
 * @version 1.0.0
 */

/**
 * Display custom CSS.
 */
function werkstatt_css_wrap() {
	?>
	<style type="text/css" id="custom-css">

	<?php if ('1' != get_theme_mod( 'werkstatt_credit_footer', '1' ) ) { ?>
		#colophon {display: none;}
	<?php } ?>

	</style>
		<?php
}
add_action( 'wp_head', 'werkstatt_css_wrap');
