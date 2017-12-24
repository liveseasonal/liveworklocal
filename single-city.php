<?php

  the_ID();
  // get_the_ID();

  get_header();

  while(have_posts()) {
      the_post(); ?>
       <div class="page-banner">
         <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">    
         </div>
         <div class="page-banner__content container container--narrow">
           <h1 class="page-banner__title"><?php the_title(); ?></h1>
           <div class="page-banner__intro">
             <p>We will be adding a custom field in here..</p>
           </div>
         </div>  
       </div>

       <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('city') ?>"><i class="fa fa-home" aria-hidden="true"></i>All Cities</a> <span class="metabox__main">Posted by <?php the_author_posts_link()  ?> <?php the_time('n.j.y') ?> <?php echo get_the_category_list(',' ) ?></span></p>
     </div>
     
          <div class="generic-content"><?php the_content() ?></div>
          <?php

           $relatedProfessors = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'professor',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'related_city',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )
            )
          )); 

           if ($relatedProfessors -> have_posts()) {
            echo '</hr class="section-break">';
            echo '<h2 class="headline headline--medium">' . get_the_title() . 'Professors</h2>';
           } 


          while($relatedProfessors -> have_posts()) {
            $relatedProfessors -> the_post(); ?>
            <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
            

          <?php }
      

        wp_reset_postdata();

        
          $today = date('Ymd');
          $homePageExperiences = new WP_Query(array(
            'posts_per_page' => 2,
            'post_type' => 'experience',
            'meta_key' => 'experience-date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
              array(
                'key' => 'experience-date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
              ),
              array(
                'key' => 'related_city',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
              )
            )
          )); 

          while($homePageExperiences -> have_posts()) {
            $homePageExperiences -> the_post(); ?>
            
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
        ?>




       </div> 

<?php }


?>

<?php get_footer(); ?>