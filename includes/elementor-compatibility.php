<?php
/**
 * Elementor Backwards Compatibility Helper
 * Handles deprecated classes and methods for older Elementor versions
 *
 * @package InfiniteScrollElementor
 * @since 1.0.0
 */

namespace InfiniteScrollElementorNameSpace;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Elementor Compatibility Helper Class
 * Provides backwards compatibility for deprecated Elementor classes and methods
 */
class Elementor_Compatibility {

    /**
     * Check if deprecated Color scheme class exists
     *
     * @return bool True if deprecated class exists, false otherwise
     */
    public static function has_deprecated_color_scheme() {
        return class_exists('\Elementor\Core\Schemes\Color');
    }

    /**
     * Check if deprecated Typography scheme class exists
     *
     * @return bool True if deprecated class exists, false otherwise
     */
    public static function has_deprecated_typography_scheme() {
        return class_exists('\Elementor\Core\Schemes\Typography');
    }

    /**
     * Check if modern Global Colors class exists
     *
     * @return bool True if modern class exists, false otherwise
     */
    public static function has_global_colors() {
        return class_exists('\Elementor\Core\Kits\Documents\Tabs\Global_Colors');
    }

    /**
     * Check if modern Global Typography class exists
     *
     * @return bool True if modern class exists, false otherwise
     */
    public static function has_global_typography() {
        return class_exists('\Elementor\Core\Kits\Documents\Tabs\Global_Typography');
    }

    /**
     * Get safe color control configuration that works with all Elementor versions
     *
     * @param string $label The label for the color control
     * @param string $default_color The default color value
     * @param array $additional_config Additional configuration options
     * @return array Color control configuration array
     */
    public static function get_safe_color_control($label = 'Color', $default_color = '#000000', $additional_config = []) {
        $control_config = array_merge([
            'label' => __($label, 'infinite-scroll-elementor-td'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => $default_color,
        ], $additional_config);

        // Add global colors for newer Elementor versions
        if (self::has_global_colors()) {
            $control_config['global'] = [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
            ];
        }

        return $control_config;
    }

    /**
     * Get safe typography control configuration that works with all Elementor versions
     *
     * @param string $name The control name
     * @param string $label The label for the typography control
     * @param string $selector The CSS selector for the typography
     * @param array $additional_config Additional configuration options
     * @return array Typography control configuration array
     */
    public static function get_safe_typography_control($name = 'typography', $label = 'Typography', $selector = '', $additional_config = []) {
        $control_config = array_merge([
            'name' => $name,
            'label' => __($label, 'infinite-scroll-elementor-td'),
            'type' => \Elementor\Group_Control_Typography::get_type(),
        ], $additional_config);

        if (!empty($selector)) {
            $control_config['selector'] = $selector;
        }

        // Add global typography for newer Elementor versions
        if (self::has_global_typography()) {
            $control_config['global'] = [
                'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
            ];
        }

        return $control_config;
    }

    /**
     * Get safe scheme-based color control for backwards compatibility
     * This method handles the transition from deprecated schemes to global colors
     *
     * @param string $label The label for the color control
     * @param string $default_color The default color value
     * @param string $global_color_constant The global color constant to use
     * @return array Color control configuration array
     */
    public static function get_legacy_safe_color_control($label = 'Color', $default_color = '#000000', $global_color_constant = null) {
        $control_config = [
            'label' => __($label, 'infinite-scroll-elementor-td'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => $default_color,
        ];

        // Use deprecated scheme method if available (older Elementor versions)
        if (self::has_deprecated_color_scheme()) {
            $scheme_value = defined('\Elementor\Core\Schemes\Color::COLOR_1') ?
                \Elementor\Core\Schemes\Color::COLOR_1 : '1';

            $control_config['scheme'] = [
                'type' => \Elementor\Core\Schemes\Color::get_type(),
                'value' => $scheme_value,
            ];
        }
        // Use modern global colors for newer versions
        elseif (self::has_global_colors()) {
            $global_default = $global_color_constant ?: \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY;
            $control_config['global'] = [
                'default' => $global_default,
            ];
        }

        return $control_config;
    }

    /**
     * Get safe scheme-based typography control for backwards compatibility
     *
     * @param string $name The control name
     * @param string $label The label for the typography control
     * @param string $selector The CSS selector for the typography
     * @param string $global_typography_constant The global typography constant to use
     * @return array Typography control configuration array
     */
    public static function get_legacy_safe_typography_control($name = 'typography', $label = 'Typography', $selector = '', $global_typography_constant = null) {
        $control_config = [
            'name' => $name,
            'label' => __($label, 'infinite-scroll-elementor-td'),
            'type' => \Elementor\Group_Control_Typography::get_type(),
        ];

        if (!empty($selector)) {
            $control_config['selector'] = $selector;
        }

        // Use deprecated scheme method if available (older Elementor versions)
        if (self::has_deprecated_typography_scheme()) {
            $scheme_value = defined('\Elementor\Core\Schemes\Typography::TYPOGRAPHY_1') ?
                \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1 : '1';

            $control_config['scheme'] = $scheme_value;
        }
        // Use modern global typography for newer versions
        elseif (self::has_global_typography()) {
            $global_default = $global_typography_constant ?: \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY;
            $control_config['global'] = [
                'default' => $global_default,
            ];
        }

        return $control_config;
    }

    /**
     * Safely get Elementor plugin instance
     *
     * @return \Elementor\Plugin|null The Elementor plugin instance or null if not available
     */
    public static function get_elementor_instance() {
        return class_exists('\Elementor\Plugin') ? \Elementor\Plugin::$instance : null;
    }

    /**
     * Check if Elementor is in edit mode safely
     *
     * @return bool True if in edit mode, false otherwise
     */
    public static function is_edit_mode() {
        $elementor = self::get_elementor_instance();
        return $elementor && $elementor->editor && $elementor->editor->is_edit_mode();
    }

    /**
     * Get current Elementor version safely
     *
     * @return string|null Elementor version or null if not available
     */
    public static function get_elementor_version() {
        if (defined('ELEMENTOR_VERSION')) {
            return ELEMENTOR_VERSION;
        }

        if (function_exists('get_plugins')) {
            $plugins = get_plugins();
            foreach ($plugins as $plugin_file => $plugin_data) {
                if (strpos($plugin_file, 'elementor.php') !== false) {
                    return $plugin_data['Version'] ?? null;
                }
            }
        }

        return null;
    }

    /**
     * Check if current Elementor version is deprecated schemes version
     *
     * @return bool True if using deprecated schemes version, false otherwise
     */
    public static function is_deprecated_schemes_version() {
        $version = self::get_elementor_version();
        return $version && version_compare($version, '3.6.0', '<');
    }
}
