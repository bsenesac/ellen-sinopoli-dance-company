<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">	
	<?php wp_head(); ?>
    <script src="https://kit.fontawesome.com/ac0cab080b.js"></script>
	<link href="/wp-content/themes/ellen-sinopoli/css/theme.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,800&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>
		<?php 
			if ( is_front_page() ) {
				echo '<nav class="navbar navbar-expand-md navbar-light bg-primary">';
			}
			else {
				echo '<nav class="navbar navbar-expand-md navbar-dark bg-primary">';
			}
		?>
		
			<div class="row">
				<div class="col-4">
			    	<a href="/">
						<?php 
							if ( is_front_page() ) {
								echo '<img src="/wp-content/themes/ellen-sinopoli/images/logo-black.png" width="426" height="96" alt="Ellen Sinopoli Dance Center"/>';
							}
							else {
								echo '<img src="/wp-content/themes/ellen-sinopoli/images/logo-white.png" width="426" height="96" alt="Ellen Sinopoli Dance Center"/>';
							}
						?>
						
					</a>
				</div><!-- .col-4 -->
			  	<div class="col">
					<div class="row upper-nav">
						<div class="col">
							<?php wp_nav_menu( array( 'theme_location' => 'header_top_navigation' ) ); ?>
							<a href="https://twitter.com/sinopolidances?lang=en" target="_blank"><i class="last fab fa-facebook-square"></i></a>
							<a href="https://www.facebook.com/Ellen-Sinopoli-Dance-Company-247603627812/?eid=ARDJXlvHgFtey_75C3Il7JjFHSb0vqotocbguseo2Fixl06FgEuoWVd2RzcWuR77D96L5gO_s17ik4r3" target="_blank"><i class="fab fa-twitter-square"></i></a>
							<a href="https://www.instagram.com/ellensinopolidancecompany/?hl=en" target="_blank"><i class="fab fa-instagram"></i></a>
							<a href="#search" target="_blank"><i class="fas fa-search"></i></a>
						</div><!-- .col -->
					</div><!-- .upper-nav -->
					
					<div class="row lower-nav">
						<div class="col">
							<?php wp_nav_menu( array( 'theme_location' => 'header_lower_navigation' ) ); ?>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
							<span class="navbar-toggler-icon"></span>
							</button>
							
							<!-- The WordPress Menu goes here -->
							<?php wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarNavDropdown',
									'menu_class'      => 'navbar-nav ml-auto',
									'fallback_cb'     => '',
									'menu_id'         => 'main-menu',
									'depth'           => 2,
									'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
								)
							); ?>
						</div><!-- .col -->
					</div><!-- .row .lower-nav -->
					
				</div><!-- .col-8 -->		  
			</div><!-- .container -->
			

				

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
