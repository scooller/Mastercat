<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
<section class="container-fluid page-cont g-0" id="productos-category">
    <div class="container">
        <h1 class="title text-center"><?php echo single_cat_title( '', false ); ?></h1>
    	<div class="contenedor">  
            <div class="row">
                <?php while ( have_posts() ) : the_post(); $ID=get_the_ID();?>
                <div class="col-6 col-md-4 mb-4">
            		<div class="prod text-center">
                    <a href="<?php echo esc_url( get_permalink( $ID ) ); ?>">
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <img src="<?php echo get_field('general_group',$ID)['imagen_detalle_alimento']['url']; ?>" class="img mx-auto">
                            <div class="txts">
                                <h5 class="mini-title"><?php echo get_the_title($ID); ?></h5>
                                <button class="btn btn-secondary">Ver Producto</button>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
    	</div>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?> 