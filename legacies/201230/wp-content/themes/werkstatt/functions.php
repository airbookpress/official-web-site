<?php
/**
 * Werkstatt functions and definitions
 *
 * @package Werkstatt
 * @since Werkstatt 1.0
 * @version 1.0.2
 */


/*-----------------------------------------------------------------------------------*/
/* Theme update feature setup
/*-----------------------------------------------------------------------------------*/

if ( ! class_exists( 'WC_AM_Client_25' ) ) {
	require_once( get_template_directory() . '/inc/wc-am-client.php' );
}

if ( class_exists( 'WC_AM_Client_25' ) ) {

	$wcam_lib = new WC_AM_Client_25( __FILE__, '', wp_get_theme( wp_get_theme()->Template )->Version, 'theme', 'https://www.elmastudio.de/', wp_get_theme( wp_get_theme()->Template )->Name, wp_get_theme( wp_get_theme()->Template )->get( 'TextDomain' ), '195426' );

}

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design.
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
		$content_width = 1005;

function werkstatt_adjust_content_width() {
		global $content_width;

		if ( is_page_template( 'full-width.php' ) )
				$content_width = 2010;
}
add_action( 'template_redirect', 'werkstatt_adjust_content_width' );


/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/

function werkstatt_setup() {

	// Make Werkstatt available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'werkstatt', get_template_directory() . '/languages' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for wider content.
	add_theme_support( 'align-wide' );

	// Add support responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for editor font sizes.
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'small', 'werkstatt' ),
			'shortName' => __( 'S', 'werkstatt' ),
			'size' => 13,
			'slug' => 'small'
		),
		array(
			'name' => __( 'regular', 'werkstatt' ),
			'shortName' => __( 'M', 'werkstatt' ),
			'size' => 15,
			'slug' => 'regular'
		),
		array(
			'name' => __( 'large', 'werkstatt' ),
			'shortName' => __( 'L', 'werkstatt' ),
			'size' => 21,
			'slug' => 'large'
		),
		array(
			'name' => __( 'larger', 'werkstatt' ),
			'shortName' => __( 'XL', 'werkstatt' ),
			'size' => 24,
			'slug' => 'larger'
		)
	) );

	// Disable custom editor font sizes.
	add_theme_support('disable-custom-font-sizes');

	// Add editor color palette.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'black', 'werkstatt' ),
			'slug' => 'black',
			'color' => '#000000',
		),
		array(
			'name' => __( 'white', 'werkstatt' ),
			'slug' => 'white',
			'color' => '#ffffff',
		),
		array(
			'name' => __( 'light grey', 'werkstatt' ),
			'slug' => 'light-grey',
			'color' => '#ececed',
		),
		array(
			'name' => __( 'grey', 'werkstatt' ),
			'slug' => 'grey',
			'color' => '#a9a9a9',
		),
		array(
			'name' => __( 'yellow', 'werkstatt' ),
			'slug' => 'yellow',
			'color' => '#e7b547',
		),
		array(
			'name' => __( 'red', 'werkstatt' ),
			'slug' => 'red',
			'color' => '#d7464d',
		),
		array(
			'name' => __( 'green', 'werkstatt' ),
			'slug' => 'green',
			'color' => '#85c066',
		),
		array(
			'name' => __( 'blue', 'werkstatt' ),
			'slug' => 'blue',
			'color' => '#0066ff',
		),
	) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', werkstatt_font_url() ) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu().
	register_nav_menus( array (
		'primary' => __( 'Primary menu', 'werkstatt' ),
		'social' => __( 'Social menu', 'werkstatt' )
	) );

	// Implement the Custom Header feature
	require get_template_directory() . '/inc/custom-header.php';

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'werkstatt_custom_background_args', array(
		'default-color'	=> 'fff',
		'default-image'	=> '',
	) ) );

	// This theme uses post thumbnails.
	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'werkstatt_setup' );


/*-----------------------------------------------------------------------------------*/
/*  Returns the Google font stylesheet URL if available.
/*-----------------------------------------------------------------------------------*/

function werkstatt_font_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Rubik translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$rubik = _x( 'on', 'Rubik: on or off', 'werkstatt' );

	if ( 'off' !== $rubik ) {
		$font_families = array();

		if ( 'off' !== $rubik )
			$font_families[] = 'Rubik:400,700,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
	}

	return esc_url_raw( $fonts_url );
}


/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles
/*-----------------------------------------------------------------------------------*/

function werkstatt_scripts() {
	global $wp_styles;

	// Add fonts, used in the main stylesheet.
	wp_enqueue_style( 'werkstatt-fonts', werkstatt_font_url(), array(), null );

	// Loads JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

	// Loads stylesheets.
	wp_enqueue_style( 'werkstatt-style', get_stylesheet_uri(), array(), '20151030' );

	// Loading bar script
	wp_enqueue_script( 'werkstatt-loadingbar', get_template_directory_uri() . '/js/pace.min.js', array( 'jquery' ), '1.0.0' );

	// Loads Post Masonry
	wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/js/imagesLoaded.js', array( 'jquery' ), '3.2.0' );
	wp_enqueue_script( 'werkstatt-postmasonry', get_template_directory_uri() . '/js/postmasonry.js', array( 'jquery', 'masonry' ), '20151128', true );

	// Loads Custom Werkstatt JavaScript functionality
	wp_enqueue_script( 'werkstatt-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150704', true );
	wp_localize_script( 'werkstatt-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'werkstatt' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'werkstatt' ) . '</span>',
	) );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

}
add_action( 'wp_enqueue_scripts', 'werkstatt_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Load block editor styles.
/*-----------------------------------------------------------------------------------*/
function werkstatt_block_editor_styles() {
 wp_enqueue_style( 'werkstatt-block-editor-styles', get_template_directory_uri() . '/block-editor.css');
 wp_enqueue_style( 'werkstatt-fonts', werkstatt_font_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'werkstatt_block_editor_styles' );

/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/

function werkstatt_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'werkstatt_page_menu_args' );


/*-----------------------------------------------------------------------------------*/
/* Sets the authordata global when viewing an author archive.
/*-----------------------------------------------------------------------------------*/

function werkstatt_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'werkstatt_setup_author' );


/*-----------------------------------------------------------------------------------*/
/* Add custom max excerpt lengths.
/*-----------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*-----------------------------------------------------------------------------------*/
/* Replace "[...]" with custom read more in excerpts.
/*-----------------------------------------------------------------------------------*/

function werkstatt_excerpt_more( $more ) {
	global $post;
	return '&hellip;';
}
add_filter( 'excerpt_more', 'werkstatt_excerpt_more' );



/*-----------------------------------------------------------------------------------*/
/* Add Theme Customizer CSS
/*-----------------------------------------------------------------------------------*/

function werkstatt_customize_css() {
		?>
	<style type="text/css">
	<?php if ('' != get_theme_mod( 'werkstatt_intro' ) || has_nav_menu('social') ) { ?>
	@media screen and (min-width: 1025px) {
		.blog #primary {margin-left: 390px;}
	}
	<?php } ?>
	<?php if ('#ffffff' != get_theme_mod( 'background_color' ) ) { ?>
		#site-navigation {background:#<?php echo get_theme_mod('background_color', '#ffffff'); ?>;}
	<?php } ?>
	<?php if ('#000000' != get_theme_mod( 'link_color' ) ) { ?>
		.entry-content a, .textwidget a, .comment-text a { color: <?php echo get_theme_mod('link_color', '#000000'); ?>;}
	<?php } ?>
	</style>
		<?php
}
add_action( 'wp_head', 'werkstatt_customize_css');


/*-----------------------------------------------------------------------------------*/
/* Remove inline styles printed when the gallery shortcode is used.
/*-----------------------------------------------------------------------------------*/

add_filter('use_default_gallery_style', '__return_false');


if ( ! function_exists( 'werkstatt_comment' ) ) :


/*-----------------------------------------------------------------------------------*/
/* Comments template werkstatt_comment
/*-----------------------------------------------------------------------------------*/
function werkstatt_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div>

			<div class="comment-wrap">
				<div class="comment-details">
					<div class="comment-author">

						<?php printf( ( '%s' ), wp_kses_post( sprintf( '%s', get_comment_author_link() ) ) ); ?>
					</div><!-- end .comment-author -->
					<div class="comment-meta">
						<span class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date */
								printf( esc_html__( '%1$s', 'werkstatt' ),
								get_comment_date());
							?></a>
						</span>
						<?php edit_comment_link( esc_html__(' Edit', 'werkstatt'), '<span class="comment-edit">', '</span>'); ?>
					</div><!-- end .comment-meta -->
				</div><!-- end .comment-details -->

				<div class="comment-text">
				<?php comment_text(); ?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'werkstatt' ); ?></p>
					<?php endif; ?>
				</div><!-- end .comment-text -->
				<?php if ( comments_open () ) : ?>
					<div class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'werkstatt' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
				<?php endif; ?>
			</div><!-- end .comment-wrap -->
		</div><!-- end .comment -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php esc_html_e( 'Pingback:', 'werkstatt' ); ?> <?php comment_author_link(); ?></p>
		<p class="pingback-edit"><?php edit_comment_link(); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/*-----------------------------------------------------------------------------------*/
/* Register widgetized areas
/*-----------------------------------------------------------------------------------*/

function werkstatt_widgets_init() {

	register_sidebar( array (
		'name' => esc_html__( 'Overlay Widget Area 1', 'werkstatt' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Widgets appear in the first column of the overlay widget area.', 'werkstatt' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => esc_html__( 'Overlay Widget Area 2', 'werkstatt' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'Widgets appear in the second column of the overlay widget area.', 'werkstatt' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => esc_html__( 'Overlay Widget Area 3', 'werkstatt' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'Widgets appear in the third column of the overlay widget area.', 'werkstatt' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => esc_html__( 'Overlay Widget Area 4', 'werkstatt' ),
		'id' => 'sidebar-4',
		'description' => esc_html__( 'Widgets appear in the fourth column of the overlay widget area.', 'werkstatt' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'werkstatt_widgets_init' );


/*-----------------------------------------------------------------------------------*/
/* Extends the default WordPress body classes
/*-----------------------------------------------------------------------------------*/
function werkstatt_body_class( $classes ) {

	if ( is_page_template( 'page-templates/full-width.php' ) ) {
		$classes[] = 'fullwidth';
	}

	if ( has_header_image() ) {
		$classes[] = 'custom-logo';
	}

	return $classes;
}
add_filter( 'body_class', 'werkstatt_body_class' );

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/*-----------------------------------------------------------------------------------*/
/* Customizer additions
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/customizer.php';

/*-----------------------------------------------------------------------------------*/
/* Load Jetpack compatibility file.
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/jetpack.php';

/*-----------------------------------------------------------------------------------*/
/* Grab the Werkstatt Custom shortcodes.
/*-----------------------------------------------------------------------------------*/
require( get_template_directory() . '/inc/shortcodes.php' );

/*-----------------------------------------------------------------------------------*/
/* Add One Click Demo Import code.
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/demo-installer.php';
