<?php
namespace InfiniteScrollElementorNameSpace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;
class ISE_InfiniteScroll extends Widget_Base {
		
	public function get_name() {
		return 'infinite-scroll-elementor-widget';
	}

	public function get_title() {
		return __( 'Infinite Scroll - ISE', 'infinite-scroll-elementor-td' );
	}

	public function get_icon() {
		return 'eicon-flash';
	}
	
	public function get_categories() {
		return [ 'infinite-scroll-elementor-category' ];
	}

	public function get_script_depends() {
		return [ 'infinite-scroll-elementor-js' ];
	}

   public function get_style_depends() {
        return [ 'infinite-scroll-elementor-css' ];
    }

	protected function _register_controls() {
	
	/* Section Controls Start */
	$this->start_controls_section(
		'pagination_settings',
		[
			'label' => __( 'Infinite Scroll Elementor - ISE', 'infinite-scroll-elementor-td' ),
		]
	);
	
	/* Pagination Type */
	$this->add_control(
		'apply_type_setting',
		[
			'label'       => __( 'Infinite Scroll', 'infinite-scroll-elementor-td' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'default'      => 'yes',	
			'label_on'     => __( 'yes', 'infinite-scroll' ),
			'label_off'    => __( 'no', 'infinite-scroll' ),
		]
	);
	/* Pagination For */
	$this->add_control(
		'pagination_for_setting',
		[
			'label'       => __( 'Pagination For', 'infinite-scroll-elementor-td' ),
			'type'        => \Elementor\Controls_Manager::SELECT,
			'default'     => 'elementor-pro-posts',
			'options'     => [
				'elementor-pro-posts'            => __( 'Elementor Posts', 'infinite-scroll-elementor-td' ),
				'elementor-pro-products'         => __( 'Elementor Products', 'infinite-scroll-elementor-td' ),					
				'elementor-pro-archive-posts'    => __( 'Elementor Archive Posts', 'infinite-scroll-elementor-td' ),
				'use-custom-selectors'           => __( 'Add Custom Selectors', 'infinite-scroll-elementor-td' ),
			],
			'condition' => [
				'apply_type_setting' => 'yes',
			]
		]
	);
	
	/* Documentation Box */
	$this->add_control(
		'documentation',
		[
			'type'            => Controls_Manager::RAW_HTML,
			'raw'             => __( 'Infinite Scroll Elementor plugin adds advanced Ajax Load More and Infinite Scroll functions to Elementor.<br><a href="https://joychetry.com/infinite-scroll-elementor" target="_blank">Check Documentation</a>', 'infinite-scroll-elementor-td' ),
			'content_classes' => 'elementor-control-raw-html elementor-panel-alert elementor-panel-alert-info',
		]
	);
	$this->end_controls_section();		
	
	/* Custom Selectors */
	$this->start_controls_section(
		'custom_selectors_section',
		[
			'label' => __( 'Custom Selectors', 'infinite-scroll-elementor-td' ),
			'condition' => [
				'pagination_for_setting' => 'use-custom-selectors',
			]
		]
	);
	
	/* Navigation Selector */
	$this->add_control(
		'custom_selector_navigation_setting',
		[
			'label'       => __( 'Navigation Selector', 'infinite-scroll-elementor-td' ),
			'label_block' => true,
			'placeholder' => __( 'E.g. nav.navigation', 'infinite-scroll-elementor-td' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'condition' => [
				'pagination_for_setting' => 'use-custom-selectors',
			]
		]
	);
	
	$this->add_control(
		'custom_selector_next_setting',
		[
			'label'       => __( 'Next Selector', 'infinite-scroll-elementor-td' ),
			'label_block' => true,
			'placeholder' => __( 'E.g. a.next', 'infinite-scroll-elementor-td' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'condition' => [
				'pagination_for_setting' => 'use-custom-selectors',
			]
		]
	);
	
	$this->add_control(
		'custom_selector_content_setting',
		[
			'label'       => __( 'Content Selector', 'infinite-scroll-elementor-td' ),
			'label_block' => true,
			'placeholder' => __( 'E.g. div.items', 'infinite-scroll-elementor-td' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'condition' => [
				'pagination_for_setting' => 'use-custom-selectors',
			]
		]
	);
	
	$this->add_control(
		'custom_selector_item_setting',
		[
			'label'       => __( 'Item Selector', 'infinite-scroll-elementor-td' ),
			'label_block' => true,
			'placeholder' => __( 'E.g. div.item', 'infinite-scroll-elementor-td' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'condition' => [
				'pagination_for_setting' => 'use-custom-selectors',
			]
		]
	);
	$this->end_controls_section();
}


	protected function render() {
		
	    $settings = $this->get_settings_for_display();
		
		/**
		 * apply_type_setting
		 * 
		 * Apply conditions and return parameters.
		 * 
		 * Infinite scroll is default.
		 */	
		if( $settings['apply_type_setting'] == 'yes' ) {
			
		    $options['event'] = 'click';		
		}
		
		// Elementor Archive Posts and Elementor Posts
		if( $settings['pagination_for_setting'] == 'elementor-pro-archive-posts' || $settings['pagination_for_setting'] == 'elementor-pro-posts' ) {
			
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo "<strong>Infinite Scroll Elementor: </strong>Executed fine, please check preview or page for results.";
			}
			else {
			?>
<style>
				.page-load-status {
				 display:none; /* hidden by default */
				  text-align: center;
				  color: #000428;
				}

				.loader-ellips {
				  font-size: 12px; /* change size here */
				  position: relative;
				  width: 4em;
				  height: 1em;
				  margin: 10px auto;
				}

				.loader-ellips__dot {
				  display: block;
				  width: 1em;
				  height: 1em;
				  border-radius: 0.5em;
				  background: #a1a1a1; /* change color here */
				  position: absolute;
				  animation-duration: 0.5s;
				  animation-timing-function: ease;
				  animation-iteration-count: infinite;
				}

				.loader-ellips__dot:nth-child(1),
				.loader-ellips__dot:nth-child(2) {
				  left: 0;
				}
				.loader-ellips__dot:nth-child(3) { left: 1.5em; }
				.loader-ellips__dot:nth-child(4) { left: 3em; }

				@keyframes reveal {
				  from { transform: scale(0.001); }
				  to { transform: scale(1); }
				}

				@keyframes slide {
				  to { transform: translateX(1.5em) }
				}

				.loader-ellips__dot:nth-child(1) {
				  animation-name: reveal;
				}

				.loader-ellips__dot:nth-child(2),
				.loader-ellips__dot:nth-child(3) {
				  animation-name: slide;
				}

				.loader-ellips__dot:nth-child(4) {
				  animation-name: reveal;
				  animation-direction: reverse;
				}
				.vmBtn {
				  text-align:center;
				  margin-top:0px;
				}
				.view-more-button{
				  background-color:#a1a1a1;
				  border-style:none;
				  color:#fff;
				  font-size:18px;
				  padding:8px 16px;
				  border-radius:3px;
				  cursor: pointer;
				}
			</style>
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last">You have made it till the end!</p>
			  <p class="infinite-scroll-error">No more posts left!</p>
			</div>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('div.elementor-posts-container').infiniteScroll({
					path: 'a.page-numbers.next',
					append: 'article.elementor-post',
					history: false,
					hideNav: 'nav.elementor-pagination',
				    status: '.page-load-status',
				});

			});
			</script>
<?php
			}
			
		}

		// Elementor Products
		elseif( $settings['pagination_for_setting'] == 'elementor-pro-products' ) {
			
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo "<strong>Infinite Scroll Elementor: </strong>Executed fine, please check preview or page for results.";
			}
			else {
			?>
			<style>
				.page-load-status {
				 display:none; /* hidden by default */
				  text-align: center;
				  color: #000428;
				}

				.loader-ellips {
				  font-size: 12px; /* change size here */
				  position: relative;
				  width: 4em;
				  height: 1em;
				  margin: 10px auto;
				}

				.loader-ellips__dot {
				  display: block;
				  width: 1em;
				  height: 1em;
				  border-radius: 0.5em;
				  background: #a1a1a1; /* change color here */
				  position: absolute;
				  animation-duration: 0.5s;
				  animation-timing-function: ease;
				  animation-iteration-count: infinite;
				}

				.loader-ellips__dot:nth-child(1),
				.loader-ellips__dot:nth-child(2) {
				  left: 0;
				}
				.loader-ellips__dot:nth-child(3) { left: 1.5em; }
				.loader-ellips__dot:nth-child(4) { left: 3em; }

				@keyframes reveal {
				  from { transform: scale(0.001); }
				  to { transform: scale(1); }
				}

				@keyframes slide {
				  to { transform: translateX(1.5em) }
				}

				.loader-ellips__dot:nth-child(1) {
				  animation-name: reveal;
				}

				.loader-ellips__dot:nth-child(2),
				.loader-ellips__dot:nth-child(3) {
				  animation-name: slide;
				}

				.loader-ellips__dot:nth-child(4) {
				  animation-name: reveal;
				  animation-direction: reverse;
				}
				.vmBtn {
				  text-align:center;
				  margin-top:0px;
				}
				.view-more-button{
				  background-color:#a1a1a1;
				  border-style:none;
				  color:#fff;
				  font-size:18px;
				  padding:8px 16px;
				  border-radius:3px;
				  cursor: pointer;
				}
			</style>
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last">You have made it till the end!</p>
			  <p class="infinite-scroll-error">No more posts left!</p>
			</div>
			<script type="text/javascript">
jQuery(document).ready(function($) {
    $('ul.products').infiniteScroll({
        append: 'li.product',
        path: 'a.page-numbers.next',
        hideNav: 'nav.woocommerce-pagination',
        history: false,
		status: '.page-load-status',
    });

});
</script>
<?php
			}
			
		}

		// Custom selectors
		else {
			
			$hideNav_custom = $settings['custom_selector_navigation_setting'];
			$path_custom = $settings['custom_selector_next_setting'];
			$content_custom = $settings['custom_selector_content_setting'];
			$append_custom = $settings['custom_selector_item_setting'];
			
           if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				echo "<strong>Infinite Scroll Elementor: </strong>Executed fine, please check preview or page for results.";
			}
			else {
			?>
			<style>
				.page-load-status {
				 display:none; /* hidden by default */
				  text-align: center;
				  color: #000428;
				}

				.loader-ellips {
				  font-size: 12px; /* change size here */
				  position: relative;
				  width: 4em;
				  height: 1em;
				  margin: 10px auto;
				}

				.loader-ellips__dot {
				  display: block;
				  width: 1em;
				  height: 1em;
				  border-radius: 0.5em;
				  background: #a1a1a1; /* change color here */
				  position: absolute;
				  animation-duration: 0.5s;
				  animation-timing-function: ease;
				  animation-iteration-count: infinite;
				}

				.loader-ellips__dot:nth-child(1),
				.loader-ellips__dot:nth-child(2) {
				  left: 0;
				}
				.loader-ellips__dot:nth-child(3) { left: 1.5em; }
				.loader-ellips__dot:nth-child(4) { left: 3em; }

				@keyframes reveal {
				  from { transform: scale(0.001); }
				  to { transform: scale(1); }
				}

				@keyframes slide {
				  to { transform: translateX(1.5em) }
				}

				.loader-ellips__dot:nth-child(1) {
				  animation-name: reveal;
				}

				.loader-ellips__dot:nth-child(2),
				.loader-ellips__dot:nth-child(3) {
				  animation-name: slide;
				}

				.loader-ellips__dot:nth-child(4) {
				  animation-name: reveal;
				  animation-direction: reverse;
				}
				.vmBtn {
				  text-align:center;
				  margin-top:0px;
				}
				.view-more-button{
				  background-color:#a1a1a1;
				  border-style:none;
				  color:#fff;
				  font-size:18px;
				  padding:8px 16px;
				  border-radius:3px;
				  cursor: pointer;
				}
			</style>
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last">You have made it till the end!</p>
			  <p class="infinite-scroll-error">No more posts left!</p>
			</div>
			<script type="text/javascript">
jQuery(document).ready(function($) {
    $('<?php echo $content_custom ?>').infiniteScroll({
        append: '<?php echo $append_custom ?>',
        path: '<?php echo $path_custom ?>',
        hideNav: '<?php echo $hideNav_custom ?>',
        history: false,
		status: '.page-load-status',
    });
});
</script>
<?php
			}
		}
		
	}
}