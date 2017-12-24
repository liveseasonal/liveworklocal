<?php 

function university_files() {
  wp_enqueue_script('main_university_javascript', get_theme_file_uri('/js/scripts-bundled.js'),NULL, microtime(), true);
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles',get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'university_files');


function university_features() {
  register_nav_menu('headerMenuLocation','Header Menu Location');
  register_nav_menu('footerLocation1','Footer Location 1');
  register_nav_menu('footerLocation2','Footer Location 2');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPotrait', 480, 650, true);
}

add_action('after_setup_theme', 'university_features');


// Removed for MU plugins

// function university_post_types() {
//   register_post_type('experience',array(
//     'public' => true,
//     'labels' => array(
//       'name' => 'Experience'
//     ),
//     'menu_icon' => 'dashicons-unlock'
//   ));

// }

// add_action('init', 'university_post_types');

function university_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('city') AND $query-> is_main_query()){
     $query ->set('orderby', 'title');
     $query ->set('order', 'ASC');
     $query ->set('posts_per_page', -1);
  }
  if (!is_admin() AND is_post_type_archive('experience') AND $query-> is_main_query()) {
    $today = date('Ymd');
    $query ->set('meta_key', 'experience-date');
    $query ->set('orderby', 'meta_value_num');
    $query ->set('order', 'ASC');
    $query ->set('meta_query', array(
              array(
                'key' => 'experience-date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              )
            ));
  }
  

}


add_action('pre_get_posts', 'university_adjust_queries');

