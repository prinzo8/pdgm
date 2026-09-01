<?php
/**
 * Archive template.
 * Design reminder: Herbier clinique tropical, calm clinical editorial surfaces.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section class="section section-paper section-pad"><div class="container"><p class="eyebrow">Archives</p><h1><?php the_archive_title(); ?></h1><?php if ( have_posts() ) : ?><div class="advice-grid"><?php while ( have_posts() ) : the_post(); ?><article class="advice-card"><span><?php echo esc_html( get_the_date() ); ?></span><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p></article><?php endwhile; ?></div><?php the_posts_pagination(); ?><?php else : ?><p>Aucun contenu trouvé.</p><?php endif; ?></div></section>
<?php get_footer(); ?>
