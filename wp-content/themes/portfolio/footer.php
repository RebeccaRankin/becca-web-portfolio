<footer class="footer">

  <div class="footer-main">

    <div class="footer-nav">
      <?php get_template_part( '_parts/nav'); ?>
    </div>

  </div>

  <div class="footer-bottom">

    <p>&copy; Becca Rankin <?php echo date('Y'); ?>. All Rights Reserved</p>

  </div>

</footer>

	<!-- Back to top arrow -->
	<div class="back-top-wrap">
	    <p id="back-top">
	        <a><i class="fa fa-arrow-up fa-2x"></i> Top</a>
	    </p>
	</div>

	<div class="overlay"></div>

</div><!-- wrapper -->

<?php wp_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/_js/scripts/lazysizes.min.js" async=""></script>

</body>
</html>
