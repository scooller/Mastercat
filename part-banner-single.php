<?php global $detect; ?>
<section id="sliders" class="sliders container-fluid g-0 d-flex align-items-center">
    <div class="owl-carousel owl-theme owl-header">
    	<?php 
            $page_id = get_queried_object_id();
			//$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
            $foto = get_field('background_desktop',$page_id);
            ?>
    	<div class="img-carousel img-<?=$page_id;?>">
            <div class="content">
				<?php if(get_field('imagen_titulo',$page_id)): ?>
				<img src="<?php the_field('imagen_titulo',$page_id); ?>" class="img-fluid">
				<?php else: ?>
                <h3 class="big-title"><?php echo get_the_title($page_id); ?></h3>
                <span><?php echo get_field('cabecera_group',$page_id)['contenido']; ?></span>
				<?php endif; ?>
            </div>
            <img src="<?=$foto;?>" class="img-fluid">
        </div>              
    </div>
</section>