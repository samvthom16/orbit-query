<?php if($atts['pagination'] != '0'):?>
	<button data-behaviour='oq-ajax-loading' data-list="<?php _e('#'.$atts['id']);?>" class="load-more" type="button">
		Load More
	</button>
<?php endif;?>