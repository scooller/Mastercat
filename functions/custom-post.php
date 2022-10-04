<?php
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'banner',
    array(
      'labels' => array(
        'name' => 'Banners',
        'singular_name' => 'Banner'
      ),
	  'menu_icon' => "dashicons-images-alt",
	  'menu_position' => 3,
      'public' => true,
      'has_archive' => false,
	  'taxonomies' => array('category'),
	  'supports' => array (
	  	'title',
		'author',
		'editor',
		'page-attributes',
		'thumbnail',
		'custom-fields'
	  )
    )
  );
  /*
	//--
	register_post_type( 'producto',
    array(
      'labels' => array(
        'name' => 'Productos',
        'singular_name' => 'Producto'
      ),
	  'menu_icon' => "dashicons-cart",
	  'menu_position' => 4,
      'public' => true,
      'has_archive' => true,
	  'supports' => array (
	  	'title',
		'author',
		'editor',
		'page-attributes',
		'thumbnail',
		'custom-fields'
	  )
    )
  );
	//--
	register_post_type( 'faq',
    array(
      'labels' => array(
        'name' => 'Preguntas Frecuentes',
        'singular_name' => 'Pregunta Frecuente'
      ),
	  'menu_icon' => "dashicons-format-status",
	  'menu_position' => 4,
      'public' => true,
      'has_archive' => true,
	  'supports' => array (
	  	'title',
		'author',
		'editor',
		'page-attributes',
		'thumbnail',
		'custom-fields'
	  )
    )
  );*/
	//--
}
function wpse_category_set_post_types( $query ){
    if( $query->is_category() && $query->is_main_query() ){
        $query->set( 'post_type', array( 'post', 'proyecto' ) );
    }
}
add_action( 'pre_get_posts', 'wpse_category_set_post_types' );