<?php
namespace Arthgocompanion\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arthgo_testimonial_slider extends Widget_Base {

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
		return 'Arthgo-testimonial-slider';
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
		return __( 'Testimonial Slider', 'Arthgo-companion' );
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
        return array('testimonial', 'swiper');
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
            '_testimonial_section',
            [
                'label' => __('Content', 'Arthgo-companion'),
            ]
        );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'testimonial_content', [
				'label' => __( 'Content', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'Arthgo-companion' ),
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'client_name', [
				'label' => __( 'Name', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Mark Parker' , 'Arthgo-companion' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'client_position', [
				'label' => __( 'Position', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Real Estate Agent, JUMP Realty' , 'Arthgo-companion' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'testimonial_repeter_item',
			[
				'label' => __( 'Repeater List', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'testimonial_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing 
						elit. Mauris pharetra erat lorem, non accumsan neque pharetra nec. Phasellus eu dolor
						mollis, tempor magna id, accumsan dolor. Praesent quis consectetur turpis. Proin at met.', 
						'Arthgo-companion' ),
						'client_name' => __( 'Mark Parker', 'Arthgo-companion' ),
					],
				],
				'title_field' => '{{{ client_name }}}',
			]
		);

        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_style_section',
            [
                'label' => esc_html__('Style', 'Arthgo-companion'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,

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
		extract($settings);

        ?>
           <div class="testimonial_section_wrapper text-center">
				<div class="swiper testimonial_slider">
					<div class="swiper-wrapper">
						<?php
							if ( $settings['testimonial_repeter_item'] ) {
								foreach (  $settings['testimonial_repeter_item'] as $item ) {
									?>
									<div class="swiper-slide">
										<div class="testimonial_item_inner">
											<div class="client_info">
                                                <p class="name"> <?php echo $item['client_name'] ?></p>
                                                <p class="position"> <?php echo $item['client_position'] ?></p>
                                            </div>
                                            <?php if(!empty($item['testimonial_content'])): ?>
												<h2 class="description"> <?php echo $item['testimonial_content'] ?></h2>
											<?php endif; ?>
										</div>
									</div>
									<?php
								}
							}
						?>
					</div>
				</div>
                <div class="testimonial_nav">
					<div class="testimonial_prev"><i class="fa-solid fa-arrow-left"></i></div>
					<div class="testimonial_next"><i class="fa-solid fa-arrow-right"></i></div>
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
