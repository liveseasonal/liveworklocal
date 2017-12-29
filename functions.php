<?php 


function pageBanner($args = NULL) {
  // php logic will live here. Will call this function on the required pages.
  if (!$args['title']){
    $args['title'] = get_the_title();
  }

  if (!$args['sub-title']){
    $args['sub-title'] = get_field('page_banner_subtitle');
  }


// Here we want to check one if there is a photo in $args and to if anythings has been uploaded

  // So we are checkening if (!$args['photo']) there is a photo hardcoded in $args see page.php and 2
  // Secondly we want to see if there is a custom field page banner background image

  if (!$args['photo']) {
    if(get_field('page_banner_background_image')) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }

  }

?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 
         
      echo $args['photo'];

      // $pageBannerImage = get_field('page_banner_background_image');
      // echo $pageBannerImage['sizes']['pageBanner'];

      ?>);">    
    </div>
    
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['sub-title'] ?></p>
        </div>
    </div>  
  </div>
  

<?php }



function university_files() {
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBA6GoHxCUfjdGaXNHXqiV9G3ZJXE17Mz8',NULL, microtime(), true);
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
  add_image_size('pageBanner', 1500, 350, true);
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

  if (!is_admin() AND is_post_type_archive('experience') AND $query-> is_main_query()){
     $query ->set('posts_per_page', -1);
  }
  

}


add_action('pre_get_posts', 'university_adjust_queries');


// $api . The advanced custom fields api will make this data available to us.
// So now that we have access to the data we will look inside the the $api and target a
// property named key and set it to the API key from Google that we just received. 

// So the plugin gave us the $api data to work with . 
// We manipulated it 
// And we return right back


function universityMapKey($api) {

  $api['key'] = 'AIzaSyBA6GoHxCUfjdGaXNHXqiV9G3ZJXE17Mz8';
  return $api;

}


add_filter('acf/fields/google_map/api','universityMapKey');


