<?php

function register_product_type_sub_conditions($conditions_manager)
{
    require_once PATH_TO_CONDITION_CLASS;
    $conditions_manager->get_condition('product')->register_sub_condition(new \Product_Type_Condition());
}
add_action('elementor/theme/register_conditions', 'register_product_type_sub_conditions', 100);
