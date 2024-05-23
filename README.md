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


