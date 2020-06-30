<?php
$args = array(
  'post_type'   => 'portfolio',
  'post_status' => 'publish',
  'posts_per_page' => -1,
	'order' => 'DES',
  // 'tax_query'   => array(
  // 	array(
  // 		'taxonomy' => 'testimonial_service',
  // 		'field'    => 'slug',
  // 		'terms'    => 'diving'
  // 	)
  // )
 );

$portfolio = new WP_Query( $args );
if( $portfolio->have_posts() ) :
?>
  <div class="projects">
    <?php
      while( $portfolio->have_posts() ) :
        $portfolio->the_post();
        ?>
          <div class="project copy">
            <!-- <div class=""> -->
              <h3><?php the_title(); ?></h3>
              <img src="<?php the_post_thumbnail_url(); ?>"/>
              <div class="content">
                <?php //the_content(); ?>
                <?php the_excerpt(); ?>
              </div>
              <p class="designed-for"><?php the_field('designed_for_text'); ?></p>
              <a class="btn" href="<?php the_permalink(); ?>">Find out more</a>
            <!-- </div> -->

          </div>
        <?php
      endwhile;
      wp_reset_postdata();
    ?>
  </div>
<?php
else :
  esc_html_e( 'No testimonials in the diving taxonomy!', 'text-domain' );
endif;
?>
