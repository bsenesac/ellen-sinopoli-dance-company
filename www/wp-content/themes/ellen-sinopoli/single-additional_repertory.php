<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<link rel='stylesheet' id='tribe-events-full-calendar-style-css'  href='http://sinopolidances.dev.briansenesac.com/wp-content/plugins/the-events-calendar/src/resources/css/tribe-events-full.min.css?ver=5.0.1' type='text/css' media='all' />


<div id="single-wrapper" class="wrapper single-tribe_events">

	<div class="<?php echo esc_attr( $container ); ?>" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main id="tribe-events-pg-template" class="tribe-events-pg-template">
				<?php while ( have_posts() ) : the_post(); ?>
				
					<div id="tribe-events" class="tribe-no-js" data-live_ajax="0" data-datepicker_format="1" data-category="" data-featured="">
						<div id="tribe-events-content" class="tribe-events-single">
							<h1><?php echo get_the_title(); ?></h1>

							<div id="post-123" class="post-123 tribe_events type-tribe_events status-publish has-post-thumbnail hentry tribe_events_cat-performances-and-repertory cat_performances-and-repertory">
								<?php
								if (get_the_post_thumbnail() != '') { ?>
									<div class="tribe-events-event-image">
										  <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
									</div>
								<?php } ?>

								<!-- Event content -->
								<div class="tribe-events-single-event-description tribe-events-content">
									<?php echo the_content(); ?>
								</div>

								<div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
									<div class="tribe-events-meta-group tribe-events-meta-group-details"><br>
										<h2 class="tribe-events-single-section-title"> Details </h2>
										  <dl>
											  
											  <?php 
											  if (get_post_meta( get_the_ID(), 'date_premiered', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Premiered: </dt>';
													echo'<dd>';
													echo get_post_meta( get_the_ID(), 'date_premiered', true);
													echo '</dd>';
												}
											  	if (get_post_meta( get_the_ID(), 'choreographer', true) != '') {
													echo '<dt class="tribe-events-start-time-label">Choreographer: </dt>';
													echo '<dd>';
													echo get_post_meta( get_the_ID(), 'choreographer', true);
													echo '</dd>';
												}
											  	if (get_post_meta( get_the_ID(), 'composer', true) != '') {
													echo '<dt class="tribe-events-start-time-label">Composer: </dt>';
													echo '<dd>';
													echo get_post_meta( get_the_ID(), 'composer', true);
													echo '</dd>';
												}
											  	if (get_post_meta( get_the_ID(), 'music', true) != '') {
													echo '<dt class="tribe-events-start-time-label">Music: </dt>';
													echo '<dd>';
													echo get_post_meta( get_the_ID(), 'music', true);
													echo '</dd>';
												}
											  if (get_post_meta( get_the_ID(), 'poetry', true) != '') {
													echo '<dt class="tribe-events-start-time-label">Poetry: </dt>';
													echo '<dd>';
													echo get_post_meta( get_the_ID(), 'poetry', true);
													echo '</dd>';
												}
											  	if (get_post_meta( get_the_ID(), 'costume_design', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Costume Design: </dt>';
													echo'<dd>';
													echo get_post_meta( get_the_ID(), 'costume_design', true);
													echo'</dd>';
												}
											  if (get_post_meta( get_the_ID(), 'dancers', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Dancers: </dt>';
													echo'<dd>';
													echo get_post_meta( get_the_ID(), 'dancers', true);
													echo'</dd>';
												}
												if (get_post_meta( get_the_ID(), 'collaborating_artists', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Collaborating Artists: </dt>';
													echo'<dd>';
													echo get_post_meta( get_the_ID(), 'collaborating_artists', true);
													echo'</dd>';
												}
												if (get_post_meta( get_the_ID(), 'video_link', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Video Link: </dt>';
													echo'<dd>';
													$link = get_post_meta( get_the_ID(), 'video_link', true);
													echo '<a href="' . $link . '" target="_blank">View on Youtube</a>';
													echo'</dd>';
												}
												if (get_post_meta( get_the_ID(), 'press_quote', true) != '') {
													echo'<dt class="tribe-events-start-time-label">Press Quote: </dt>';
													echo'<dd>';
													echo get_post_meta( get_the_ID(), 'press_quote', true);
													echo'</dd>';
												}
											  ?>											  
										  </dl>
									</div>
								</div>
							</div>
						</div> <!-- #post-x -->
					</div><!-- #tribe-events-content -->
				<?php endwhile; // end of the loop. ?>
			</main> 
			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
