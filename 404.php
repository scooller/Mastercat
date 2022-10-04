<?php get_header(); ?>
<?php //get_template_part( 'part', 'banner' ); ?>
<section class="container-fluid page-cont" id="page-<?=$ID;?>">	
	<div class="container text-center">
		<h1><?php echo get_field('paginas_errores_group','option')['titulo'] ?></h1>
		<p><?php echo get_field('paginas_errores_group','option')['contenido'] ?></p>
		<img src="<?php echo get_field('paginas_errores_group','option')['imagen'] ?>" class="img-fluid mx-auto">		
	</div>
</section>
<?php get_footer('solo'); ?> 