<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

        <main class="site-main" id="main">

            <div class="row error-404 not-found">
                <div class="col-sm-8">
                    <h1>Shoot!</h1>
                    <h2>Well, this is unexpected...</h2>
                    <p>The page that you are looking for doesn't seem to be found. Don't worry though. We'll get you to the right place. Please use our website search below to search for what you were looking for.</p>
                    <?php get_search_form(); ?>
                </div>
                <div class="col-sm-4">
                    <img src="/wp-content/themes/ellen-sinopoli/images/404.jpg"
                </div>
            </div>

        </main>
			
	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer(); ?>
