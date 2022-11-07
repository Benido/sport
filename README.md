(Cette application est développée dans le cadre de la formation Développeur Web - Web Mobile de Studi)
# En chantier #
Application déployée sur Heroku \>  https://sapik.herokuapp.com/](https://sapik.herokuapp.com/)

Cette application utilise le SGBD MariaDB

Pour déployer en local : 
   - Assurez vous que Node.js et Composer soient installés ( dans une console, node --version et composer --version)
   - Installez XAMPP et mettez en place un serveur Apache en local. Activez-le ainsi que le module mySQL depuis le panneau de contrôle XAMPP
   - Pour relier la base de données à l'application, renseignez votre username et password MariaDB dans la variable d'environnement DATABASE_URL
   - Pour peupler la base de données, ouvrez un terminal dans le dossier racine du projet et lancez la commande php bin/console doctrine:fixtures:load 
   - Ajouter la variable d'environnement suivante dans le fichier .env.local et saisissez la chaîne de caractères de votre choix \> JWT_SECRET='machaînedecaractère'
    

Pour déployer sur Heroku : 
- Définissez la variable d'environnement stockant le secret utilisé pour générer les Json Web Tokens et donner lui en valeur la chaîne de caractères de votre choix :
    Settings \> Config Vars \>  JWT_SECRET='machaînedecaractères'
