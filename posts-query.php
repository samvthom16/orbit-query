<?php
/*
Plugin Name: Posts Query
Plugin URI: http://wordpress.org/plugins/posts-query/
Description: The simplest way to build and display WordPress Posts without writing a single line of code. Includes multiple customizable templates that allows to match the look and feel of the website.
Author: Samuel Thomas
Version: 1.0
Author URI: http://sputznik.com/
*/

$inc_files = array(
	'class-posts-query-base.php',
	'class-posts-query.php',
	'class-posts-query-users.php',
	'the.php'
);

foreach( $inc_files as $inc_file ){
	include( $inc_file );
}