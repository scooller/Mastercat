<?php
//header('Content-Type: text/html; charset=iso-8859-1');
global $detect;
$logo = get_field('logo_carga','option');
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo_site = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if(empty($logo)){    
    $logo = $logo_site[0];
}
//--

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php bloginfo(); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="googlebot" content="index" />
    <meta name="google" content="nositelinkssearchbox" />
	
   
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <meta name="msapplication-TileColor" content="#000">
    <meta name="theme-color" content="#000">
    <?php wp_head(); ?>
    <script type="text/javascript">
        var $url_site='<?=site_url();?>';
        var $ajax_url='<?=admin_url( 'admin-ajax.php' );?>';
        var $from_page=<?php echo is_front_page()?'true':'false';?>;
    </script>
    <?php the_field('codigo_header','option'); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<header class="shadow-header menu-header">
    <div class="container-fluid">
        <div class="header__logo">
            <a href="<?php echo esc_url(home_url()); ?>" target="_top">
                <img class="header__logo-img" src="<?=$logo; ?>" alt="mastercat">
            </a>
        </div>

        <nav role="navigation">
            <div id="menuToggle" class="">
                <!-- Una casilla de verificación falsa / oculta se utiliza como receptor clic,
            puedes usar el selector :checked en él.-->

                <input type="checkbox">

                <!-- Some spans to act as a hamburger. -->
                <span></span>
                <span></span>
                <span></span>

                <!-- <a onclick="jQuery('#menuToggle input').prop('checked', false)">X</a> -->
                <div id="menu">
                    
                    <div class="menu__box">
                        <div class="menu-home-container">
                            <?php
                            wp_nav_menu([
                                'theme_location'  => 'general',
                                'container'       => '',
                                'container_id'    => '',
                                'container_class' => '',
                                'menu_id'         => false,
                                'menu_class'      => 'main-menu',
                                'depth'           => 2,
                                'fallback_cb'     => 'bs4navwalker::fallback',
                                'walker'          => new bs4navwalker()
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="header__rrss mt-3">
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
                    <img class="menu__footer img-fluid w-100" src="<?php echo get_template_directory_uri(); ?>/img/pattern-nav.svg" alt="patrón de gatos en barra de navegación">
                </div>
            </div>
        </nav>
    </div>
</header>