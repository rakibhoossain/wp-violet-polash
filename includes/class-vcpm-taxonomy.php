<?php
/**
 * Register taxonomies
 *
 * @link       www.rakibhossain.cf
 * @since      1.0.0
 *
 * @package    Vcpm
 * @subpackage Vcpm/includes
 */
class Vcpm_Taxonomy {

    /**
     * Add taxonomies(portfolio category)
     *
     * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
     */
    // public function vcpm_taxonomy_portfolio() {
    //     $labels = array(
    //         'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'vcpm' ),
    //         'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'vcpm' ),
    //         'search_items'      => __( 'Search Portfolio Categories', 'vcpm' ),
    //         'all_items'         => __( 'All Portfolio Categories', 'vcpm' ),
    //         'parent_item'       => __( 'Parent Portfolio Category', 'vcpm' ),
    //         'parent_item_colon' => __( 'Parent Portfolio Category:', 'vcpm' ),
    //         'edit_item'         => __( 'Edit Portfolio Category', 'vcpm' ), 
    //         'update_item'       => __( 'Update Portfolio Category', 'vcpm' ),
    //         'add_new_item'      => __( 'Add New Portfolio Category', 'vcpm' ),
    //         'new_item_name'     => __( 'New Portfolio Category', 'vcpm' ),
    //         'menu_name'         => __( 'Portfolio Categories', 'vcpm' ),
    //     );
    //     $args = array(
    //         'labels' => $labels,
    //         'hierarchical' => true,
    //     );
    //     register_taxonomy( 'portfolio_category', 'portfolio', apply_filters('vcpm_portfolio_category_params', $args) );
    // }

    public function vcpm_taxonomy_activity() {
        $labels = array(
            'name'              => _x( 'Activity Categories', 'taxonomy general name', 'vcpm' ),
            'singular_name'     => _x( 'Activity Category', 'taxonomy singular name', 'vcpm' ),
            'search_items'      => __( 'Search Activity Categories', 'vcpm' ),
            'all_items'         => __( 'All Activity Categories', 'vcpm' ),
            'parent_item'       => __( 'Parent Activity Category', 'vcpm' ),
            'parent_item_colon' => __( 'Parent Activity Category:', 'vcpm' ),
            'edit_item'         => __( 'Edit Activity Category', 'vcpm' ), 
            'update_item'       => __( 'Update Activity Category', 'vcpm' ),
            'add_new_item'      => __( 'Add New Activity Category', 'vcpm' ),
            'new_item_name'     => __( 'New Activity Category', 'vcpm' ),
            'menu_name'         => __( 'Activity Categories', 'vcpm' ),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
        );
        register_taxonomy( 'activity_category', 'activity', apply_filters('vcpm_activity_category_params', $args) );
    }
}
