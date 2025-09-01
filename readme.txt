=== Infinite Scroll Elementor ===

Contributors: joychetry
Donate link: https://www.buymeacoffee.com/joychetry/
Tags: infinite scroll, load more, pagination, paginate, scroll, infinite, infinity, ajax, posts, products, elementor, woocommerce, facetwp, jetsmartfilters
Requires at least: 5.0
Tested up to: 6.7.2
Requires PHP: 5.6
Stable tag: 2.6.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

== Description ==

Infinite Scroll Elementor pulls the next posts automatically when the reader approaches the bottom of the page. Plugin supports Elementor Posts, Elementor Archive, WooCommerce Products, WooCommerce Products Archive and also has support for Custom Selectors.

= Quick Links =

- Full Documentation: [Infinite Scroll Elementor - Website](https://joychetry.com/infinite-scroll-elementor/)
- [Buy me a coffee](https://www.buymeacoffee.com/joychetry/)

= How it Works? =

Infinite Scroll Elementor plugin pulls the next posts automatically when the reader approaches the bottom of the page.

== Installation ==

= How to manually install Infinite Scroll Elementor? =

= From within WordPress =

1. Visit 'Plugins > Add New'
1. Search for 'Infinite Scroll Elementor'
1. Activate Infinite Scroll Elementor for WordPress from your Plugins page.
1. Open page with Elementor, go to 'Elements -> Infinite Scroll - ISE' to configure.

= Manually =

1. Upload the `infinite-scroll-elementor` folder to the `/wp-content/plugins/` directory
1. Activate the Infinite Scroll Elementor plugin through the 'Plugins' menu in WordPress
1. Open page with Elementor, go to 'Elements -> Infinite Scroll - ISE' to configure.

== Frequently Asked Questions ==

= Will it add extra CSS and JavaScript to pages? =
Infinite Scroll Elementor does not add any CSS to your website. It only adds few lines of JavaScript wherever you have placed these widgets.

= How to get support? =
You can also get help from my website by [commenting in this post](https://joychetry.com/infinite-scroll-elementor/).

== Changelog ==

= 2.6.1 - 2025-09-01 =
* Fix: Elementor Backwards Compatibility - Resolved fatal error caused by deprecated `Elementor\Core\Schemes\Color` class
  * Added comprehensive backwards compatibility helper for all Elementor versions
  * Updated all color controls to use safe compatibility methods
  * Implemented automatic detection of deprecated vs modern Elementor classes
  * Added class existence checks to prevent fatal errors
  * Created Elementor_Compatibility helper class with safe color control generation
  * Updated widget files to use compatibility-safe color controls
  * Implemented graceful fallback for deprecated Elementor features

* Fix: Resolved SearchWP integration fatal errors related to deprecated Elementor classes
* Fix: Fixed color control compatibility across different Elementor versions
* Fix: Prevented fatal errors on full-page loads and search form submissions
* Fix: Ensured plugin works with both legacy and modern Elementor installations
* Feature: History Mode Configuration - Disabled History Mode by default in both widgets
  * Improved user experience by preventing unexpected browser navigation changes
  * Enhanced SEO compatibility for infinite scroll implementations
  * Maintained user control with ability to enable History Mode when needed
* Compatibility: Tested with Elementor 2.0.0 to 3.27.6 and Elementor Pro 3.27.4
* Compatibility: Maintained backwards compatibility with existing implementations

* Update: Plugin Update Checker - Upgraded from v4.11 to v5.6 (4-year upgrade)
  * Added WordPress 5.5+ auto-updates integration for better user experience
  * Improved ZIP handling for more reliable plugin updates
  * Enhanced security with 4+ years of accumulated patches
  * Added broader internationalization support
  * Better Debug Bar integration for debugging capabilities

= 2.6 - 2025-02-18 =
* Feature: Advanced Widget Targeting ([#9](https://github.com/joychetry/infinite-scroll-elementor/issues/6)) ([#10](https://github.com/joychetry/infinite-scroll-elementor/issues/11)) ([#11](https://github.com/joychetry/infinite-scroll-elementor/issues/12)) ([#12](https://github.com/joychetry/infinite-scroll-elementor/issues/13)) ([#13](https://github.com/joychetry/infinite-scroll-elementor/issues/21)) ([#14](https://github.com/joychetry/infinite-scroll-elementor/issues/23)) ([#15](https://github.com/joychetry/infinite-scroll-elementor/issues/24))
  * New `button_target_widget_id` control for precise pagination
  * Specify exact CSS ID/Class for targeted content loading
  * Supports all pagination scenarios (Posts, Archive Posts, Products)

* Feature: Enhanced Scroll Configuration
  * Scroll Threshold Control: Customize distance from viewport bottom for content loading
  * Element Scroll Customization: Specify custom scrollable container via CSS selector

* Feature: Flexible History Management
  * Three history update modes: Replace, Push, Disabled
  * Optional page title update for new content

* Improvement: Dynamic Content Handling
  * MutationObserver implementation for dynamically loaded elements
  * Robust image ratio fix using `querySelectorAll`

* Improvement: Multi-Widget Compatibility
  * Unique identifier generation to prevent widget conflicts
  * Creates distinctive classes for each widget instance

* Technical Update: Comprehensive Control Descriptions
  * Added detailed explanations for new and existing controls
  * Improved user understanding of configuration options

* Compatibility: 
  * Tested with WordPress 6.7.2, Elementor 3.27.6 and Elementor Pro 3.27.4
  * Maintained backwards compatibility with existing implementations

= 2.5 - 2025-01-17 =
* Fix: Undefined variable warning for $ImgRatioFixButton
* Fix: jQuery compatibility improvements
* Update: Migrated from deprecated Elementor color schemes to new global system ([#8](https://github.com/joychetry/infinite-scroll-elementor/pull/25))
* Tested with WordPress 6.7.1 and Elementor 3.26.5

= 2.4.1 - 2022-04-04 =
* Fix: Code error ([#7](https://github.com/joychetry/infinite-scroll-elementor/pull/18))

= 2.4 - 2022-03-28 =
* Fix: Compatibility with Elementor 3.6 ([#6](https://github.com/joychetry/infinite-scroll-elementor/pull/17))
* Fix: Button Load - ISE is now visible in Elementor Widgets Panel ([#5](https://github.com/joychetry/infinite-scroll-elementor/issues/16))

= 2.3.2 - 2020-11-08 =
* Fix: WooCommerce Product loop fix in Infinite Scroll Elementor ([#4](https://github.com/joychetry/infinite-scroll-elementor/pull/4))

= 2.3.1 - 2020-11-08 =
* Fix: Syntax error at line 1041 in Button Load Elementor ([#2](https://github.com/joychetry/infinite-scroll-elementor/issues/3#issuecomment-723476404))

= 2.3 - 2020-11-07 =
* Tweak: Defer jQuery compatibility ([#2](https://github.com/joychetry/infinite-scroll-elementor/issues/2))
* Fix: Missing class 'elementor-fit-height' after Infinite Scrolling ([#3](https://github.com/joychetry/infinite-scroll-elementor/issues/3))
* Tweak: Ability to toggle Image Ratio Fix in Elementor Post and Elementor Archive.
* Tweak: Infinite Scroll Elementor options are properly arranged.
* New: Ability to add Margin.
* New: Ability to add Text Shadow.
* New: Ability to add Spacing to Loading Animation.

= 2.2.2 - 2020-10-20 =
* Fix: Fatal error after adding both Infinite Scroll Elementor and Button Load Elementor two times in the same page ([#1](https://github.com/joychetry/infinite-scroll-elementor/issues/1#issuecomment-711065217))

= 2.2.1 - 2020-10-16 =
* Fix: Fatal error after adding both Infinite Scroll Elementor and Button Load Elementor in the same page ([#1](https://github.com/joychetry/infinite-scroll-elementor/issues/1))
* Fix: Fatal error after setting animation color to global color.

= 2.2.0 - 2020-09-26 =
* New: Button Load Elementor - ISE.
* New: Style Tab.
* Tweak: Added ability to Load More using Button.
* Tweak: Added ability to disable loaded animation.
* Tweak: Added ability to select Loading Type between Animation and Text.
* Tweak: Added ability to customize Last Text and Error Text.
* Tweak: Added Loading animation to Elementor Products widget infinite scroll.
* Tweak: Added ability to add Loading text.
* Tweak: Added ability to Style Button.
* Tweak: Added ability to Style Loading Text, Last Text and Error Text.

= 2.1.2 - 2020-09-10 =
* Tweak: General Fixes.
* Tweak: Added Loading animation to Elementor Products widget infinite scroll.

= 2.1.1 - 2020-09-06 =
* Tweak: Grammar slam.

= 2.1 - 2020-09-05 =
* Tweak: Added new Infinite Scroll JavaScript
* Tweak: Added compatibility with Wordpress 5.5
* Tweak: Added compatibility with Elementor 3.0
* Tweak: Added support for Other Elementor Adons
* Tweak: Removed custom Loading Image and No More Items option.
* Tweak: Added Loading Image and No More Items and removed option to the code.

= 1.5.25 - 2020-05-25 =
* Tweak: Renamed Infinite Scroll Elementor widget to Infinite Scroll - ISE.
* Tweak: Removed Load More from Infinite Scroll - ISE.
* Tweak: Added spearate widget Load More - ISE.

= 1.5.24 - 2020-05-24 =
* Tweak: Added  Extra Options
* Tweak: Conditional load for Assign Load More ID
