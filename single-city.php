<?php



  get_header();

  while(have_posts()) {
      the_post(); 
      pageBanner();
      ?>
       

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
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
            


          echo '<ul class="professor-cards">';

          while($relatedProfessors -> have_posts()) {
            $relatedProfessors -> the_post(); ?>
            <li class="professor-card__list_item">
              <a class="professor-card" href="<?php the_permalink();?>">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape');?>">
                <span class="professor-card__name"><?php the_title(); ?></span>
              </a>
            </li>
            

          <?php }
      
          echo '</ul>';

          }  
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
            $homePageExperiences -> the_post(); 
            
          get_template_part('template-parts/content-experience');  

           }
        ?>




       </div> 

<?php }


?>

<?php get_footer(); ?>