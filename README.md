# GESTION PRODUITS

## Prérequis
Cette application est compatible `PHP8` et a été testée avec une base de données `MySQL 8.4`.

## Installation
- Copier les fichiers du dossier `www` dans un dossier accessible par le serveur Web.
- Assurez vous que le dossier `uploads` est accessible en lecture et écriture par le serveur Web : `chmod 777 uploads`
- Importez la base de données test à partir du dump SQL `database/gestion_produits.sql`.
- Connectez vous à l'application avec l'url adaptée avec les informations suivantes :
    - Login : `admin`
    - Mot de passe : `password`

## Fonctionnalités
L'application permet de :
- Lister les produits
- Afficher la fiche produit en lecture seule
- Ajouter des produits
- Modifier les produits
- Supprimer les produits
- Pour chaque produit, il est possible d'ajouter autant de photos que nécessaire#   k u b e r n e t e s 
 
 
# GESTION PRODUITS

## Prérequis
Cette application est compatible `PHP8` et a été testée avec une base de données `MySQL 8.4`.

## Installation
- Copier les fichiers du dossier `www` dans un dossier accessible par le serveur Web.
- Assurez vous que le dossier `uploads` est accessible en lecture et écriture par le serveur Web : `chmod 777 uploads`
- Importez la base de données test à partir du dump SQL `database/gestion_produits.sql`.
- Connectez vous à l'application avec l'url adaptée avec les informations suivantes :
    - Login : `admin`
    - Mot de passe : `password`

## Fonctionnalités
L'application permet de :
- Lister les produits
- Afficher la fiche produit en lecture seule
- Ajouter des produits
- Modifier les produits
- Supprimer les produits
- Pour chaque produit, il est possible d'ajouter autant de photos que nécessaire


## Gestion Produits – Déploiement Kubernetes (PHP + MySQL / PostgreSQL)

### Technologies utilisées
| Outil / Langage | Version |
|-----------------|---------|
| Docker Desktop  | Dernière version (Windows) |
| Kubernetes      | Intégré à Docker Desktop |
| PHP             | 8.2 (via `php:8.2-apache`) |
| MySQL           | 8.0 |
| PostgreSQL      | 15 |
| kubectl         | en ligne de commande |
| PowerShell      | pour les scripts |
### Arborescence du projet
gestion-produits/
├── php/
│   └── www/                 # Code PHP + fichiers images
├── database/
│   └── gestion_produits.sql # Script d'init BD
├── Dockerfile               # Image PHP
├── docker-compose.yml       # Pour test local
└── k8s/
    ├── mysql/               # Fichiers Kubernetes MySQL
    ├── postgresql/          # Fichiers Kubernetes PostgreSQL
    ├── php-mysql/           # App PHP connectée à MySQL
    └── php-postgresql/      # App PHP connectée à PostgreSQL
 Déploiement – Version PHP + MySQL
1. Construire l’image PHP localement :
    docker build -t gestion-produits-php:latest .

2. Appliquer les fichiers Kubernetes :
    kubectl apply -f k8s/mysql/
    kubectl apply -f k8s/php-mysql/

3. Redémarrer le pod PHP :
    kubectl delete pod -l app=php-app

4. Accéder à l’application :
    kubectl get svc php-service
    http://localhost:<NodePort>
 Déploiement – Version PHP + PostgreSQL
Même logique que MySQL :
    docker build -t gestion-produits-php:latest .
    kubectl apply -f k8s/postgresql/
    kubectl apply -f k8s/php-postgresql/
    kubectl delete pod -l app=php-pg
    kubectl get svc php-pg-service
    http://localhost:<NodePort>
 Vérifications à faire
- kubectl get pods
- kubectl get svc php-service
- Navigateur : test-db.php → Connexion OK
- Navigateur : /uploads/image.jpg → Image s'affiche
- kubectl logs <php-pod> -c init-uploads → logs de copie
Logs utiles
kubectl exec -it <php-pod> -- ls /var/www/html/uploads
kubectl logs <php-pod> -c init-uploads
 Fonctionnalités couvertes
- Déploiement multi-services dans Kubernetes
- Volumes persistants (PVC) pour /uploads et base
- Secrets pour mots de passe et noms de base
- initContainer pour précharger les images
- Exposition en NodePort

Déploiement Kubernetes local sur Docker Desktop (Windows).
