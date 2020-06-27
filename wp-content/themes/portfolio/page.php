<?php get_header(); ?>
<?php get_template_part('_parts/hero'); ?>

<div id="content" class="content-area">
	<main class="wrapper main" role="main">

	<div class="container">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php // the_content(); ?>

      <?php if(is_page('my-work')) { get_template_part('_parts/my-work'); } ?>
      <?php if(is_page('about-me')) { get_template_part('_parts/about'); } ?>

    <?php endwhile; ?>
  </div>

  </main>
</div>

<?php get_footer(); ?>
