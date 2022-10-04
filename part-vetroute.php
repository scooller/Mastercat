<section class="vet-route py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <img class="img-fluid" src="<?php echo get_field('general_group','option')['imagen_lateral']['url']; ?>">
            </div>
            <div class="col-12 offset-md-1 col-md-5 py-4">
                <h3 class="title text-center"><?php echo get_field('general_group','option')['texto_superior_slider']; ?></h3>
                <?php $query = new WP_Query(array('post_type' => 'rutas_master_vet', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'menu_order')); ?>
                <div class="owl-carousel owl-theme owl-vet">
                <?php if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID(); 
                	$foto = get_the_post_thumbnail_url($ID, 'full');
                ?>
                	<img src="<?php echo $foto; ?>" class="img-fluid">
                <?php endwhile; endif; wp_reset_postdata(); ?>
                </div>
                <p><?php echo get_field('general_group','option')['texto_inferior_slider']; ?></p>

            </div>
        </div>
    </div>
</section>