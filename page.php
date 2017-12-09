<?php

get_header(); 




  while(have_posts()) { the_post(); ?>
        
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>We will be adding a custom field in here..</p>
     </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">

  <?php

  $theParent = wp_get_post_parent_id(get_the_ID());

   if ($theParent) {?>
     
     <div class="metabox metabox--position-up metabox--with-home-link">
       <p><a class="metabox__blog-home-link" href="/about-us/"><i class="fa fa-home" aria-hidden="true"></i>Howdy <?php get_permalink($theParent) ?></a> <span class="metabox__main">Back To <?php get_the_title($theParent) ?></span></p>
     </div>
   
   <?php }
 
  ?>


  
    
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php get_permalink($theParent); ?>"><?php echo get_the_title($theParent);§ ?></a></h2>
      <ul class="min-list">
        <?php

          if ($theParent) {
            $findchildrenOf = $theParent; 
          }

          else {
            $findchildrenOf = get_the_ID();
          }

          wp_list_pages(array(
            'title_li' =>  NULL,
            'child_of' => $findchildrenOf
          ));
         ?>
      </ul>
    </div>

    <div class="generic-content">
      <p><?php the_title(); ?></p>
      <p><?php the_content(); ?></p>
    </div>

  </div>



<?php }


?>

<?php get_footer(); ?>