<?php
/**
 * Created by V3
 * Date: 07/08/22 
 * Project Name: WP-APi
 */

require get_template_directory() . '/inc/options.php';


add_action( 'acf/init', 'v3_landing_acf_init' );
function v3_landing_acf_init() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		if ( current_user_can( 'administrator' ) ):
			acf_add_options_page( array(
				'page_title'  => __( 'Theme Options', 'atsichs' ),
				'menu_title'  => __( 'Theme Options', 'atsichs' ),
				'menu_slug'   => 'theme-options',
				'parent_slug' => 'themes.php',
			) );
		endif;
	}
}

// create api json
add_action( 'rest_api_init', 'v3_landing_register_api_hooks' );
function v3_landing_register_api_hooks() {
	register_rest_route( 'page-landing', '/data-api', array(
		'methods'  => 'get',
		'callback' => 'v3_landing_get_options',
	) );
}

function v3_landing_get_options(){
	return array(
		'general'       => __general(),
		'hero_section'  => __hero_section(),
		'best_seller'   => __best_seller(),
		'trusted'       => __trusted(),
		'prebuild_demo' => __prebuild_demo(),
		'about_section' => __about_section(),
		'responsive_ss' => __responsive_ss(),
		'optimized_ss'  => __optimized_ss(),
		'special_ss'    => __special_ss(),
		'footer_ss'     => __footer_ss(),
	);
}


function __general(){
	$purchase           = get_field( 'purchase', 'option' );
	$purchase_link      = $purchase['link'];
	$purchase_text      = $purchase['text'];
	$document_link      = get_field( 'document_link', 'option' );
	$support_link       = get_field( 'support_link', 'option' );
	$portfolio_link     = get_field( 'portfolio_link', 'option' );
	$get_elementor      = get_field( 'get_elementor', 'option' );
	$get_elementor_link = $get_elementor['link'];
	$get_elementor_text = $get_elementor['text'];

	return array(
		'document_link'      => $document_link,
		'support_link'       => $support_link,
		'purchase_link'      => $purchase_link,
		'purchase_text'      => $purchase_text,
		'get_elementor_link' => $get_elementor_link,
		'get_elementor_text' => $get_elementor_text,
		'portfolio_link'     => $portfolio_link,
	);
}

function __responsive_ss(){
	return array(
		'heading'     => get_field( 'responsive_heading', 'option' ),
		'sub_heading' => get_field( 'responsive_sub_heading', 'option' ),
	);
}

function __optimized_ss(){
	return array(
		'heading'     => get_field( 'optimized_heading', 'option' ),
		'sub_heading' => get_field( 'optimized_sub_heading', 'option' ),
		'description' => get_field( 'optimized_description', 'option' ),
	);
}

function __special_ss(){
	return array(
		'heading'     => get_field( 'special_heading', 'option' ),
		'description' => get_field( 'special_description', 'option' ),
	);
}

function __footer_ss(){
	return array(
		'heading'        => get_field( 'footer_heading', 'option' ),
		'sub_heading'    => get_field( 'footer_sub_heading', 'option' ),
		'trusted_number' => get_field( 'footer_trusted_number', 'option' ),
	);
}

function __hero_section(){
	return array(
		'highly_customizable' => get_field( 'heading_hero', 'option' ),
		'wordpress_theme'     => get_field( 'wordpress_theme', 'option' ),
		'sales_over'          => get_field( 'sales_over', 'option' ),
		'sell_number'         => get_field( 'sell_number', 'option' ),
		'hero_description'    => get_field( 'hero_description', 'option' ),
		'multipurpose'        => get_field( 'multipurpose', 'option' ),
	);
}

function __best_seller(){
	$list_best_seller = [];
	if ( have_rows( 'list_best_seller', 'option' ) ):
		while ( have_rows( 'list_best_seller', 'option' ) ) : the_row();
			$heading            = get_sub_field( 'heading' );
			$image              = get_sub_field( 'image' );
			$list_best_seller[] = array(
				'heading' => $heading,
				'image'   => $image,
			);
		endwhile;
	endif;

	return array(
		'heading'          => get_field( 'heading_best_seller', 'option' ),
		'sub_heading'      => get_field( 'sub_heading_best_seller', 'option' ),
		'list_best_seller' => $list_best_seller,
	);
}


function __trusted(){
	$list_trusted = [];
	if ( have_rows( 'list_trusted', 'option' ) ):
		while ( have_rows( 'list_trusted', 'option' ) ) : the_row();
			$heading     = get_sub_field( 'heading' );
			$number      = get_sub_field( 'number' );
			$description = get_sub_field( 'description' );

			$list_trusted[] = array(
				'heading'     => $heading,
				'number'      => $number,
				'description' => $description,
			);
		endwhile;
	endif;

	$testimonial = [];
	if ( have_rows( 'testimonial', 'option' ) ):
		while ( have_rows( 'testimonial', 'option' ) ) : the_row();
			$avatar      = get_sub_field( 'avatar' );
			$name        = get_sub_field( 'name' );
			$description = get_sub_field( 'description' );

			$testimonial[] = array(
				'avatar'      => $avatar,
				'name'        => $name,
				'description' => $description,
			);
		endwhile;
	endif;

	return array(
		'heading'      => get_field( 'heading_trusted', 'option' ),
		'list_trusted' => $list_trusted,
		'testimonial'  => $testimonial
	);
}

function __prebuild_demo(){
	$demo_page  = [];
	$cat_filter = [ 'all' => 'All' ];
	if ( have_rows( 'prebuild_demo', 'option' ) ):
		while ( have_rows( 'prebuild_demo', 'option' ) ) : the_row();
			$image_featured  = get_sub_field( 'image_featured' );
			$name_demo_page  = get_sub_field( 'name_demo_page' );
			$link_demo_page  = get_sub_field( 'link_demo_page' );
			$category_filter = get_sub_field( 'category_filter' );
			$new_label       = get_sub_field( 'new_label' );
			$coming_soon     = get_sub_field( 'coming_soon' );
			$cat_temp        = [ 'all' => 'All' ];

			if ( $category_filter ) {
				foreach ( $category_filter as $key => $cat ) {
					$key                = strtolower( str_replace( ' ', '', $cat['value'] ) );
					$cat_filter[ $key ] = $cat['label'];
					$cat_temp[ $key ]   = $cat['label'];
				}
			}
			if ( $image_featured ) {
				$demo_page[] = array(
					'name_demo_page'  => $name_demo_page,
					'image_featured'  => $image_featured,
					'link_demo_page'  => $link_demo_page,
					'category_filter' => $cat_temp,
					'new_label'       => $new_label,
					'coming_soon'     => $coming_soon
				);
			}
		endwhile;
	endif;

	return array(
		'heading'     => get_field( 'heading_prebuild', 'option' ),
		'description' => get_field( 'description_prebuild', 'option' ),
		'cat_filter'  => $cat_filter,
		'demo_page'   => $demo_page,
	);
}

function __about_section(){
	return array(
		'heading'     => get_field( 'heading_about', 'option' ),
		'sub_heading' => get_field( 'sub_heading_about', 'option' ),
		'description' => get_field( 'description_about', 'option' ),
	);
}