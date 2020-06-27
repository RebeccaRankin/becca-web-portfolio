<?php
/**
 * Functions and definitions
 * @package adtrak_boilerplate
 */

// require('_wp/custom-dash.php');
// require("_wp/wp-head.php");

/* ========================================================================================================================

jQuery

======================================================================================================================== */

wp_enqueue_script('jquery');

/* ========================================================================================================================

Remove query string from CSS & JS

======================================================================================================================== */

// Remove WP Version From Styles
add_filter( 'style_loader_src', 'sdt_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999 );

// Function to remove version numbers
function sdt_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

/* ========================================================================================================================

Enqueue scripts and stylesheets

======================================================================================================================== */

function site_script_loader() {
	// Style sheets
    wp_enqueue_style( 'master', get_stylesheet_directory_uri() . '/_css/master.css' );
    // Scripts
    wp_enqueue_script( 'production', get_template_directory_uri() .'/_js/production.min.js','','', true  );
    wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/731f5cd381.js', [], '', true );

    /* ========================================================================================================================

    Add variables to WP_Localize so we can use them in ajax-form

    ======================================================================================================================== */

    $translation_array = array( 'templateUrl' => get_template_directory_uri() );
    wp_localize_script( 'production', 'object_name', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'site_script_loader' );

/* ========================================================================================================================

Navigation

======================================================================================================================== */

function register_menus() {
  register_nav_menus(
    array(
      'main' => __( 'Main Nav' ),
      'top' => __( 'Top Nav' ),
      'locations' => __( 'Locations' )
    )
  );
}

add_action( 'init', 'register_menus' );

/* ========================================================================================================================

Enable Featured Image

======================================================================================================================== */

add_theme_support('post-thumbnails');

/* ========================================================================================================================

Allow SVG in media library

======================================================================================================================== */

function allow_svg( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter( 'upload_mimes', 'allow_svg' );

/* ========================================================================================================================

Remove P tags from images through WYSIWYG

======================================================================================================================== */

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

/* ========================================================================================================================

Remove YOAST Bar for non-admins

======================================================================================================================== */

function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    if(!current_user_can( 'install_themes' ) ) {
        $wp_admin_bar->remove_menu('wpseo-menu');
        remove_meta_box('wpseo_meta', 'page', 'normal');
        remove_meta_box('wpseo_meta', 'post', 'normal');
        remove_meta_box('wpseo_meta', 'custom-post-type-slug', 'normal');
    }
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

/* ========================================================================================================================

Hide frontend toolbar

======================================================================================================================== */

add_filter('show_admin_bar', '__return_false');

/* ========================================================================================================================

Custom image sizes

======================================================================================================================== */

add_action( 'after_setup_theme', 'custom_image_sizes' );
function custom_image_sizes() {
	/* Useful for buckets */
	add_image_size( 'square-480', 480, 480, true );
	add_image_size( 'letterbox-480', 480, 270, true );
	add_image_size( 'skyscraper-300', 300, 462, true );
	/* Hero images */
	add_image_size( 'hero-2000', 2000, 650, true );
	add_image_size( 'hero-1200', 1200, 500, true );
	add_image_size( 'hero-600', 600, 600, true );
}

/* ========================================================================================================================

Hero Picturefill Function

======================================================================================================================== */

function heroPictureFill($sizes, $default) {
    $alt = get_field('h1');
    echo "<picture>
          <!--[if IE 9]><video style='display: none;'><![endif]-->";
    foreach($sizes as $size => $option) {
        $attachment = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), "hero-".$option['imageSize'] );
        $attachment = $attachment['0'];
        echo "<source srcset='$attachment' media='(".$option['mediaQuery'].")'>";
    }
    echo "<!--[if IE 9]></video><![endif]-->";
    echo "<img srcset='$default' alt='$alt'>";
    echo "</picture>";
}

/* ========================================================================================================================

Show ALT tag for images in Media Library (IM request)

======================================================================================================================== */

function wpse_media_extra_column( $cols ) {
$cols["alt"] = "ALT";
return $cols;
}
function wpse_media_extra_column_value( $column_name, $id ) {
    if( $column_name == 'alt' )
        echo get_post_meta( $id, '_wp_attachment_image_alt', true);
}
add_filter( 'manage_media_columns', 'wpse_media_extra_column' );
add_action( 'manage_media_custom_column', 'wpse_media_extra_column_value', 10, 2 );

/* ========================================================================================================================

Options pages

======================================================================================================================== */

if( function_exists('acf_add_options_page') ) {

	$page = acf_add_options_page(array(
		'page_title' 	=> 'Site Specific',
		'menu_title' 	=> 'Site Specific',
		'menu_slug' 	=> 'site-specific',
		'position' 		=> 75,
		'capability' 	=> 'edit_themes',
		'icon_url' 		=> 'dashicons-hammer',
		'redirect' 		=> false
	));

	$page = acf_add_options_page(array(
		'page_title' 	=> 'Marketing',
		'menu_title' 	=> 'Marketing',
		'menu_slug' 	=> 'marketing',
		'position' 		=> 75,
		'capability' 	=> 'edit_themes',
		'icon_url' 		=> 'dashicons-randomize',
		'redirect' 		=> false
	));

}

/* ========================================================================================================================

Address - Stacked

======================================================================================================================== */

function address_stacked() {

	// loop through the rows of data
	while ( have_rows('company_address', 'options') ) : the_row();

	// display a sub field value
	the_sub_field('address_line', 'options');

	echo "<br/>";

	endwhile;

	the_field('company_postcode', 'option');

}

/* ========================================================================================================================

Address - Inline

======================================================================================================================== */

function address_inline() {

	// loop through the rows of data
	while ( have_rows('company_address', 'options') ) : the_row();

	// display a sub field value
	the_sub_field('address_line', 'options');

	echo ",&nbsp;";

	endwhile;

	the_field('company_postcode', 'option');

}

/* ========================================================================================================================

CPT - Portfolio Pages

======================================================================================================================== */

// Register Custom Post Type
function portfolio_post_type() {

	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'      => __( 'Portfolio', 'text_domain' ),
		'all_items'           => __( 'All Portfolio', 'text_domain' ),
		'add_new_item'        => __( 'Add New Portfolio', 'text_domain' ),
		'add_new'             => __( 'New Portfolio', 'text_domain' ),
		'new_item'            => __( 'New Portfolio', 'text_domain' ),
		'edit_item'           => __( 'Edit Portfolio', 'text_domain' ),
		'update_item'         => __( 'Update Portfolio', 'text_domain' ),
		'view_item'           => __( 'View Portfolio', 'text_domain' ),
		'search_items'        => __( 'Search portfolio', 'text_domain' ),
		'not_found'           => __( 'No portfolio found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No portfolio found in Trash', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                => 'portfolio',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Portfolio', 'text_domain' ),
		'description'         => __( 'Portfolio pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-location',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio_post_type', 0 );

/* ========================================================================================================================

Custom Excerpt Length

======================================================================================================================== */

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '';
	} else {
		echo $excerpt;
	}
}


/* ========================================================================================================================

Enable Widgets

======================================================================================================================== */

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'News Sidebar',
		'id'            => 'news_sidebar',
		'before_widget' => '<div class="aside-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


/* ========================================================================================================================

Limit Characters

======================================================================================================================== */

function shorten_string($string, $wordsreturned) {
  $retval = $string;
  $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
  $string = str_replace("\n", " ", $string);
  $array = explode(" ", $string);
  if (count($array)<=$wordsreturned)
  {
    $retval = $string;
  }
  else
  {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array)." ...";
  }
  return $retval;
}


/* ========================================================================================================================

Get Directions Form Shortcode

======================================================================================================================== */

function get_directions() {
	get_template_part('_parts/theme-parts/get-directions');
}
add_shortcode('get-directions', 'get_directions');


/* ========================================================================================================================

Move Yoast lower down the page

======================================================================================================================== */

add_filter( 'wpseo_metabox_prio', function() { return 'low';});


/* ========================================================================================================================

Hide comments

======================================================================================================================== */

function emersonthis_custom_menu_page_removing() {
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'emersonthis_custom_menu_page_removing' );


/* ========================================================================================================================

Replace [...] with ... in excerpt

======================================================================================================================== */

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
