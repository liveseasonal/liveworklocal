<?php

  get_header();

  while(have_posts()) {
      the_post(); 
      pageBanner();

?>

       

       <div class="container container--narrow page-section">
          
          <div class="generic-content">
            <div class="row group">
              <div class="one-third">
                <?php the_post_thumbnail('professorPotrait'); ?>                
              </div>
              <div class="two-thirds">
                 <?php the_content() ?>
              </div>
            </div>
          </div>

          <?php
            
            $relatedCities = get_field('related_city');

            if ($relatedCities) {

                echo '<hr class="section-break">';
                echo '<h2 headline headline--medium >Cities(s) taught in</h2>';
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