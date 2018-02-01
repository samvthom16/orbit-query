<ul>
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li>
		<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
		<p><small>Published by <a href="<?php the_author_link();?>"><?php the_author();?></a> on <?php the_date();?> | <?php the_category( ', ' ); ?></small></p>
		<p><?php the_excerpt();?></p>
		<br><br>
	</li>
	<?php endwhile;?>
</ul>
