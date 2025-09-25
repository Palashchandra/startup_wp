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
class Arthgo_faq extends Widget_Base {

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
		return 'Arthgo-faq';
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
		return __( 'Faq', 'Arthgo-companion' );
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

	protected function _register_controls()
    {
        do_action('cre_widgets/animated-image/register_control/start', $this);

        // add content
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
        do_action('cre_widgets/animated-image/register_control/end', $this);

        // by default
        do_action('cre_widget/section/style/custom_css', $this);
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_cre_pro_animated_image_layout_section',
            [
                'label' => __('Content', 'Arthgo-companion'),
            ]
        );

		$repeater = new \Elementor\Repeater();
		
        $repeater->add_control(
            'faq_title',
            [
                'label' => __( 'FAQ Title', 'Arthgo-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => 'What is Cohousing?'
            ]
        );
        $repeater->add_control(
            'faq_desc',
            [
                'label' => __( 'FAQ Description', 'Arthgo-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => 'Tosser wellies bog bobby bevvy crikey argy-bargy wind up mush Charles cuppa, 
                                bodge dropped a clanger Why James Bond knackered blower
                                 bamboozled pardon you fantastic lost the plot posh,'
            ]
        );
        $this->add_control(
            'advance_accordion',
            [
                'label' => __( 'FAQ Items', 'Arthgo-companion' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ faq_title }}}',
            ]
        );
        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_cre_pr_animated_image_style_section',
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
	$a = 0;
	$b = 0;
	$c = 0;
	$d = 0;
	$e = 1;
	$f = 0;
	$g = 0;
	$h = 1;
	?>
		<div class="cre_accordion" id="cre_accordion">
			<?php
				if( is_array($settings['advance_accordion']) ){
					foreach ( $settings['advance_accordion'] as $accordion ){
						$showClass = $d == 3 ? 'show' : '';
						$collapsedClass = $d == 3 ? '' : 'collapsed';
						$accordionitemactive = $d == 3? 'accordion-item-active' : '';
						?>
						<div class="accordion-item position-relative <?php echo $accordionitemactive; ?>">
							<h2 class="position-relative accordion-header" id="heading<?php echo $a++; ?>">
								<button class="accordion-button <?php echo esc_attr($collapsedClass); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#cre_faq_<?php echo $b++; ?>" aria-expanded="false" aria-controls="cre_faq_<?php echo $c++; ?>">
									<span class="counter"><?php echo sprintf("%02d", $e++); ?></span>
									<?php
										if( !empty($accordion['faq_title']) ){
											echo esc_html($accordion['faq_title']);
										}
									?>
								</button>
							</h2>
							<div id="cre_faq_<?php echo $d++; ?>" class="accordion-collapse collapse <?php echo esc_attr($showClass); ?>" data-bs-parent="#cre_accordion">
								<div class="accordion-body">
									<?php
										if( !empty($accordion['faq_desc']) ){
											echo '<p>' . esc_html($accordion['faq_desc']) . '</p>';
										}
									?>
								</div>
							</div>
						</div>
						<?php
					}
				}
			?>
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
