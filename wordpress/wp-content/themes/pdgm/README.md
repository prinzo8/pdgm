# Pharmacie du Grand Marché — thème WordPress

Thème WordPress one-page responsive pour la **Pharmacie du Grand Marché de San Pedro**, conçu dans une direction « Herbier clinique tropical » : santé premium, proximité et identité ivoirienne discrète.

## Installation

1. Compressez le dossier `pharmacie-grand-marche` en fichier `pharmacie-grand-marche.zip`.
2. Dans WordPress, ouvrez **Apparence → Thèmes → Ajouter un thème → Téléverser un thème**.
3. Sélectionnez le ZIP, installez-le, puis activez le thème.
4. Ouvrez **Apparence → Personnaliser → Pharmacie du Grand Marché** pour modifier les coordonnées.
5. Dans **Réglages → Lecture**, définissez la page d’accueil comme page statique si votre configuration WordPress le demande.

## Coordonnées modifiables

Le panneau du Customizer permet de modifier le nom, la ville, l’adresse, les deux téléphones, le numéro WhatsApp, le lien Google Maps, le pharmacien responsable et tous les horaires d’ouverture. Il contient aussi une option « Afficher la période de garde », un champ « Dates de garde » multilignes et une « Note de garde ». Pour mettre à jour ces informations : WordPress → Apparence → Personnaliser → Pharmacie du Grand Marché, puis Publier. Le numéro WhatsApp est laissé vide par défaut afin de ne pas afficher un lien non vérifié. Si vous le renseignez, utilisez le format international sans espaces, par exemple `225XXXXXXXXXX`.

Les valeurs publiques utilisées dans cette version sont prudentes et marquées comme à confirmer : « Grand Marché, 01 BP 1366 San Pédro 01 », `+225 27 34 71 55 55`, `+225 27 34 71 56 67`, le lien Google Maps fourni `https://maps.app.goo.gl/dDSs4A5R91sgfrZ78`, et des horaires publiés lundi–vendredi 08:00–20:00, samedi 08:00–12:00. Vérifiez-les auprès de l’établissement avant mise en ligne.

## Structure

- `front-page.php` : one-page complète et sections principales.
- `header.php` / `footer.php` : navigation sticky, actions, footer et modals légaux.
- `functions.php` : support du thème, enqueue CSS/JS, Customizer et configuration.
- `assets/css/theme.css` : design responsive et accessibilité visuelle.
- `assets/js/theme.js` : menu mobile, smooth scroll, reveal motion, curseur desktop et modals.
- `style.css` : métadonnées WordPress nécessaires à la reconnaissance du thème.
- `index.php`, `page.php`, `single.php` : fallbacks WordPress propres.

## Images et identité institutionnelle

Le hero utilise une image générée évoquant la côte et le port de San Pédro sans prétendre représenter une adresse précise. La photo intérieure fournie par le client a été améliorée en haute résolution et reste utilisée comme photographie documentaire de l’officine. Le logo de pharmacie est un emblème original inspiré des codes visuels d’une enseigne officinale ivoirienne ; il ne s’agit pas du logo d’une institution publique.

Le footer contient une version haute résolution corrigée du logo public du Ministère de la Santé de Côte d’Ivoire, avec l’espace typographique dans « HYGIÈNE PUBLIQUE », reliée à son site officiel. Les deux marques institutionnelles sont volontairement réduites pour s’intégrer dans le footer sans prendre le dessus sur l’identité de la pharmacie. Il contient également un visuel identifié comme ONP-CI, relié au site de l’Ordre National des Pharmaciens de Côte d’Ivoire. Le site de l’Ordre retournant actuellement une erreur critique et la source directe du fichier n’étant pas confirmée, ce second visuel doit être validé ou remplacé par le fichier officiel fourni par l’Ordre avant publication définitive. La présence des logos ne doit pas suggérer un partenariat ou une validation officielle sans accord explicite.

## Personnalisation éditoriale

La section Horaires affiche automatiquement la carte « Pharmacie de garde » uniquement si l’option est activée et si des dates sont renseignées. Cela évite de publier une information vide ou obsolète. Les horaires et la garde sont échappés côté thème pour conserver un affichage sûr, et les champs multilignes acceptent une date par ligne.

Les services et conseils sont écrits de façon générale pour éviter de présenter comme disponibles des prestations non confirmées. Les cartes ne contiennent aucun avis client fabriqué. Pour faire évoluer le contenu, modifiez les blocs de `front-page.php` ou transformez-les ultérieurement en champs personnalisés / blocs WordPress selon les besoins de l’équipe.

## Accessibilité et performance

Le thème utilise des éléments sémantiques, un lien d’évitement, des boutons de modal accessibles, la fermeture par `Échap`, la fermeture par clic extérieur, le respect de `prefers-reduced-motion`, un curseur limité aux pointeurs fins et un JavaScript vanilla léger. Les images hero sont chargées avec un texte alternatif descriptif.

## Sources publiques consultées

Les informations de recherche ont été recoupées avec les fiches publiques suivantes : [Go Africa Online](https://www.goafricaonline.com/ci/69269-grand-marche-pharmacies-san-pedro-cote-ivoire), [Pharmacies de garde Côte d’Ivoire](https://www.pharmacies-de-garde.ci/listing/pharmacie-du-grand-marche/), [Mapcarta / OpenStreetMap](https://mapcarta.com/fr/N5852321516) et [I Am Beezy](https://www.iambeezy.app/beezpages/pharmacie-du-grand-marche-san-pedro-nf0r). Les annuaires ne constituant pas une validation officielle, les coordonnées et horaires doivent être contrôlés avant publication.
