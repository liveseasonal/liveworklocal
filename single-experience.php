<?php

  get_header();

  while(have_posts()) {
      the_post(); 
      pageBanner();
      ?>
       

       <div class="container container--narrow page-section">
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php get_post_type_archive_link('experience'); ?>"><i class="fa fa-home" aria-hidden="true"></i>Experience Home</a> <span class="metabox__main">Posted by <?php the_title(); ?></span></p>
     </div>
          <div class="generic-content"><?php the_content() ?></div>

          <?php
            
            $relatedCities = get_field('related_city');

            if ($relatedCities) {

                echo '<hr class="section-break">';
                echo '<h2 headline headline--medium >Related Cities</h2>';
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