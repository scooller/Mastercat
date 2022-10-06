<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-single' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
?>
<section class="container-fluid page-cont" id="master-vet">
</section>
<?php get_template_part( 'part', 'vetroute' ); ?>
<?php if(get_field('mostrar_mv')): ?>
<section class="container-fluid page-cont" id="master-vet-online">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
				<div class="col-12 col-md-6 txts text-center">
					<img src="<?php echo get_field('mastervet_online_group')['imagen_principal']['url'];?>" class="img-fluid img-title mx-auto">
					<div class="cont"><?php echo get_field('mastervet_online_group')['texto_inferior_imagen'];?></div>
					<?php if( get_field('mastervet_online_group')['mostrar_popup'] ): ?>
					<a data-fancybox data-src="#popup-content" href="javascript:;" class="btn btn-primary"><?php echo get_field('mastervet_online_group')['texto_boton'];?></a>
					<?php elseif( get_field('mastervet_online_group')['boton'] ): $link = get_field('mastervet_online_group')['boton']; 
						$link_target = $link['target'] ? $link['target'] : '_self'; ?>
						<a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="btn btn-primary"><?=$link['title'];?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<img src="<?php echo get_field('mastervet_online_group')['imagen_lateral_derecha']['url'];?>" class="img_100 mx-auto">
			</div>
		</div>
	</div>
</section>
<div class="d-none">
	<div id="popup-content"><?php echo get_field('mastervet_online_group')['contenido_popup'];?></div>
</div>
<?php endif; ?>
<section class="container-fluid page-cont" id="master-vet-contacto">
	<div class="container text-center">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<div class="title">
					<?php echo get_field('formulario_de_contacto_group')['titulo'];?>
				</div>
				<div class="formulario">
					<?php echo get_field('formulario_de_contacto_group')['contenido'];?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid page-cont g-0" id="blog">
	<h2 class="title text-center mt-4">Preguntas Frecuentes</h2>
	<div class="container news">
		<div class="row">
			<div class="col-12 col-md-10 mx-auto"><div class="row">
		<?php $query = new WP_Query(array('post_type' => 'preguntas-frecuentes', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
    	if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID(); 
    		
			$foto = get_the_post_thumbnail_url($ID, 'full');
    	?>
    		<div class="col-12 col-sm-6 col-lg-4 mb-4 text-center">
				<a href="<?php echo esc_url( get_permalink( $ID ) ); ?>">
					<div class="new">
						<div class="img" style="background-size: cover; background-image: url(<?php echo $foto; ?>);">
							<!--<img src="<?php echo $foto; ?>" class="img-fluid invisible">-->
						</div>
						<div class="inter">
							<small><?php the_date(); ?></small>
							<h4 class="mini-title"><?php the_title(); ?></h4>
							<div class="cont">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				</a>
			</div>
    	<?php endwhile; endif; wp_reset_query(); ?>
    		</div></div>
		</div>
	</div>
</section>
<section class="sliders container-fluid page-cont g-0" id="master-vet-mastermatch">
	<div class="owl-carousel owl-theme owl-mmatch">
		<div class="img-carousel">
			<div class="content">
		        <h4><img src="<?php echo get_field('master_match_group')['logo']['url'];?>"></h4>
		        <span><?php echo get_field('master_match_group')['contenido'];?></span>
		        <a href="<?php echo get_field('master_match_group')['boton']['url'];?>" class="btn btn-primary" title="<?php echo get_field('master_match_group')['boton']['title'];?>"><?php echo get_field('master_match_group')['boton']['title'];?></a>
		    </div>
		    <img src="<?php echo get_field('master_match_group')['background_image']['url'];?>" class="img-fluid">
	    </div>	    
	</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 
<script type="text/javascript">
$('.owl-vet').owlCarousel({
    loop:true,
    margin:0,
    dots:false,
    nav:true,
    items:1,
    responsive:{
    }
})
$('.owl-mmatch').owlCarousel({
    loop:true,
    margin:0,
    dots:false,
    nav:true,
    items:1,
    responsive:{
    }
})
</script> 