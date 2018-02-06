<?php

class ORBIT_QUERY_BASE{
	
	var $query;
	var $shortcode;
	var $default_atts;
	
	function __construct(){
		
		$this->shortcode = '';
		$this->shortcode_slug = '';
		
		$this->init();
		
	}
	
	function init(){
		add_action( 'wp_enqueue_scripts', array( $this, 'assets') );
		
		add_shortcode( $this->shortcode, array( $this, 'plain_shortcode' ), 100 );
		
		add_action( 'wp_ajax_'.$this->shortcode_slug, array( $this, 'ajax_callback' ) );
		add_action( 'wp_ajax_nopriv_'.$this->shortcode_slug, array( $this, 'ajax_callback' ) );
		
		/* ADD FORMS THROUGH THE BACKEND */
		add_filter( 'orbit_post_type_vars', array( $this, 'create_post_type' ) );
		
		/* ADD THE RELEVANT META BOXES TO THE FORM */
		add_filter( 'orbit_meta_box_vars', array( $this, 'create_meta_box' ) );
	}
	
	function create_post_type( $post_types ){
			
		$post_types['orbit-tmp'] = array(
			'slug' 		=> 'orbit-tmp',
			'labels'	=> array(
				'name' 			=> 'Orbit Templates',
				'singular_name' => 'Orbit Template',
			),
			'supports'	=> array( 'title' ),
			'menu_icon'	=> 'dashicons-media-document'
		);
			
		return $post_types;
	}
	
	function create_meta_box( $meta_box ){
			
		$meta_box['orbit-tmp'] = array(
			array(
				'id'		=> 'orbit-tmp-cf',
				'title'		=> 'Settings',
				'fields'	=> array(
					'html' => array( 
						'type' 		=> 'textarea',
						'text' 		=> 'HTML', 
					),
				)
			),
		);
			
		
			
		return $meta_box;
	}
	
	function get_default_atts(){
		return array();
	}
	
	function get_atts($atts){
		$defaults_atts = apply_filters( $this->shortcode_slug.'_atts', $this->get_default_atts() );
		$atts = shortcode_atts( $defaults_atts, $atts, $this->shortcode );
		return $atts;
	}

	function plain_shortcode($atts){
		
	}
	
	function ajax_callback(){
		
	}
	
		
	// CHECK IF THE TEMPLATE FILE EXISTS IN THE THEME
	function include_template_file( $template, $atts ){
		
		
		if( isset( $atts['style'] ) ){
			$template_url = $template.'-'.$atts['style'].'.php';
		}
		else{
			$template_url = $template.'.php';	
		}
		
		$theme_templates_url = get_stylesheet_directory()."/orbit-query/".$template_url;
		$plugin_templates_url = plugin_dir_path(__FILE__)."/templates/".$template_url;
		
		
		
		if( file_exists( $theme_templates_url ) ){
			include( $theme_templates_url );
		}
		else if( file_exists( $plugin_templates_url ) ){
			include( $plugin_templates_url );
		}
		else{
			include( "templates/".$template.".php" );
		}
	}
	
	function has_shortcode( $posts ){
		$found = false;
		if ( !empty($posts) ){
			foreach ($posts as $post) {
				if ( has_shortcode($post->post_content, $this->shortcode ) ){
					$found = true;
					break;
				}
			}	
		}
		return $found;
	}
	
	/* LOAD SCRIPTS AND STYLES IF THE SHORTCODE IS USED */
	function assets($posts){
		
		$uri = plugin_dir_url( __FILE__ );
			
		// ENQUEUE SCRIPT
		wp_enqueue_script('jquery');
		wp_enqueue_script('pf-script', $uri.'js/posts-query.js', array('jquery'), '1.0.2', true);
			
	}
}