<?php
global $detect;
$logo = get_field('logo_carga','option');
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_site = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if(empty($logo)){    
    $logo = $logo_site[0];
}
//--
?>
<?php //get_template_part( 'part', 'squares' ); ?>
<footer>    
    <div class="footer__container">
        <div class="container">
            <div class="row">
                <div class="col-12 pb-5 pb-md-0 col-md-1 col-lg-3 mr-md-2 mr-lg-0">
                    <a href="<?php echo esc_url(home_url()); ?>" target="_top">
                        <img class="footer__logo" src="<?=$logo;?>" alt="mastercat">
                    </a>
                </div>
                <div class="col-12 pb-5 pb-md-0 col-md-3 col-lg-5 mr-md-5 mr-lg-0">
                    <div class="footer__info">
                                                    
                        <p><img class="aligncenter wp-image-1664 size-full" src="<?php echo get_template_directory_uri(); ?>/img/INTAFINAL-e1627422868110.png"></p>

                                            </div>
                </div>
                <div class="col-12 offset-md-2 offset-lg-0 col-md-5 col-lg-4">
                    <div class="contact-info mb-4">
                        <a class="phone-info" href="tel:+5622800228228" target="_blank" title="Servicio al Consumidor 800 228 228">
                            <i class="fas fa-mobile-alt pr-2" aria-hidden="true"></i>
                            <h5>Servicio al Consumidor <span>800 228 228</span></h5>
                        </a>
                        <hr class="mx-auto">
                         <div class="footer__rrss">
                            <div class="footer__rrss-text">
                                <strong>Síguenos</strong>
                            </div>
                            <?php
                            $menuSocial = array(
                                'theme_location'  => 'social',
                                'container'       => false,
                                'echo'            => false,
                                'container_id'    => '',
                                'container_class' => 'header__rrss mt-3',
                                'menu_id'         => false,
                                'menu_class'      => 'text-center',
                                'items_wrap'      => '%3$s',
                            );
                            echo strip_tags(wp_nav_menu( $menuSocial ), '<a><i>' );
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__rights">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p class="footer__rights-text">Master Cat <?php echo date('Y') ?>® </p>
                </div>
            </div>
        </div>
    </div>

</footer>
</div>

<?php wp_footer(); ?>
<?php the_field('codigo_footer','option'); 
$tiempo_espera=(intval(get_field('tiempo_espera','option'))/1000)+1;
?>

<script type="text/javascript">
    var owl = $('.owl-header');
    owl.owlCarousel({
        loop: <?php echo (get_field('loop','option'))?'true':'false'; ?>,
        autoplay: true,
        autoplayTimeout: <?php the_field('tiempo_espera','option'); ?>,
        autoplayHoverPause: <?php echo (get_field('pausar_mouse','option'))?'true':'false'; ?>,
        margin: 0,
        nav: <?php echo (get_field('navegador','option'))?'true':'false'; ?>,
        dots: <?php echo (get_field('puntos','option'))?'true':'false'; ?>,
        smartSpeed:450,
        navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
</script>
</body>
</html>