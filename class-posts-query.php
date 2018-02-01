<?php

class POSTS_QUERY extends POSTS_QUERY_BASE{
	
	function __construct(){
		
		$this->shortcode = 'posts-query';
		$this->shortcode_slug = 'posts_query';
		
		$this->init();
	}
	
	function get_default_atts() {	
		return array(
			'sticky_posts'			=> '0',
			'exclude_sticky_posts'	=> '0',
			'post_type' 			=> 'post',
			'post_status'			=> 'publish',
			'posts_per_page'		=> '10',
			'post__not_in'			=> '',
			'post__in'				=> '',
			's'						=> '',
			'author'				=> '',
			'cat'					=> '',
			'category_name' 		=> '',
			'tag' 					=> '',
			'offset'				=> '0',
			'pagination'			=> '0',
			'paged'					=> '1',
			'style'					=> '',
			'id'					=> 'posts-'.rand()
		);
	}

	function get_offset($atts){
		return (((int)$atts['paged'] - 1) * (int)$atts['posts_per_page']) + (int)$atts['offset'];
	}
	
	function get_sticky_posts(){
		return get_option( 'sticky_posts' );
	}
	
	function plain_shortcode($atts){
		ob_start();
		$atts = $this->get_atts($atts);
		
		/* ADD STICKY POSTS */
		if( $atts['sticky_posts'] != '0' ){
			$atts['post__in'] = $this->get_sticky_posts();
			$atts['post__in'] = implode(',', $atts['post__in']);
		}
		
		/* EXCLUDE STICKY POSTS */
		if( $atts['exclude_sticky_posts'] != '0' ){
			$atts['post__not_in'] = $this->get_sticky_posts();
			$atts['post__not_in'] = implode(',', $atts['post__not_in']);
		}
			
		$query_atts = array(
			'post_type'		=> $atts['post_type'], 
			'post_status'	=> $atts['post_status'],
			'posts_per_page'=> $atts['posts_per_page'],
			'cat' 			=> $atts['cat'],
			'author'		=> $atts['author'],
			'category_name' => $atts['category_name'],
			'tag' 			=> $atts['tag'],
			's' 			=> $atts['s'],
			'post__not_in' 	=> ! empty($atts['post__not_in']) ? explode(',', $atts['post__not_in']) : '',
			'post__in'		=> ! empty($atts['post__in']) ? explode(',', $atts['post__in']) : '',
			'ignore_sticky_posts'	=> 1,
			'offset'		=> self::get_offset($atts)
		);
		
		$atts['url'] = $this->get_ajax_url($atts, array('paged'));	
			
		$this->query = new WP_Query( $query_atts );
		
		if( $this->query->have_posts() ){
			the_pq_articles( $atts );
			wp_reset_postdata();
		}
			
		return ob_get_clean();
	}
	
	
	
	// CREATE AJAX URL TO REQUEST SUBSEQUENT POSTS LATER
	function get_ajax_url($args, $dont_include = array()){
		$url = admin_url( 'admin-ajax.php' )."?action=posts_query";
		foreach($args as $key=>$val){
			if(!in_array($key, $dont_include) && $val){
				
				$url .= "&".$key."=".$val;
			}
				
		}
		return $url;
	}
		
	
	
	function ajax_callback(){
		
		$shortcode_str = '[posts-query';
			
		$default_atts = self::get_default_atts();
		
		/* init all attributes for the shortcodes */
		foreach($default_atts as $key=>$val){
			if(isset($_GET[$key])){
				$val = $_GET[$key];
			}
			$shortcode_str .= ' '.$key.'="'.$val.'"';
		}
			
		$shortcode_str .= ']';
			
		//echo $shortcode_str;
		echo do_shortcode($shortcode_str);
		
		wp_die();
	}
	
}

global $posts_query;	
$posts_query = new POSTS_QUERY;
