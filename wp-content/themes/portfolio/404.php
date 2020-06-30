<?php get_header(); ?>
<?php get_template_part('_parts/hero'); ?>

<div id="content" class="content-area">
	<main class="wrapper main" role="main">

	<div class="container">

    <div class="wrapper section">

      <div class="copy">

        <h2>404 Error</h2>

        <p>Sorry - the page you are looking for cannot be found. Please click <a href="<?php echo get_site_url();?>">here</a> to return home.</p>

        <a class="btn" href="<?php echo get_site_url();?>">Return home</a>

      </div>

    </div>

  </div>

  </main>
</div>

<?php get_footer(); ?>
