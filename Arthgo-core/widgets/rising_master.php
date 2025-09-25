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
class Arthgo_rising_master extends \Elementor\Widget_Base {

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
		return 'Arthgo-rising-master';
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
		return __( 'Rising Master', 'Arthgo-companion' );
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

        // add content
        $this->_content_control();
        
        //style section
        $this->_styles_control();
        
    }

    public function _content_control(){
        //start subscribe layout
        $this->start_controls_section(
            '_cre_rising_master_section',
            [
                'label' => __('Content', 'Arthgo-companion'),
            ]
        );

        $this->add_control(
			'rising_master_tab_item',
			[
                'name' => 'rising_master_tab_name',
				'label' => esc_html__( 'Tab List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'rising_master_tab_menu',
						'label' => esc_html__( 'Menu', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'CoderDude' , 'textdomain' ),
						'label_block' => true,
					],
                    [
                        'name' => 'rising_master_tab_icon',
                        'label' => esc_html__( 'Choose Icon', 'textdomain' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
					[
						'name' => 'rising_master_item_wrapper',
						'label' => esc_html__( 'Rising Master list', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => [
                            [
                                'name' => 'rising_master_status',
                                'label' => esc_html__( 'Is Active?', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'label_on' => esc_html__( 'Show', 'textdomain' ),
                                'label_off' => esc_html__( 'Hide', 'textdomain' ),
                                'return_value' => 'yes',
                                'default' => 'yes',
                            ],
                            [
                                'name' => 'rising_master_img',
                                'label' => esc_html__( 'Image', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                                'default' => [
                                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                                ],
                                'label_block' => true,
                            ],
                            [
                                'name' => 'rising_master_rating',
                                'label' => esc_html__( 'Rating', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__( '4.8 (6)', 'textdomain' ),
                                'placeholder' => esc_html__( 'Type your rating here', 'textdomain' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'rising_master_name',
                                'label' => esc_html__( 'Name', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__( 'Zrand Hobs', 'textdomain' ),
                                'placeholder' => esc_html__( 'Type your name here', 'textdomain' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'rising_master_position',
                                'label' => esc_html__( 'Position', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__( 'Developer', 'textdomain' ),
                                'placeholder' => esc_html__( 'Type your position here', 'textdomain' ),
                                'label_block' => true,
                            ],
                            [
                                'name' => 'rising_master_skils',
                                'label' => esc_html__( 'Skils', 'textdomain' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__( 'Gimp, Wordpress', 'textdomain' ),
                                'placeholder' => esc_html__( 'Type your position here', 'textdomain' ),
                                'label_block' => true,
                            ],
                        ],
                        'title_field' => '{{{ rising_master_name }}}',
					],
				],
                'title_field' => '{{{ rising_master_tab_menu }}}',
			],
		);
        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_cre_rising_master_section',
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

    if (empty($settings['rising_master_tab_item']) || !is_array($settings['rising_master_tab_item'])) {
        return;
    }

    $widget_id = $this->get_id();
    ?>
    <div class="rising_master_section elementor-widget-rising-master">
        <ul class="nav nav-pills" id="pills-tab-<?php echo esc_attr($widget_id); ?>" role="tablist">
            <?php
            $index = 0;
            foreach ($settings['rising_master_tab_item'] as $tab_name) :
                $is_active = ($index === 1) ? 'active' : '';
                $aria_selected = ($index === 1) ? 'true' : 'false';
                ?>
                <li class="nav-item" role="presentation">
                    <button
                        class="tab_menu_item nav-link <?php echo esc_attr($is_active); ?>"
                        id="pills-tab-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                        type="button"
                        role="tab"
                        aria-controls="pills-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                        aria-selected="<?php echo esc_attr($aria_selected); ?>"
                    >
                        <?php if (!empty($tab_name['rising_master_tab_icon']['url'])) : ?>
                            <img src="<?php echo esc_url($tab_name['rising_master_tab_icon']['url']); ?>" alt="">
                        <?php endif; ?>
                        <?php echo esc_html($tab_name['rising_master_tab_menu'] ?? ''); ?>
                    </button>
                </li>
                <?php
                $index++;
            endforeach;
            ?>
        </ul>

        <div class="tab-content" id="pills-tabContent-<?php echo esc_attr($widget_id); ?>">
            <?php
            $index = 0;
            foreach ($settings['rising_master_tab_item'] as $tab_name) :
                $active_class = ($index === 1) ? 'show active' : '';
                ?>
                <div
                    class="tab-pane fade <?php echo esc_attr($active_class); ?>"
                    id="pills-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                    role="tabpanel"
                    aria-labelledby="pills-tab-<?php echo esc_attr($widget_id . '-' . $index); ?>"
                    tabindex="0"
                >
                    <div class="row g-4 rising_master_wrapper">
                        <?php
                        if (!empty($tab_name['rising_master_item_wrapper']) && is_array($tab_name['rising_master_item_wrapper'])) :
                            foreach ($tab_name['rising_master_item_wrapper'] as $item) :
                                ?>
                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                    <div class="rising_master_item">
                                        <div class="rising_master_thumb position-relative">
                                            <?php if (!empty($item['rising_master_img']['url'])) : ?>
                                                <img src="<?php echo esc_url($item['rising_master_img']['url']); ?>" alt="#">
                                            <?php endif; ?>
                                            <?php
                                            if( 'yes' === $item['rising_master_status']){
                                                echo '<span class="active position-absolute"></span>';
                                            }
                                            ?>
                                        </div>
                                        
                                        <div class="rating">
                                            <i class="fa-solid fa-star"></i>
                                            <?php echo esc_html($item['rising_master_rating'] ?? ''); ?>
                                        </div>
                                        <h5 class="name"><?php echo esc_html($item['rising_master_name'] ?? ''); ?></h5>
                                        <p class="position"><?php echo esc_html($item['rising_master_position'] ?? ''); ?></p>
                                        <div class="skil_list">
                                            <?php
                                            $skills = !empty($item['rising_master_skils']) ? explode(',', $item['rising_master_skils']) : [];
                                            foreach ($skills as $skill) {
                                                echo '<span>' . esc_html(trim($skill)) . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                <?php
                $index++;
            endforeach;
            ?>
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
