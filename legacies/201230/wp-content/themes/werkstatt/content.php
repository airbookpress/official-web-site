<?php
/**
 * The default template for displaying content
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>>
	
	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div><!-- end .entry-thumbnail -->
	<?php else : ?>
		<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" alt="<?php the_title(); ?>" class="placeholder-img wp-post-img" /></a></div><!-- end .entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<div class="entry-meta">
				<div class="entry-date">
					<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
				</div><!-- end .entry-date -->
				<div class="entry-author">
				<?php
					printf( __( 'by <a href="%1$s" title="%2$s">%3$s</a>', 'werkstatt' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'All posts by %s', 'werkstatt' ), get_the_author() ),
					get_the_author() );
				?>
				</div><!-- end .entry-author -->
			<?php edit_post_link( esc_html__( 'Edit', 'werkstatt' ), '<div class="entry-edit">', '</div>' ); ?>
		</div><!-- end .entry-meta -->
	</header><!-- end .entry-header -->

</article><!-- end post -<?php the_ID(); ?> -->
