## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# Executer Bitchest en local : 

* Créez une base de données sur votre serveur Laragon / Xampp....
* Renommez le fichier .env comme ceci : APP_NAME=bitChest
* Saisissez "composer install" dans votre terminal pour installer les dépendances de Composer.
* Ensuite "php artisan key:generate" pour générer une clé d'application.
* Puis "php artisan migrate --seed" pour lancer les migrations.
* Puis "php artisan serve" pour executer l'application.
