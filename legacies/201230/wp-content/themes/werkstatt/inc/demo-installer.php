<?php
/**
 * Demo Installer content, One Click Demo Import plugin required
 * See: https://wordpress.org/plugins/one-click-demo-import/
 *
 * @package Werkstatt
 * @since Werkstatt 1.0.1
 * @version 1.0
 */

function ocdi_import_files() {
	return array(

		array(
			'import_file_name'             => 'Demo Werkstatt',
			'categories'                   => array( 'Blog' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo/werkstatt-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo/werkstatt-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/demo/werkstatt-customizer.dat',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );
