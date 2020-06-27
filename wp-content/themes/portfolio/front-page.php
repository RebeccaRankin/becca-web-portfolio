<?php get_header(); ?>
<?php get_template_part('_parts/hero'); ?>

<div id="content" class="content-area">
	<main class="wrapper main" role="main">

	<div class="container">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <!-- Section 1 -->
      <div class="wrapper section section1">
        <div class="content">
          <h2>About Me</h2>
          <div class="copy">
            <?php the_content(); ?>

            <?php if(have_rows('about_button')): while (have_rows('about_button')): the_row(); ?>
              <a class="btn" href="<?php the_sub_field('button_link'); ?>">
                <?php the_sub_field('button_text'); ?>
              </a>
            <?php endwhile;
          endif; ?>

          </div>
        </div>
        <?php
      		$image = get_field('about_image');
      		if( !empty($image) ):
      		// vars
      		$url = $image['url'];
      		// thumbnail
      		$size = 'meduim';
      		$thumb = $image['sizes'][ $size ];
      		?>
          <img src="<?php echo $url; ?>"/>
        <?php endif; ?>
      </div>

      <!-- Section 2 -->
      <div class="wrapper section section2">
        <div class="content">
          <h2>My Portfolio</h2>
          <div class="copy">
            <?php the_field('portfolio_text'); ?>

              <?php if(have_rows('portfolio_button')): while (have_rows('portfolio_button')): the_row(); ?>
                <a class="btn" href="<?php the_sub_field('button_link'); ?>">
                  <?php the_sub_field('button_text'); ?>
                </a>
              <?php endwhile;
            endif; ?>

          </div>
        </div>
        <?php
      		$image = get_field('portfolio_image');
      		if( !empty($image) ):
      		// vars
      		$url = $image['url'];
      		// thumbnail
      		$size = 'meduim';
      		$thumb = $image['sizes'][ $size ];
      		?>
          <img src="<?php echo $url; ?>"/>
        <?php endif; ?>
      </div>

      <!-- Section 3 -->
      <div class="wrapper section section3">
        <div class="content">
          <h2>Get In Touch</h2>
          <div class="copy">
            <?php the_field('contact_text'); ?>

            <?php if(have_rows('contact_button')): while (have_rows('contact_button')): the_row(); ?>
              <a class="btn" href="<?php the_sub_field('button_link'); ?>">
                <?php the_sub_field('button_text'); ?>
              </a>
            <?php endwhile;
          endif; ?>

          </div>
        </div>
        <?php
      		$image = get_field('contact_image');
      		if( !empty($image) ):
      		// vars
      		$url = $image['url'];
      		// thumbnail
      		$size = 'meduim';
      		$thumb = $image['sizes'][ $size ];
      		?>
          <img src="<?php echo $url; ?>"/>
        <?php endif; ?>
      </div>

    <?php endwhile; ?>
  </div>

  </main>
</div>

<?php get_footer(); ?>
