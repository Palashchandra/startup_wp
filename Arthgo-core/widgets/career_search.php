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
class Arthgo_career extends Widget_Base {

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
		return 'Arthgo-career';
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
		return __( 'Career', 'Arthgo-companion' );
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
            '_cre_career_section',
            [
                'label' => __('Content', 'Arthgo-companion'),
            ]
        );

        
        $this->end_controls_section();
    }

    public function _styles_control(){

        $this->start_controls_section(
            '_cre_career_section',
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
		<div class="career_search_wrapper">
			<form class="search-form-wrapper" method="get" action="<?php echo esc_url( home_url() ); ?>">
				<div class="search-form-inner">
					<div class="search_item job-title">
						<div class="item_icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#002B6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<input class="search-input" id="global-search" type="search" name="s" placeholder="WordPress Designer">
					</div>
					<div class="search_item select-location">
						<div class="item_icon">
							<svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18.1569 16.6569C17.2202 17.5935 15.2616 19.5521 13.9138 20.8999C13.1327 21.681 11.8677 21.6814 11.0866 20.9003C9.76234 19.576 7.84159 17.6553 6.84315 16.6569C3.71895 13.5327 3.71895 8.46734 6.84315 5.34315C9.96734 2.21895 15.0327 2.21895 18.1569 5.34315C21.281 8.46734 21.281 13.5327 18.1569 16.6569Z" stroke="#002B6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M15.5 11C15.5 12.6569 14.1569 14 12.5 14C10.8431 14 9.5 12.6569 9.5 11C9.5 9.34315 10.8431 8 12.5 8C14.1569 8 15.5 9.34315 15.5 11Z" stroke="#002B6B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div>
						<select name="category" class="form-control">
							<option value="">All Location</option>
							<?php
							$product_categories = get_terms( array(
								'taxonomy' => 'location',
								'orderby' => 'name',
								'order'   => 'ASC',
								'hide_empty' => false,
							) );

							foreach ( $product_categories as $category ) {
								echo '<option value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				
				<input type="hidden" name="post_type" value="career"> 
				<button class="button search-button" type="submit">
					Search
				</button>
			</form>
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
