<?php
/**
 * One-page homepage: all content is editable from the Customizer contact panel.
 * Design reminder: Herbier clinique tropical, calm premium healthcare, no fabricated testimonials.
 */
get_header(); $c = pgm_config(); $phone_href = pgm_phone_href( $c['phone'] ); $wa_href = pgm_whatsapp_href( $c['whatsapp'] );
?>
<section id="accueil" class="hero section-pad">
    <div class="container hero-grid">
        <div class="hero-copy reveal">
<?php
$is_on_duty = (bool) get_theme_mod( 'pgm_duty_enabled', false );
$duty_status_class = $is_on_duty ? 'on-duty' : 'off-duty';
$duty_status_label = $is_on_duty ? 'Pharmacie de garde' : 'Pharmacie hors garde';
?>
<div class="hero-duty-status <?php echo esc_attr( $duty_status_class ); ?>">
    <span class="hero-duty-dot" aria-hidden="true"></span>
    <div>
        <strong><?php echo esc_html( $duty_status_label ); ?></strong>
        <small><?php echo $is_on_duty ? 'La pharmacie est actuellement de garde.' : 'La pharmacie n’est actuellement pas de garde.'; ?></small>
    </div>
</div>
<p class="eyebrow"><span class="flag-mark" aria-hidden="true"><i></i><i></i><i></i></span> San Pedro · Côte d’Ivoire</p><h1>Votre santé,<br><em>notre priorité.</em></h1><p class="hero-lead">Un repère de proximité pour vos médicaments, vos questions de santé et vos essentiels de bien-être au cœur du Grand Marché.</p><div class="hero-actions">
<a class="button button-primary" href="#contact">
    Nous contacter
    <span class="hero-cta-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"></path>
        </svg>
    </span>
</a>
<a class="button button-quiet" href="<?php echo esc_url( $c['maps_url'] ); ?>" target="_blank" rel="noopener">
    Nous trouver
    <span class="hero-cta-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"></path>
            <circle cx="12" cy="10" r="2.5"></circle>
        </svg>
    </span>
</a>
</div><div class="hero-note"><span class="pulse-dot"></span><span>Pharmacie du Grand Marché<br><strong><?php echo esc_html( $c['city'] ); ?></strong></span></div></div>
        <div class="hero-visual reveal reveal-delay"><div class="hero-image"><img src="<?php echo esc_url( pgm_asset( 'san-pedro-coast.webp' ) ); ?>" alt="Paysage côtier et atmosphère urbaine de San Pédro, en Côte d’Ivoire" loading="eager"><div class="hero-stamp"><span>PGM</span><small>Repère santé<br>à San Pedro</small></div></div><div class="scribble">proche · claire · attentive</div></div>
    </div>
</section>
<section id="pharmacie" class="section section-paper section-pad"><div class="container split-grid"><div class="section-intro reveal"><p class="eyebrow">01 — La pharmacie</p><h2>Un conseil qui commence par <em>l’écoute.</em></h2><p>Notre Pharmacie à San-Pédro en Côte d’Ivoire propose une gamme complète de services pharmaceutiques, notamment la vente de médicaments sur ordonnance et de produits en vente libre. En plus des médicaments classiques, elle offre également des produits de santé, des soins de beauté, et des conseils personnalisés pour le bien-être des patients.</p><p>La pharmacie se distingue par son engagement envers la qualité du service et son accès à des produits authentiques, contribuant ainsi au soutien de la santé publique dans la région.</p><p class="muted">Les informations publiques présentées ici sont à confirmer auprès de l’équipe de la pharmacie.</p></div><div class="pharmacy-panel reveal reveal-delay"><img class="pharmacy-interior" src="<?php echo esc_url( pgm_asset( 'pharmacie-interieur-enhanced.webp' ) ); ?>" alt="Intérieur de la Pharmacie du Grand Marché à San Pédro, avec comptoir et rayonnages" loading="lazy"><div class="panel-top"><span class="round-icon">✦</span><span>Le mot du pharmacien</span></div><blockquote>« Chaque visite est l’occasion d’apporter un peu plus de clarté et de confiance. »</blockquote><p class="signature"><?php echo esc_html( $c['pharmacist'] ); ?><br><span>Pharmacien responsable</span></p><div class="value-row"><span>01</span><strong>Proximité</strong><span class="line"></span><span>San Pedro</span></div></div></div></section>
<section id="services" class="section section-green section-pad"><div class="container"><div class="section-heading light reveal"><p class="eyebrow">02 — Services</p><h2>Le nécessaire,<br><em>avec le bon conseil.</em></h2><p>Des services essentiels, présentés avec clarté. Les disponibilités précises sont à confirmer auprès de la pharmacie.</p></div><div class="service-list"><article class="service-card reveal"><span class="service-num">01</span><span class="service-icon">✚</span><h3>Médicaments<br>& santé</h3><p>Médicaments sur ordonnance et produits de santé, selon disponibilité.</p><a href="#contact">Demander conseil <span>↗</span></a></article><article class="service-card reveal reveal-delay"><span class="service-num">02</span><span class="service-icon">◌</span><h3>Conseil<br>pharmaceutique</h3><p>Un échange pour mieux comprendre l’usage de vos traitements.</p><a href="#contact">Parler à l’équipe <span>↗</span></a></article><article class="service-card reveal reveal-delay-2"><span class="service-num">03</span><span class="service-icon">⌁</span><h3>Hygiène<br>& bien-être</h3><p>Une sélection d’essentiels pour prendre soin de soi au quotidien.</p><a href="#contact">Nous contacter <span>↗</span></a></article></div></div></section>
<section id="conseils" class="section section-pad advice-section"><div class="container"><div class="section-heading reveal"><p class="eyebrow">03 — Conseils santé</p><h2>Quelques repères<br><em>pour chaque jour.</em></h2></div><div class="advice-grid"><article class="advice-card reveal"><span>01 / prévention</span><h3>Demander conseil, c’est déjà prendre soin de soi.</h3><p>Pour tout nouveau médicament ou toute question, demandez l’avis d’un professionnel de santé.</p></article><article class="advice-card advice-card-accent reveal reveal-delay"><span>02 / quotidien</span><h3>Hydratation, repos, régularité.</h3><p>De petits gestes simples soutiennent votre bien-être jour après jour, en complément d’un suivi adapté.</p></article><article class="advice-card reveal reveal-delay-2"><span>03 / sécurité</span><h3>Bien utiliser ses médicaments.</h3><p>Respectez la posologie prescrite et ne partagez jamais un traitement sans avis médical.</p></article></div><p class="disclaimer">Ces informations sont générales et ne remplacent pas un avis médical personnalisé.</p></div></section>
<section id="horaires" class="section section-sand section-pad"><div class="container hours-layout"><div class="reveal"><p class="eyebrow">04 — Horaires</p><h2>Vous savez<br><em>quand passer.</em></h2><?php if ( $c['duty']['enabled'] && $c['duty']['dates'] ) : ?><div class="duty-card"><div class="duty-card-head"><span class="round-icon">✚</span><div><strong>Pharmacie de garde</strong><small>Dates à retenir</small></div></div><p><?php echo nl2br( esc_html( $c['duty']['dates'] ) ); ?></p><?php if ( $c['duty']['note'] ) : ?><small><?php echo esc_html( $c['duty']['note'] ); ?></small><?php endif; ?></div><?php endif; ?></div><div class="hours-card reveal reveal-delay"><div class="hours-card-head"><span class="round-icon">◷</span><div><strong>Horaires d’ouverture</strong><small><?php echo esc_html( $c['hours_note'] ); ?></small></div></div><?php foreach ( $c['hours'] as $day => $time ) : ?><div class="hours-row"><span><?php echo esc_html( $day ); ?></span><strong><?php echo esc_html( $time ); ?></strong></div><?php endforeach; ?></div></div></section>


<section id="medicaments" class="section section-paper section-pad">
    <div class="container">

        <div class="section-heading reveal">
            <p class="eyebrow">05 — Médicaments</p>

            <h2>
                Vérifier une
                <br>
                <em>disponibilité.</em>
            </h2>

            <p>
                Recherchez un médicament pour vérifier s’il figure
                parmi les produits disponibles à la pharmacie.
            </p>
        </div>

        <div class="pgm-medicament-search-wrap reveal">

            <label class="pgm-search-label" for="pgm-medicament-search">
                Rechercher un médicament
            </label>

            <div class="pgm-search-box">
                <span class="pgm-search-icon" aria-hidden="true">⌕</span>

                <input
                    id="pgm-medicament-search"
                    type="search"
                    autocomplete="off"
                    placeholder="Commencez à taper le nom..."
                    aria-label="Rechercher un médicament"
                >
            </div>

            <p class="pgm-search-hint">
                Tapez au moins une lettre pour afficher les résultats.
            </p>

            <?php
            /*
             * Source des médicaments pour la recherche JavaScript.
             *
             * Les éléments sont volontairement cachés.
             * Ils servent uniquement de source de données.
             */
            $pgm_medicaments = pgm_get_medicaments();

            foreach ( $pgm_medicaments as $medicament ) :
            ?>
                <span
                    data-medicament="<?php echo esc_attr( $medicament['name'] ); ?>"
                    data-available="<?php echo $medicament['available'] ? 'true' : 'false'; ?>"
                    hidden
                ></span>
            <?php endforeach; ?>

            <div
                id="pgm-medicament-results"
                class="pgm-medicament-results"
                aria-live="polite"
            ></div>

            <div
                id="pgm-medicament-empty"
                class="pgm-medicament-empty"
                hidden
            >
                Aucun médicament correspondant trouvé.
            </div>

        </div>

    </div>
</section>


<section id="localisation" class="section section-pad"><div class="container location-grid"><div class="map-visual reveal">
    <iframe
        src="https://www.google.com/maps?q=4.77863,-6.65600&z=17&output=embed"
        width="100%"
        height="100%"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Pharmacie du Grand Marché — San Pedro, Côte d’Ivoire">
    </iframe>
</div><div class="location-copy reveal reveal-delay"><p class="eyebrow">05 — Localisation</p><h2>Au cœur de<br><em>San Pedro.</em></h2><p class="address"><strong>Pharmacie du Grand Marché</strong><br><?php echo nl2br( esc_html( $c['address'] ) ); ?><br><?php echo esc_html( $c['city'] ); ?></p><div class="hero-actions"><a class="button button-primary" href="<?php echo esc_url( $c['maps_url'] ); ?>" target="_blank" rel="noopener">Ouvrir Google Maps <span>↗</span></a></div><p class="coordinates">Repère cartographique public · 4.77863, −6.65600</p></div></div></section>
<section id="contact" class="section contact-section section-pad"><div class="container contact-layout"><div class="contact-intro reveal"><p class="eyebrow">06 — Contact</p><h2>Une question ?<br><em>Nous sommes là.</em></h2><p>Pour confirmer les horaires, la disponibilité d’un produit ou l’itinéraire, choisissez le moyen le plus simple pour vous.</p></div><div class="contact-actions reveal reveal-delay"><a class="contact-action" href="<?php echo esc_attr( $phone_href ); ?>"><span class="contact-icon">☎</span><span><small>Appeler</small><strong><?php echo esc_html( $c['phone'] ); ?></strong></span><b>↗</b></a><?php if ( $wa_href ) : ?><a class="contact-action" href="<?php echo esc_url( $wa_href ); ?>" target="_blank" rel="noopener"><span class="contact-icon contact-icon-whatsapp" aria-hidden="true">
<svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path d="M20.52 3.48A11.86 11.86 0 0 0 12.06 0C5.5 0 .16 5.34.16 11.9c0 2.1.55 4.15 1.6 5.96L.05 24l6.28-1.65a11.88 11.88 0 0 0 5.72 1.46h.01c6.56 0 11.9-5.34 11.9-11.9 0-3.18-1.24-6.16-3.44-8.43ZM12.06 21.8h-.01a9.86 9.86 0 0 1-5.03-1.38l-.36-.21-3.73.98 1-3.64-.23-.37a9.85 9.85 0 0 1-1.51-5.28C2.19 6.43 6.62 2 12.07 2c2.64 0 5.12 1.03 6.98 2.9a9.83 9.83 0 0 1 2.89 7c0 5.45-4.43 9.9-9.88 9.9Zm5.42-7.4c-.3-.15-1.77-.87-2.05-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.25-.46-2.38-1.47-.88-.78-1.47-1.74-1.64-2.04-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.87 1.22 3.07.15.2 2.1 3.2 5.09 4.49.71.31 1.27.49 1.7.63.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/>
</svg>
</span><span><small>WhatsApp</small><strong>Écrire à la pharmacie</strong></span><b>↗</b></a><?php endif; ?><a class="contact-action" href="<?php echo esc_url( $c['maps_url'] ); ?>" target="_blank" rel="noopener"><span class="contact-icon">⌖</span><span><small>Adresse</small><strong>Grand Marché · San Pedro</strong></span><b>↗</b></a></div></div></section>
<?php get_footer(); ?>
