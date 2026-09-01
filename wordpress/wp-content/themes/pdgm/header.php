<?php
/**
 * Header: sticky navigation with Côte d’Ivoire marker.
 * Design reminder: editorial health, asymmetric rhythm, #0B6B50.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$config = pgm_config();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#contenu">Aller au contenu</a>
<header class="site-header" data-header>
    <div class="header-inner">
        <a class="brand" href="#accueil" aria-label="<?php echo esc_attr( $config['name'] ); ?> — Accueil">
            <img class="brand-logo" src="<?php echo esc_url( pgm_asset( 'pharmacie-logo-ivoirien.webp' ) ); ?>" alt="Pharmacie du Grand Marché San Pédro">
            <span class="brand-copy"><strong>Pharmacie</strong><em>du Grand Marché<br>San Pédro</em></span>
        </a>

        <?php
        $duty_active = ! empty( $config['duty']['enabled'] );
        ?>

        <div class="header-duty-status <?php echo $duty_active ? 'is-on' : 'is-off'; ?>" aria-label="<?php echo $duty_active ? 'Pharmacie de garde' : 'Pharmacie hors garde'; ?>">
            <span class="duty-status-dot" aria-hidden="true"></span>
            <span class="duty-status-label"><?php echo $duty_active ? 'De garde' : 'Pas de garde'; ?></span>
        </div>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav"><span></span><span></span><span></span><b>Menu</b></button>
        <nav id="primary-nav" class="primary-nav" aria-label="Navigation principale"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'pgm_menu_fallback', 'items_wrap' => '%3$s' ) ); ?></nav>
    </div>

<div class="site-progress" aria-hidden="true">
    <span class="site-progress-bar"></span>
</div>
</header>
<main id="contenu">
