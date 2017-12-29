<?php 

get_header(); 
pageBanner(array(
  'title' => 'Past Experiences',
  'sub-titles' => ' Recap of experiences See whats happening in our World'
));


?>


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Past Experiences</h1>
      <div class="page-banner__intro">
        <p>Recap of Past Experiences</p>
     </div>
    </div>  
  </div>  

<div class="container container--narrow page-section">
  <?php 

 $today = date('Ymd');
          $pastExperiences = new WP_Query(array(
            'paged' => get_query_var('paged', 1),
            'post_type' => 'experience',
            'meta_key' => 'experience-date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'experience-date',
                'compare' => '<=',
                'value' => $today,
                'type' => 'numeric'
              )
            )
          )); 

    while ($pastExperiences ->have_posts()) { 
     $pastExperiences -> the_post(); 

     get_template_part('template-parts/content-experience');


     }

  echo paginate_links(array(
    'total' => $pastExperiences->max_num_pages,
  ));
  ?>

</div>



<?php get_footer(); ?>

