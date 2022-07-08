<?php
/**
 * Created by V3
 * Date: 07/08/22 
 * Project Name: WP-APi
 */

require get_template_directory() . '/inc/options.php';


add_action( 'acf/init', 'beplus_landing_acf_init' );
function beplus_landing_acf_init() {
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
