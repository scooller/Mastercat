<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-single' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
?>
<section class="page-cont" id="adopcion-match">
	<div class="container-fluid g-0">
		<div class="row g-0">
	        <div class="col-12 col-lg-7 d-flex align-items-center py-3">
	            <div class="vet-online__left px-3">
	                <img class="vet-online_left-img py-3 pt-lg-0 pb-lg-3 img-fluid" src="<?php echo get_field('master_match_superior_group')['imagen_principal']['url'];?>">
	                <h4 class="title"><?php echo get_field('master_match_superior_group')['titulo'];?></h4>
					<p class="pb-2"><?php echo get_field('master_match_superior_group')['contenido'];?></p>
	                <a href="<?php echo get_field('master_match_superior_group')['boton']['url'];?>" class="btn btn-primary" title="<?php echo get_field('master_match_superior_group')['boton']['title'];?>"><?php echo get_field('master_match_superior_group')['boton']['title'];?></a>
	            </div>
	        </div>
	        <div class="col-12 col-lg-5">
	            <img class="img_100" src="<?php echo get_field('master_match_superior_group')['imagen_lateral']['url'];?>">
	        </div>
	    </div>
	</div>
</section>
<section class="container-fluid page-cont" id="adopcion-cuidados">
	<div class="container">
		<h2 class="title"><?php echo get_field('primeros_pasos_group')['titulo'];?></h2>
	<?php if(get_field('primeros_pasos_group')['tips']): ?>
		<div class="row">
			<?php foreach(get_field('primeros_pasos_group')['tips'] as $tips): ?>
			<div class="col-12 mb-3 col-md text-center">
				<img src="<?php echo $tips['icono']; ?>" class="img-fluid img mx-auto">
				<h4 class="title"><?php echo $tips['titulo']; ?></h4>
				<div class="txt"><?php echo $tips['contenido']; ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	</div>
</section>
<section class="container-fluid page-cont" id="adopcion-fundacion">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 imagen-l">
				<img src="<?php echo get_field('fundacion_adopta')['imagen_lateral']['url'];?>" class="img_100 mx-auto">
			</div>
			<div class="col-12 col-lg-6 d-flex align-items-center py-3">
				<div class="txts text-center">
					<img src="<?php echo get_field('fundacion_adopta')['imagen_principal_1']['url'];?>" class="img-fluid img-title mx-auto">
					<div class="cont"><?php echo get_field('fundacion_adopta')['contenido'];?></div>
					<a href="<?php echo get_field('fundacion_adopta')['boton']['url'];?>" class="btn btn-primary" title="<?php echo get_field('fundacion_adopta')['boton']['title'];?>"><?php echo get_field('fundacion_adopta')['boton']['title'];?></a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="container-fluid page-cont" id="adopcion-jornadas">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-3">
				<div class="txts text-center col-md-8 col-12">
					<img src="<?php echo get_field('jornadas_adopcion_group')['imagen_principal']['url'];?>" class="img-fluid img-title mx-auto">
					<h4 class="title"><?php echo get_field('jornadas_adopcion_group')['titulo'];?></h4>
					<div class="cont"><?php echo get_field('jornadas_adopcion_group')['contenido'];?></div>
					<?php if( get_field('jornadas_adopcion_group')['activar_popup'] ): ?>
					<a data-fancybox data-src="#popup-content" href="javascript:;" class="btn btn-primary"><?php echo get_field('jornadas_adopcion_group')['boton_popup'];?></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<img src="<?php echo get_field('jornadas_adopcion_group')['imagen_lateral']['url'];?>" class="img_100 mx-auto">
			</div>
		</div>
	</div>

	<div class="d-none">
	<div id="popup-content"><?php echo get_field('jornadas_adopcion_group')['contenido_popup'];?></div>
	</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 