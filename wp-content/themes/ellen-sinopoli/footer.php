<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

	<div class="wrapper" id="wrapper-footer">

		<div class="<?php echo esc_attr( $container ); ?>">

			<footer class="site-footer" id="colophon">
				<div class="row no-gutters" style="margin-bottom: 60px;">
					<div class="col address">
						<img src="/wp-content/themes/ellen-sinopoli/images/logo-white.png" width="426" height="96" alt="Ellen Sinopoli Dance Center"/>
						<p>Ellen Sinopoli Dance Company<br>PO Box 775<br>Troy , NY 12181</p>
						<p><a href="tel:5184081341">(518) 408-1341</a></p>
					</div><!-- .address -->
					<div class="col quicklinks">
						<h6>Quick Links</h6>
						<?php wp_nav_menu( array( 'theme_location' => 'footer_quick_links' ) ); ?>
					</div><!-- .address -->
					<div class="col instagram">
						<h6>Instagram Feed</h6>
						<?php echo do_shortcode('[instagram-feed]'); ?>
					</div><!-- .address -->
					<div class="col subscribe">
						<h6>Subscribe</h6>
						<?php echo do_shortcode('[gravityforms id="1"]'); ?>
						<div class="row no-gutters social">
							<a href="https://twitter.com/sinopolidances?lang=en" target="_blank"><i class="last fab fa-facebook-square"></i></a>
							<a href="https://www.facebook.com/Ellen-Sinopoli-Dance-Company-247603627812/?eid=ARDJXlvHgFtey_75C3Il7JjFHSb0vqotocbguseo2Fixl06FgEuoWVd2RzcWuR77D96L5gO_s17ik4r3" target="_blank"><i class="fab fa-twitter-square"></i></a>
							<a href="https://www.instagram.com/ellensinopolidancecompany/?hl=en" target="_blank"><i class="fab fa-instagram"></i></a>
						</div>
					</div><!-- .address -->
				</div><!-- row end -->
				<div class="row no-gutters">
					<div class="col">
						<p class="credit">Photo Credit: Gary Gold Photography</p>
						<p class="legal">&copy; <?php echo date('Y'); ?> Ellen Sinopoli Dance Company. All Right Reserved.</p>
					</div><!-- .col -->
				</div><!-- .row -->
			</footer><!-- #colophon -->
		</div><!-- container end -->
	</div><!-- wrapper end -->
</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

