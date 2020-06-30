<?php get_header(); ?>
<?php get_template_part('_parts/hero'); ?>

<div id="content" class="content-area">
	<main class="wrapper main" role="main">

	<div class="container">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <div class="wrapper section">
        <div class="content">
          <h2><?php the_title(); ?></h2>
          <div class="copy">
            <p class="designed-for"><?php the_field('designed_for_text'); ?></p>

            <?php the_content(); ?>

            <a class="btn" href="<?php the_field('website_link'); ?>" target="_blank">
              <?php the_field('link_text'); ?>
            </a>

          </div>
        </div>
        <!-- Gallery -->
        <div class="portfolio-gallery">
          <?php the_field('gallery'); ?>
        </div>
      </div>



    <?php endwhile; ?>
  </div>

  </main>
</div>

<?php get_footer(); ?>

<?php if (is_singular('portfolio')) {   //  displaying a single blog post ?>
<script type="text/javascript">
  jQuery("a[href$='my-work/']").parent().addClass('current-menu-item');
</script>
<?php } ?>
