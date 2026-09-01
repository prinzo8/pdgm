<?php
/**
 * Not-found template.
 * Design reminder: Herbier clinique tropical, reassuring healthcare voice.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<section class="section section-paper section-pad"><div class="container"><p class="eyebrow">404 — Repère introuvable</p><h1>Cette page n’est pas ici.</h1><p>Retournez à l’accueil de la Pharmacie du Grand Marché ou utilisez le menu principal.</p><a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">Retour à l’accueil</a></div></section>
<?php get_footer(); ?>
