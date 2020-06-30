<div class="wrapper section section1">
  <div class="content">
    <h2>Contact</h2>
    <div class="copy">
      <?php the_content(); ?>

        <a class="btn" href="mailto:rebeccarankin002@gmail.com">
          Send me an email
        </a>

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
