<?php
//header('Access-Control-Allow-Origin: *'); 
global $lang,$detect;
load_theme_textdomain( 'neourbe', get_template_directory().'/languages' );
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {  
	register_nav_menu( 'social', 'Social Menu' );
	register_nav_menu( 'general', 'Menu Principal' );
	//register_nav_menu( 'footer', 'Menu Footer' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5' );
	add_theme_support( 'custom-logo' );
}
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

require_once(TEMPLATEPATH.'/functions/enqueue-scripts.php');
require_once(TEMPLATEPATH.'/functions/cleanup.php');
require_once(TEMPLATEPATH.'/functions/bs4navwalker.php');
require_once(TEMPLATEPATH.'/functions/custom-post.php');
require_once(TEMPLATEPATH.'/functions/acf-pro.php');
require_once(TEMPLATEPATH.'/functions/Mobile_Detect.php');

$detect = new Mobile_Detect;
//--
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
		'page_title' 	=> 'Configuración del Sitio',
		'menu_title'	=> 'Configuración del Sitio',
		'menu_slug' 	=> 'theme-general-settings',
		'icon_url'		=> 'dashicons-hammer'
	));
}

function noImage($cont){	
	return preg_replace('/<img[^>]+>/i', '', $cont);
}
/*this function allows users to use the first image in their post as their thumbnail*/
function first_image($content = "") {
	global $post, $posts;
	$img = '';
	ob_start();
	ob_end_clean();
	if(empty($content)){
		$content=$post->post_content;
	}
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	$img = $matches [1] [0];

	return trim($img);
} 

/*
SVG FIX
*/
function fix_svg_thumb_display() {
  echo '<style>
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
      width: 100% !important; 
      height: auto !important; 
    }
  </style>';
}
add_action('admin_head', 'fix_svg_thumb_display');
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['mp4'] = 'video/mp4';
  $mimes['m4v'] = 'video/mp4';
  $mimes['webm'] = 'video/webm';
  $mimes['ogv'] = 'video/ogg';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
show_admin_bar( false );

function normalizeNumber($number){
    $number = str_replace(".", "", $number);
    $number = str_replace(",", ".", $number);
    return floatval($number);
}

//[social-menu]
function social_shortcode(){
	$menuSocial = array(
       'theme_location'  => 'social',
        'container'       => 'div',
        'echo'            => false,
        'container_id'    => '',
        'container_class' => 'menu_rrss mt-3 mx-auto',
        'menu_id'         => false,
        'menu_class'      => 'text-center',
        'items_wrap'      => '%3$s',
    );
    return strip_tags(wp_nav_menu( $menuSocial ), '<a><i><div>' );
}
add_shortcode( 'social-menu', 'social_shortcode' );
//[siteurl]
function siteurl_shortcode(){
	return get_site_url();
}
add_shortcode( 'siteurl', 'siteurl_shortcode' );
//ajax
function title_filter( $where, &$wp_query ){
    global $wpdb;
    if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
}
function search_title(){
  $slugs=array();
  $title = $_POST['titulo'];
  add_filter( 'posts_where', 'title_filter', 10, 2 );
  $query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'DESC', 'orderby' => 'date', 'search_prod_title' => $title));
  remove_filter( 'posts_where', 'title_filter', 10, 2 );
  if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID();
    array_push($slugs, 'p-'.$ID);
    //array_push($slugs, 'Hola');
  endwhile; endif;
  echo '.'.implode(",.",$slugs);
  //echo 'busqueda'.count($slugs);
  wp_die();
}
add_action( 'wp_ajax_nopriv_search_title', 'search_title' );
add_action( 'wp_ajax_search_title', 'search_title' );
//
function paged_posts(){
  $slugs=array();  
  $paged = $_POST['page'];
  $query = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 6, 'paged' => $paged, 'order' => 'DESC', 'orderby' => 'date'));
  if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID();
    array_push($slugs, 'p-'.$ID);
    //array_push($slugs, 'Hola');
  endwhile; endif;
  echo '.'.implode(",.",$slugs);
  //echo 'busqueda'.count($slugs);
  wp_die();
}
add_action( 'wp_ajax_nopriv_paged_posts', 'paged_posts' );
add_action( 'wp_ajax_paged_posts', 'paged_posts' );
//funcion master match
function get_gatito(){
  $resp = array();
  //$taxs = array('relation' => 'AND');
  $taxs = array();
  foreach ($_POST as $key => $value) {
    if($key != 'action'){
      array_push($taxs, array(
        'taxonomy' => 'categoria_gato',
        'field'    => 'term_id',
        'terms'    => intval($value)
      ));
    }
  }
  
  $query_arg = array(
    'post_type'       => 'gato_mastermatch', 
    'post_status'     => 'publish', 
    'posts_per_page'  => -1, 
    'order'           => 'ASC', 
    'orderby'         => 'rand',
    'tax_query' => $taxs
  );
  $query = new WP_Query($query_arg);
  //--
  if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); $ID=get_the_ID();
    $foto = get_the_post_thumbnail_url($ID, 'full');
    array_push($resp, [
      'id'      => $ID,
      'link'    => get_permalink(),
      'titulo'  => get_the_title(),
      'cont'    => get_the_content(),
      'foto'    => $foto
    ]);
  endwhile; endif; wp_reset_postdata();
  echo json_encode($resp);
  //echo json_encode($taxs);
  wp_die();
}
add_action( 'wp_ajax_nopriv_get_gatito', 'get_gatito' );
add_action( 'wp_ajax_get_gatito', 'get_gatito' );