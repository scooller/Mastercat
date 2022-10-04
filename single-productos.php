<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
?>
<section class="container-fluid page-cont prod-<?php echo $ID; ?>" id="header-producto">
	<div class="contenido mx-auto">
		<div class="row">
			<div class="col-md-7 order-1 order-md-0">
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="content"><?php echo get_field('cabecera_group',$ID)['contenido']; ?></div>
			
				<h5 class="title">Presentación</h5>
				<div class="sale-points__presentations mb-4">
				<?php if(get_field('cabecera_group',$ID)['presentacion']): foreach(get_field('cabecera_group',$ID)['presentacion'] as $presentacion): ?>
                    <span class="sale-points-pill mb-4"><?php echo trim($presentacion['presentacion']); ?>&#8239;<?php echo trim($presentacion['volumen']); ?></span>
                <?php endforeach; endif; ?>
                </div>
                <div class="d-none d-sm-block mb-5">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#response-dialog-sale">Ver puntos de venta</button>
                </div>
			</div>
			<div class="col-md-5 order-0 order-md-1">
				<img src="<?php echo get_field('general_group',$ID)['imagen_detalle_alimento']['url']; ?>" class="img-fluid mx-auto">
			</div>
		</div>
	</div>
</section>
<?php if(get_field('atributos_funcionales_group',$ID)['atributos']): ?>
<section id="atributos-funcionales">
	<div class="container d-flex flex-column justify-content-center">
		<h2 class="title text-center"><?php echo get_field('atributos_funcionales_group',$ID)['titulo'] ?></h2>
		<div class="group row mx-auto">
		<?php foreach(get_field('atributos_funcionales_group',$ID)['atributos'] as $atributos): ?>
			<div class="item col-md col-12">
				<img src="<?php echo $atributos['icono']['url']; ?>" class="img-fluid icono-atributo">
				<h4 class="title"><?php echo $atributos['titulo']; ?></h4>
				<div class="cont"><?php echo $atributos['contenido']; ?></div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<section id="ingredientes">
	<div class="container">
		<h2 class="title text-center"><small><?php echo get_field('ingredientes_group',$ID)['pre_titulo'] ?></small><?php echo get_field('ingredientes_group',$ID)['titulo'] ?></h2>
		<div class="row ingredients_content my-5 px-3 px-md-0 mx-auto">
			<?php if(get_field('ingredientes_group',$ID)['iconos']): foreach(get_field('ingredientes_group',$ID)['iconos'] as $iconos): ?>
			<div class="col-3 col-md">
				<img src="<?php echo $iconos['icono']['url']; ?>" class="icono img-fluid">
			</div>
			<?php endforeach; endif; ?>
		</div>
		<div class="txt text-center"><?php echo get_field('ingredientes_group',$ID)['contenido'] ?></div>
	</div>
</section>
<?php 
$informacion_nutricional_group=get_field('informacion_nutricional_group',$ID);
if($informacion_nutricional_group['informacion_nutricional']): ?>
<section id="nutricional">
	<div class="container">
		<h2 class="title text-center"><small><?php echo $informacion_nutricional_group['titulo'] ?></small><?php echo $informacion_nutricional_group['nombre_de_alimento'] ?></h2>
		<div class="nutricional owl-carousel owl-theme owl-nutri">
			<?php foreach($informacion_nutricional_group['informacion_nutricional'] as $informacion_nutricional): ?>
			<div class="item text-center">
				<img src="<?php echo $informacion_nutricional['icono_porcentaje']['url'] ?>" class="img-fluid mx-auto svg">
				<h5 class="title"><?php echo $informacion_nutricional['nombre'] ?></h5>
				<span>(<?php echo $informacion_nutricional['texto_inferior'] ?>)</span>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<?php 
$porciones_recomendadas_group=get_field('porciones_recomendadas_group',$ID);
if( $porciones_recomendadas_group['imagen'] ): ?>
<section id="porciones">
	<div class="container">
		<h2 class="title text-center"><small><?php echo $porciones_recomendadas_group['pre_titulo'] ?></small><?php echo $porciones_recomendadas_group['titulo'] ?></h2>
		<div class="txt text-center">
			<?php echo $porciones_recomendadas_group['contenido']; ?>
			<img class="img-fluid mx-auto" src="<?php echo $porciones_recomendadas_group['imagen']['url'] ?>" alt="">
		</div>
	</div>
</section>
<?php endif; ?>
<!--
<?php 
$productos_relacionados_group=get_field('productos_relacionados_group',$ID)['productos_relacionados'];
if($productos_relacionados_group): ?>
<section id="relacionados">
	<div class="container">
    <h2 class="title text-center">Conoce la familia de Productos</h2>
		<div class="relacionados text-center owl-carousel owl-theme owl-relacionados">
			<?php 			
			foreach($productos_relacionados_group as $productos_relacionados):  ?>
			<div class="prod text-center">
            <a href="<?php echo esc_url( get_permalink( $productos_relacionados->ID ) ); ?>">
                <img src="<?php echo get_field('general_group',$productos_relacionados->ID)['imagen_detalle_alimento']['url']; ?>" class="img mx-auto">
                <h4 class="n-title"><?php echo get_the_title($productos_relacionados->ID); ?></h4>
            </a>
            </div>
			<?php endforeach; ?>
		</div>	
	</div>
</section>
<?php endif; ?>
-->
<?php 
//TODOS los PRODUCTOS
$query = new WP_Query(array('post_type' => 'productos', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
if ( $query->have_posts() ): ?>
<section id="relacionados">
	<div class="container">
    <h2 class="title text-center">Conoce la familia de Productos</h2>
		<div class="relacionados text-center owl-carousel owl-theme owl-relacionados">
			<?php 			
			while ( $query->have_posts() ): $query->the_post();  ?>
			<div class="prod text-center">
            <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
                <img src="<?php echo get_field('general_group',$post->ID)['imagen_detalle_alimento']['url']; ?>" class="img mx-auto">
                <h4 class="n-title"><?php echo get_the_title($post->ID); ?></h4>
            </a>
            </div>
			<?php endwhile; ?>
		</div>	
	</div>
</section>
<?php endif; ?>
<!-- // -->
<div class="modal" tabindex="-1" id="response-dialog-sale">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<div class="w-100">
	        <h3 class="text-center"><small>Puedes comprar</small><?php echo get_the_title($ID); ?><br></h3>
	    </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<ul class="list-group">
			<!--
      	<?php foreach(get_field('puntos_de_venta_group',$ID)['punto_de_venta'] as $punto_de_venta): ?>
      		<li class="list-group-item d-flex justify-content-between align-items-center">
      			<img src="<?php echo $punto_de_venta['logo']; ?>" class="img-fluid logo-venta">
      			<a href="<?php echo $punto_de_venta['enlace']; ?>" target="_blank" class="btn btn-primary">Comprar</a>
      		</li>
      	<?php endforeach; ?>
-->
			<?php foreach(get_field('puntos_de_venta_group','option')['punto_de_venta'] as $punto_de_venta): ?>
      		<li class="list-group-item d-flex justify-content-between align-items-center">
      			<img src="<?php echo $punto_de_venta['logo']; ?>" class="img-fluid logo-venta">
      			<a href="<?php echo $punto_de_venta['enlace']; ?>" target="_blank" class="btn btn-primary">Comprar</a>
      		</li>
      	<?php endforeach; ?>
      	</ul>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?> 
<script type="text/javascript">
$('.owl-nutri').owlCarousel({
    loop:<?php echo count($informacion_nutricional_group)>=4?'true':'false'; ?>,
    center:<?php echo count($productos_relacionados_group)>=4?'false':'true'; ?>,
    margin:0,
    navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
    responsive: {
        0: {
            items: 1,
            nav: false,
            dots: true,
        },
        600: {
            items: 3,
            nav: true,
            dots: false,
        },
        1000: {
            items: 5,
            nav: true,
            dots: false,
        }
    }
})
$('.owl-relacionados').owlCarousel({
    loop:<?php echo count($productos_relacionados_group)>=4?'true':'false'; ?>,
    center:false,
    margin:30,
    nav: true,
    navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
    responsive: {
        0: {
            items: 1,
            dots: true,
        },
        600: {
            items: 2,
            dots: false,
        },
        1000: {
            items: 4,
            dots: false,
        }
    }
})
<?php if( count($productos_relacionados_group)<4 ): ?>
$(function() {
  //$('.owl-relacionados .owl-stage').css({"transform": "translate3d(50%, 0px, 0px)"});
});
<?php endif; ?>
<?php if( count($informacion_nutricional_group)<4 ): ?>
$(function() {
  $('.owl-nutri .owl-stage').css({"transform": "translate3d(0%, 0px, 0px)"});
});
<?php endif; ?>
</script>