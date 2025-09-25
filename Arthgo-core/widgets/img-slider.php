<?php
namespace Arthgocompanion\Widgets;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Arthgo_img_slider extends Widget_Base {

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
		return 'Arthgo-img-slider';
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
		return __( 'Img Slider', 'Arthgo-core' );
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
        return array('imgSlider', 'swiper');
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
            '_cre_slider_layout_section',
            [
                'label' => __('Images', 'Arthgo-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'cre_slider_title', [
				'label' => __( 'Title', 'Arthgo-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Sign up' , 'Arthgo-core' ),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'cre_slider_img',
			[
				'label' => __( 'Choose Icon', 'Arthgo-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		
		$this->add_control(
			'cre_slider_repeter_item',
			[
				'label' => __( 'Repeater List', 'Arthgo-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'cre_slider_title' => __( 'Slide item', 'Arthgo-core' ),
					],
				],
				'title_field' => '{{{ cre_slider_title }}}',
			]
		);


        $this->end_controls_section();
    }

    public function _styles_control(){
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

		<div class="img_slider_wrapper img_slider">
			<div class="img_slider img_slide_track">
				<?php if ( $settings['cre_slider_repeter_item'] ) : foreach (  $settings['cre_slider_repeter_item'] as $item ) : ?>
					<div class="dl_slider_item slide_item">
						<img src="<?php echo esc_url($item['cre_slider_img']['url']) ?>" class="img-fluid" alt="#">
					</div>
				<?php endforeach; endif; ?>
			</div>
		</div>
           
        <?php
		
	}
}
