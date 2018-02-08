<?php 
	
	/* SHORTCODE TO RETURN THE EXCERPT OF THE POST */
	add_shortcode( 'orbit_excerpt', function(){
		
		global $post;
		
		if( $post->post_excerpt ){
			return $post->post_excerpt;
		}
		
		return wp_trim_excerpt( $post->post_content );
		
	} );
	
	/* SHORTCODE TO RETURN THE CONTENT OF THE POST */
	add_shortcode( 'orbit_content', function(){
		
		global $post;
		
		return $post->post_content;
		
	} );
	
	/* SHORTCODE TO RETURN THE TITLE OF THE POST */
	add_shortcode( 'orbit_title', function(){ 	return get_the_title(); } );
	
	/* SHORTCODE TO RETURN THE LINK OF THE POST */
	add_shortcode( 'orbit_link', function(){ return get_permalink(); } );
	
	/* SHORTCODE TO RETURN THE AUTHOR OF THE POST */
	add_shortcode( 'orbit_author', function(){ return get_the_author(); } );
	
	/* SHORTCODE TO RETURN THE AUTHOR LINK */
	add_shortcode( 'orbit_author_link', function(){ return get_the_author_link(); } );
	
	/* SHORTCODE TO RETURN THE DATE OF THE POST */
	add_shortcode( 'orbit_date', function(){ return get_the_date(); } );
	
	/* SHORTCODE TO RETURN THE FEATURED IMAGE OF THE POST */
	add_shortcode( 'orbit_thumbnail', function( $atts ){
		
		/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
		$atts = shortcode_atts( array('size' => 'post-thumbnail'), $atts, 'orbit_thumbnail' );
		
		return get_the_post_thumbnail( null, $atts['size'] );
		
	} );
	
	
	/* SHORTCODE TO RETURN THE FEATURED IMAGE OF THE POST */
	add_shortcode( 'orbit_terms', function( $atts ){
		
		/* CREATE ATTS ARRAY FROM DEFAULT AND USER PARAMETERS IN THE SHORTCODE */
		$atts = shortcode_atts( array(
			'taxonomy' => 'post_tag'
		), $atts, 'orbit_terms' );
		
		global $post;
		
		$term_list = wp_get_post_terms($post->ID, $atts['taxonomy']);
		
		$html = "";
		
		$i = 1;
		foreach( $term_list as $term ){
			$html .= $term->name; 
			
			if( $i < count( $term_list ) ){
				$html .= ",";
			}
		}
		
		return $html;
		
	} );
	