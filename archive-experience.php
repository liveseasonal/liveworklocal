<?php 

get_header(); 
pageBanner(array(
  'title' => 'All Experiences',
  'sub-titles' => 'See whats happening in our World'
));

?>
 

<div class="container container--narrow page-section">
  <?php 
    while (have_posts()) { 
      the_post(); 
     
     get_template_part('template-parts/content-experience');

     }
  echo paginate_links();
  ?>

</div>



<?php get_footer(); ?>

