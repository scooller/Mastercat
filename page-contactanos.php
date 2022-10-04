<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-otros' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();?>
<section class="container-fluid page-cont" id="contactanos">
	<div class="container">
		<h1 class="title text-center"><?php echo get_field('cuerpo_group')['titulo']; ?></h1>
		<h4 class="sub-title text-center"><?php echo get_field('cuerpo_group')['sub_titulo']; ?></h4>
		<div class="row">
			<div class="cont col-12 col-md-6 offset-0 offset-md-3"><?php echo do_shortcode(get_field('cuerpo_group')['contenido']); ?></div>
		</div>
	</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 