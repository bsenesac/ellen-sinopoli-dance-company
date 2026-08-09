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
						<p><a href="tel:5185277008">(518) 527-7008</a></p>
					</div><!-- .address -->
					<div class="col quicklinks">
						<h6>Quick Links</h6>
						<?php wp_nav_menu( array( 'theme_location' => 'footer_quick_links' ) ); ?>
					</div><!-- .address -->
					<div class="col instagram">
						<h6>Instagram Feed</h6>
						<?php echo do_shortcode('[instagram-feed feed=3]'); ?>
					</div><!-- .address -->
					<div class="col subscribe">
						<h6>Subscribe</h6>
						<?php echo do_shortcode('[gravityforms id="1"]'); ?>
					</div><!-- .address -->
				</div><!-- row end -->
				<div class="row no-gutters">
					<div class="col">
						<p class="credit">Photo Credit: Gary Gold Photography</p>
						<div class="logos">
							<ul>
								<?php foreach ( ellen_get_footer_supporting_logos() as $supporting_logo ) :
									$image_url = ! empty( $supporting_logo['image_id'] ) ? wp_get_attachment_image_url( $supporting_logo['image_id'], 'full' ) : '';
									$image_url = $image_url ? $image_url : ( isset( $supporting_logo['image_url'] ) ? $supporting_logo['image_url'] : '' );
									if ( ! $image_url ) { continue; }
									$link_url = ! empty( $supporting_logo['link_url'] ) ? $supporting_logo['link_url'] : '';
								?>
									<li>
										<?php if ( $link_url ) : ?><a href="<?php echo esc_url( $link_url ); ?>"<?php if ( ! empty( $supporting_logo['new_tab'] ) ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>><?php endif; ?>
										<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $supporting_logo['alt'] ); ?>"/>
										<?php if ( $link_url ) : ?></a><?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
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
