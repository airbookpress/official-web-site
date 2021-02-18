<?php
/**
 * The main template file.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content cf" role="main">
		


		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content' );

			// End the loop.
			endwhile;
			?>
			

			<?php // pagination.
			the_posts_pagination( array(
				'next_text' => '<span class="meta-nav">' . __( 'Older', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Older', 'werkstatt' ) . '</span> ',
					
				'prev_text' => '<span class="meta-nav">' . __( 'Newer', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Newer', 'werkstatt' ) . '</span> ',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'werkstatt' ) . ' </span>',
			) );
			
			?>

	</div><!-- end #primary -->

<?php get_footer(); ?>
