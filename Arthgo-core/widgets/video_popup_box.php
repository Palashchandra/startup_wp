<?php
namespace Arthgocompanion\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arthgo_popup_slider_box extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'Arthgo-popup-slider_-box';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Video slider', 'Arthgo-companion' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-social-icons';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'Arthgo' ];
    }

	public function get_script_depends() {
        return array('videoSlider', 'swiper');
    }

    protected function _register_controls()
    {
        // add content
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_cre_popup_slider_section',
            [
                'label' => esc_html__('Content', 'Arthgo-companion'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'cre_popup_slider_img',
            [
                'label' => esc_html__( 'Choose Image', 'Arthgo-companion' ), // Changed textdomain
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'cre_popup_slider_title', [
                'label' => esc_html__( 'Name', 'Arthgo-companion' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Mark Parker' , 'Arthgo-companion' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'cre_popup_slider_position', [
                'label' => esc_html__( 'Position', 'Arthgo-companion' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Position' , 'Arthgo-companion' ), // Changed default to be more generic
                'label_block' => true,
            ]
        );
        
        $repeater->add_control(
            'cre_popup_slider_icon',
            [
                'label' => esc_html__( 'Icon', 'Arthgo-companion' ), // Changed textdomain
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play-circle', // Changed default to play icon for video
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'cre_popup_slider_btn_link',
            [
                'label' => esc_html__( 'Video Link', 'Arthgo-companion' ), // Changed textdomain
                'type' => Controls_Manager::URL,
                'options' => [ 'url' ],
                'default' => [
                    'url' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cre_popup_slider_repeter_item',
            [
                'label' => esc_html__( 'Repeater List', 'Arthgo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'cre_popup_slider_title' => esc_html__( 'Mark Parker', 'Arthgo-companion' ),
                        'cre_popup_slider_position' => esc_html__( 'CEO', 'Arthgo-companion' ),
                    ],
                    [
                        'cre_popup_slider_title' => esc_html__( 'Jane Doe', 'Arthgo-companion' ),
                        'cre_popup_slider_position' => esc_html__( 'Marketing Manager', 'Arthgo-companion' ),
                    ],
                ],
                'title_field' => '{{{ cre_popup_slider_title }}}',
            ]
        );

        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_cre_style_section',
            [
                'label' => esc_html__('Style', 'Arthgo-companion'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        
        $this->end_controls_section();
    }


    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
           <div class="popup_section_wrapper">
                <div class="swiper popup_wrapper_box">
                    <div class="swiper-wrapper">
                    <?php
                        if ( $settings['cre_popup_slider_repeter_item'] ) {
                            foreach (  $settings['cre_popup_slider_repeter_item'] as $item ) {
                                // Ensure 'url' is set before trying to access it
                                $image_url = isset($item['cre_popup_slider_img']['url']) ? $item['cre_popup_slider_img']['url'] : Utils::get_placeholder_image_src();
                                $video_link = isset($item['cre_popup_slider_btn_link']['url']) ? $item['cre_popup_slider_btn_link']['url'] : '#';
                                ?>
                                <div class="swiper-slide">
                                    <div class="popup_item_wrapper position-relative">
                                        <div class="slider_thumb">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($item['cre_popup_slider_title']); ?>" class="popup_slider_title">
                                        </div>
                                        <div class="popup_slider_info d-flex align-items-center justify-content-between position-absolute bottom-0 start-0 w-100">
                                            <div class="popup_slider_inner">
                                                <h4 class="title mb-1 text-white"><?php echo esc_html($item['cre_popup_slider_title']); ?></h4>
                                                <p class="position text-white"><?php echo esc_html($item['cre_popup_slider_position']); ?></p>
                                            </div>
                                            <a class="video_popup" href="<?php echo esc_url($video_link); ?>">
                                                <?php Icons_Manager::render_icon( $item['cre_popup_slider_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    </div>
                </div>
				<div class="slider_nav">
					<div class="popup_prev"><i class="fa-solid fa-arrow-left"></i></div>
					<div class="popup_next"><i class="fa-solid fa-arrow-right"></i></div>
				</div>
		   </div>
        <?php
        
    }
    

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template() {
    }
}