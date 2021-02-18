<?php
/**
 * The template used for displaying page content.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- end .entry-header -->
	
	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- end .entry-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'werkstatt' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	<footer class="entry-footer cf">
		<?php edit_post_link( esc_html__( 'Edit', 'werkstatt' ), '<div class="edit-link cf">', '</div>' ); ?>
	</footer><!-- end .entry-footer -->

</article><!-- #post-## -->
