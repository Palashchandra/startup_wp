<?php
namespace Arthgocompanion\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Arthgo_img_list extends Widget_Base {

	public function get_name() {
		return 'Arthgo-img-list';
	}

	public function get_title() {
		return __( 'Image List', 'Arthgo-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'Arthgo' ];
	}

	public function get_script_depends() {
		return array('imgSlider', 'swiper');
	}

	protected function _register_controls() {
		$this->_content_control();
		$this->_styles_control();
	}

	public function _content_control(){
		$this->start_controls_section(
			'_cre_img_list_layout_section',
			[
				'label' => __('Images', 'Arthgo-core'),
			]
		);

		$this->add_control(
			'img_list_gallery',
			[
				'label' => esc_html__( 'Add Images', 'Arthgo-core' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->end_controls_section();
	}

	public function _styles_control(){
		$this->start_controls_section(
			'_cre_img_list_style_section',
			[
				'label' => __('Image Style', 'Arthgo-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Image Spacing', 'Arthgo-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .dl_img_list_item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'Arthgo-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dl_img_list_item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items = $settings['img_list_gallery'] ?? [];

		if ( empty( $items ) ) {
			echo '<p>' . esc_html__( 'No images added.', 'Arthgo-core' ) . '</p>';
			return;
		}

		$total_items = count($items);
		$columns = [8, 7, 6, 5, 4]; // items per column
		$start_index = 0;
		?>

		<div class="img_img_list_wrapper d-none d-md-block">
			<?php foreach ($columns as $count) : ?>
				<?php if ($start_index >= $total_items) break; ?>
				<?php
				$end_index = min($start_index + $count, $total_items);
				if ($end_index <= $start_index) continue;
				?>
				<div class="img_img_list_column" style="flex: 1;">
					<?php for ($i = $start_index; $i < $end_index; $i++) :
						$item = $items[$i];
						?>
						<div class="dl_img_list_item">
							<img decoding="async" src="<?php echo esc_url($item['url']); ?>" class="img-fluid" alt="">
						</div>
					<?php endfor; ?>
				</div>
				<?php $start_index += $count; ?>
			<?php endforeach; ?>
		</div>
		<!-- Mobile View -->
		<div class="img_img_list_wrapper d-block d-md-none">
			<div class="img_img_list_inner">
				<?php foreach ($settings['img_list_gallery'] as $item) : ?>
					<div class="dl_img_list_item">
						<img decoding="async" src="<?php echo esc_url($item['url']); ?>" class="img-fluid" alt="">
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
