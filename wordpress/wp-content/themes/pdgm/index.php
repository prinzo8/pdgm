<?php
/**
 * Fallback template; the theme is intentionally one-page.
 * Design reminder: preserve the same editorial typography and green signature.
 */
get_header(); ?><section class="section section-pad"><div class="container"><h1><?php bloginfo( 'name' ); ?></h1><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?><article><?php the_title( '<h2>', '</h2>' ); the_content(); ?></article><?php endwhile; endif; ?></div></section><?php get_footer();
