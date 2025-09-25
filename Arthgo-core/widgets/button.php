<?php
namespace Arthgocompanion\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Arthgo_button extends Widget_Base {

	public function get_name() {
		return 'Arthgo-button';
	}

	public function get_title() {
		return __( 'Button', 'Arthgo-companion' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'Arthgo' ];
	}

	protected function _register_controls() {
		$this->_content_control();
		$this->_styles_control();
	}

	public function _content_control() {
		$this->start_controls_section(
			'_cre_button_layout_section',
			[
				'label' => __('Content', 'Arthgo-companion'),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'Arthgo-companion'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Create Account', 'Arthgo-companion'),
			]
		);

        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'Arthgo-companion'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

		$this->add_control(
			'button_url',
			[
				'label' => __('Button URL', 'Arthgo-companion'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-site.com',
				'default' => [
					'url' => '#',
				],
				'show_external' => true,
			]
		);

		$this->end_controls_section();
	}

	public function _styles_control() {
		$this->start_controls_section(
			'_cre_pr_animated_image_style_section',
			[
				'label' => esc_html__('Style', 'Arthgo-companion'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'Arthgo-companion'),
				'type' => Controls_Manager::COLOR,
				'default' => '#0066FF',
				'selectors' => [
					'{{WRAPPER}} .cre_btn_wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'Arthgo-companion'),
				'type' => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .cre_btn_wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => __('Background Color', 'Arthgo-companion'),
				'type' => Controls_Manager::COLOR,
				'default' => '#0066FF',
				'selectors' => [
					'{{WRAPPER}} .cre_btn_wrapper' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_text_color',
			[
				'label' => __('Hover Text Color', 'Arthgo-companion'),
				'type' => Controls_Manager::COLOR,
				'default' => '#0066FF',
				'selectors' => [
					'{{WRAPPER}} .cre_btn_wrapper:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __('Background Circle Color', 'Arthgo-companion'),
				'type' => Controls_Manager::COLOR,
				'default' => '#0066FF',
				'selectors' => [
					'{{WRAPPER}} .cre_btn_wrapper:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$text = $settings['button_text'];
		$url = $settings['button_url']['url'];
		$target = $settings['button_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_url']['nofollow'] ? ' rel="nofollow"' : '';
        $icon = $settings['button_icon'];
		?>
		<a class="cre_btn_wrapper contact_btn" href="<?php echo esc_url($url); ?>"<?php echo $target . $nofollow; ?>>
			<?php echo esc_html($text); ?>
			<div class="icon">
				<?php
                    if (!empty($icon['value'])) {
                        \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
                    }
                ?>
			</div>
		</a>
		<?php
	}

	protected function _content_template() {}
}
