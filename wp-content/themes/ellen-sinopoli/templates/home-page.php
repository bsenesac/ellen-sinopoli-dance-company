<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

    <div id="carousel" class="hero carousel slide" data-ride="carousel">
        <div class="carousel-inner container">
			<?php
			$run = 1;
			
			global $post;
			$args = array( 'posts_per_page' => -1, 'post_type' => 'homepage_hero', 'post_status' => 'publish');
			$heros = get_posts( $args );
		
			foreach ( $heros as $hero ) : setup_postdata( $hero );
				if ($run == 1 ) {
					echo '<div class="carousel-item active">';
				}
				else {
					echo '<div class="carousel-item">';
				}
					echo '<div class="row no-gutters">';
						echo '<div class="col text">';
							echo '<h2>' . get_the_title($hero->ID) . '</h2>';
							echo '<p>' . get_post_meta( $hero->ID, $key = 'hero_text', true ) . '</p>';
							echo '<a class="btn btn-primary white" href="' . get_post_meta( $hero->ID, $key = 'button_link', true) . '">' . get_post_meta( $hero->ID, $key = 'button_text', true) . '</a>';
						echo '</div><!-- .text -->';
						echo '<div class="col image">';
							$imageURL = get_post_meta( $hero->ID, $key = 'hero_image', true);
							$imageURL = $imageURL['guid'];
							if($imageURL != NULL) {
								echo '<img src="' . $imageURL . '" alt="' . get_the_title($hero->ID) . '" height="895" width="936"/>';
							}
							else {
								echo '<img src="/wp-content/themes/ellen-sinopoli/images/hero-graphic.png" alt="' . get_the_title($hero->ID) . '" height="895" width="936"/>';
							}
						echo '</div><!-- .image -->';
					echo '</div><!-- .row -->';
				echo '</div><!-- .carousel-item -->';	
				$run++;
			endforeach; 
			wp_reset_postdata();
			
			
		?>
        </div><!-- .carousel-inner -->
		<?php
		$run = $run - 1;
		$counter = 0;
		echo '<ul class="hero-bullets">';
		while ($counter < $run) {
			if ($counter == 0 ) {
				echo '<li data-target="#carousel" data-slide-to="' . $counter . '" class="active"><span class="underline"></span><span class="bullet-text">0' . $counter . '</span></li>';
			}
			else {
				 echo '<li data-target="#carousel" data-slide-to="' . $counter . '"><span class="underline"></span><span class="bullet-text">0' . $counter . '</span></li>';
			}
			$counter++;
		}
		
		echo '</ul>';
		?>
    </div><!-- .hero -->


	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php the_content(); ?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>
