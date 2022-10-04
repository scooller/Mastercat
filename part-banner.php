<?php global $detect; ?>
<section id="sliders" class="sliders container-fluid g-0 d-flex align-items-center">
    <div class="owl-carousel owl-theme owl-header owl-home">
    	<?php 
    	global $detect;
        $nn=0;
    	$query = new WP_Query(array('post_type' => 'banner', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
    	if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
    		$content = get_the_content( );
            $nn++;
			//$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
            $foto=get_field('imagen',$post->ID);
            if( $detect->isMobile() ){
                if(!empty(get_field('imagen_mobile',$post->ID))){
                    $foto=get_field('imagen_mobile',$post->ID);
                }
            }
		?>
    	<div class="img-carousel img-<?=$post->ID;?>">
            <div class="content"><?=do_shortcode(wpautop($content));?></div>
            <img src="<?=$foto;?>" class="img-fluid">
        </div>              
    <?php endwhile; endif; wp_reset_query(); ?>
    </div>
</section>