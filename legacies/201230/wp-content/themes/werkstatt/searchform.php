<?php
/**
 * Template for displaying the standard search forms
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="screen-reader-text"><span><?php esc_html_e( 'Search', 'werkstatt' ); ?></span></label>
	<input type="text" class="search-field" name="s" id="s" placeholder="<?php echo esc_attr_x( ' ', 'placeholder', 'werkstatt' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'werkstatt' ); ?>" />
</form>