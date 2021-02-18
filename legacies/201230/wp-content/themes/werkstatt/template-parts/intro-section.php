<?php
/**
 * The template for for the Home Page Intro Section
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
  * @version 1.0
 */
?>

<div class="intro-section">

		<?php if ( get_theme_mod( 'werkstatt_intro' ) ) : ?>
			<div class="intro-text">
				<?php echo wpautop( get_theme_mod( 'werkstatt_intro' ) ); ?>
			</div><!-- end .intro-text -->
		<?php endif; // get_theme_mod werkstatt_intro ?>

		<?php if (has_nav_menu( 'social' ) ) : ?>
			<nav id="social-nav" class="social-nav" role="navigation">
				<?php wp_nav_menu( array('theme_location' => 'social', 'container' => 'false', 'depth' => -1 ));  ?>
			</nav><!-- end #social-nav -->
		<?php endif; // has_nav_menu ?>

</div><!-- end .intro-section -->