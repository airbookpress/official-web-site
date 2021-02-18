<?php
/**
 * The Template for displaying single posts.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation( array (
				'next_text' => '<span class="meta-nav">' . __( 'Next', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'next post', 'werkstatt' ) . '</span> ',
				'prev_text' => '<span class="meta-nav">' . __( 'Previous', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'previous post', 'werkstatt' ) . '</span> ',
			) ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

	</div><!-- end #primary -->

<?php get_footer(); ?>
