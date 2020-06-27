<?php get_template_part('head'); ?>
</head>

<?php if(!is_front_page()) { $internalClass = 'internal'; } ?>

<body <?php body_class(); ?> <?php body_class($internalClass); ?>>

<div class="wrapper">

	<a class="skip-link screen-reader-text" href="#content">
		<?php// _e( 'Skip to content', 'twentyseventeen' ); ?>
	</a>

	<header class="site-header" role="banner">

		<?php get_template_part( '_parts/header', 'image' ); ?>

			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( '_parts/nav'); ?>
				</div>
			</div>

	</header>

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	// if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
	// 	echo '<div class="single-featured-image-header">';
	// 	echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
	// 	echo '</div><!-- .single-featured-image-header -->';
	// endif;
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
