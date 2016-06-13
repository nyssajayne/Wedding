<?php
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_styles' );

/**
 * Register style sheet.
 */
function register_styles() {
	wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
	wp_register_style( 'main', get_stylesheet_directory_uri() . '/main.css' );
	wp_register_style( 'front', get_stylesheet_directory_uri() . '/front.css' );
	wp_register_style( 'nyc', get_stylesheet_directory_uri() . '/nyc.css' );
	wp_register_style( 'chf', get_stylesheet_directory_uri() . '/chf.css' );
	wp_register_style( 'mel', get_stylesheet_directory_uri() . '/mel.css' );
	wp_register_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_register_style( 'raleway', 'http://fonts.googleapis.com/css?family=Raleway:600,300' );
	wp_register_style( 'oswald', 'http://fonts.googleapis.com/css?family=Oswald' );
	wp_register_style( 'roboto-pt-dancing', 'http://fonts.googleapis.com/css?family=PT+Sans:400,400italic|Roboto+Slab|PT+Sans+Caption:400,700|Dancing+Script' );

	wp_enqueue_style( 'style' );
	wp_enqueue_style( 'main' );
	wp_enqueue_style( 'fontawesome' );

	//If this is the homepage or the error page
	if(is_page(17) || is_page(38)) {
		wp_enqueue_style( 'raleway' );
		wp_enqueue_style( 'front' );
	}

	//If this is the NYC page
	if(is_page(12)) {
		wp_enqueue_style( 'nyc' );
	}

	//If this is Chesterfield
	if(is_page(22)) {
		wp_enqueue_style( 'chf' );
		wp_enqueue_style( 'roboto-pt-dancing' );
	}

	//If this is Melbourne
	if(is_page(24)) {
		wp_enqueue_style( 'raleway' );
		wp_enqueue_style( 'mel' );
	}

	//If this is the landing page
	if(is_page(20)) {
		wp_enqueue_style( 'oswald' );
	}
}

add_action( 'wp_enqueue_scripts', 'register_scripts' );

function register_scripts() {
	wp_register_script( 'scripts', get_stylesheet_directory_uri() . '/scripts.js' );
	wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js' );
	wp_register_script( 'map-scripts', get_stylesheet_directory_uri() . '/map-scripts.js' );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'scripts' );

	//If this is the homepage
	if(is_page(17) || is_page(38)) {
		wp_enqueue_script( 'google-map' );
		wp_enqueue_script( 'map-scripts' );
	}
}

//Remove Admin Bar
function my_function_admin_bar(){ 
	return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

//http://www.wpbeginner.com/wp-tutorials/force-users-to-login-before-reading-posts-in-wordpress/
function my_force_login() {
	global $current_user;

	if (!is_user_logged_in()) {
		$args = array(
	        'echo'           => true,
			'remember'       => false,
			'label_log_in'	 => __ ( 'Log In &nbsp; &#xf072;' )
	    );

		wp_login_form( $args );
	}
}

//https://codex.wordpress.org/Plugin_API/Filter_Reference/login_redirect
//Guests who are only invited to one party don't need to see the switch cities page
function my_login_redirect( $redirect_to, $request, $user ) {
	global $user;

	$locations = fetch_location($user->ID);
	$no_of_locations = count($locations);

	if($no_of_locations > 1) {
		return site_url('/switch');
	}
	else {
		foreach($locations as $location) {
			//1: New York, 2: Chesterfield, 3: Melbourne

			switch($location->location_id) {
				case 1:
					return site_url('/new-york');
				break;

				case 2:
					return site_url('/chesterfield');
				break;

				case 3:
					return site_url('/melbourne');
				break;
			}
		}
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

//http://digwp.com/2011/08/how-to-redirect-logged-in-users/
//Make sure guests who aren't invited to parties can see the pages
function redirect_guests() {
	global $post; 

	if (!is_page(17) && !is_page(38)) {
		if(!is_user_logged_in()) {
			auth_redirect(); 
		}
		else {
			global $current_user;

			$locations = fetch_location($current_user->ID);

			$invited = false;

			$city;

			switch ($post->ID) {
				case 12:
					$city = 1;
					break;
				case 22:
					$city = 2;
					break;
				case 24:
					$city = 3;
					break;
				case 20:
					$city = 4;
					break;
			}

			if($city == 4 && count($locations) > 1) {
				$invited = true;
			}
			else {
				foreach($locations as $location) {
					if($city == $location->location_id) {
						$invited = true;
						break;
					}
				}
			}

			if($invited == false) {
				wp_redirect( site_url('/error-page') ); exit;
			}
		}
	}
}

//Some functions to replace wp-login with the home page.
//http://www.hongkiat.com/blog/wordpress-custom-loginpage/
function redirect_login_page() {
	$login_page  = home_url();
	$page_viewed = basename($_SERVER['REQUEST_URI']);
 
	if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		wp_redirect($login_page);
		exit;
	}
}
add_action('init','redirect_login_page');

function login_failed() {
	$login_page  = home_url();
	wp_redirect( $login_page . '?login=failed' );
	exit;
}
add_action( 'wp_login_failed', 'login_failed' );
 
function verify_username_password( $user, $username, $password ) {
	$login_page  = home_url();
	if( $username == "" || $password == "" ) {
		wp_redirect( $login_page . "?login=empty" );
		exit;
	}
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
	$login_page  = home_url();
	wp_redirect( $login_page . "?login=false" );
	exit;
}
add_action('wp_logout','logout_page');

//http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/
/**
 * Checks if a particular user has a role. 
 * Returns true if a match was found.
 *
 * @param string $role Role name.
 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
 * @return bool
 */
function appthemes_check_user_role( $role, $user_id = null ) {
 
    if ( is_numeric( $user_id ) )
		$user = get_userdata( $user_id );
    else
        $user = wp_get_current_user();
 
    if ( empty( $user ) )
		return false;
 
    return in_array( $role, (array) $user->roles );
}

//http://premium.wpmudev.org/blog/limit-access-to-your-wordpress-dashboard/
add_action( 'init', 'blockusers_init' );
	function blockusers_init() {
		if ( is_admin() && ! appthemes_check_user_role( 'administrator' ) &&
				! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_redirect( home_url() );
		exit;
	}
}

function fetch_guests($household_id, $location_id) {
	global $wpdb;

	$rsvp_table = $wpdb->prefix."rsvp";

	$querystr = "SELECT id, name, attending, requirements
		FROM $rsvp_table
		WHERE household_id = $household_id
		AND location_id = $location_id;";

	$guests = $wpdb->get_results($querystr);

	return $guests;
}

function fetch_location($household_id) {
	global $wpdb;

	$rsvp_table = $wpdb->prefix."rsvp";

	$querystr = "SELECT location_id
		FROM $rsvp_table
		WHERE household_id = $household_id
		GROUP BY location_id;";

	$location = $wpdb->get_results($querystr);

	return $location;
}

//Displays the switch cities or logout nav
function switch_or_logout($household_id) {
	$locations = count(fetch_location($household_id));

	$switch = "<a href=\"". get_site_url() ."/switch/\">Switch Cities</a> | ";
	$logout = "<a href=\"".  wp_logout_url( home_url() ) ."\">Logout</a>";

	if($locations > 1) {
		echo "<nav>". $switch . $logout . "</nav>";
	}
	else {
		echo "<nav>". $logout . "</nav>";
	}
}