<?php
/**
 * The template for displaying all pages.
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
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="row entry-header-container no-gutters">
            <header class="entry-header col">
                <div class="breadcrumb">
                    <?php echo bcn_display(); ?>
                </div>
                <h2 class="entry-sub-title"><?php echo get_field('sub_title');?></h2>
                <h1 class="entry-title"><?php echo get_the_title(); ?></h1>
            </header>
        </div><!-- .row -->	
	
		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
			<main class="site-main" id="main">
				<div class="row">
					<div class="col">
						<?php the_content(); ?>
					</div>
				</div><!-- .row -->	
		</main><!-- #main -->	
	</div><!-- #content -->
	<?php endwhile; // end of the loop. ?>
</div><!-- #page-wrapper -->

<?php get_footer(); ?>
