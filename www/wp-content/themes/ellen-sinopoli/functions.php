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
		
	$today = date( 'Y-m-d' );
    $args = array( 	'posts_per_page' => 5, 
				  	'post_type'	=> 'additional_repertory',
				  	'post_status' => 'publish',
				 	'order' => 'DESC',
				  	'orderby' 	=> 'meta_value_num',
				  	'meta_key' 	=> 'what_position',
				    'meta_type' =>	'NUMERIC',
				  	'meta_query' => array(
					   array(
						   'key' => 'feature_video',
						   'value' => true,
						   'compare' => '='
					   	)
					)
				 );
    $videos = get_posts( $args );
	$run=1;
	$closingNeeded = 'false';
    foreach ( $videos as $video ) : setup_postdata( $video );	
		
		$videoLink = get_post_meta( $video->ID, $key = 'video_link', true);
		$videoThumb = wp_get_attachment_url( get_post_thumbnail_id($video->ID), 'full' );
		if ($videoLink == '') {
			continue;
		}
        // first run we'll print the large area
		if ($run == 1 ) {
            // this is where we'll print the large video
			echo '<div class="row large-video">';
			echo '<div class="col video-box" style="background: url(\'' . $videoThumb . '\')">';
				echo '<a href="' . $videoLink . '" target="_blank"><i class="fab fa-youtube"></i></a>';
				echo '<h2>Play Video</h2>';
			echo '</div><!-- .col -->';
			echo '</div><!-- .large-video -->';
        }
	
		// the rest we'll print thumbnails
        else {
			// print the thubnail container
			if ($run == 2 ) {
				echo '<div class="row video-thumbnails">';
				echo '<ul>';
				$closingNeeded = 'true';
			}
			echo '<li><a href="' . $videoLink . '" target="_blank">';
			echo '<div class="col thumbnail-' . $run . ' " style="background-image: url(\'' . $videoThumb . '\')"><i class="fab fa-youtube"></i></div>';
			echo '<div class="title">' . get_the_title($video->ID) . '</div>';
			echo '</a></li>';
        }
        $run++;
    endforeach;
	
	if ($closingNeeded == 'true') {
        echo '</ul>';
        echo '</div><!-- .video-thumbnails -->';
    }
}
add_shortcode( 'video-highlight', 'videoHighlight' );

function eventHighlight() {
	
	$events = tribe_get_events( [ 
	   'posts_per_page' => 1, 
	   'start_date'     => 'now',
	   'featured'       => true,
	] );
	
    // Loop through the events, displaying the title and content for each
	foreach ( $events as $event ) :
		
		echo '<div class="row site-width">';
		echo '<div class="col image">';
	
		$eventThumb = wp_get_attachment_url( get_post_thumbnail_id($event->ID), 'full' );
		echo '<img src="' . $eventThumb . '" alt="' . $event->post_title . '"/>';
	
		
		echo '</div><!-- .image -->';
		echo '<div class="col col-lg-offset-2 info">';
	   		echo '<h2>' . $event->post_title . '</h2>';
			echo '<div class="event-time">';
				echo '<div class="day">';
					echo date("d", strtotime(get_post_meta($event->ID)['_EventStartDate'][0]));
				echo '</div><!-- .time -->'	;
				echo '<div class="month">';
					echo date("F Y", strtotime(get_post_meta($event->ID)['_EventStartDate'][0]));
				echo '</div><!-- .month -->';
			echo '</div><!-- .event-time -->';
			echo '<div class="event-info" style="width: 100%;">';
				echo $event->post_content;
				
			echo '</div><!-- .event-info -->';
			echo '<div class="event-link">';
				echo '<a class="btn btn-primary" href="' . get_the_permalink($event->ID) . '">View Event</a>';
			echo '</div><!-- .event-link -->';
		echo '</div><!-- .info -->';
		echo '</div><!-- . row -->';		
	endforeach;
}
add_shortcode( 'event-highlight', 'eventHighlight' );

function reviewHighlight() {
		
	$today = date( 'Y-m-d' );
    $args = array( 	'posts_per_page' => 3, 
				  	'post_type' => 'review',
				  	'post_status' => 'publish',
				  	'orderby' => 'date',
            		'order'   => 'DESC'
				 );
    $reviews = get_posts( $args );
	$run=1;
    foreach ( $reviews as $review ) : setup_postdata( $review );
		if (($run == 1 ) || ($run == 3)) {
            // this is where we'll print the large review
			echo '<div class="row individual-review left">';
				echo '<div class="col-sm-4 review-image">';
					$reviewThumb = get_post_meta($review->ID, 'image', true);
					echo '<img src="' . $reviewThumb['guid'] . '" alt="' . $review->post_title . '"/>';
				echo '</div><!-- .col -->';
				echo '<div class="col-sm-8 review-box">';
					echo '<p class="date">' . date('d M, Y', strtotime($review->post_date)) . '</p>';
					echo '<p class="title">' . get_the_title($review->ID) . '</p>';
					$reviewExceprt = get_the_content($review->ID);
					echo '<p class="content">' . substr($reviewExceprt, 0, 350) . '...</p>';
					echo '<a class="btn btn-primary" href="' . get_the_permalink($review->ID) . '">Full Review</a>';
				echo '</div><!-- .col -->';
			echo '</div><!-- .individual-review -->';
        }
		else {
			echo '<div class="row individual-review right">';
				echo '<div class="col-sm-8 review-box">';
					echo '<p class="date">' . date('d M, Y', strtotime($review->post_date)) . '</p>';
					echo '<p class="title">' . get_the_title($review->ID) . '</p>';
					$reviewExceprt = get_the_content($review->ID);
					echo '<p class="content">' . substr($reviewExceprt, 0, 350) . '...</p>';
					echo '<a class="btn btn-primary" href="' . get_the_permalink($review->ID) . '">Full Review</a>';
						
				echo '</div><!-- .col -->';
				echo '<div class="col-sm-4 review-image">';
					$reviewThumb = get_post_meta($review->ID, 'image', true);
					echo '<img src="' . $reviewThumb['guid'] . '" alt="' . $review->post_title . '"/>';
				echo '</div><!-- .col -->';
			echo '</div><!-- .individual-review -->';		
        }
	
		
        $run++;
    endforeach;
}
add_shortcode( 'review-highlight', 'reviewHighlight' );

function reviewHighlightAll() {
		
	$today = date( 'Y-m-d' );
    $args = array( 	'posts_per_page' => -1, 
				  	'post_type' => 'review',
				  	'post_status' => 'publish',
				  	'orderby' => 'date',
            		'order'   => 'DESC'
				 );
    $reviews = get_posts( $args );
    foreach ( $reviews as $review ) : setup_postdata( $review );
      echo '<div class="row individual-review review-page">';
          echo '<div class="col-sm-8 review-box">';
              echo '<h3 class="title">' . get_the_title($review->ID) . '</h3>';
			  echo '<p class="date"><strong>Posted: </strong>' . date('d M, Y', strtotime($review->post_date)) . '</p>';
              $reviewExceprt = get_the_content($review->ID);
              echo '<p class="content">' . substr($reviewExceprt, 0, 350) . '...</p>';
              echo '<a class="btn btn-primary" href="' . get_the_permalink($review->ID) . '">Full Review</a>';

          echo '</div><!-- .col -->';
          echo '<div class="col-sm-4 review-image">';
              $reviewThumb = get_post_meta($review->ID, 'image', true);
              echo '<img src="' . $reviewThumb['guid'] . '" alt="' . $review->post_title . '"/>';
          echo '</div><!-- .col -->';
      echo '</div><!-- .individual-review -->';		
    endforeach;
}
add_shortcode( 'all-reviews', 'reviewHighlightAll' );


function artistHighlight() {
		
	$today = date( 'Y-m-d' );
    $args = array( 	'posts_per_page' => -1, 
				  	'post_type' => 'artist',
				  	'post_status' => 'publish',
				  	'order'     => 'ASC',
				  	'meta_key' => 'display_order',
					'orderby'   => 'meta_value_num'
					
				 );
    $artists = get_posts( $args );
	$run=1;
    foreach ( $artists as $artist ) : setup_postdata( $artist );
        echo '<div class="row individual-artist">';
            echo '<div class="col-4 artist-image">';
                $headShot = get_post_meta($artist->ID, 'headshot', true);
                //print_r($headShot);
                echo '<img src="' . $headShot['guid'] . '" alt="' . get_post_meta($artist->ID, 'first_name', true) . '  ' . get_post_meta($artist->ID, 'last_name', true) . '"/>';
            echo '</div><!-- .col -->';
            echo '<div class="col-8 artist-box">';
                echo '<p class="title"><strong>' . get_post_meta($artist->ID, 'first_name', true) . '  ' . get_post_meta($artist->ID, 'last_name', true) . '</strong></p>';
                echo '<p class="position">' . get_post_meta($artist->ID, 'position', true) . '</p>';
                $artistBio = get_post_meta($artist->ID, 'bio', true);
                echo '<p class="content">' . $artistBio. '</p>';
            echo '</div><!-- .col -->';
        echo '</div><!-- .individual-artist -->';
    endforeach;
}
add_shortcode( 'artist-highlight', 'artistHighlight' );

function upcomingEvents($attr = array()) {
	$attr = shortcode_atts(array(
		'section' => '',
		'limit'   => -1,
	), $attr, 'upcoming-events');
	$section = strtolower(trim($attr['section']));
	$limit = filter_var($attr['limit'], FILTER_VALIDATE_INT);
	$limit = ($limit === false || $limit === 0 || $limit < -1) ? -1 : $limit;
	$sections = array(
		'performance'  => 'performances-and-repertory',
		'performances' => 'performances-and-repertory',
		'education'    => 'education-and-outreach',
		'fundraising'  => 'fundraising',
	);

	$args = array(
		'posts_per_page' => $limit,
		'post_type'       => 'tribe_events',
		'post_status'     => 'publish',
		'eventDisplay'    => 'upcoming',
		'start_date'      => 'now',
		'orderby'         => 'event_date',
		'order'           => 'ASC',
	);

	// A supplied section must be recognized; otherwise return no events rather
	// than accidentally exposing every category because of a shortcode typo.
	if ($section !== '') {
		if (!isset($sections[$section])) {
			return '';
		}
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'tribe_events_cat',
				'field'    => 'slug',
				'terms'    => $sections[$section],
			),
		);
	}

	// Let The Events Calendar build the date query. In addition to recurring
	// events, this correctly respects its "Hide From Event Listings" setting.
	$events = function_exists('tribe_get_events') ? tribe_get_events($args) : get_posts($args);
	if (!$events) {
		return '<p class="no-upcoming-events">There are currently no upcoming events.</p>';
	}

	$run = 1;
	$output = '<ul>';
	foreach ($events as $event) {
		$permalink = get_the_permalink($event->ID);
		$event_thumb = wp_get_attachment_url(get_post_thumbnail_id($event->ID), 'full');
		$event_start = get_post_meta($event->ID, '_EventStartDate', true);
		$event_date = function_exists('tribe_get_start_date')
			? tribe_get_start_date($event->ID, false, 'D M j Y')
			: wp_date('D M j Y', strtotime($event_start));

		$output .= '<li class="event-' . esc_attr($run) . '">';
		if ($event_thumb) {
			$output .= '<a href="' . esc_url($permalink) . '" aria-label="View ' . esc_attr($event->post_title) . '">';
			$output .= '<div class="image-box" role="img" aria-label="' . esc_attr($event->post_title) . '" style="background-image: url(\'' . esc_url($event_thumb) . '\')"></div>';
			$output .= '</a>';
		}
		$output .= '<h3>' . esc_html($event->post_title) . '</h3>';
		$output .= '<p class="date"><time datetime="' . esc_attr(date('c', strtotime($event_start))) . '">' . esc_html($event_date) . '</time></p>';
		$output .= '<a class="learn-more" href="' . esc_url($permalink) . '">Find Out More</a>';
		$output .= '</li>';
		$run++;
	}
	$output .= '</ul>';

	return $output;
}
add_shortcode( 'upcoming-events', 'upcomingEvents' );


function additionalRepertory($attr=[]) {
	
	$args = array( 	'posts_per_page' => -1, 
                    'post_type' => 'additional_repertory',
                    'post_status' => 'publish',
                    'orderby' => 'title',
                    'order' => 'ASC'
							
    );
 
	// for upcoming repetory
	if ( $attr['section'] == 'performances' )
		$sectionArgs = array (
			array(
				'key' => 'display_page',
				'value' => 'Performances Repertory',
				'compare' => 'LIKE'
				)
		);
	
	if ( $attr['section'] == 'education' )
		$sectionArgs =  array (
			array(
				'key' => 'display_page',
				'value' => 'Education Outreach',
				'compare' => 'LIKE'
				)
		);
	
	// for upcoming repetory
	if ( $attr['time'] == 'current' )
		$dateArgs = array (
			array(
			 'key'     => 'display_section',
			 'value'   => 'Current',
			 'compare' => 'equal'
			)
      	);
	
	// for upcoming repetory
	if ( $attr['time'] == 'past' )
		$dateArgs = array (
			array(
             'key'     => 'display_section',
			 'value'   => 'Past',
			 'compare' => '='
				)
            );
	
	// for education repetory
	if ( $attr['time'] == 'education' )
		$dateArgs = array (
			array(
             'key'     => 'display_section',
			 'value'   => 'Education',
			 'compare' => '='
				)
            );
	
	// for outcome repetory
	if ( $attr['time'] == 'outreach' )
		$dateArgs = array (
			array(
             'key'     => 'display_section',
			 'value'   => 'Outreach',
			 'compare' => '='
				)
            );
	
	// if only the location is set
	if( isset( $sectionArgs ) )
		$args['meta_query'] = array($sectionArgs);
	
	// if only the location is set
	if( isset( $dateArgs ) )
		$args['meta_query'] = array($dateArgs);
	   
	// if the location and diagnoses are set
	if( isset( $sectionArgs ) && isset( $dateArgs ) )
		$args['meta_query'] = array_merge ($sectionArgs, $dateArgs);
	
	
    $events = get_posts( $args );
    $run=1;		
    // Loop through the events, displaying the title and content for each
    echo '<ul>';
    foreach ( $events as $event ) :
        echo '<li class="event-' . $run . '">';
            $eventThumb = wp_get_attachment_url( get_post_thumbnail_id($event->ID), 'full' );
            echo '<a href="' . get_the_permalink($event->ID) . '">';
                echo '<div class="image-box" style="background-image: url(\'' . $eventThumb . '\')"></div>';
            echo '</a>';
            echo '<h3>' . $event->post_title . '</h3>';
            //echo '<p class="date">Premiered in:  ' . date("Y", strtotime(get_post_meta($event->ID)['date_premiered'][0])) . '</p>';
            echo '<a class="learn-more" href="' . get_the_permalink($event->ID) . '">Find Out More</a>';
        echo '</li>';
        $run++;
    endforeach;
    echo '<ul>';
}
add_shortcode( 'additional-repertory', 'additionalRepertory' );

function ellen_footer_default_supporting_logos() {
	$theme_uri = get_stylesheet_directory_uri();
	return array(
		array( 'image_id' => 0, 'image_url' => $theme_uri . '/images/logos/danceForce.png', 'alt' => 'Dance Force', 'link_url' => '', 'new_tab' => 0 ),
		array( 'image_id' => 0, 'image_url' => $theme_uri . '/images/logos/theEgg.png', 'alt' => 'The Egg', 'link_url' => '', 'new_tab' => 0 ),
		array( 'image_id' => 0, 'image_url' => $theme_uri . '/images/logos/StewartsShops.png', 'alt' => "Stewart's Shops", 'link_url' => '', 'new_tab' => 0 ),
		array( 'image_id' => 0, 'image_url' => $theme_uri . '/images/logos/TSBCharitableFoundation.png', 'alt' => 'Troy Savings Bank Charitable Foundation', 'link_url' => '', 'new_tab' => 0 ),
		array( 'image_id' => 0, 'image_url' => $theme_uri . '/images/logos/CDPHP_4c.png', 'alt' => 'CDPHP', 'link_url' => '', 'new_tab' => 0 ),
		array( 'image_id' => 0, 'image_url' => 'https://sinopolidances.org/wp-content/uploads/2023/02/NYSCA-Logo-Black-FY23.png', 'alt' => 'New York State Council on the Arts', 'link_url' => '', 'new_tab' => 0 ),
	);
}

function ellen_get_footer_supporting_logos() {
	$logos = get_option( 'ellen_footer_supporting_logos', false );
	return is_array( $logos ) ? $logos : ellen_footer_default_supporting_logos();
}

add_action( 'admin_menu', function() {
	add_theme_page( 'Footer Settings', 'Footer Settings', 'edit_theme_options', 'ellen-footer-settings', 'ellen_footer_settings_page' );
} );

add_action( 'admin_enqueue_scripts', function( $hook ) {
	if ( 'appearance_page_ellen-footer-settings' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-sortable' );
} );

function ellen_sanitize_footer_logos( $submitted ) {
	$logos = array();
	foreach ( is_array( $submitted ) ? $submitted : array() as $logo ) {
		$image_id  = isset( $logo['image_id'] ) ? absint( $logo['image_id'] ) : 0;
		$image_url = isset( $logo['image_url'] ) ? esc_url_raw( $logo['image_url'] ) : '';
		if ( ! $image_id && ! $image_url ) {
			continue;
		}
		$logos[] = array(
			'image_id'  => $image_id,
			'image_url' => $image_url,
			'alt'       => isset( $logo['alt'] ) ? sanitize_text_field( $logo['alt'] ) : '',
			'link_url'  => isset( $logo['link_url'] ) ? esc_url_raw( $logo['link_url'] ) : '',
			'new_tab'   => empty( $logo['new_tab'] ) ? 0 : 1,
		);
	}
	return $logos;
}

add_action( 'admin_post_ellen_save_footer_settings', function() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( 'You do not have permission to edit footer settings.' );
	}
	check_admin_referer( 'ellen_save_footer_settings' );
	$logos = ellen_sanitize_footer_logos( isset( $_POST['supporting_logos'] ) ? wp_unslash( $_POST['supporting_logos'] ) : array() );
	update_option( 'ellen_footer_supporting_logos', $logos, false );
	wp_safe_redirect( add_query_arg( 'updated', '1', admin_url( 'themes.php?page=ellen-footer-settings' ) ) );
	exit;
} );

function ellen_footer_settings_page() {
	// Enqueue here as well as admin_enqueue_scripts so custom admin-menu configurations cannot omit the media modal.
	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-sortable' );
	$logos = ellen_get_footer_supporting_logos();
	?>
	<div class="wrap">
		<h1>Footer Settings</h1>
		<p>Add, remove, link, or drag the supporting logos into the order in which they should appear in the footer.</p>
		<?php if ( isset( $_GET['updated'] ) ) : ?><div class="notice notice-success is-dismissible"><p>Footer settings saved.</p></div><?php endif; ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<input type="hidden" name="action" value="ellen_save_footer_settings">
			<?php wp_nonce_field( 'ellen_save_footer_settings' ); ?>
			<div id="ellen-footer-logos">
				<?php foreach ( $logos as $index => $logo ) :
					$image_url = ! empty( $logo['image_id'] ) ? wp_get_attachment_image_url( $logo['image_id'], 'medium' ) : '';
					$image_url = $image_url ? $image_url : ( isset( $logo['image_url'] ) ? $logo['image_url'] : '' ); ?>
					<div class="ellen-logo-row">
						<span class="dashicons dashicons-move ellen-logo-handle" title="Drag to reorder"></span>
						<div class="ellen-logo-preview"><?php if ( $image_url ) : ?><img src="<?php echo esc_url( $image_url ); ?>" alt=""><?php endif; ?></div>
						<div class="ellen-logo-fields">
							<input type="hidden" class="ellen-image-id" name="supporting_logos[<?php echo (int) $index; ?>][image_id]" value="<?php echo absint( $logo['image_id'] ); ?>">
							<input type="hidden" class="ellen-image-url" name="supporting_logos[<?php echo (int) $index; ?>][image_url]" value="<?php echo esc_url( isset( $logo['image_url'] ) ? $logo['image_url'] : '' ); ?>">
							<button type="button" class="button ellen-select-logo">Choose or Replace Logo</button>
							<label>Alternative text<input type="text" class="regular-text ellen-logo-alt" name="supporting_logos[<?php echo (int) $index; ?>][alt]" value="<?php echo esc_attr( $logo['alt'] ); ?>"></label>
							<label>Optional link<input type="url" class="regular-text" name="supporting_logos[<?php echo (int) $index; ?>][link_url]" value="<?php echo esc_url( $logo['link_url'] ); ?>" placeholder="https://"></label>
							<label class="ellen-checkbox"><input type="checkbox" name="supporting_logos[<?php echo (int) $index; ?>][new_tab]" value="1" <?php checked( ! empty( $logo['new_tab'] ) ); ?>> Open link in a new tab</label>
						</div>
						<button type="button" class="button-link-delete ellen-remove-logo">Remove</button>
					</div>
				<?php endforeach; ?>
			</div>
			<p><button type="button" class="button" id="ellen-add-logo">Add Supporting Logo</button></p>
			<?php submit_button( 'Save Footer Settings' ); ?>
		</form>
	</div>
	<style>
		.ellen-logo-row{display:flex;align-items:center;gap:18px;max-width:950px;margin:12px 0;padding:16px;background:#fff;border:1px solid #ccd0d4}.ellen-logo-handle{cursor:move;color:#646970}.ellen-logo-preview{width:150px;text-align:center}.ellen-logo-preview img{max-width:150px;max-height:90px}.ellen-logo-fields{display:grid;grid-template-columns:1fr 1fr;gap:10px 16px;flex:1}.ellen-logo-fields label{display:flex;flex-direction:column;gap:4px}.ellen-logo-fields .ellen-checkbox{display:block}.ellen-remove-logo{margin-left:auto}.ellen-logo-placeholder{height:125px;border:2px dashed #72aee6;margin:12px 0;max-width:950px}
	</style>
	<script>
	jQuery(function($){
		var list=$('#ellen-footer-logos');
		function reindex(){list.children('.ellen-logo-row').each(function(index){$(this).find('[name]').each(function(){this.name=this.name.replace(/supporting_logos\[\d+\]/,'supporting_logos['+index+']');});});}
		if($.fn.sortable){list.sortable({handle:'.ellen-logo-handle',placeholder:'ellen-logo-placeholder',update:reindex});}
		list.on('click','.ellen-select-logo',function(){
			if(typeof window.wp==='undefined'||!wp.media){window.alert('The WordPress Media Library did not load. Please refresh this page and try again.');return;}
			var row=$(this).closest('.ellen-logo-row'),frame=wp.media({title:'Choose a supporting logo',button:{text:'Use this logo'},multiple:false});
			frame.on('select',function(){var image=frame.state().get('selection').first().toJSON();row.find('.ellen-image-id').val(image.id);row.find('.ellen-image-url').val(image.url);row.find('.ellen-logo-preview').html('<img src="'+image.url+'" alt="">');if(!row.find('.ellen-logo-alt').val()){row.find('.ellen-logo-alt').val(image.alt||image.title||'');}});frame.open();
		});
		list.on('click','.ellen-remove-logo',function(){$(this).closest('.ellen-logo-row').remove();reindex();});
		$('#ellen-add-logo').on('click',function(){list.append('<div class="ellen-logo-row"><span class="dashicons dashicons-move ellen-logo-handle" title="Drag to reorder"></span><div class="ellen-logo-preview"></div><div class="ellen-logo-fields"><input type="hidden" class="ellen-image-id" name="supporting_logos[0][image_id]" value="0"><input type="hidden" class="ellen-image-url" name="supporting_logos[0][image_url]" value=""><button type="button" class="button ellen-select-logo">Choose Logo</button><label>Alternative text<input type="text" class="regular-text ellen-logo-alt" name="supporting_logos[0][alt]" value=""></label><label>Optional link<input type="url" class="regular-text" name="supporting_logos[0][link_url]" value="" placeholder="https://"></label><label class="ellen-checkbox"><input type="checkbox" name="supporting_logos[0][new_tab]" value="1"> Open link in a new tab</label></div><button type="button" class="button-link-delete ellen-remove-logo">Remove</button></div>');reindex();});
	});
	</script>
	<?php
}
