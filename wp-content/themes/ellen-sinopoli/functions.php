<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'after_setup_theme', 'register_custom_nav_menus' );
function register_custom_nav_menus() {
	register_nav_menus( array(
		'header_top_navigation' => 'Header Top Navigation',
		'header_lower_navigation' => 'Header Lower Navigation',
		'footer_quick_links' => 'Footer Quick Links',
	) );
}

function videoHighlight() {
		
	global $post;
    $args = array( 'posts_per_page' => -1, 'post_type' => 'video', 'post_status' => 'publish');
    $videos = get_posts( $args );
	$run=1;
    foreach ( $videos as $video ) : setup_postdata( $video );
        if ($run == 1 ) {
            // this is where we'll print the large video
			echo '<div class="row large-video">';
			$videoLink = get_post_meta( $video->ID, $key = 'video_thumbnail', true);
			echo '<div class="col video-box" style="background: url(\'' . $videoLink[guid] . '\')">';
				echo '<a href="' . get_post_meta( $video->ID, $key = 'video_link', true) . '" target="_blank"><i class="fab fa-youtube"></i></a>';
				echo '<h2>Play Video</h2>';
			echo '</div><!-- .col -->';
			echo '</div><!-- .large-video -->';
        }
        else {
			if ($run == 2 ) {
				echo '<div class="row video-thumbnails">';
			}
			$videoLink = get_post_meta( $video->ID, $key = 'video_thumbnail', true);
			echo '<a href="' . get_post_meta( $video->ID, $key = 'video_link', true) . '" target="_blank">';
			echo '<div class="col thumbnail-' . $run . ' " style="background-image: url(\'' . $videoLink[guid] . '\')"></div>';
			echo '</a>';
        }
		
        $run++;
    endforeach;
	echo '</div><!-- .video-thumbnails  -->';
	
    wp_reset_postdata();
	
}
add_shortcode( 'video-highlight', 'videoHighlight' );
