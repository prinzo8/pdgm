<?php
/** Single post fallback. */
get_header(); ?><section class="section section-pad"><div class="container content-page"><?php while ( have_posts() ) : the_post(); the_title( '<h1>', '</h1>' ); the_content(); endwhile; ?></div></section><?php get_footer();
