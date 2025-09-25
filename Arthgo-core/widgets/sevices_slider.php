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
class Arthgo_services_slider extends Widget_Base {

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
		return 'Arthgo-services-slider';
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
		return __( 'Services Slider', 'Arthgo-companion' );
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
        return array('services', 'swiper');
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
            '_cre_services_section',
            [
                'label' => __('Content', 'Arthgo-companion'),
            ]
        );

		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'cre_services_img',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $repeater->add_control(
			'cre_services_title', [
				'label' => __( 'Name', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Mark Parker' , 'Arthgo-companion' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'cre_services_content', [
				'label' => __( 'Content', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'Arthgo-companion' ),
				'show_label' => false,
			]
		);
		
		
		$repeater->add_control(
			'cre_services_btn', [
				'label' => __( 'Button Text', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Schedule a call' , 'Arthgo-companion' ),
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'cre_services_btn_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url' ],
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'cre_services_repeter_item',
			[
				'label' => __( 'Repeater List', 'Arthgo-companion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'cre_services_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing 
						elit. Mauris pharetra erat lorem, non accumsan neque pharetra nec. Phasellus eu dolor
						mollis, tempor magna id, accumsan dolor. Praesent quis consectetur turpis. Proin at met.', 
						'Arthgo-companion' ),
						'cre_services_title' => __( 'Mark Parker', 'Arthgo-companion' ),
					],
				],
				'title_field' => '{{{ cre_services_title }}}',
			]
		);

        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_cre_style_section',
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
           <div class="cre_services_section_wrapper">
				<div class="swiper cre_services_slider">
					<div class="swiper-wrapper">
						<?php
							if ( $settings['cre_services_repeter_item'] ) {
								foreach (  $settings['cre_services_repeter_item'] as $item ) {
									?>
									<div class="swiper-slide">
										<div class="services_section_inner">
                                            <img src="<?php echo $item['cre_services_img']['url']; ?>" alt="#" class="services_img">
											<div class="services_content">
                                                <h5 class="title"> <?php echo $item['cre_services_title'] ?></h5>
                                                <div class="description"> <?php echo $item['cre_services_content'] ?></div>
                                                <a href="<?php echo $item['cre_services_btn_link']['url'] ?>">
                                                    <?php echo $item['cre_services_btn'] ?>
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M13.75 6.75L5 15.5" stroke="#EDF4FF" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M6.66797 5.65659C6.66797 5.65659 13.3746 5.09124 14.3923 6.10899C15.4101 7.12674 14.8446 13.8333 14.8446 13.8333" stroke="#EDF4FF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
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
                <div class="services_nav d-none d-md-flex">
                    <div class="services_prev"><i class="fa-solid fa-arrow-left"></i></div>
                    <div class="services_next"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
				<div class="d-md-none text-center mt-4">
					<div class="cre_services_pag"></div>
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
