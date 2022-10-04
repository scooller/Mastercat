<?php
function my_acf_init() {
	$key = get_field('google_map','option');
	//acf_update_setting('google_api_key', $key);
}
add_action('acf/init', 'my_acf_init');
//--
/*
function acf_load_ubicaciones_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    // if has rows
    if( have_rows('ubicaciones', 'option') ) {
        // while has rows
        while( have_rows('ubicaciones', 'option') ) {
            // instantiate row
            the_row();
            // vars
            $value = get_sub_field('ubicacion');
            $label = get_sub_field('ubicacion');
            // append to choices
            $field['choices'][ $value ] = $label;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/key=field_601a19626f15e', 'acf_load_ubicaciones_choices');
function acf_load_dormitorios_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    // if has rows
    if( have_rows('dormitorios', 'option') ) {
        // while has rows
        while( have_rows('dormitorios', 'option') ) {
            // instantiate row
            the_row();
            // vars
            $value = get_sub_field('dormitorio');
            $label = get_sub_field('dormitorio');
            // append to choices
            $field['choices'][ $value ] = $label;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/key=field_601a198f6f15f', 'acf_load_dormitorios_choices');
function acf_load_plazo_choices( $field ) {    
    // reset choices
    $field['choices'] = array();
    // if has rows
    if( have_rows('plazos', 'option') ) {
        // while has rows
        while( have_rows('plazos', 'option') ) {
            // instantiate row
            the_row();
            // vars
            $value = get_sub_field('plazo');
            $label = get_sub_field('plazo');
            // append to choices
            $field['choices'][ $value ] = $label;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/key=field_601a19a26f160', 'acf_load_plazo_choices');*/