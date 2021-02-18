<?php get_header(); ?>

<?php if( _hui('focusbox_s') ): ?>
    <?php _the_focusbox( 'h3', _hui('focusbox_title'), _hui('focusbox_text') ); ?>
<?php endif; ?>

<section class="container">
	<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 0;

		$args = array(
            'ignore_sticky_posts' => 1,
            'paged'               => $paged
		);

		if( _hui('notinhome') ){
			$pool = array();
			foreach (_hui('notinhome') as $key => $value) {
				if( $value ) $pool[] = $key;
			}
			$args['cat'] = '-'.implode(',-',$pool);
		}

		query_posts($args);

		get_template_part( 'excerpt', 'home' );
	?>
</section>

<?php get_footer(); ?>