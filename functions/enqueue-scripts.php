<?php
function theme_enqueue() {	
	wp_deregister_script('jquery');
	wp_register_script('jquery', "//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js", false, '3.6.0');
	wp_enqueue_script('jquery');

    wp_enqueue_script( 'bootstrap-js', '//cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js', array( 'jquery' ), '5.2.0', true );		
	wp_enqueue_script( 'OwlCarousel2-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	wp_enqueue_script( 'isotope-js', '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );		
	wp_enqueue_script( 'fancybox', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true );
	wp_enqueue_script( 'svg-injector', '//cdnjs.cloudflare.com/ajax/libs/svg-injector/1.1.3/svg-injector.min.js', array( 'jquery' ), '1.1.3', true );
	wp_enqueue_script( 'smooth-scroll', '//cdnjs.cloudflare.com/ajax/libs/smooth-scroll/16.1.3/smooth-scroll.min.js', array( 'jquery' ), '16.1.3', true );
	wp_enqueue_script( 'mobile-detect', '//cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.5/mobile-detect.min.js', array( 'jquery' ), '1.4.5', true );
	wp_enqueue_script( 'jquery-form', '//cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js', array( 'jquery' ), '4.3.0', true );
	wp_enqueue_script( 'animateplus', '//cdnjs.cloudflare.com/ajax/libs/animateplus/2.1.1/animateplus.min.js', array( 'jquery' ), '2.1.1', true );

	wp_enqueue_script( 'rut', get_template_directory_uri() .'/js/jquery.rut.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'custom', get_template_directory_uri() .'/js/actions.js', array( 'jquery' ), false, true );

	wp_enqueue_style( 'bootstrap-style', '//cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css', array( ), '5.2.0' );
	wp_enqueue_style( 'fontawesome-style', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css', array( ), '6.1.2' );
	wp_enqueue_style( 'OwlCarousel2-style', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array( ), '2.3.4' );
	wp_enqueue_style( 'fancybox-style', '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array( ), '3.5.7' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&family=Open+Sans:wght@400;600&display=swap', array(), null );
	wp_enqueue_style( 'font-style', get_template_directory_uri() .'/css/fonts.css', array( ) );
	wp_enqueue_style( 'general-style', get_template_directory_uri() .'/css/custom.css', array( ) );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue' );