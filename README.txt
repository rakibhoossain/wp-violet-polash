=== Violet Custom Post Meta ===
Contributors: serakib
Donate link: www.rakibhossain.cf
Tags: custom fields, custom post types, Custom Taxonomies
Requires at least: 4.5
Tested up to: 4.9.4
Stable tag: 4.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin for Theme developers, Who wants to build portfolio themes rapidly.

== Description ==

To avoid plugin territory warning for CPT and Meta Boxes, This is a great choice for you. Violet Custom Post Meta adds necessary CPT, Meta, Texonomy to develop awesome portfolio theme. 

Post Types:

*   services
*   skill
*   portfolio
*   testimonial
*   team
*   partner

Note that this plugin function can be modify as your choice by filter Hooks.

Hook Lists :

`
vcpm_{post_type}_params //to modify post type args.
vcpm_portfolio_category_params //to modify portfolio texonomy.
vcpm_meta_fields_{post_type} //provides ability to add, remove, modify meta fields.
vcpm_meta_box //Provides ability to create, delete and modify meta box.
vcpm_meta_fields_control //Fields styte, presentation can be modify.
`

== Installation ==

Just install and active the plugin. Custom meta you can use in you theme as by wordpress rules.

Meta fields list can be checked by plugins `/includes/class-vcpm-meta.php`

== Frequently Asked Questions ==

= Can I use both Portfolio image and link? =

No, When you select portfolio image, Portfolio link would be hidden.

= How to modify meta box render style =

Use vcpm_meta_fields_control hook. It accept max 3 arguments ($html,$fields,$post).

`<?php
	function example_callback( $html, $fields, $post ) {
		foreach ($fields as $field) {
	        $value = get_post_meta($post->ID, $field['id'], true);
	        // Actions you need to do
	    }
	    return $html;
	}
	add_filter( 'vcpm_meta_fields_control', 'example_callback' 1, 3 );
?>`

= I need samply query code =

Hear is sample query code for portfolio post types and their meta.

`<?php
//Portfolio post and meta query
$args = array( 'post_type' => 'portfolio');
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
    $post_id = get_the_ID();
    $terms = get_the_terms( $post_id, 'portfolio_category' );
    $post_custom = get_post_custom($post_id);
    $portfolio_title = get_the_title();
    $portfolio_sub = $post_custom["sub_name"][0];
    $portfolio_img = $post_custom["portfolio_img"][0];
    $portfolio_link = esc_url($post_custom["portfolio_link"][0]);
    $portfolio_thumb_url = '';
        $portfolio_thumb_url = wp_get_attachment_url( get_post_thumbnail_id() );
    }
?>`

== Screenshots ==

1. Supports input type text, radio, checkbox, range.
2. Portfolio Category and Image picker.
3. Field type checkbox, radio.
4. Field type select option.
5. General meta box register args.

== Changelog ==

= 1.0 =

Initial release.