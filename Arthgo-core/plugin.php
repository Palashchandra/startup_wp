<?php
namespace Arthgocompanion;
use Arthgocompanion\Widgets\Arthgo_faq;
use Arthgocompanion\Widgets\Arthgo_career;
use Arthgocompanion\Widgets\Arthgo_img_slider;
use Arthgocompanion\Widgets\Arthgo_rising_master;
use Arthgocompanion\Widgets\Arthgo_img_list;
use Arthgocompanion\Widgets\Arthgo_popup;
use Arthgocompanion\Widgets\Arthgo_popup_slider_box;
use Arthgocompanion\Widgets\Arthgo_testimonial_slider;
use Arthgocompanion\Widgets\Arthgo_button;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class ArthgoPlugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'Arthgo-companion', plugins_url( '/assets/js/custom.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'imgSlider', plugins_url( '/assets/js/img-carousel.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'videoSlider', plugins_url( '/assets/js/video-slider.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/faq.php' );
		require_once( __DIR__ . '/widgets/career_search.php' );
		require_once( __DIR__ . '/widgets/img-slider.php' );
		require_once( __DIR__ . '/widgets/rising_master.php' );
		require_once( __DIR__ . '/widgets/img-list.php' );
		require_once( __DIR__ . '/widgets/popup.php' );
		require_once( __DIR__ . '/widgets/video_popup_box.php' );
		require_once( __DIR__ . '/widgets/testimonial_slider.php' );
		require_once( __DIR__ . '/widgets/button.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_faq() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_career() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_img_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_rising_master() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_img_list() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_popup() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_popup_slider_box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_testimonial_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Arthgo_button() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
ArthgoPlugin::instance();