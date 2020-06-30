<?php

if ( is_front_page() ) { ?>

	<section class="wrapper hero bgcover">

			<?php

			/* This uses the featured image as a background. Takes the featured image, and applies the different sizes to varying breakpoints. */

			$thumb_id = get_post_thumbnail_id();

			$thumb_url_array_small = wp_get_attachment_image_src($thumb_id, 'hero-600', true);
			$thumb_url_small = $thumb_url_array_small[0];

			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'hero-1200', true);
			$thumb_url = $thumb_url_array[0];

			$thumb_url_array_large = wp_get_attachment_image_src($thumb_id, 'hero-2000', true);
			$thumb_url_large = $thumb_url_array_large[0];

			if ( $thumb_id ) : ?>

				<style scoped>
					.hero:after {
					    background-image: url(<?php echo $thumb_url_small; ?>);
					}
				    @media (min-width: 600px) {
						.hero:after {
					       background-image: url(<?php echo $thumb_url; ?>);
					    }
				    }
				    @media (min-width: 1200px) {
						.hero:after {
					      background-image: url(<?php echo $thumb_url_large; ?>);
					    }
				    }
				</style>

			<?php else : ?>

				<style scoped>
					.hero {
				      background-color: #eee;
				    }
				</style>

			<?php endif; ?>

		<div class="container">

			<div class="hero-content">

				<?php // Check if the Hero Heading option is used for the page, else display the normal page title
				if (get_field('hero_heading')) : ?>
					<h2><?php the_field('hero_heading'); ?></h2>
				<?php else : ?>
					<h2><?php single_post_title(); ?></h2>
				<?php endif; ?>

				<?php // Check if the Hero Subtext has been filled out for this page, else show "Call us on..."
				if (get_field('hero_subtext')) : ?>
					<p><?php the_field('hero_subtext'); ?></p>
				<?php else : ?>
					<p><span class="ld-calltag"><?php the_field('default_phone_tag', 'option'); ?></span> <span class="ld-phonenumber"><?php the_field('default_phone_number', 'option'); ?></span></p>
				<?php endif; ?>

				<?php if (get_field('hero_ctas', 'options')) : ?>

					<?php while( has_sub_field('hero_ctas', 'options') ): ?>

					 		<a class="<?php the_sub_field('cta_class', 'options') ?>" href="<?php the_sub_field('cta_link', 'options') ?>" <?php the_sub_field('ga_event_code'); ?>>
					 			<?php the_sub_field('cta_text', 'options') ?>
					 		</a>

					<?php endwhile; ?>

				<?php endif; ?>

			</div>

		</div>

	</section>

<?php  } elseif (is_404()) { ?>
	<section class="wrapper hero bgcover">

			<?php	if ( $thumb_id ) : ?>

				<style scoped>
					.hero:after {
					    background-image: url(<?php echo $thumb_url_small; ?>);
					}
				    @media (min-width: 600px) {
						.hero:after {
					       background-image: url(<?php echo $thumb_url; ?>);
					    }
				    }
				    @media (min-width: 1200px) {
						.hero:after {
					      background-image: url(<?php echo $thumb_url_large; ?>);
					    }
				    }
				</style>

			<?php else : ?>

				<style scoped>
					.hero {
				      background-color: #eee;
				    }
				</style>

			<?php endif; ?>

		<div class="container">

			<div class="hero-content">

				<h2>Sorry page not found</h2>

				<p>404 Error</p>

			</div>

		</div>

	</section>
<?php  } else { ?>

	<?php /* Internal page hero */ ?>

	<section class="wrapper hero bgcover">

			<?php

			/* This uses the featured image as a background. Takes the featured image, and applies the different sizes to varying breakpoints. */

			$thumb_id = get_post_thumbnail_id();

			$thumb_url_array_small = wp_get_attachment_image_src($thumb_id, 'hero-600', true);
			$thumb_url_small = $thumb_url_array_small[0];

			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'hero-1200', true);
			$thumb_url = $thumb_url_array[0];

			$thumb_url_array_large = wp_get_attachment_image_src($thumb_id, 'hero-2000', true);
			$thumb_url_large = $thumb_url_array_large[0];

			if ( $thumb_id ) : ?>

				<style scoped>
					.hero:after {
					    background-image: url(<?php echo $thumb_url_small; ?>);
					}
				    @media (min-width: 600px) {
						.hero:after {
					       background-image: url(<?php echo $thumb_url; ?>);
					    }
				    }
				    @media (min-width: 1200px) {
						.hero:after {
					      background-image: url(<?php echo $thumb_url_large; ?>);
					    }
				    }
				</style>

			<?php else : ?>

				<style scoped>
					.hero {
				      background-color: #eee;
				    }
				</style>

			<?php endif; ?>

		<div class="container">

			<div class="hero-content">

				<?php // Check if the Hero Heading option is used for the page, else display the normal page title
				if (get_field('hero_heading')) : ?>
					<h2><?php the_field('hero_heading'); ?></h2>
				<?php else : ?>
					<h2><?php the_title(); ?></h2>
				<?php endif; ?>

				<?php // Check if the Hero Subtext has been filled out for this page, else show "Call us on..."
				if (get_field('hero_subtext')) : ?>
					<p><?php the_field('hero_subtext'); ?></p>

				<?php else : ?>

				<?php endif; ?>

			</div>

		</div>

	</section>

<?php  } ?>
