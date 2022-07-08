<?php
/**
 * Created by V3
 * Date: 7/08/22
 * Project Name: wp-api
 */

add_filter( 'acf/settings/save_json', 'bsa_acf_json_save_point' );
function bsa_acf_json_save_point( $path ) {
	// update path
	$path = get_stylesheet_directory() . '/inc/acf-options';

	// return
	return $path;
}

add_filter( 'acf/settings/load_json', 'bsa_acf_json_load_point' );
function bsa_acf_json_load_point( $paths ) {
	// remove original path (optional)
	unset( $paths[0] );
	// append path
	$paths[] = get_stylesheet_directory() . '/inc/acf-options';

	// return
	return $paths;
}
