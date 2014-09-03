<?php
/**
 * @package SuperCamera
 */
/*
Plugin Name: Super Camera WP Slider
Plugin URI: http://www.j11.ca
Description: Another Slider
Version: 1-alpha
Author: Theepan
Author URI: http://www.j11.ca
*/
if(!is_admin()) {
	add_action('init','supercamera_scripts');
}


function supercamera_scripts() {
    wp_enqueue_script( 'jquerymobile', plugins_url( '/js/jquery.mobile.customized.min.js', __FILE__ ));
	wp_enqueue_script( 'jqueryeasing', plugins_url( '/js/jquery.easing.1.3.js', __FILE__ ));
	wp_enqueue_script( 'cameralib', plugins_url( '/js/camera.min.js', __FILE__ ));
	wp_enqueue_script( 'camera', plugins_url( '/js/camera.js', __FILE__ ));
	wp_enqueue_style( 'camera', plugins_url('/css/camera.css', __FILE__) );
}
add_image_size( 'supercamera', 625, 350, true );
function supercamera_shortcode( $atts ){
	$output = "";
	$output .= '<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">';
	$args = array(numberposts=>3,category=>4);
	$recent_posts = wp_get_recent_posts($args);
	foreach( $recent_posts as $recent ){
		$thumbnail = wp_get_attachment_image_src(get_the_post_thumbnail($recent['ID']), supercamera);
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($recent['ID']), supercamera );
		
		//$output .= '<img src= "' . plugins_url() . '/supercamera/inc/timthumb.php?src=' . $thumbnail[0] . '&h=350&w=625&zc=1' . '" />';
		$big = plugins_url() . '/supercamera/inc/timthumb.php?src=' . $thumbnail[0] . '&h=480&w=722&zc=1';
		$thumb = plugins_url() . '/supercamera/inc/timthumb.php?src=' . $thumbnail[0] . '&h=75&w=100&zc=1';
		
		$output .= '<div data-thumb="'.$thumb.'" data-src="'.$big.'">';
	    $output .= '<div class="camera_caption fadeFromBottom">';
	    $output .= '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" ><h3>' .   $recent["post_title"].'</h3></a>';
	    $output .= '</div></div>';
		
		
	}
	$output .= '</div>';
	WP_Reset_Query();
	return $output;

}
add_shortcode( 'supercamera', 'supercamera_shortcode' );