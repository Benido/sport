(Cette application est développée dans le cadre de la formation Développeur Web - Web Mobile de Studi)
# SAPIK #

**En chantier**

Application déployée sur Heroku \>  https://sapik.herokuapp.com/](https://sapik.herokuapp.com/)

Une application de gestion d'autorisations d'accès à une API externe

Cette application utilise le SGBD MariaDB et le mailer Sendgrid

Pour déployer en local : 
   - Assurez vous que Node.js et Composer soient installés ( dans une console, node --version et composer --version)
   - Installez XAMPP et mettez en place un serveur Apache en local. Activez-le ainsi que le module mySQL depuis le panneau de contrôle XAMPP
   - Pour relier la base de données à l'application, renseignez votre username et password MariaDB dans la variable d'environnement DATABASE_URL
   - Pour peupler la base de données, ouvrez un terminal dans le dossier racine du projet et lancez la commande php bin/console doctrine:fixtures:load 
   - Ajouter la variable d'environnement suivante dans le fichier .env.local et saisissez la chaîne de caractères de votre choix \> JWT_SECRET='machaînedecaractère'
    

Pour déployer sur Heroku : 
- Choisissez un serveur Apache avec PHP 8.0 minimum et installez Node.js
- Créez un compte sur Sendgrid et générez une clé d'API en choisissant l'option SMTP relay
- Dans les options Settings \> Config Vars \> 
   - Définissez la variable d'environnement pour stocker la clé d'API utilisée par le mailer : MAILER_DSN=sendgrid+smtp://'votre clé API'@default
   - Définissez la variable d'environnement stockant le secret utilisé pour générer les Json Web Tokens et donner lui en valeur la chaîne de caractères de votre choix :
      JWT_SECRET='machaînedecaractères'
