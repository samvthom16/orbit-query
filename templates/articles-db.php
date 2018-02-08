<ul class="orbit-article-<?php _e( $atts['style-id'] );?> orbit-articles-db">
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li>
		<?php echo do_shortcode( get_post_meta( $atts['style-id'], 'html', true ) );?>
	</li>
	<?php endwhile;?>
</ul>
