<?php

  get_header();

  while(have_posts()) {
      the_post(); ?>
       <div class="page-banner">
         <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);">    
         </div>
         <div class="page-banner__content container container--narrow">
           <h1 class="page-banner__title"><?php the_title(); ?></h1>
           <div class="page-banner__intro">
             <p>The Feline , the myth , the legend</p>
           </div>
         </div>  
       </div>

       <div class="container container--narrow page-section">
          
          <div class="generic-content"><?php the_content() ?></div>

          <?php
            
            $relatedCities = get_field('related_city');

            if ($relatedCities) {

                echo '<hr class="section-break">';
                echo '<h2 headline headline--medium >Subject(s) taught</h2>';
                echo '<ul class="link-list min-list">';

                foreach ($relatedCities as $city) { ?>
                   <li><a href="<?php echo get_the_permalink($city) ?>"><?php echo get_the_title($city); ?></a></li>
               <?php }
                
                echo '</ul>';
            
            }
          ?>
       </div> 

<?php }


?>

<?php get_footer(); ?>