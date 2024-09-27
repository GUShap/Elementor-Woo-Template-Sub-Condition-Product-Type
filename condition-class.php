<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use ElementorPro\Modules\ThemeBuilder\Conditions\Condition_Base;
class Product_Type_Condition extends Condition_Base
{

    /**
     * Get the type of condition.
     *
     * @return string
     */
    public static function get_type()
    {
        return 'product';
    }

    /**
     * Get the priority of this condition.
     *
     * @return int
     */

    /**
     * Get the unique name for this condition.
     *
     * @return string
     */
    public function get_name()
    {
        return 'product_type_condition';
    }

    /**
     * Get the label that appears in Elementor's conditions interface.
     *
     * @return string
     */
    public function get_label()
    {
        return __('Product Type', 'text-domain');
    }

    /**
     * Get the label for "All" product types option.
     *
     * @return string
     */
    public function get_all_label()
    {
        return __('All', 'text-domain');
    }

    protected function _register_controls()
    {
        $product_types = wc_get_product_types(); // Get all registered product types
        $product_types = array_merge(['all' => __('All', 'text-domain')], $product_types);

        $this->add_control(
            'product_types',
            args: [
                'section' => 'settings',
                'label' => __('Page Template'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $product_types,
                'default' => 'all',
            ]
        );
    }

    /**
     * Check if the current product matches the selected product type condition.
     *
     * @param array $args
     * @return bool
     */
    public function check($args)
    {
        if (!is_product()) {
            return false;
        }
        $selected_type = $args['id'];
        if ($selected_type === 'all') {
            return true;
        }

        $product = wc_get_product();
        $product_type = $product->get_type();
        return $product_type === $selected_type;
    }

}
