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
         Données pour les tags :
         Identifiant du tag
         Nom du tag
         
    - Données pour l'IA générative :
        Identifiant de l'IA générative
        Type de l'IA générative (texte ou image)
        Fonction de l'IA générative
        
    - Relations entre les entités :
    
        Une dépêche AFP peut générer plusieurs articles.
        Un article peut avoir plusieurs illustrations.
        Un article peut avoir plusieurs tags.
        Un article utilise une IA générative pour le texte.
        Une illustration utilise une IA générative pour l'image.


2- Créer le diagramme de classe UML

```mermaid
classDiagram
    class Depêche {
        +int id_depeche
        +string titre
        +string contenu
        +date date_publication
        +string source
    }

    class Article {
        +int id_article
        +string titre
        +string contenu
        +date date_creation
        +string url
        +string statut
        +string auteur
    }

    class Illustration {
        +int id_illustration
        +string url
        +string description
        +date date_creation
    }

    class Tag {
        +int id_tag
        +string nom
    }

    class IAGenerative {
        <<abstract>>
        +int id_ia
        +string type
        +string fonction
        +creer()
    }

    class IAGenerativeTexte {
        +creer()
    }

    class IAGenerativeImage {
        +creer()
    }

    Depêche "1" --> "0..*" Article : génère
    Article "1" --> "0..*" Illustration : a
    Article "1" --> "0..*" Tag : a
    Article "1" --> "0..*" IAGenerativeTexte : utilise
    Illustration "1" --> "0..*" IAGenerativeImage : utilise
    IAGenerative <|-- IAGenerativeTexte
    IAGenerative <|-- IAGenerativeImage

```


3- Créer le diagramme MCD 

```mermaid
erDiagram
    DEPECHE {
        int id_depeche PK
        string titre
        string contenu
        date date_publication
        string source
    }
    ARTICLE {
        int id_article PK
        string titre
        string contenu
        date date_creation
        string url
        string statut
        string auteur
    }
    ILLUSTRATION {
        int id_illustration PK
        string url
        string description
        date date_creation
    }
    TAG {
        int id_tag PK
        string nom
    }
    IAGENERATIVE {
        int id_ia PK
        string type
        string fonction
    }
    ARTICLE_ILLUSTRATION {
        int id_article FK
        int id_illustration FK
    }
    ARTICLE_TAG {
        int id_article FK
        int id_tag FK
    }
    ARTICLE_IAGENERATIVE {
        int id_article FK
        int id_ia FK
    }
    ILLUSTRATION_IAGENERATIVE {
        int id_illustration FK
        int id_ia FK
    }

    DEPECHE ||--o{ ARTICLE : "génère"
    ARTICLE ||--o{ ARTICLE_ILLUSTRATION : "a"
    ARTICLE ||--o{ ARTICLE_TAG : "a"
    ILLUSTRATION ||--o{ ARTICLE_ILLUSTRATION : "appartient"
    TAG ||--o{ ARTICLE_TAG : "a"
    ARTICLE ||--o{ ARTICLE_IAGENERATIVE : "utilise"
    ILLUSTRATION ||--o{ ILLUSTRATION_IAGENERATIVE : "utilise"
    IAGENERATIVE ||--o{ ARTICLE_IAGENERATIVE : "est utilisé par"
    IAGENERATIVE ||--o{ ILLUSTRATION_IAGENERATIVE : "est utilisé par"


```


4- Créer le schéma relationnel des tables grâce à un ORM dans le langage de
votre choix

J'ai utilisé le framework symfony avec l'ORM DOCTRINE  ,le code se trouve ci dessus. 



 
 

#
#
# Projet Hotel Management 

## Use Case Diagram

```plantuml
@startuml

top to bottom direction

actor Client
actor "Administrateur Hôtelier" as Admin
actor Réceptionniste

rectangle Réservation {
    usecase UC1 as "Consulter la disponibilité des chambres"
    usecase UC2 as "Effectuer une réservation en ligne"
    usecase UC12 as "Effectuer une réservation en agence"
    usecase UC3 as "Payer les arrhes de réservation"
}

rectangle Receptionniste {
    usecase UC10 as "Consulter la liste des arrivées prévues"
    usecase UC11 as "Consulter l'état d'occupation des chambres"
    usecase UC7 as "Enregistrer l'arrivée des clients"
    usecase UC8 as "Enregistrer les consommations des clients"
    usecase UC9 as "Établir la facture de départ"
}

rectangle Administration {
    usecase UC5 as "Créer/modifier les caractéristiques des hôtels"
    usecase UC6 as "Créer/modifier les caractéristiques des chambres"
}

Client --> UC1
UC1 --> UC2
UC1 --> UC12
UC2 --> UC3
UC12 --> UC3

Réceptionniste --> UC10
Réceptionniste --> UC11
Réceptionniste --> UC7
UC7 --> UC9
UC7 --> UC8

Admin --> UC5
Admin --> UC6

@enduml
```

![image](https://github.com/iimAtomic/TP-UML/assets/71674056/646eb4b8-430a-47e4-9472-461c369deddf)
![image](https://github.com/iimAtomic/TP-UML/assets/71674056/4487a204-638c-4e98-aee4-e61d82b4dc64)




## Diagramme d'Activité

```mermaid
classDiagram
    class Hôtel {
        +String nom
        +String adresse
        +String téléphone
        +int étoiles
        +ajouterChambre(Chambre chambre)
        +modifierChambre(Chambre chambre)
        +supprimerChambre(Chambre chambre)
    }

    class Chambre {
        +String catégorie
        +int capacité
        +boolean confort
        +double prix
        +boolean disponibilité
        +vérifierDisponibilité()
        +réserver()
    }

    class Réservation {
        +String idRéservation
        +Date dateDébut
        +Date dateFin
        +String statut
        +double arrhes
        +enregistrerArrhes()
        +confirmerRéservation()
    }

    class Client {
        +String idClient
        +String nom
        +String adresse
        +String téléphone
        +String email
        +effectuerRéservation()
        +annulerRéservation()
    }

    class Réception {
        +enregistrerArrivée()
        +enregistrerConsommation()
        +générerFacture()
        +imprimerListeArrivées()
        +imprimerÉtatOccupation()
    }

    class Admin {
        +gérerHôtels()
    }

    Hôtel "1" -- "*" Chambre : contient
    Chambre "1" -- "0..*" Réservation : assignée_à
    Client "1" -- "0..*" Réservation : effectue
    Réservation "1" -- "1" Chambre : réserve
    Réception "1" -- "0..*" Réservation : gère
    Admin "1" -- "*" Hôtel : gère

```

## Diagramme d'Activité

```mermaid
flowchart TD
    A[Début] --> B[Le client choisit la méthode de réservation]
    B --> |En ligne| C[Remplir le formulaire de réservation]
    B --> |À l'agence| D[Remplir le formulaire imprimé]
    C --> E[Soumettre le formulaire de réservation]
    D --> F[Soumettre le formulaire imprimé à l'agence]
    E --> G[Vérifier la disponibilité]
    F --> G[Vérifier la disponibilité]
    G --> |Disponible| H[Créer un enregistrement de réservation]
    G --> |Non disponible| I[Notifier le client]
    H --> J[Calculer les arrhes]
    J --> K[Confirmer la réservation]
    K --> L[Envoyer la confirmation au client]
    L --> M[Fin]
    I --> M[Fin]

```


## Diagramme de sequence

```mermaid
sequenceDiagram
    participant Client
    participant Réception
    participant Système

    Client->>Réception: Remplir le formulaire de réservation
    Réception->>Système: Soumettre la réservation
    Système-->>Réception: Vérifier la disponibilité
    Réception-->>Client: Confirmation de la disponibilité
    Client->>Réception: Confirmer la réservation
    Réception->>Système: Enregistrer la réservation
    Système-->>Réception: Confirmation de la réservation
    Réception-->>Client: Envoyer la confirmation
    Client->>Réception: Arrivée
    Réception->>Système: Enregistrer l'arrivée
    Système-->>Réception: Confirmation de l'arrivée
    Réception-->>Client: Remettre les clés et les détails

```












# Tableau Synoptique sur le Thème "ChatGPT"

| **Idée**                                 | **Document 1 (Guide de l'enseignant)**                                                                                 | **Document 2 (Formation ChatGPT)**                                                                            | **Document 3 (Comprendre le phénomène ChatGPT)**                                                                 | **Document 4 (100 exemples de mise en pratique avec ChatGPT)**                                                   | **Document 5 (ChatGPT)**                                                                                         |
|------------------------------------------|-----------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------|
| **Aide à la création de contenu**        | Utilisation de ChatGPT pour générer des quiz et des évaluations pour les élèves.                                       | Utilisation de ChatGPT pour générer des idées de contenu.                                                     | Utilisation de ChatGPT pour générer des articles de blog et des posts sur les réseaux sociaux.                  | ChatGPT peut aider à créer des contenus, mais il faut éviter de les utiliser tels quels en raison d'éventuelles erreurs. | Utilisation de ChatGPT pour générer des réponses automatiques et du contenu marketing.                           |
| **Éducation et formation**               | Génération de plans de cours adaptés aux besoins des élèves.                                                          | Utilisation de ChatGPT pour fournir des exemples de qualité pour les devoirs et les tâches d'apprentissage.   | Utilisation de ChatGPT pour générer des plans de cours et des supports pédagogiques.                            | Utilisation de ChatGPT pour trouver des sujets d'articles, d'exposés et de conférences.                           | Utilisation de ChatGPT pour créer des supports éducatifs interactifs.                                             |
| **Amélioration des compétences**         | Utilisation de ChatGPT pour générer des tâches différenciées selon les capacités des élèves.                           | ChatGPT aide à l'évaluation formative en générant des quiz et des évaluations.                                 | Utilisation de ChatGPT pour améliorer les compétences rédactionnelles des élèves.                                | Utilisation de ChatGPT pour générer rapidement du contenu en cas d'urgence.                                       | Utilisation de ChatGPT pour fournir des commentaires et des conseils personnalisés.                              |
| **Applications pratiques diverses**      | Utilisation de ChatGPT pour générer des supports visuels comme des affiches et des infographies.                       | Utilisation de ChatGPT pour générer des scripts, des poèmes et des histoires.                                 | Utilisation de ChatGPT pour générer des questions d'interview et des scripts.                                    | ChatGPT peut proposer des plans pour des articles ou des exposés.                                                 | Utilisation de ChatGPT pour générer des idées de projets et des présentations.                                   |
| **Défis et limitations**                 | ChatGPT doit être utilisé avec précaution pour éviter des contenus de qualité médiocre.                                | ChatGPT peut générer des contenus répétitifs et impersonnels.                                                  | ChatGPT peut introduire des erreurs dans les contenus générés.                                                   | Nécessité de réécrire les contenus générés pour les personnaliser et les rendre plus engageants.                  | Importance de vérifier et de personnaliser les contenus générés par ChatGPT pour éviter les erreurs et les imprécisions. |


