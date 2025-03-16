<?php




// Подключение стилей родительской и дочерней темы
function storefront_child_enqueue_styles() {
    wp_enqueue_style('storefront-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('storefront-child-style', get_stylesheet_directory_uri() . '/style.css', ['storefront-parent-style']);
}
add_action('wp_enqueue_scripts', 'storefront_child_enqueue_styles');




// Регистрация CPT "Cities"
function register_cities_post_type() {
    $args = array(
        'label'               => 'Cities',
        'public'              => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-location',
        'supports'            => array('title', 'editor', 'thumbnail'),
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'cities'),
        'show_in_rest'        => true,
    );
    register_post_type('cities', $args);
}
add_action('init', 'register_cities_post_type');

// Регистрация таксономии "Countries"
function register_countries_taxonomy() {
    $args = array(
        'label'        => 'Countries',
        'public'       => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'countries'),
    );
    register_taxonomy('countries', 'cities', $args);
}
add_action('init', 'register_countries_taxonomy');


require_once get_stylesheet_directory() . '/inc/cities-meta-box.php';
require_once get_stylesheet_directory() . '/inc/cities-weather-widget.php';
