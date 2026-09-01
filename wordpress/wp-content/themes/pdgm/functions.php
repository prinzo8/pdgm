<?php
/**
 * Pharmacie du Grand Marché — theme bootstrap.
 * Design: Herbier clinique tropical; green #0B6B50, warm white, editorial health.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }


function pgm_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array( 'height' => 160, 'width' => 420, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    register_nav_menus( array( 'primary' => __( 'Navigation principale', 'pgm' ) ) );
}
add_action( 'after_setup_theme', 'pgm_theme_setup' );

function pgm_menu_fallback() {
    $items = array(
        'Accueil'       => '#accueil',
        'La pharmacie'  => '#pharmacie',
        'Services'      => '#services',
        'Conseils'      => '#conseils',
        'Horaires'      => '#horaires',
        'Garde'         => '#horaires',
        'Médicaments'    => '#medicaments',
        'Contact'       => '#contact'
    );

    foreach ( $items as $label => $href ) {
        printf(
            '<a href="%1$s">%2$s</a>',
            esc_url( $href ),
            esc_html( $label )
        );
    }

    $is_on_duty = (bool) get_theme_mod( 'pgm_duty_enabled', false );

    $status_class = $is_on_duty ? 'on-duty' : 'off-duty';
    $status_label = $is_on_duty ? 'De garde' : 'Pas de garde';

    echo '<div class="header-duty-status ' . esc_attr( $status_class ) . '" aria-label="' . esc_attr( $status_label ) . '">';
    echo '<span class="header-duty-dot" aria-hidden="true"></span>';
    echo '<span class="header-duty-label">' . esc_html( $status_label ) . '</span>';
    echo '</div>';

    echo '<a class="nav-cta" href="#contact">Nous contacter <span class="phone-icon" aria-hidden="true">
    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a19.79 19.79 0 0 1 .62 2.63 2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"></path>
    </svg>
    </span></a>';
}

function pgm_asset( $filename ) {
    return get_template_directory_uri() . '/assets/images/' . ltrim( $filename, '/' );
}



/* =========================================================
   Médicaments — gestion depuis WordPress
   ========================================================= */

function pgm_register_medicaments() {

    register_post_type(
        'pgm_medicament',
        array(
            'labels' => array(
                'name'               => 'Médicaments',
                'singular_name'      => 'Médicament',
                'menu_name'          => 'Médicaments',
                'name_admin_bar'     => 'Médicament',
                'add_new'            => 'Ajouter',
                'add_new_item'       => 'Ajouter un médicament',
                'new_item'           => 'Nouveau médicament',
                'edit_item'          => 'Modifier le médicament',
                'view_item'          => 'Voir le médicament',
                'all_items'          => 'Tous les médicaments',
                'search_items'       => 'Rechercher un médicament',
                'not_found'          => 'Aucun médicament trouvé',
                'not_found_in_trash' => 'Aucun médicament dans la corbeille',
            ),

            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => false,
            'show_in_rest'        => true,

            'menu_position'       => 25,
            'menu_icon'           => 'dashicons-plus-alt',

            'supports'            => array(
                'title',
            ),

            'capability_type'     => 'post',
            'map_meta_cap'        => true,

            'has_archive'         => false,
            'rewrite'             => false,
            'query_var'           => false,
        )
    );
}

add_action( 'init', 'pgm_register_medicaments' );


/*
 * Champ de disponibilité.
 */

function pgm_medicament_meta_box() {

    add_meta_box(
        'pgm_medicament_availability',
        'Disponibilité',
        'pgm_medicament_availability_box',
        'pgm_medicament',
        'side',
        'high'
    );
}

add_action(
    'add_meta_boxes',
    'pgm_medicament_meta_box'
);


function pgm_medicament_availability_box( $post ) {

    wp_nonce_field(
        'pgm_save_medicament',
        'pgm_medicament_nonce'
    );

    $available = get_post_meta(
        $post->ID,
        '_pgm_medicament_available',
        true
    );

    ?>

    <label style="display:flex;align-items:center;gap:8px;">
        <input
            type="checkbox"
            name="pgm_medicament_available"
            value="1"
            <?php checked( $available, '1' ); ?>
        >

        <strong>Disponible</strong>
    </label>

    <p style="margin-top:10px;color:#666;">
        Si cette case est cochée, le médicament apparaîtra
        comme disponible sur le site.
    </p>

    <?php
}


/*
 * Sauvegarde du statut.
 */

function pgm_save_medicament( $post_id ) {

    if (
        ! isset( $_POST['pgm_medicament_nonce'] ) ||
        ! wp_verify_nonce(
            $_POST['pgm_medicament_nonce'],
            'pgm_save_medicament'
        )
    ) {
        return;
    }

    if (
        defined( 'DOING_AUTOSAVE' ) &&
        DOING_AUTOSAVE
    ) {
        return;
    }

    if (
        ! current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    $available = isset(
        $_POST['pgm_medicament_available']
    ) ? '1' : '0';

    update_post_meta(
        $post_id,
        '_pgm_medicament_available',
        $available
    );
}

add_action(
    'save_post_pgm_medicament',
    'pgm_save_medicament'
);


/*
 * Colonnes personnalisées dans WordPress.
 */

function pgm_medicament_columns( $columns ) {

    return array(
        'cb'          => $columns['cb'],
        'title'       => 'Médicament',
        'availability'=> 'Disponibilité',
        'date'        => 'Date',
    );
}

add_filter(
    'manage_pgm_medicament_posts_columns',
    'pgm_medicament_columns'
);


function pgm_medicament_column_content(
    $column,
    $post_id
) {

    if ( $column !== 'availability' ) {
        return;
    }

    $available = get_post_meta(
        $post_id,
        '_pgm_medicament_available',
        true
    );

    if ( $available === '1' ) {

        echo '<strong style="color:#0B6B50;">● Disponible</strong>';

    } else {

        echo '<strong style="color:#B65A45;">● Indisponible</strong>';

    }
}

add_action(
    'manage_pgm_medicament_posts_custom_column',
    'pgm_medicament_column_content',
    10,
    2
);


/*
 * Liste initiale de 100 médicaments.
 *
 * Tout est créé comme "indisponible" par défaut.
 */

function pgm_seed_medicaments() {

    $medicaments = array(

        'Acétylsalicylate de lysine',
        'Acide acétylsalicylique',
        'Acyclovir',
        'Albendazole',
        'Allopurinol',
        'Amlodipine',
        'Amoxicilline',
        'Amoxicilline + acide clavulanique',
        'Artemether + lumefantrine',
        'Artemisinine',
        'Atenolol',
        'Atorvastatine',
        'Azithromycine',
        'Benzylpénicilline',
        'Bisacodyl',
        'Bromazépam',
        'Budesonide',
        'Captopril',
        'Cefixime',
        'Ceftriaxone',
        'Cetirizine',
        'Chloramphénicol',
        'Chloroquine',
        'Ciprofloxacine',
        'Clarithromycine',
        'Clotrimazole',
        'Codeine',
        'Dexaméthasone',
        'Diazépam',
        'Diclofénac',
        'Digoxine',
        'Doxycycline',
        'Enalapril',
        'Erythromycine',
        'Fer + acide folique',
        'Fluconazole',
        'Fluoxétine',
        'Folic acid',
        'Furosémide',
        'Glibenclamide',
        'Gliclazide',
        'Glimepiride',
        'Hydrochlorothiazide',
        'Hydrocortisone',
        'Ibuprofène',
        'Insuline humaine',
        'Ipratropium',
        'Ivermectine',
        'Ketoconazole',
        'Lactulose',
        'Lidocaïne',
        'Loratadine',
        'Losartan',
        'Magnesium hydroxide',
        'Mebendazole',
        'Metformine',
        'Methyldopa',
        'Metoclopramide',
        'Metronidazole',
        'Miconazole',
        'Morphine',
        'Nifedipine',
        'Oméprazole',
        'Ondansétron',
        'Paracétamol',
        'Perméthrine',
        'Phénobarbital',
        'Phénytoïne',
        'Prednisolone',
        'Prednisone',
        'Propranolol',
        'Quinine',
        'Ranitidine',
        'Rifampicine',
        'Salbutamol',
        'Simvastatine',
        'Spironolactone',
        'Sulfadiazine',
        'Sulfaméthoxazole + triméthoprime',
        'Tamsulosine',
        'Tétracycline',
        'Tramadol',
        'Valaciclovir',
        'Valproate de sodium',
        'Valsartan',
        'Verapamil',
        'Vitamine A',
        'Vitamine B1',
        'Vitamine B6',
        'Vitamine B12',
        'Vitamine C',
        'Vitamine D',
        'Zinc',
        'Sérum physiologique',
        'Solution de réhydratation orale',
        'Povidone iodée',
        'Chlorhexidine',
        'Glycérine',
    );


    foreach ( $medicaments as $nom ) {

        $existing = get_page_by_title(
            $nom,
            OBJECT,
            'pgm_medicament'
        );

        if ( $existing ) {
            continue;
        }

        $post_id = wp_insert_post(
            array(
                'post_type'   => 'pgm_medicament',
                'post_status' => 'publish',
                'post_title'  => $nom,
            )
        );

        if (
            $post_id &&
            ! is_wp_error( $post_id )
        ) {

            /*
             * Sécurité :
             * aucun médicament n'est annoncé disponible
             * automatiquement.
             */

            update_post_meta(
                $post_id,
                '_pgm_medicament_available',
                '0'
            );
        }
    }
}


/*
 * On exécute le seed une seule fois.
 */

function pgm_maybe_seed_medicaments() {

    if (
        get_option(
            'pgm_medicaments_seeded'
        )
    ) {
        return;
    }

    pgm_seed_medicaments();

    update_option(
        'pgm_medicaments_seeded',
        '1'
    );
}

add_action(
    'after_switch_theme',
    'pgm_maybe_seed_medicaments'
);




/* =========================================================
   PGM — Médicaments pour la recherche publique
   ========================================================= */

function pgm_get_medicaments() {

    $query = new WP_Query(
        array(
            'post_type'      => 'pgm_medicament',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        )
    );

    $medicaments = array();

    foreach ( $query->posts as $post ) {

        $available = get_post_meta(
            $post->ID,
            '_pgm_medicament_available',
            true
        );

        $medicaments[] = array(
            'name'      => get_the_title( $post->ID ),
            'available' => $available === '1',
        );
    }

    wp_reset_postdata();

    return $medicaments;
}


function pgm_config() {
    return array(
        'name'       => get_theme_mod( 'pgm_name', 'Pharmacie du Grand Marché San Pédro' ),
        'city'       => get_theme_mod( 'pgm_city', 'San Pedro, Côte d’Ivoire' ),
        'address'    => get_theme_mod( 'pgm_address', 'Grand Marché\n01 BP 1366 San Pédro 01' ),
        'phone'      => get_theme_mod( 'pgm_phone', '+225 27 34 71 55 55' ),
        'phone_alt'  => get_theme_mod( 'pgm_phone_alt', '+225 27 34 71 56 67' ),
        'whatsapp'   => get_theme_mod( 'pgm_whatsapp', '' ),
        'maps_url'   => get_theme_mod( 'pgm_maps_url', 'https://maps.app.goo.gl/dDSs4A5R91sgfrZ78' ),
        'hours_note' => get_theme_mod( 'pgm_hours_note', 'Horaires publiés à confirmer' ),
        'pharmacist' => get_theme_mod( 'pgm_pharmacist', 'Dr Yacinthe Ocho' ),
        'hours'      => array(
            'Lundi – Vendredi' => get_theme_mod( 'pgm_hours_week', '08:00 – 20:00' ),
            'Samedi'           => get_theme_mod( 'pgm_hours_saturday', '08:00 – 12:00' ),
            'Dimanche'         => get_theme_mod( 'pgm_hours_sunday', 'À confirmer' ),
        ),
        'duty'       => array(
            'enabled' => (bool) get_theme_mod( 'pgm_duty_enabled', false ),
            'dates'   => get_theme_mod( 'pgm_duty_dates', '' ),
            'note'    => get_theme_mod( 'pgm_duty_note', 'Période de garde à confirmer auprès de la pharmacie.' ),
        ),
    );
}

function pgm_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'pgm_contact', array( 'title' => __( 'Pharmacie du Grand Marché', 'pgm' ), 'priority' => 30 ) );
    $fields = array(
        'pgm_name'      => array( 'Nom de la pharmacie', 'Pharmacie du Grand Marché San Pédro' ),
        'pgm_city'      => array( 'Ville et pays', 'San Pedro, Côte d’Ivoire' ),
        'pgm_address'   => array( 'Adresse', "Grand Marché\n01 BP 1366 San Pédro 01" ),
        'pgm_phone'     => array( 'Téléphone principal', '+225 27 34 71 55 55' ),
        'pgm_phone_alt' => array( 'Téléphone secondaire', '+225 27 34 71 56 67' ),
        'pgm_whatsapp'  => array( 'WhatsApp (laisser vide si indisponible)', '' ),
        'pgm_maps_url'  => array( 'Lien Google Maps', 'https://maps.app.goo.gl/dDSs4A5R91sgfrZ78' ),
        'pgm_hours_note'    => array( 'Note sur les horaires', 'Horaires publiés à confirmer' ),
        'pgm_pharmacist'    => array( 'Pharmacien responsable', 'Dr Yacinthe Ocho' ),
        'pgm_hours_week'    => array( 'Lundi – Vendredi', '08:00 – 20:00' ),
        'pgm_hours_saturday'=> array( 'Samedi', '08:00 – 12:00' ),
        'pgm_hours_sunday'  => array( 'Dimanche', 'À confirmer' ),
        'pgm_duty_dates'    => array( 'Dates de garde', '' ),
        'pgm_duty_note'     => array( 'Note de garde', 'Période de garde à confirmer auprès de la pharmacie.' ),
    );
    foreach ( $fields as $id => $field ) {
        $wp_customize->add_setting( $id, array( 'default' => $field[1], 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( $id, array( 'label' => $field[0], 'section' => 'pgm_contact', 'type' => $id === 'pgm_address' || $id === 'pgm_duty_dates' ? 'textarea' : 'text' ) );
    }
    $wp_customize->add_setting( 'pgm_duty_enabled', array( 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
    $wp_customize->add_control( 'pgm_duty_enabled', array(
    'label'       => __( 'Pharmacie actuellement de garde', 'pgm' ),
    'description' => __( 'Activez cette option pour afficher le voyant vert « De garde » sur le site. Désactivez-la pour afficher « Pas de garde ».', 'pgm' ),
    'section'     => 'pgm_contact',
    'type'        => 'checkbox'
) );
}
add_action( 'customize_register', 'pgm_customize_register' );

function pgm_enqueue_assets() {
    wp_enqueue_style( 'pgm-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap', array(), null );
    wp_enqueue_style( 'pgm-style', get_template_directory_uri() . '/assets/css/theme.css', array(), '1.0.3' );
    wp_enqueue_script( 'pgm-script', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.3', true );
    wp_localize_script( 'pgm-script', 'pgmData', array( 'whatsapp' => pgm_config()['whatsapp'] ) );
}
add_action( 'wp_enqueue_scripts', 'pgm_enqueue_assets' );

function pgm_phone_href( $phone ) { return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ); }
function pgm_whatsapp_href( $phone ) {
    $digits = preg_replace( '/[^0-9]/', '', $phone );
    return $digits ? 'https://wa.me/' . $digits : '';
}






/* =========================================================
   PGM MEDICAMENTS CUSTOMIZER
   ========================================================= */

function pgm_medicaments_customizer( $wp_customize ) {

    $wp_customize->add_section(
        'pgm_medicaments',
        array(
            'title'       => 'Médicaments',
            'description' => 'Gérez les médicaments affichés dans la recherche de disponibilité.',
            'priority'    => 35,
        )
    );

    for ( $i = 1; $i <= 100; $i++ ) {

        $name_id = 'pgm_medicament_' . $i . '_name';
        $available_id = 'pgm_medicament_' . $i . '_available';

        $wp_customize->add_setting(
            $name_id,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            $name_id,
            array(
                'label'   => 'Médicament ' . $i,
                'section' => 'pgm_medicaments',
                'type'    => 'text',
            )
        );

        $wp_customize->add_setting(
            $available_id,
            array(
                'default'           => true,
                'sanitize_callback' => function( $value ) {
                    return (bool) $value;
                },
            )
        );

        $wp_customize->add_control(
            $available_id,
            array(
                'label'   => 'Disponible',
                'section' => 'pgm_medicaments',
                'type'    => 'checkbox',
            )
        );
    }
}

add_action(
    'customize_register',
    'pgm_medicaments_customizer'
);


/* ---------------------------------------------------------
   Synchronisation Customizer → médicaments WordPress
   --------------------------------------------------------- */

function pgm_sync_medicaments_from_customizer() {

    if ( ! get_option( 'pgm_medicaments_customizer_synced_v1' ) ) {

        for ( $i = 1; $i <= 100; $i++ ) {

            $name = get_theme_mod(
                'pgm_medicament_' . $i . '_name',
                ''
            );

            if ( ! $name ) {
                continue;
            }

            $existing = get_page_by_title(
                $name,
                OBJECT,
                'pgm_medicament'
            );

            if ( $existing ) {
                continue;
            }

            $post_id = wp_insert_post(
                array(
                    'post_type'   => 'pgm_medicament',
                    'post_title'  => $name,
                    'post_status' => 'publish',
                )
            );

            if ( $post_id ) {

                $available = get_theme_mod(
                    'pgm_medicament_' . $i . '_available',
                    true
                );

                update_post_meta(
                    $post_id,
                    '_pgm_medicament_available',
                    $available ? '1' : '0'
                );
            }
        }

        update_option(
            'pgm_medicaments_customizer_synced_v1',
            '1'
        );
    }
}

add_action(
    'init',
    'pgm_sync_medicaments_from_customizer',
    30
);




/* =========================================================
   PGM MEDICAMENTS REPAIR
   Vérifie et crée les médicaments manquants.
   ========================================================= */

function pgm_repair_medicaments() {

    $medicaments = array(
        'Acide acétylsalicylique',
        'Aciclovir',
        'Albendazole',
        'Allopurinol',
        'Amlodipine',
        'Amoxicilline',
        'Amoxicilline + acide clavulanique',
        'Artéméther',
        'Artéméther + luméfantrine',
        'Artésunate',
        'Aténolol',
        'Atorvastatine',
        'Azithromycine',
        'Benzathine benzylpénicilline',
        'Bétaméthasone',
        'Bisacodyl',
        'Bromazépam',
        'Captopril',
        'Carbamazépine',
        'Céfixime',
        'Ceftriaxone',
        'Cétirizine',
        'Chloramphénicol',
        'Chloroquine',
        'Ciprofloxacine',
        'Clarithromycine',
        'Clindamycine',
        'Clonazépam',
        'Clopidogrel',
        'Codéine',
        'Dexaméthasone',
        'Diazépam',
        'Diclofénac',
        'Doxycycline',
        'Énalapril',
        'Érythromycine',
        'Esoméprazole',
        'Fer + acide folique',
        'Fluconazole',
        'Fluoxétine',
        'Furosémide',
        'Gentamicine',
        'Glibenclamide',
        'Gliclazide',
        'Hydrochlorothiazide',
        'Ibuprofène',
        'Insuline humaine',
        'Ivermectine',
        'Kétoconazole',
        'Kétoprofène',
        'Lactulose',
        'Lidocaïne',
        'Loratadine',
        'Losartan',
        'Mébendazole',
        'Méclozine',
        'Metformine',
        'Méthotrexate',
        'Métronidazole',
        'Miconazole',
        'Montélukast',
        'Naproxène',
        'Nifédipine',
        'Nitrofurantoïne',
        'Oméprazole',
        'Ondansétron',
        'Paracétamol',
        'Perméthrine',
        'Phénobarbital',
        'Prednisolone',
        'Prednisone',
        'Propranolol',
        'Quinine',
        'Ramipril',
        'Rifampicine',
        'Salbutamol',
        'Simvastatine',
        'Spironolactone',
        'Sulfadiazine',
        'Sulfaméthoxazole + triméthoprime',
        'Tamsulosine',
        'Terbinafine',
        'Tramadol',
        'Trimébutine',
        'Valaciclovir',
        'Valproate de sodium',
        'Valsartan',
        'Venlafaxine',
        'Vérapamil',
        'Vitamine B12',
        'Vitamine D',
        'Zinc',
        'Zolpidem',
    );

    foreach ( $medicaments as $name ) {

        $existing = get_page_by_title(
            $name,
            OBJECT,
            'pgm_medicament'
        );

        if ( $existing ) {
            continue;
        }

        $post_id = wp_insert_post(
            array(
                'post_type'   => 'pgm_medicament',
                'post_title'  => $name,
                'post_status' => 'publish',
            ),
            true
        );

        if ( ! is_wp_error( $post_id ) && $post_id ) {

            update_post_meta(
                $post_id,
                '_pgm_medicament_available',
                '1'
            );
        }
    }
}

add_action(
    'init',
    'pgm_repair_medicaments',
    50
);

