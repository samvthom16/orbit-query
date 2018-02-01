<ul class="pq-cards">
	<?php while( $this->query->have_posts() ) : $this->query->the_post();?>
	<li class="pq-card">
		<?php 
			
			$url = false;
			
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $this->query->post->ID ), 'medium' );
			if( is_array( $thumbnail ) ){
				$url = $thumbnail[0];
			}
			
			
		?>
		<?php if( $url ):?>
		<div class='pq-image' style="background-image:url('<?php _e( $url );?>')"><a class="pq-link" href="<?php the_permalink();?>"></a></div>
		<?php endif;?>
		<div class='pq-content'>
			<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
			<p><small>Published by <a href="<?php the_author_link();?>"><?php the_author();?></a> on <?php the_date();?> | <?php the_category( ', ' ); ?></small></p>
			<p><?php the_excerpt();?></p>
		</div>
	</li>
	<?php endwhile;?>
</ul>
<style>
	.pq-cards{
		display: grid;
		grid-gap: 20px;
		grid-template-columns: 1fr 1fr;
		list-style: none;
		padding-left: 0;
	}
	.pq-card{
		border: #aaa solid 1px;
		display: grid;
		grid-gap: 20px;
		grid-template-areas: "image" "content";
		grid-template-columns: 1fr;
	}
	.pq-image{
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		grid-area: image;
		min-height: 300px;
		position: relative;
	}
	.pq-link{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}
	.pq-content{
		padding: 0px 20px 20px;
		grid-area: content;
	}
	
	@media( max-width: 768px ){
		.pq-cards{
			grid-template-columns: 1fr;
		}
		.pq-image{
				min-height: 230px;
		}
	}
</style>