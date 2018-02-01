<?php
	
function the_pq_articles( $atts ){
	global $posts_query;
	$posts_query->include_template_file( 'articles', $atts );
}

function the_pq_pagination( $atts ){
	global $posts_query;
	$posts_query->include_template_file( 'pagination', $atts );
}

function the_pq_users( $atts ){
	global $posts_query_users;
	$posts_query_users->include_template_file( 'users', $atts );
}