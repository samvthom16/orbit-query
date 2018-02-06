<ul class="orbit-article-<?php _e( $atts['style-id'] );?> orbit-articles-db">
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li>
		<?php 
			$tmpl = get_post_meta( $atts['style-id'], 'html', true );
			eval("?>". $tmpl ."<?" );
		?>
	</li>
	<?php endwhile;?>
</ul>
