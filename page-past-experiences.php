<?php get_header(); ?>


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
     $pastExperiences -> the_post(); ?>
     <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
              <span class="event-summary__month"><?php  
                
                $experienceDate = new DateTime(get_field('experience-date'));
                echo $experienceDate->format('M');
                
              ?></span>
              <span class="event-summary__day"><?php
                echo $experienceDate->format('d');
              ?></span>  
            </a>
           <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              <p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
           </div>
      </div>


  <?php }
  echo paginate_links(array(
    'total' => $pastExperiences->max_num_pages,
  ));
  ?>

</div>



<?php get_footer(); ?>

