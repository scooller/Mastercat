<?php get_header(); ?>
<?php get_template_part( 'part', 'banner' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
?>
<section class="container-fluid page-cont" id="page-<?=$ID;?>" style="background-color: <?=$color_bg?>">
	<h2 class="title mx-auto text-center<?php echo get_field('mostrar_titulo')?'':' d-none' ?>"><?php the_title(); ?></h2>
	<div class="container"><?php the_content(); ?></div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 