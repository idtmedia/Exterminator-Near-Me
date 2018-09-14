<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'listingpr-parent-style', get_template_directory_uri() . '/style.css' );
}

/* ============== ListingPro Default sidebar ============ */

if (!function_exists('listingpro_child_sidebar')) {

	function listingpro_child_sidebar() {			
		
		/* ============== Thangnn start ============ */
		
		
				/*register_sidebar(array(
					'name' => esc_html__("Header Social sidebar widget ", "listingpro"),
					'id' => "header-socials-sidebar",
					'description' => esc_html__('The header socials sidebar widget area', 'listingpro'),
					'before_widget' => '<aside class="col-md-12 widget widgets %2$s" id="%1$s">',
					'after_widget' => '</aside>',						
				));*/
				
		register_sidebar(array(
					'name' => esc_html__("Footer Join now widget", "listingpro"),
					'id' => "footer-joinnow-sidebar",
					'description' => esc_html__('The footer join now widget area', 'listingpro'),
					'before_widget' => '<aside class="col-md-12 widget widgets %2$s" id="%1$s">',
					'after_widget' => '</aside>',						
				));
				
		/* ============== Thangnn end ============ */	
			
	}

}
add_action('widgets_init', 'listingpro_child_sidebar');

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more($more) {
   global $post;
	return '';
   // return '… <a href="'. get_permalink($post->ID) . '">' . $more_text . '</a>';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
	  $words = str_word_count($text, 2);
	  $pos = array_keys($words);
	  $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

/*******************************
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 ********************************/
function great_circle_distance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad(floatval($latitudeFrom));
  $lonFrom = deg2rad(floatval($longitudeFrom));
  $latTo = deg2rad(floatval($latitudeTo));
  $lonTo = deg2rad(floatval($longitudeTo));

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}
/*******************************
* Exterminator get closest counties
* Author: ThangNN
* creativeOSC.com
********************************/
function get_closest_counties($ip_address, $numer=3){
	$geo_data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip_address));
	$lat = $geo_data['geoplugin_latitude'];
	$long = $geo_data['geoplugin_longitude'];
	
	$state_page_id = 1281;
	$states_pages = get_pages( array( 'child_of' => $state_page_id, 'parent' => $state_page_id) );

	$counties = array();
	foreach( $states_pages as $state ) {		
		$counties_pages = get_pages( array( 'child_of' => $state->ID, 'parent' => $state->ID));
		foreach( $counties_pages as $county ) {
			$counties[] = $county;
		}
	}	
	$closest_distances = array();
	$closest_counties = array();
	
	for($i=0;$i<3; $i++){		
		$page_lat = get_field('latitude', $counties[$i]->ID);
		$page_long = get_field('longitude', $counties[$i]->ID);
		$closest_distances[] = great_circle_distance($lat, $long, $page_lat, $page_long); 
		$closest_counties[] = $counties[$i];
	}
	// echo '<pre>';
	// var_dump($closest_distances);
	// echo '</pre>';
	// echo '<br>';
	for($i=3;$i<count($counties);$i++){
		$page_lat = get_field('latitude', $counties[$i]->ID);
		$page_long = get_field('longitude', $counties[$i]->ID);
		if(great_circle_distance($lat, $long, $page_lat, $page_long)<max($closest_distances)){
			$position = array_search(max($closest_distances), $closest_distances);
			$closest_distances[$position] = great_circle_distance($lat, $long, $page_lat, $page_long);
			$closest_counties[$position] = $counties[$i];
		}
	}
	return $closest_counties;
}

function getCountyByPostal($postal){
	
	$state_page_id = 1281;
	$states_pages = get_pages( array( 'child_of' => $state_page_id, 'parent' => $state_page_id) );

	$counties = array();
	foreach( $states_pages as $state ) {		
		$counties_pages = get_pages( array( 'child_of' => $state->ID, 'parent' => $state->ID));
		foreach( $counties_pages as $county ) {
			$counties[] = $county;
		}
	}
	$county = 0;
	for($i=0;$i<count($counties);$i++){
		$countyZipcodes = get_field('postal_codes', $counties[$i]->ID);
		if(strpos($countyZipcodes, $postal)!==false){
			$county = $counties[$i]->ID;
			break;
		}
	}
	return $county;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>
