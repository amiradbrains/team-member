<?php
/**
 * Plugin Name: Team member
 * Description: Create Team member Owl Carousel
 * Plugin URI:  https://adbrains.in/
 * Version:     1.0.0
 * Author:      Amir Khan
 * Author URI:  https://adbrains.in/
 * Text Domain: elementor-oembed-widget
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_abTeam_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/ab-team-widget.php' );

	$widgets_manager->register( new \AB_Team_Widget() );

}
add_action( 'elementor/widgets/register', 'register_abTeam_widget' );

function ab_script(){
    wp_enqueue_script('jquery');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('bootstrap-css','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_script('team-owl-js','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
    wp_enqueue_style('owl-carousel-css','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css',array('team-css'));
    wp_enqueue_style('team-css', plugin_dir_url(__FILE__) . 'css/team-style.css');
}
add_action('wp_enqueue_scripts','ab_script');