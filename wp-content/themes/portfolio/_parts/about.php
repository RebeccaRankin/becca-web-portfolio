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
