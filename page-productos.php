<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-interior' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();?>
<section class="container-fluid page-cont g-0" id="productos-home">
	<div class="cont-gral">
		<div class="container text-center"><?php echo get_field('contenido_productos'); ?></div>
	</div>
	<div class="container contenedor">
		<?php $n=0; if( have_rows('productos') ): while( have_rows('productos') ) : the_row(); $n++; ?>		
		<div class="row g-0">
			<?php if($n%2): ?>
			<div class="col-md-7 txt-r txt d-flex align-items-center">
				<div>
					<h5 class="mini-title d-flex align-items-center"><img src="<?php the_sub_field('icono') ?>" class="icon"> <?php the_sub_field('titulo') ?></h5>
					<div class="txts"><?php the_sub_field('contenido') ?></div>
					<a href="<?php echo esc_url( get_category_link( get_sub_field('link_boton')) ); ?>" class="btn btn-secondary" target="_self">Ver Productos</a>
				</div>
			</div>
			<div class="col-md-5 img-prod">
				<div class="productos owl-carousel owl-theme owl-prod">
					<?php
					$productos_posts = get_sub_field('productos');
					if( $productos_posts ):
						foreach( $productos_posts as $producto_id ):
					?>
					<div class="prod text-center">
					<a href="<?php echo esc_url( get_permalink( $producto_id ) ); ?>">
						<img src="<?php echo get_field('general_group',$producto_id)['imagen_detalle_alimento']['url']; ?>" class="img mx-auto">
						<h4><?php echo get_the_title($producto_id); ?></h4>
					</a>
					</div>
					<?php 
						endforeach;
					endif; ?>
				</div>
			</div>
			<?php else: ?>			
			<div class="col-md-5 img-prod order-1 order-md-0">
				<div class="productos owl-carousel owl-theme owl-prod">
					<?php
					$productos_posts = get_sub_field('productos');
					if( $productos_posts ):
						foreach( $productos_posts as $producto_id ):
					?>
					<div class="prod text-center">
					<a href="<?php echo esc_url( get_permalink( $producto_id ) ); ?>">
						<img src="<?php echo get_field('general_group',$producto_id)['imagen_detalle_alimento']['url']; ?>" class="img mx-auto">
						<h4><?php echo get_the_title($producto_id); ?></h4>
					</a>
					</div>
					<?php 
						endforeach;
					endif; ?>
				</div>
			</div>
			<div class="col-md-7 txt-l txt d-flex align-items-center order-0 order-md-1">
				<div>
					<h4 class="mini-title d-flex align-items-center"><img src="<?php the_sub_field('icono') ?>" class="icon"> <?php the_sub_field('titulo') ?></h4>
					<div class="txts"><?php the_sub_field('contenido') ?></div>
					<a href="<?php echo esc_url( get_category_link( get_sub_field('link_boton')) ); ?>" class="btn btn-secondary" target="_self">Ver Productos</a>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endwhile; endif; ?>
	</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 
<script type="text/javascript">
$('.owl-prod').owlCarousel({
    loop:true,
    autoplay: true,
    autoplayTimeout: <?php the_field('tiempo_espera','option'); ?>,
    autoplayHoverPause: <?php echo (get_field('pausar_mouse','option'))?'true':'false'; ?>,
    margin:0,
    dots:true,
    nav:false,
    smartSpeed:450,
    items:1,
    responsive:{
    }
})
</script>