<?php
/**
 * Search results template.
 * Design reminder: Herbier clinique tropical, clear hierarchy and accessible states.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section class="section section-paper section-pad"><div class="container"><p class="eyebrow">Recherche</p><h1><?php printf( esc_html__( 'Résultats pour : %s', 'pgm' ), esc_html( get_search_query() ) ); ?></h1><?php if ( have_posts() ) : ?><div class="advice-grid"><?php while ( have_posts() ) : the_post(); ?><article class="advice-card"><span><?php echo esc_html( get_post_type() ); ?></span><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p></article><?php endwhile; ?></div><?php the_posts_pagination(); ?><?php else : ?><p>Aucun résultat ne correspond à votre recherche.</p><?php endif; ?></div></section>
<?php get_footer(); ?>
