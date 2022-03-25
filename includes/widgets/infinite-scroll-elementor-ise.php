<?php
namespace InfiniteScrollElementorNameSpace\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class ISE_InfiniteScroll extends Widget_Base
{
    public function get_name()
    {
        return 'infinite-scroll-elementor-widget';
    }

    public function get_title()
    {
        return __('Infinite Scroll - ISE', 'infinite-scroll-elementor-td');
    }

    public function get_icon()
    {
        return 'eicon-flash';
    }
    
    public function get_categories()
    {
        return [ 'infinite-scroll-elementor-category' ];
    }

    public function get_script_depends()
    {
        return [ 'infinite-scroll-elementor-js' ];
    }

    public function get_style_depends()
    {
        return [ 'infinite-scroll-elementor-css' ];
    }
    
    protected function register_controls()
    {
        $this->register_layout_content_controls();
        $this->register_infinite_scroll_animation_style_controls();
    }

    protected function register_layout_content_controls()
    {
    
        /* Section Controls Start */
        $this->start_controls_section(
            'section_infinite_scroll_elementor',
            [
            'label' => __('Infinite Scroll Elementor - ISE', 'infinite-scroll-elementor-td'),
        ]
        );
    
        /* Pagination Type */
        $this->add_control(
            'ISE_register',
            [
            'label'       => __('Infinite Scroll', 'infinite-scroll-elementor-td'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'default'      => 'no',
            'label_on'     => __('yes', 'infinite-scroll'),
            'label_off'    => __('no', 'infinite-scroll'),
            'frontend_available' => true,
        ]
        );
        /* Pagination For */
        $this->add_control(
            'pagination_for_setting',
            [
            'label'       => __('Pagination For', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'default'     => 'elementor-pro-posts',
            'separator'		=> 'after',
            'options'     => [
                'elementor-pro-posts'            => __('Elementor Posts', 'infinite-scroll-elementor-td'),
                'elementor-pro-archive-posts'    => __('Elementor Archive Posts', 'infinite-scroll-elementor-td'),
                'elementor-pro-products'         => __('Elementor Products', 'infinite-scroll-elementor-td'),
                'ise-custom-selectors'           => __('Add Custom Selectors', 'infinite-scroll-elementor-td'),
            ],
            'condition' => [
                'ISE_register' => 'yes',
            ]
        ]
        );
    
        $this->add_control(
            'infinite_scroll_elementor_animation',
            [
                'label' 		=> __('Show Loading Animation', 'infinite-scroll-elementor-td'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('yes', 'infinite-scroll'),
                'label_off'    => __('no', 'infinite-scroll'),
                'condition' 	=> [
                    'ISE_register' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite_scroll_elementor_loading_type',
            [
                'label' 		=> __('Loading Type', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'animation',
                'options' 		=> [
                    'animation' 	=> __('Animation', 'infinite-scroll-elementor-td'),
                    'text' 		=> __('Text', 'infinite-scroll-elementor-td'),
                ],
                'condition' => [
                    'ISE_register' => 'yes',
                    'infinite_scroll_elementor_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite_scroll_elementor_loading_text',
            [
                'label' 		=> __('Loading Text', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('Loading...', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('Loading...', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISE_register' => 'yes',
                    'infinite_scroll_elementor_animation' => 'yes',
                    'infinite_scroll_elementor_loading_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'infinite_scroll_elementor_last_text',
            [
                'label' 		=> __('Last Text', 'infinite-scroll-elementor-td'),
				'separator' => 'before',
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('You have made it till the end!', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('You have made it till the end!', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISE_register' => 'yes',
                    'infinite_scroll_elementor_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite_scroll_elementor_error_text',
            [
                'label' 		=> __('Error Text', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('No post here!', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('No post here!', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISE_register' => 'yes',
                    'infinite_scroll_elementor_animation' => 'yes',
                ],
            ]
		);
		
		/* Image Ratio Fix */
        $this->add_control(
            'missing_featured_image_fix',
            [
            'label'        => __('Fix Image Ratio', 'infinite-scroll-elementor-td'),
            'separator'    => 'before',
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => __('yes', 'infinite-scroll-elementor-td'),
            'label_off'    => __('no', 'infinite-scroll-elementor-td'),
            'description' => __('Only make it YES if you have modified Image Ratio to more or less than 0.66 in the Post Widget or if you are missing the featured image.', 'infinite-scroll-elementor-td'),
            'condition' => [
              'ISE_register' => 'yes',
          ],
        ]
        );
    
        /* Documentation Box */
        $this->add_control(
            'documentation',
            [
                  'type'            => Controls_Manager::RAW_HTML,
				  'separator' => 'before',
                  'raw'             => __('Infinite Scroll Elementor plugin adds advanced Ajax Load More and Infinite Scroll functions to Elementor.<br><a href="https://joychetry.com/infinite-scroll-elementor/" target="_blank">Check Documentation</a>', 'infinite-scroll-elementor-td'),
                  'content_classes' => 'elementor-control-raw-html elementor-panel-alert elementor-panel-alert-info',
              ]
        );

        $this->end_controls_section();
    
        /* Custom Selectors */
        $this->start_controls_section(
            'custom_selectors_section',
            [
            'label' => __('Custom Selectors', 'infinite-scroll-elementor-td'),
            'condition' => [
                'pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        /* Navigation Selector */
        $this->add_control(
            'custom_selector_navigation_setting',
            [
            'label'       => __('Navigation Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. nav.navigation', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_selector_next_setting',
            [
            'label'       => __('Next Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. a.next', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_selector_content_setting',
            [
            'label'       => __('Content Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. div.items', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_selector_item_setting',
            [
            'label'       => __('Item Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. div.item', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        $lastText = $settings['infinite_scroll_elementor_last_text'];
        $errorText = $settings['infinite_scroll_elementor_error_text'];
		$loadingText = $settings['infinite_scroll_elementor_loading_text'];
		
		if ($settings['missing_featured_image_fix'] === 'yes') {
            $ImgRatioFix = "$(window).scroll(function() {    
            var scroll = $(window).scrollTop();
            if (scroll >= 0) {
              $('.elementor-post__thumbnail').addClass('elementor-fit-height');
            }
          });";
        }
        
        /* Removed <?php ISEcolor() ?> */

        // Elementor Posts
        if ($settings['pagination_for_setting'] == 'elementor-pro-posts') {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo "<strong>Infinite Scroll Elementor for Elementor Posts: </strong>Executed fine, please check preview or page for results.";
            } else {
                if ($settings['infinite_scroll_elementor_loading_type'] == 'animation') {
                    ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>
				
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			  <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			</div>
			
			<?php
                } else { ?>     
                <style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>           
                <div class="page-load-status">
                    <p class="loadingText infinite-scroll-request"><?php echo $loadingText ?></p>
			        <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			        <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			    </div>
            <?php } ?>
			
			<script type="text/javascript">
          function deferISE(method) {
              if (window.jQuery) {
                  method();
              } else {
                  setTimeout(function() { deferISE(method) }, 50);
              }
          }
          deferISE(function() {            
            jQuery(document).ready(function($) {
              <?php echo $ImgRatioFix ?>
				$('.elementor-posts').infiniteScroll({
					path: 'a.page-numbers.next',
					append: '.elementor-post',
					history: false ,
					hideNav: 'nav.elementor-pagination',
				    status: '.page-load-status',
				});
              });
          });
        </script>
			 
			<?php
            }
        }

        
        // Elementor Archive Posts
        if ($settings['pagination_for_setting'] == 'elementor-pro-archive-posts') {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo "<strong>Infinite Scroll Elementor for Elementor Posts: </strong>Executed fine, please check preview or page for results.";
            } else {
                if ($settings['infinite_scroll_elementor_loading_type'] == 'animation') {
                    ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>
				
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			  <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			</div>
			
			<?php
                } else { ?>     
                <style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>           
                <div class="page-load-status">
                    <p class="loadingText infinite-scroll-request"><?php echo $loadingText ?></p>
			        <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			        <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			    </div>
            <?php } ?>
			
			<script type="text/javascript">
          function deferISE(method) {
              if (window.jQuery) {
                  method();
              } else {
                  setTimeout(function() { deferISE(method) }, 50);
              }
          }
          deferISE(function() {            
            jQuery(document).ready(function($) {
              <?php echo $ImgRatioFix ?>
				$('div.elementor-posts-container').infiniteScroll({
					path: 'a.page-numbers.next',
					append: 'article.elementor-post',
					history: false ,
					hideNav: 'nav.elementor-pagination',
				    status: '.page-load-status',
				});
              });
          });
        </script>
			<?php
            }
        }

        // Elementor Products
        elseif ($settings['pagination_for_setting'] == 'elementor-pro-products') {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo "<strong>Infinite Scroll Elementor for Elementor Posts: </strong>Executed fine, please check preview or page for results.";
            } else {
                if ($settings['infinite_scroll_elementor_loading_type'] == 'animation') {
                    ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>
				
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			  <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			</div>
			
			<?php
                } else { ?>     
                <style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>           
                <div class="page-load-status">
                    <p class="loadingText infinite-scroll-request"><?php echo $loadingText ?></p>
			        <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			        <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			    </div>
            <?php } ?>
			
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('ul.products').infiniteScroll({
					append: 'li.product',
					path: 'a.next.page-numbers',
					hideNav: 'nav.woocommerce-pagination',
					history: false ,
					status: '.page-load-status',
				});
          });
        </script>
			<?php
            }
        }

        // Custom selectors
        elseif ($settings['pagination_for_setting'] == 'ise-custom-selectors') {
            $hideNav_custom = $settings['custom_selector_navigation_setting'];
            $path_custom = $settings['custom_selector_next_setting'];
            $content_custom = $settings['custom_selector_content_setting'];
            $append_custom = $settings['custom_selector_item_setting'];
            
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo "<strong>Infinite Scroll Elementor for Elementor Posts: </strong>Executed fine, please check preview or page for results.";
            } else {
                if ($settings['infinite_scroll_elementor_loading_type'] == 'animation') {
                    ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>
				
			<div class="page-load-status">
			  <div class="loader-ellips infinite-scroll-request">
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
				<span class="loader-ellips__dot"></span>
			  </div>
			  <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			  <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			</div>
			
			<?php
                } else { ?>     
                <style>
				.page-load-status {
				 display:none; /* hidden by default */
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
                             
			</style>           
                <div class="page-load-status">
                    <p class="loadingText infinite-scroll-request"><?php echo $loadingText ?></p>
			        <p class="infinite-scroll-last"><?php echo $lastText ?></p>
			        <p class="infinite-scroll-error"><?php echo $errorText ?></p>
			    </div>
            <?php } ?>
			
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('<?php echo $content_custom ?>').infiniteScroll({
					append: '<?php echo $append_custom ?>',
					path: '<?php echo $path_custom ?>',
					hideNav: '<?php echo $hideNav_custom ?>',
					history: false ,
					status: '.page-load-status',
				});
              });
          });
        </script>
			<?php
            }
        }
    }

    public function register_infinite_scroll_animation_style_controls()
    {
        $this->start_controls_section(
            'section_style_animation_infinite_scroll',
            [
                        'label' => __('Infinite Scroll Elementor - ISE', 'infinite-scroll-elementor-td'),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
        );

        $this->add_responsive_control(
            'infinite_scroll_loading_align',
            [
                            'label' 		=> __('Align', 'infinite-scroll-elementor-td'),
                            'type' 			=> Controls_Manager::CHOOSE,
                            'default' 		=> 'center',
                            'options' 		=> [
                                'left' 	=> [
                                    'title' 	=> __('Left', 'infinite-scroll-elementor-td'),
                                    'icon' 		=> 'eicon-h-align-left',
                                ],
                                'center' 		=> [
                                    'title' 	=> __('Center', 'infinite-scroll-elementor-td'),
                                    'icon' 		=> 'eicon-h-align-center',
                                ],
                                'right' 		=> [
                                    'title' 	=> __('Right', 'infinite-scroll-elementor-td'),
                                    'icon' 		=> 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' 	=> [
                                '{{WRAPPER}} .loadingText' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .infinite-scroll-last' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .infinite-scroll-error' => 'text-align: {{VALUE}};',
                            ],
                        ]
        );

        $this->add_responsive_control(
            'infinite_scroll_status_top_spacing',
            [
                            'label' 		=> __('Spacing', 'infinite-scroll-elementor-td'),
                            'type' 			=> Controls_Manager::DIMENSIONS,
                            'size_units' 	=> [ 'px', 'em', '%' ],
                            'selectors' 	=> [
                                '{{WRAPPER}} .page-load-status' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
							'default' => [
										'unit' => 'px',
										'top' => 0,
										'right' => 0,
										'bottom' => 24,
										'left' => 0,
										'isLinked' => true,
										]
							]
        );

        $this->add_control(
            'infinite_scroll_loader_color',
            [
                            'label' 	=> __('Animation Color', 'infinite-scroll-elementor-td'),
							'separator' => 'before',
                            'type' 		=> Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'default' => '#a1a1a1',
                            'selectors' => [
                                '{{WRAPPER}} .loader-ellips__dot' => 'background: {{VALUE}};',
                            ],
							'condition' => [
                                'infinite_scroll_elementor_loading_type' => 'animation',
                            ]
                        ]
        );
        
        $this->end_controls_section();
    }
}
