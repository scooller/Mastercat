<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
	$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
?>
<section class="container-fluid page-cont d-flex justify-content-center align-items-stretch" id="master-club">
    <div class="container text-center">
        <?php //echo do_shortcode( '[contact-form-7 id="1853" title="Master Club"]' ); ?>
		<?php echo do_shortcode( get_field('formulario') ); ?>
    </div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?> 
<script type="text/javascript">
var nGatos = 1;
var currItem = 0;
var owl = $('.owl-exp');
owl.owlCarousel({
	autoplay:false,
    loop:false,
    margin:0,
    dots:false,
    nav:false,
    items:1,
    touchDrag:false,
    mouseDrag:false,
    responsive:{
    }
}).on('changed.owl.carousel', function(event) {
	currItem=event.property.value;
	console.log("paso:"+currItem);
	
	$(window).scrollTop($('#master-club .owl-item .paso-'+(currItem+1) ).offset().top-($('#master-club .owl-item .paso-'+(currItem+1)).height()/3));
	
	if(currItem == 2){
		$('.paso-3 ul.peludos').empty();
		console.log()
		$('input.nombregato_arry').each(function(index) {
			console.log(index);
			$('.paso-3 ul.peludos').prepend('<li class="list-group-item d-flex justify-content-between align-items-start">'+$(this).val()+'<span class="badge bg-primary rounded-pill">'+$($('input.anhos_arry')[index]).val()+' Años '+$($('input.meses_arry')[index]).val()+' Meses</span></li>')
		});		
	}
});
$(window).scrollTop($('#master-club .owl-item .paso-1').offset().top-($('#master-club .owl-item .paso-1').height()/3));
$('.next-step').click(function(){
	if( $('input[name="anhos"]').val() !== "" ){
		if( typeof $('input[name="anhos_arry['+nGatos+']"]').val() === "undefined" ){
			$('#hidden_input').prepend('<input type="hidden" name="anhos_arry['+nGatos+']" class="anhos_arry" value="'+$('input[name="anhos"]').val()+'">');
		}else{
			$('input[name="anhos_arry['+nGatos+']"]').val($('input[name="anhos"]').val());
		}
	}
	if( $('input[name="meses"]').val() !== "" ){
		if( typeof $('input[name="meses_arry['+nGatos+']"]').val() === "undefined" ){
			$('#hidden_input').prepend('<input type="hidden" name="meses_arry['+nGatos+']" class="meses_arry" value="'+$('input[name="meses"]').val()+'">');
		}else{
			$('input[name="meses_arry['+nGatos+']"]').val($('input[name="meses"]').val());
		}
	}
	if( $('input[name="nombregato"]').val() !== "" ){
		if( typeof $('input[name="nombregato_arry['+nGatos+']"]').val() === "undefined" ){
			$('#hidden_input').prepend('<input type="hidden" name="nombregato_arry['+nGatos+']" class="nombregato_arry" value="'+$('input[name="nombregato"]').val()+'">');
		}else{
			$('input[name="nombregato_arry['+nGatos+']"]').val($('input[name="nombregato"]').val());
		}
	}
	$('input[name="n_gatos"]').val(nGatos);
	var $nNext=true;
	switch(currItem){
		case 0:
			if( (typeof $('input[name="meses"]').val() === "undefined") && (typeof $('input[name="anhos"]').val() === "undefined") ){
				$nNext=false;
				alerta("<div class='stroke'><h2>Atención,</h2><p>Debes Ingresar la edad</p></div>");
			}
			if( ($('input[name="meses"]').val()==0) && ($('input[name="anhos"]').val()==0) ){
				$nNext=false;
				alerta("<div class='stroke'><h2>Atención,</h2><p>Debes Ingresar la edad</p></div>");
			}
			break;
		case 1:
			if( (typeof $('input[name="nombregato"]').val() === "undefined") || ($('input[name="nombregato"]').val()=='') ){
				$nNext=false;
				alerta("<div class='stroke'><h2>Atención,</h2><p>Debes Ingresar el nombre</p></div>");
			}
			break;
	}
	if($nNext){
		console.log('next');
    	owl.trigger('next.owl.carousel');
	}	
});
$('.back-step').click(function(){
    console.log('prev');
    owl.trigger('prev.owl.carousel');
});
$('.new-cat').click(function(){
	nGatos+=1;
	resetInputs();
});
function resetInputs(){
	$('input[name="anhos"]').val('');
	$('input[name="meses"]').val('');
	$('input[name="nombregato"]').val('');
	currItem=0;
    owl.trigger('to.owl.carousel', 0);
}
$(function() {
	document.removeEventListener( 'wpcf7mailsent', msj_gracias, false );
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		alerta( "<div class='stroke'><h2>¡Bienvenid@!</h2><span>Ya eres parte de Master Club</span></div>" );
		resetInputs()
	}, false );
});
</script>