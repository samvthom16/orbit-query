<?php
	
function the_orbit_articles( $atts ){
	global $orbit_query;
	$orbit_query->include_template_file( 'articles', $atts );
}

function the_orbit_pagination( $atts ){
	global $orbit_query;
	$orbit_query->include_template_file( 'pagination', $atts );
}

function the_orbit_users( $atts ){
	global $posts_query_users;
	$posts_query_users->include_template_file( 'users', $atts );
}