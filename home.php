<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-single' ); ?>
<?php 
if ( have_posts() ) :
	$categories = get_the_category();
	$categorias = array();
	foreach($categories as $category){
		array_push($categorias,$category->name);
	}
?>
<section class="container-fluid page-cont g-0" id="blog">
	<header id="secondary-nav" class="secondary-nav shadow-sm text-center mt-5 shadow-header" style="top:0;">
        <ul class="vam nav list-group list-group-horizontal-md justify-content-center align-items-center">
            <li class="list-group-item">
            	<a data-active="true" class="btn-change-category active nav-link" href="*">Ver todos</a>
            </li>
            <?php foreach($categories as $category): ?>
            <li class="list-group-item px-4 px-md-3">
                <a data-active="false" class="btn-change-category nav-link" href=".<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
            </li>
        	<?php endforeach; ?>
            <li class="list-group-item position-relative blog-input-container">
            	<form class="busqueda">
	                <input class="blog-input__search" type="search" name="search"><i class="fas fa-search" aria-hidden="true"></i>
	            </form>
            </li>
        </ul>
    </header>
	<div class="container news">
		<div class="row grid">
		<?php 
		$cc=0;
		$query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date'));
  		while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID();
		//while ( have_posts() ) : the_post(); $ID=get_the_ID(); 
			$cc++;
			$categories = get_the_category();
			$categorias = array();
			$categorias_slug = array();
			foreach($categories as $category){
				array_push($categorias,$category->name);
				array_push($categorias_slug,$category->slug);
			}
			$foto = get_the_post_thumbnail_url($ID, 'full');
		?>
			<div class="<?php echo $cc==1?'grid-sizer grid-item':'grid-item';?> col-12 col-sm-6 col-lg-4 mb-4 text-center <?php echo implode(" ", $categorias_slug) ?> p-<?php echo $ID; ?>">
			<a href="<?php echo esc_url( get_permalink( $ID ) ); ?>">
				<div class="new">
					<div class="img" style="background-size: cover; background-image: url(<?php echo $foto; ?>);">
						<!--<img src="<?php echo $foto; ?>" class="img-fluid">-->
					</div>
					<div class="inter">
						<small><?php echo implode(",", $categorias) ?></small>
						<h4 class="mini-title"><?php the_title(); ?></h4>
						<div class="cont">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</a>
			</div>
		<?php endwhile; ?>
		</div>
		<?php
		$published_posts = wp_count_posts()->publish;
	    $posts_per_page = 6;
	    $page_number_max = ceil($published_posts / $posts_per_page);	    
		?>
		<div id="paginator" class="btn-group" role="group" aria-label="Paginador">
		<?php for($p=0;$p<$page_number_max;$p++): ?>
			<button type="button" class="btn btn-outline-secondary page-<?=$p+1?> <?php echo $p==0?'active':'';?>" onClick="pag_ajax(<?=$p+1?>)"><?=$p+1?></button>
		<?php endfor; ?>
		</div>
	</div>
	<?php get_template_part( 'part', 'vetroute' ); ?>
</section>
<?php endif; ?>
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
});
$grid=$('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows',
  cellsByRow: {
    rowHeight: 503
  }
});
$('#blog #secondary-nav .list-group-item a').click(function(event){
	event.preventDefault();
	var $href = $(this).attr('href');
	console.log($href);
	$grid.isotope({ filter: $href });
});
$('form.busqueda').submit(function( event ) {
	event.preventDefault();
	var $href = $('.blog-input__search').val();
	console.log($href);
	$.ajax({
	  method: "POST",
	  url: $ajax_url,
	  data: { action: "search_title", titulo: $href }
	}).done(function( result ) {
		console.log(result);
		$grid.isotope({ 
			filter: result,
			cellsByRow: {
				rowHeight: 503
			}
		});
	});
	//$grid.isotope({ filter: '*'+$href+'*' });
});
function pag_ajax($num){
	$('#paginator .active').removeClass('active');
	$('#paginator .page-'+$num).addClass('active');
	$.ajax({
	  method: "POST",
	  url: $ajax_url,
	  data: { action: "paged_posts", page: $num }
	}).done(function( result ) {
		console.log(result);
		$grid.isotope({ 
			filter: result,
			cellsByRow: {
				rowHeight: 503
			}
		});
	});
}
pag_ajax(1);
</script> 