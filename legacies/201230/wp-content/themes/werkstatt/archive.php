<?php
/**
 * The template for displaying archive pages
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content cf" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<?php
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- end .archive-header -->
			
			<div id="masonry-wrap">
			<div class="grid-sizer"></div>

			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					get_template_part( 'content', get_post_format() );

				// End the loop.
				endwhile;

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
			
			</div><!-- end #masonry-wrap -->

			<?php // Previous/next page navigation.
				the_posts_pagination( array(
					'next_text' => '<span class="meta-nav">' . __( 'Older', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Older', 'werkstatt' ) . '</span> ',
					'prev_text' => '<span class="meta-nav">' . __( 'Newer', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Newer', 'werkstatt' ) . '</span> ',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'werkstatt' ) . ' </span>',
			) ); ?>

	</div><!-- end #primary -->

<?php get_footer(); ?>