<?php global $detect; ?>
<section id="sliders" class="sliders container-fluid g-0 d-flex align-items-center">
    <div class="owl-carousel owl-theme owl-header">
    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
    		$content = get_the_content( );
            $nn++;
			//$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
            $foto = get_the_post_thumbnail_url($post->ID, 'full');
		?>
    	<div class="img-carousel img-<?=$post->ID;?>">
            <div class="content"><?=do_shortcode(wpautop($content));?></div>
            <img src="<?=$foto;?>" class="img-fluid">
        </div>              
    <?php endwhile; endif; wp_reset_query(); ?>
    </div>
</section>