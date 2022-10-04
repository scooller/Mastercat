<?php get_header(); ?>
<section id="sliders" class="container-fluid g-0">
    <div class="owl-carousel owl-theme owl-header">
    	<?php 
    		$ID=get_the_ID();
			//$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
            $foto = get_the_post_thumbnail_url($ID, 'full');
            ?>
    	<div class="img-carousel img-<?=$page_id;?>" style="background-image: url(<?=$foto;?>);">            
            <img src="<?=$foto;?>" class="img-fluid d-none">
        </div>              
    </div>
</section>
<section class="single">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
	$categories = get_the_category();
	$categorias = array();
	foreach($categories as $category){
		array_push($categorias,$category->name);
	}
?>
	<div class="container">
		<div class="head-news text-center">
			<span class="type-news"><?php echo implode(",", $categorias) ?></span>
			<h3 class="mini-title text-center"><?php the_title(); ?></h3>
        </div>
		
		<div class="content">
		<?php the_content(); ?>
		</div>
	</div>
<?php endwhile; endif; ?>
</section>
<section class="relacionado bg-grey mt-5" id="blog">
	<div class="container news">		
		<h4 class="title text-center">Otras publicaciones que podrían interesarte</h4>
	<?php
	$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 2, 'post__not_in' => array($post->ID) ) );
	if( $related ): ?>
	<div class="row justify-content-center">
	<?php 
		foreach( $related as $post ) :
		setup_postdata($post); 
		$ID=get_the_ID();
		$categories = get_the_category();
		$categorias = array();
		$categorias_slug = array();
		foreach($categories as $category){
			array_push($categorias,$category->name);
			array_push($categorias_slug,$category->slug);
		}
		$foto = get_the_post_thumbnail_url($ID, 'full');
	?>
	<div class="col-12 col-sm-6 col-lg-4 mb-4 text-center <?php echo implode(" ", $categorias_slug) ?>">
		<a href="<?php echo esc_url( get_permalink( $ID ) ); ?>">
			<div class="new">
				<div class="img" style="background-size: cover; background-image: url(<?php echo $foto; ?>);">
					<!--<img src="<?php echo $foto; ?>" class="img-fluid">-->
				</div>
				<div class="inter">
					<small><?php echo implode(",", $categorias) ?></small>
					<h4 class="mini-title"><?php the_title(); ?></h4>
					<div class="cont">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
		</a> 
	</div>
	<?php endforeach; ?>
	</div>
	<?php endif;
	wp_reset_postdata(); 
	?>
	</div>
</section>
<?php get_footer(); ?> 