<?php get_header(); ?>
<?php get_template_part( 'part', 'banner-single' ); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $ID=get_the_ID();
?>
<section class="container-fluid page-cont" id="master-match">
	<div class="container text-center txts">
        <?php the_content(); ?>        
    </div>
    <div class="container puntos">
        <h3 class="title titulo-round text-center"><?php the_field('titulo_puntos');?></h3>
        <?php if( have_rows('puntos') ): ?>
        <div class="row puntos-cont">
        <?php $nn=0; while( have_rows('puntos') ) : the_row(); $nn++; ?>
            <div class="col-md d-flex">
                <span><?php echo $nn; ?></span>
                <div class="txt"><?php echo get_sub_field('texto'); ?></div>
            </div>
        <?php endwhile; ?>
        </div>        
        <?php endif; ?>
    </div>
    <div id="preguntas" class="container selector text-center">
        <form id="quest" action="<?=admin_url( 'admin-ajax.php' );?>" method="post" novalidate>
            <ul class="list-unstyled">
            <?php $categorias=get_field('preguntas'); 
            foreach($categorias as $categoria):
                $tax = get_term_by('id', $categoria, 'categoria_gato');
                $taxchilds = get_term_children( $categoria, 'categoria_gato' );
            ?>
                <li class="item-quest">
                    <i class="fas fa-heart icon"></i>
                    <i class="far fa-heart icon"></i>
                    <h2 class="title"><?php echo $tax->name; ?></h2>
                    <div class="col-12 col-md-6 mx-auto">
                    <div class="checks row">
                    <?php foreach($taxchilds as $taxchil): 
                        $subtax = get_term_by('id', $taxchil, 'categoria_gato');
                        //var_dump($subtax);
                    ?>
                    <div class="col-6 col-md">
                        <label>
                            <input class="check-input" type="radio" name="<?php echo $tax->slug; ?>" value="<?php echo $subtax->term_id; ?>" required>
                            <span class="checkmark"><?php echo $subtax->name; ?></span>
                        </label>
                    </div>
                    <?php endforeach; ?>
                    </div></div>
                </li>
            <?php endforeach; ?>
            </ul>
            <input type="hidden" name="action" value="get_gatito">
            <button type="submit" class="btn btn-primary">Probar Master Match</button>
        </form>
    </div>
	<div class="cargando-icon text-center d-none"><i class="fa-solid fa-shield-cat fa-spin"></i></div>
    <div id="resultado" class="d-none">
        <hr>
        <div class="row gato-principal">            
        </div>
        <div class="otros text-center">
            <h2 class="title text-center mx-auto mb-4 mt-3">Otros gatos ideales para ti</h2>
            <div class="row"></div>
            <button type="button" class="btn btn-warning mx-auto">Volver al Formulario</button>
        </div>        
        
        <div class="msj-form text-center" id="form-adopta" style="display: none;">
            <h3 class="big-title">Master Match</h3>
            <img src="" class="img_100">
            <div class="row g-0 form">
                <div class="cont col-12 col-md-6 offset-0 offset-md-3">
                    <?php //echo do_shortcode('[contact-form-7 id="425" title="Contacto Mastermatch"]'); ?>
					<?php echo do_shortcode( get_field('formulario') ); ?>
                </div>
            </div>            
        </div>		
		
        <!-- //clone -->
        <div class="col-6 col-md-4 mb-3 gatito-clone d-none">
            <div class="new mx-auto text-center">
                <div class="img">
                    <img src="" class="img-fluid">
                </div>
                <div class="inter">
                    <h3 class="title"></h3>
                    <div class="cont">
                        <div class="txts"></div>
                        <a href="javascript:;" onclick="abrirForm(this)" class="btn btn-primary w-100">Adoptar</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- //clone -->
        
    </div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
<script type="text/javascript">
    $('.checks input').on( "click", function() {
        if(this.checked) {
            $(this).parents('.item-quest').addClass('check');
        }
    });
    function abrirForm(obj){
        console.log($(obj).data());
        $('#form-adopta .img_100').attr('src',$(obj).data('foto'));
        $('#form-adopta input[name="cat-name"]').val($(obj).data('titulo'));
        $('#form-adopta input[name="cat-id"]').val($(obj).data('id'));
        $('#form-adopta input[name="cat-permalink"]').val($(obj).data('link'));
        $.fancybox.open({
            src: '#form-adopta',
            type: 'inline'
        });
    }
    $('#resultado .otros .btn-warning').on( "click", function() {
        $('#preguntas').removeClass('d-none');
        $('#resultado').addClass('d-none');
        $('#resultado .gatito').remove();
    });
    $('#quest').ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            console.log('enviando...'+formData.length);
            $('#preguntas').addClass('d-none');
			$('.cargando-icon').removeClass('d-none');
            if(formData.length <= 1){
                alert('Porfavor rellene todos los campos');
                $('#preguntas').removeClass('d-none');
				$('.cargando-icon').addClass('d-none');
                return false;
            }
        },
        success: function(resp){
            console.log('respuesta...');
            console.log(resp);
			$('.cargando-icon').addClass('d-none');
            if(resp.length){
                $('#resultado').removeClass('d-none');
                $.each(resp, function( index, gatito ) {
                    var $clone=$('#resultado .gatito-clone').clone().removeClass('gatito-clone d-none').addClass('gatito gato-'+index);
                    if(index==0){
                        $clone.appendTo("#resultado .gato-principal");
                        $('#resultado .gato-'+index).addClass('mx-auto')
                    }else{
                        $clone.appendTo("#resultado .otros .row");
                    }
                    console.log($clone);
                    $('#resultado .gato-'+index+' .title').html(gatito.titulo);
                    $('#resultado .gato-'+index+' .img img').attr('src',gatito.foto);
                    $('#resultado .gato-'+index+' .txts').html(gatito.cont);
                    $('#resultado .gato-'+index+' .btn-primary').data('foto',gatito.foto);
                    $('#resultado .gato-'+index+' .btn-primary').data('name',gatito.titulo);
                    $('#resultado .gato-'+index+' .btn-primary').data('id',gatito.id);
                    $('#resultado .gato-'+index+' .btn-primary').data('link',gatito.link);
                });
                //--
            }else{
                $('#preguntas').removeClass('d-none');
                alert('Lo sentimos no hay gatitos con las opciones elegidas');
            }
        },
        error: function(msj){
            $('#preguntas').removeClass('d-none');
			$('.cargando-icon').addClass('d-none');
            console.log(msj.responseText);
        },
        dataType: 'json'
    });
	$(function() {
		document.removeEventListener( 'wpcf7mailsent', msj_gracias, false );
		document.addEventListener( 'wpcf7mailsent', function( event ) {
			alerta( "<div class='stroke'><h2>Gracias,<h2><span>pronto nos comunicaremos contigo.</span></div>" );
		  }, false );
	});
</script>