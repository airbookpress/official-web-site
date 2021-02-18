<?php
/**
 * The template for displaying search results.
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content cf" role="main">

	<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php echo absint($wp_query->found_posts); ?> <?php printf( esc_html__( 'Search Results for: %s', 'werkstatt' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!--end .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php	get_template_part( 'content' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php else : ?>

			<article id="post-0" class="page no-results not-found">

			<header class="entry-header">
				<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'werkstatt' ); ?></h1>
			</header><!-- end .entry-header -->

					<div class="entry-content cf">
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'werkstatt' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- end .entry-content -->

			</article>

	<?php endif; ?>

	<?php // Previous/next page navigation.
				the_posts_pagination( array(
					'next_text' => '<span class="meta-nav">' . __( 'Next', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next', 'werkstatt' ) . '</span> ',
					'prev_text' => '<span class="meta-nav">' . __( 'Previous', 'werkstatt' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous', 'werkstatt' ) . '</span> ' .
					'<span class="project-title">%title</span>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'werkstatt' ) . ' </span>',
	) ); ?>

	</div><!-- end #primary -->

<?php get_footer(); ?>