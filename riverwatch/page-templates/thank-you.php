<?php
/*
* Template Name: Thank You
*
*/
get_header(); ?>
  <div class="thank-you container" role="main">
    <div class="content">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <?php the_content();?> 
        <?php endwhile;?>
      <?php endif;?>
    </div>
  </div>
<?php get_footer(); ?>