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
class ISE_ButtonLoad extends Widget_Base
{
    public function get_name()
    {
        return 'button-load-elementor-widget';
    }

    public function get_title()
    {
        return __('Button Load - ISE', 'infinite-scroll-elementor-td');
    }

    public function get_icon()
    {
        return 'eicon-lightbox';
    }
    
    public function get_categories()
    {
        return [ 'button-load-elementor-category' ];
    }

    public function get_script_depends()
    {
        return [ 'ibutton-load-elementor-js' ];
    }

    public function get_style_depends()
    {
        return [ 'button-load-elementor-css' ];
    }
    
    protected function _register_controls()
    {
        $this->register_layout_content_controls();
        $this->register_button_load_style_controls();
        $this->register_button_animation_style_controls();
    }

    protected function register_layout_content_controls()
    {
    
        /* Section Controls Start */
        $this->start_controls_section(
            'section_button_load_elementor',
            [
            'label' => __('Button Load Elementor - ISE', 'infinite-scroll-elementor-td'),
        ]
        );
    
        /* Pagination Type */
        $this->add_control(
            'ISEButton_register',
            [
            'label'       => __('Button Load', 'infinite-scroll-elementor-td'),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'default'      => 'no',
            'label_on'     => __('yes', 'infinite-scroll'),
            'label_off'    => __('no', 'infinite-scroll'),
            'frontend_available' => true,
        ]
        );

        /* Button Text */
        $this->add_control(
            'button_load_elementor_button_text',
            [
                'label' 		=> __('Button Text', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('More Posts', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('More Posts', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISEButton_register' => 'yes',
                 ],
            ]
        );
        
        /* Pagination For */
        $this->add_control(
            'button_pagination_for_setting',
            [
            'label'       => __('Pagination For', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'separator' => 'after',
            'default'     => 'elementor-pro-posts',
            'options'     => [
                'elementor-pro-posts'            => __('Elementor Posts', 'infinite-scroll-elementor-td'),
                'elementor-pro-archive-posts'    => __('Elementor Archive Posts', 'infinite-scroll-elementor-td'),
                'elementor-pro-products'         => __('Elementor Products', 'infinite-scroll-elementor-td'),
                'ise-custom-selectors'           => __('Add Custom Selectors', 'infinite-scroll-elementor-td'),
            ],
            'condition' => [
                'ISEButton_register' => 'yes',
            ]
        ]
        );
    
        $this->add_control(
            'button_load_elementor_animation',
            [
                'label' 		=> __('Show Loading Animation', 'infinite-scroll-elementor-td'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('yes', 'infinite-scroll'),
                'label_off'    => __('no', 'infinite-scroll'),
                'condition' 	=> [
                    'ISEButton_register' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_load_elementor_loading_type',
            [
                'label' 		=> __('Loading Type', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'animation',
                'options' 		=> [
                    'animation' 	=> __('Animation', 'infinite-scroll-elementor-td'),
                    'text' 		=> __('Text', 'infinite-scroll-elementor-td'),
                ],
                'condition' => [
                    'ISEButton_register' => 'yes',
                    'button_load_elementor_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_load_elementor_loading_text',
            [
                'label' 		=> __('Loading Text', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('Loading...', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('Loading...', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISEButton_register' => 'yes',
                    'button_load_elementor_animation' => 'yes',
                    'button_load_elementor_loading_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'button_load_elementor_last_text',
            [
                'label' 		=> __('Last Text', 'infinite-scroll-elementor-td'),
                'separator' => 'before',
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('You have made it till the end!', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('You have made it till the end!', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISEButton_register' => 'yes',
                    'button_load_elementor_animation' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_load_elementor_error_text',
            [
                'label' 		=> __('Error Text', 'infinite-scroll-elementor-td'),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __('No post here!', 'infinite-scroll-elementor-td'),
                'placeholder' 	=> __('No post here!', 'infinite-scroll-elementor-td'),
                'condition' => [
                    'ISEButton_register' => 'yes',
                    'button_load_elementor_animation' => 'yes',
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
              'ISEButton_register' => 'yes',
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
            'custom_button_selectors_section',
            [
            'label' => __('Custom Selectors', 'infinite-scroll-elementor-td'),
            'condition' => [
                'button_pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        /* Navigation Selector */
        $this->add_control(
            'custom_button_selector_navigation_setting',
            [
            'label'       => __('Navigation Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. nav.navigation', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'button_pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_button_selector_next_setting',
            [
            'label'       => __('Next Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. a.next', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'button_pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_button_selector_content_setting',
            [
            'label'       => __('Content Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. div.items', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'button_pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
    
        $this->add_control(
            'custom_button_selector_item_setting',
            [
            'label'       => __('Item Selector', 'infinite-scroll-elementor-td'),
            'label_block' => true,
            'placeholder' => __('E.g. div.item', 'infinite-scroll-elementor-td'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'condition' => [
                'button_pagination_for_setting' => 'ise-custom-selectors',
            ]
        ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        $lastText = $settings['button_load_elementor_last_text'];
        $errorText = $settings['button_load_elementor_error_text'];
        $loadingText = $settings['button_load_elementor_loading_text'];

        $buttonText = $settings['button_load_elementor_button_text'];
        $MissingThumbnail = $settings['missing_featured_image_fix'];

        if ($settings['missing_featured_image_fix'] === 'yes') {
            $ImgRatioFixButton = "$(window).scroll(function() {    
            var scroll = $(window).scrollTop();
            if (scroll >= 0) {
              $('.elementor-post__thumbnail').addClass('elementor-fit-height');
            }
          });";
        }
        
        /* Removed <?php ISEButtoncolor() ?> */

        // Elementor Posts
        if ($settings['button_pagination_for_setting'] == 'elementor-pro-posts') {
            if ($settings['button_load_elementor_loading_type'] == 'animation') {
                ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
				}
				
				.view-more-button:hover {
					text-decoration: none;
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
				
				.view-more-button:hover {
					text-decoration: none;
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
        <div class="vmBtn"><button class="view-more-button"><?php echo $buttonText ?></button></div>
            
        <script type="text/javascript">
          function deferISEbutton(method) {
              if (window.jQuery) {
                  method();
              } else {
                  setTimeout(function() { deferISEbutton(method) }, 50);
              }
          }
          deferISEbutton(function() {            
            jQuery(document).ready(function($) {
              <?php echo $ImgRatioFixButton ?>
            $('.elementor-posts').infiniteScroll({
              path: 'a.page-numbers.next',
              append: '.elementor-post',
              history: false ,
              hideNav: 'nav.elementor-pagination',
                status: '.page-load-status',
                        button: '.view-more-button',
                        scrollThreshold: false,
            });
              });
          });
        </script>
			<?php
        }

        
        // Elementor Archive Posts
        if ($settings['button_pagination_for_setting'] == 'elementor-pro-archive-posts') {
            if ($settings['button_load_elementor_loading_type'] == 'animation') {
                ?>
                    <style>
				.page-load-status {
				 display:none; /* hidden by default */
				}
				
				.view-more-button:hover {
					text-decoration: none;
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
				
				.view-more-button:hover {
					text-decoration: none;
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
    
      <div class="vmBtn"><button class="view-more-button"><?php echo $buttonText ?></button></div>

			<script type="text/javascript">
        function deferISEbutton(method) {
            if (window.jQuery) {
                method();
            } else {
                setTimeout(function() { deferISEbutton(method) }, 50);
            }
        }
        deferISEbutton(function() {
            jQuery(document).ready(function($) {
              <?php echo $ImgRatioFixButton ?>
          $('div.elementor-posts-container').infiniteScroll({
            path: 'a.page-numbers.next',
            append: 'article.elementor-post',
            history: false ,
            hideNav: 'nav.elementor-pagination',
              status: '.page-load-status',
                      button: '.view-more-button',
                      scrollThreshold: false,
          });
          });
      });
</script>
			<?php
        }

        // Elementor Products
        elseif ($settings['button_pagination_for_setting'] == 'elementor-pro-products') {
            if ($settings['button_load_elementor_loading_type'] == 'animation') {
                ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
				}
				
				.view-more-button:hover {
					text-decoration: none;
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
				
				.view-more-button:hover {
					text-decoration: none;
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

  <div class="vmBtn"><button class="view-more-button"><?php echo $buttonText ?></button></div>

		<script type="text/javascript">
      function deferISEbutton(method) {
          if (window.jQuery) {
              method();
          } else {
              setTimeout(function() { deferISEbutton(method) }, 50);
          }
      }
      deferISEbutton(function() {
          jQuery(document).ready(function($) {
				$('ul.products').infiniteScroll({
					append: 'li.product',
					path: 'a.next.page-numbers',
					hideNav: 'nav.woocommerce-pagination',
					history: false ,
					status: '.page-load-status',
                    button: '.view-more-button',
                    scrollThreshold: false,
				});
          });
      });
</script>
			<?php
        }

        // Custom selectors
        elseif ($settings['button_pagination_for_setting'] == 'ise-custom-selectors') {
            $hideNav_custom = $settings['custom_button_selector_navigation_setting'];
            $path_custom = $settings['custom_button_selector_next_setting'];
            $content_custom = $settings['custom_button_selector_content_setting'];
            $append_custom = $settings['custom_button_selector_item_setting'];
            
            if ($settings['button_load_elementor_loading_type'] == 'animation') {
                ?>
				<style>
				.page-load-status {
				 display:none; /* hidden by default */
				}
				
				.view-more-button:hover {
					text-decoration: none;
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
				
				.view-more-button:hover {
					text-decoration: none;
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

      <div class="vmBtn"><button class="view-more-button"><?php echo $buttonText ?></button></div>

		<script type="text/javascript">
      function deferISEbutton(method) {
          if (window.jQuery) {
              method();
          } else {
              setTimeout(function() { deferISEbutton(method) }, 50);
          }
      }
      deferISEbutton(function() {
          jQuery(document).ready(function($) {
				$('<?php echo $content_custom ?>').infiniteScroll({
					append: '<?php echo $append_custom ?>',
					path: '<?php echo $path_custom ?>',
					hideNav: '<?php echo $hideNav_custom ?>',
					history: false ,
					status: '.page-load-status',
                    button: '.view-more-button',
                    scrollThreshold: false,
				});
          });
      });
</script>
			<?php
        }
    }

    
    public function register_button_load_style_controls()
    {
        $this->start_controls_section(
            'section_style_infinite_scroll',
            [
                        'label' => __('Button Load Elementor - ISE', 'infinite-scroll-elementor-td'),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
        );
        
        $this->add_responsive_control(
            'infinite_scroll_button_align',
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
                                '{{WRAPPER}} .vmBtn' => 'text-align: {{VALUE}};'
                            ],
                        ]
        );

        $this->add_responsive_control(
            'infinite_scroll_button_margin',
            [
                            'label' 		=> __('Margin', 'infinite-scroll-elementor-td'),
                            'type' 			=> Controls_Manager::DIMENSIONS,
                            'size_units' 	=> [ 'px', 'em', '%' ],
                            'selectors' 	=> [
                                '{{WRAPPER}} .view-more-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'default' => [
                                        'unit' => 'px',
                                        'top' => 24,
                                        'right' => 0,
                                        'bottom' => 0,
                                        'left' => 0,
                                        'isLinked' => true,
                                        ]
                            ]
        );
        
        $this->add_responsive_control(
            'infinite_scroll_button_padding',
            [
                            'label' 		=> __('Padding', 'infinite-scroll-elementor-td'),
                            'type' 			=> Controls_Manager::DIMENSIONS,
                            'size_units' 	=> [ 'px', 'em', '%' ],
                            'selectors' 	=> [
                                '{{WRAPPER}} .view-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                            'name' 		=> 'infinite_scroll_button_typography',
                            'label' 	=> __('Typography', 'infinite-scroll-elementor-td'),
                            'global' => [
                                'default' => Global_Typography::TYPOGRAPHY_TEXT,
                            ],
                            'selector' 	=> '{{WRAPPER}} .view-more-button',
                        ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'infinite_scroll_button_text_shadow',
                'label' 	=> __('Text Shadow', 'infinite-scroll-elementor-td'),
                'selector' => '{{WRAPPER}} .view-more-button',
            ]
        );
        
        $this->start_controls_tabs('infinite_scroll_button_tabs_hover');
        
        $this->start_controls_tab('infinite_scroll_button_tab_default', [
                        'label' 	=> __('Default', 'infinite-scroll-elementor-td'),
                    ]);
        
        $this->add_control(
            'infinite_scroll_button_color',
            [
                                'label' 	=> __('Color', 'infinite-scroll-elementor-td'),
                                'type' 		=> Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => \Elementor\Scheme_Color::get_type(),
                                    'value' => \Elementor\Scheme_Color::COLOR_1,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .view-more-button' => 'color: {{VALUE}};',
                                ],
                            ]
        );
        
        $this->add_control(
            'infinite_scroll_button_background_color',
            [
                                'label' 	=> __('Background Color', 'infinite-scroll-elementor-td'),
                                'type' 		=> Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => \Elementor\Scheme_Color::get_type(),
                                    'value' => \Elementor\Scheme_Color::COLOR_1,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .view-more-button' => 'background-color: {{VALUE}};',
                                ],
                            ]
        );
        
        $this->end_controls_tab();
        
        $this->start_controls_tab('infinite_scroll_button_tab_hover', [
                        'label' 	=> __('Hover', 'infinite-scroll-elementor-td'),
                    ]);
        
        $this->add_control(
            'infinite_scroll_button_color_hover',
            [
                                'label' 	=> __('Color', 'infinite-scroll-elementor-td'),
                                'type' 		=> Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => \Elementor\Scheme_Color::get_type(),
                                    'value' => \Elementor\Scheme_Color::COLOR_1,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .view-more-button:hover' => 'color: {{VALUE}};',
                                ],
                            ]
        );
        
        $this->add_control(
            'infinite_scroll_button_background_color_hover',
            [
                                'label' 	=> __('Background Color', 'infinite-scroll-elementor-td'),
                                'type' 		=> Controls_Manager::COLOR,
                                'scheme' => [
                                    'type' => \Elementor\Scheme_Color::get_type(),
                                    'value' => \Elementor\Scheme_Color::COLOR_1,
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .view-more-button:hover' => 'background-color: {{VALUE}};',
                                ],
                            ]
        );
        
        $this->add_control(
            'infinite_scroll_button_hover_border_color',
            [
                'label' => __('Border Color', 'infinite-scroll-elementor-td'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .view-more-button:hover, {{WRAPPER}} .view-more-button:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                            'name' 		=> 'load_button',
                            'label' 	=> __('Border', 'infinite-scroll-elementor-td'),
                            'selector' 	=> '{{WRAPPER}} .view-more-button',
                            'separator' => 'before',
                        ]
        );
        
        $this->add_control(
            'infinite_scroll_button_border_radius',
            [
                            'type' 			=> Controls_Manager::DIMENSIONS,
                            'label' 		=> __('Border Radius', 'infinite-scroll-elementor-td'),
                            'size_units' 	=> [ 'px', '%' ],
                            'selectors' 	=> [
                                '{{WRAPPER}}  .view-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'separator'		=> 'after',
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .view-more-button',
            ]
        );
        
        $this->end_controls_section();
    }

    public function register_button_animation_style_controls()
    {
        $this->start_controls_section(
            'section_style_animation_infinite_scroll_button',
            [
                        'label' => __('Loading Style', 'infinite-scroll-elementor-td'),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
        );

        $this->add_responsive_control(
            'infinite_scroll_button_loading_align',
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
                            ]
                        ]
        );
        
        $this->add_responsive_control(
            'infinite_scroll_button_loading_spacing',
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
            'infinite_scroll_button_loader_color',
            [
                            'label' 	=> __('Animation Color', 'infinite-scroll-elementor-td'),
                            'separator' => 'before',
                            'type' 		=> Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => \Elementor\Scheme_Color::get_type(),
                                'value' => \Elementor\Scheme_Color::COLOR_1,
                            ],
                            'default' => '#a1a1a1',
                            'selectors' => [
                                '{{WRAPPER}} .loader-ellips__dot' => 'background: {{VALUE}};',
                            ],
                            'condition' => [
                                'button_load_elementor_loading_type' => 'animation',
                            ]
                        ]
        );
        
        $this->end_controls_section();
    }
}
