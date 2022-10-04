<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-otros' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
?>
<section class="container-fluid page-cont" id="calidad">
<?php
// Check value exists.
if( have_rows('contenido') ): ?>
<div class="container">
<div class="row">
<?php while ( have_rows('contenido') ) : the_row(); ?>
<?php if( get_row_layout() == '1_columna' ): ?>
	<div class="col-12 d-flex align-items-center justify-content-center">
		<div class="cont text-center"><?php echo do_shortcode( get_sub_field('contenido') ); ?></div>
	</div>
<?php elseif( get_row_layout() == '2_columnas' ): ?>
	<div class="col-md-6 d-flex align-items-center justify-content-center">
		<div class="cont text-center"><?php echo do_shortcode( get_sub_field('columna_izq') ); ?></div>
	</div>
	<div class="col-md-6 d-flex align-items-center justify-content-center">
		<div class="cont text-center"><?php echo do_shortcode( get_sub_field('columna_der') ); ?></div>
	</div>
<?php endif; ?>
<?php endwhile; ?>
</div>
</div>
<?php endif; ?>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 