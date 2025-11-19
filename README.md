# Thème WordPress Foyer Ander Lechtois

Un thème WordPress mobile-first avec slider tactile pour le Foyer Ander Lechtois.

## 🚀 Installation

### Méthode 1: Via l'administration WordPress (Recommandée)
1. Connectez-vous à votre administration WordPress
2. Allez dans **Apparence > Thèmes**
3. Cliquez sur **Ajouter** puis **Téléverser un thème**
4. Sélectionnez le fichier ZIP du thème
5. Cliquez sur **Installer maintenant**
6. **Activez** le thème

### Méthode 2: Via FTP
1. Décompressez le thème
2. Uploadez le dossier via FTP dans `/wp-content/themes/`
3. Dans l'admin WordPress: **Apparence > Thèmes**
4. **Activez** le thème "Foyer Ander Lechtois"

## 📱 Fonctionnalités

✅ **Design mobile-first responsive**
✅ **Slider tactile** avec swipe gauche/droite
✅ **3 cartes interactives** cliquables
✅ **Indicateurs de pagination** (dots)
✅ **Navigation clavier** (flèches, Home, End)
✅ **Accessibilité optimisée**
✅ **Performance optimisée**
✅ **SEO-friendly**

## 🎨 Personnalisation

### Ajout de vos images
1. Allez dans **Apparence > Personnaliser**
2. Section **"Images des Cartes"**:
   - **Image "Je suis habitant"**: Votre carte complète (fond jaune + illustration + texte)
   - **Image "Je cherche un logement"**: Votre carte complète (fond rose + illustration + texte)
   - **Image "Je découvre le foyer"**: Votre carte complète (fond vert + illustration + texte)
   - **Logo Footer**: Votre logo du foyer

**IMPORTANT**: Vos images doivent être les cartes **complètes** comme dans vos maquettes. Elles remplaceront entièrement la zone colorée, seule la bande rouge avec le titre reste.

### Configuration des liens
1. Dans **Apparence > Personnaliser**
2. Section **"Liens des Cartes"**:
   - **Lien "Je suis habitant"**: URL vers la page habitant
   - **Lien "Je cherche un logement"**: URL vers la page logement  
   - **Lien "Je découvre le foyer"**: URL vers la page découverte

### Formats d'images recommandés
- **Cartes complètes**: 300x400px minimum, format PNG ou JPG
- **Logo footer**: 120x120px maximum, format PNG avec transparence

**Note**: Vos images couvriront toute la zone au-dessus de la bande rouge titre.

## 🛠️ Structure du thème

```
foyer-theme/
├── style.css          # Styles principaux + info thème
├── functions.php      # Fonctionnalités WordPress
├── index.php          # Template principal
├── front-page.php     # Template page d'accueil
├── header.php         # En-tête
├── footer.php         # Pied de page
├── page.php           # Template pages
└── assets/
    ├── js/
    │   └── slider.js  # JavaScript du slider
    └── images/        # Vos images (à ajouter)
        ├── habitant.png
        ├── logement.png
        ├── foyer.png
        └── logo.png
```

## 📋 Ajout de vos images

### Noms de fichiers recommandés:
- `habitant.png` - Femme au téléphone + bulle logo
- `logement.png` - Maison + loupe  
- `foyer.png` - Bâtiment + végétation
- `logo.png` - Logo du foyer

### Comment ajouter vos images:
1. **Via le personnaliseur** (recommandé):
   - **Apparence > Personnaliser > Images des Cartes**
   - Uploadez chaque image dans la section correspondante

2. **Via FTP** (avancé):
   - Uploadez vos images dans `/wp-content/themes/foyer-theme/assets/images/`
   - Renommez-les selon les noms ci-dessus

## 🎯 Utilisation

### Slider tactile
- **Mobile**: Swipe gauche/droite sur les cartes
- **Desktop**: Clic sur les dots ou clavier (flèches)
- **Accessibilité**: Navigation clavier complète

### Navigation
- Chaque carte est cliquable et mène vers sa page respective
- Les liens se configurent dans **Apparence > Personnaliser**

## 🔧 Support technique

### Compatibilité
- **WordPress**: 5.0 minimum
- **PHP**: 7.4 minimum  
- **Navigateurs**: Chrome, Firefox, Safari, Edge (versions récentes)
- **Responsive**: Mobile, tablette, desktop

### Performance
- CSS optimisé mobile-first
- JavaScript vanilla (pas de jQuery)
- Images lazy loading
- Code minimaliste et rapide

## 🆘 Dépannage

### Les images ne s'affichent pas
1. Vérifiez les permissions des fichiers (755)
2. Utilisez le personnaliseur pour uploader les images
3. Videz le cache si vous en utilisez un

### Le slider ne fonctionne pas
1. Vérifiez que JavaScript est activé
2. Testez sur un autre navigateur
3. Regardez la console pour les erreurs

### Problèmes de responsive
1. Videz le cache du navigateur (Ctrl+F5)
2. Testez en navigation privée
3. Vérifiez qu'aucun plugin n'interfère

## 📞 Contact

Pour toute question sur ce thème, contactez le développeur ou consultez la documentation WordPress officielle.

## 🎨 Couleurs du thème

- **Fond principal**: Dégradé violet (#7B68EE vers #6A5ACD)
- **Carte habitant**: Dégradé doré (#F4D03F vers #E8C547)
- **Carte logement**: Dégradé rose (#F1A7A7 vers #E89B9B)  
- **Carte foyer**: Dégradé vert (#7DCEA0 vers #73C6B6)
- **Bande titre**: Rouge vif (#FF0000)
- **Texte**: Noir (#000000)

---

**Version**: 2.0 (Corrigée)  
**Auteur**: Thème personnalisé  
**Licence**: Usage privé

## 🔄 Version 2.0 - Corrections
- ✅ Les images couvrent maintenant **toute** la zone colorée
- ✅ Vos maquettes s'affichent exactement comme prévu
- ✅ Les images remplacent fond coloré + illustration
- ✅ Seule la bande rouge titre reste visible
