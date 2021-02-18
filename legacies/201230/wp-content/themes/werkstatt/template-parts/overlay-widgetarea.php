<?php
/**
 * The template for for the Overlay area
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
  * @version 1.0
 */
?>

<button id="overlay-open" class="overlay-btn"><span><?php esc_html_e( 'Info', 'werkstatt' ); ?></span></button>
<div id="overlay-wrap" class="overlay-wrap cf">
	
	<nav id="site-navigation-mobile" class="main-navigation cf" role="navigation">
			<?php
				wp_nav_menu( array(
					'theme_location'	=> 'primary',
					'menu_class'    	=> 'primary-menu',
					'container' 		=> false,
				 ) );
			?>
	</nav><!-- .mobile-navigation -->

	<?php get_sidebar( 'overlay' ); ?>

<div class="close-wrap">
<button id="overlay-close" class="overlay-btn"><span><?php esc_html_e( 'Close', 'werkstatt' ); ?></span></button>
</div>
</div><!-- end #overlay-wrap -->
