# Project ORM

## Question

1- lister les données nécessaires

 
    - Données pour les dépêches AFP :

        Identifiant de la dépêche
        Titre de la dépêche
        Contenu de la dépêche
        Date de publication de la dépêche
        Source de la dépêche

    - Données pour les articles générés :

        Identifiant de l'article
        Titre de l'article
        Contenu de l'article
        Date de création de l'article
        URL de l'article
        Statut de publication de l'article (brouillon, publié)
        Auteur de l'article (IA générative)

    - Données pour les illustrations :

        Identifiant de l'illustration
        URL de l'illustration
        Description de l'illustration
        Date de création de l'illustration

    - Données pour les tags :

        Identifiant du tag
        Nom du tag

    - Relations entre les entités :

        Une dépêche AFP peut générer plusieurs articles.
        Un article peut avoir plusieurs illustrations.
        Un article peut avoir plusieurs tags.


2- Créer le diagramme de classe UML

![uml](https://github.com/iimAtomic/TP_ORM/assets/71674056/2e0ef516-12e2-46ee-b5db-bec4e884b65c)


3- Créer le diagramme MCD 

![mcd_orm](https://github.com/iimAtomic/TP_ORM/assets/71674056/83cd40db-94c0-47d9-9763-b708114549b5)


4- Créer le schéma relationnel des tables grâce à un ORM dans le langage de
votre choix

J'ai utilisé le framework symfony avec l'ORM DOCTRINE  ,le code se trouve ci dessus. 

![doctrine_mcd](https://github.com/iimAtomic/TP_ORM/assets/71674056/5d847fc6-3d8b-4bd4-884c-4e252edefc28)

 
 


