<?php get_header();?>
 <?php 
 
 if (have_posts()){
     while(have_posts()):the_post();
         the_title();
         the_content(); 
     endwhile; 
 }
 
 ?>
 
 <?php get_template_part( 'single-photo' );?>
 
 <?php get_footer();?>