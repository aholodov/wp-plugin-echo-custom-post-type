<?php


/**
 * @param $id
 * @param string $size
 *
 * @return mixed
 */
function get_attached_img_url( $id, $size = "full" ) {
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );

	if ( is_array( $img ) ) {
		return array_shift( $img );
	}

	return false;
}

/**
 * Get template part.
 *
 *
 * @access public
 *
 * @param mixed $slug
 * @param string $name (default: '')
 */
function pt_eco_get_template_part( $name = '', $args = null ) {
	$template = '';

	// Look in yourtheme/name.php and yourtheme/pt-echo/name.php
	if ( $name ) {
		$template = locate_template( array( "{$name}.php", 'pte-templates/' . "{$name}.php" ) );
	}

	// Get default name.php
	if ( ! $template && $name && file_exists( PT_ECHO_DIR . "templates/{$name}.php" ) ) {
		$template = PT_ECHO_DIR . "templates/{$name}.php";
	}

	$template = apply_filters( 'pt_eco_get_template_part', $template, $name );

	$args = apply_filters( 'pt_eco_get_template_part_args', $args );

	if ( $args ) {
		extract( $args );
	}
	if ( $template ) {
		include( $template );
	}
}


function test() {
	if ( $overridden_template = locate_template( 'some-template.php' ) ) {
		// locate_template() returns path to file
		// if either the child theme or the parent theme have overridden the template
		load_template( $overridden_template );
	} else {
		// If neither the child nor parent theme have overridden the template,
		// we load the template from the 'templates' sub-directory of the directory this file is in
		load_template( dirname( FILE ) . '/templates/some-template.php' );
	}
}