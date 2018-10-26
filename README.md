# php light

Bonjour et bienvenue sur le framework.

## config

### server

- ubuntu 16.04
- apache 2.4.18
- php : 7.0+
- sqlite : 3
- composer :1.0

## arborescence du framework

```
├── composer.json
├── composer.lock
├── public
│   ├── .htaccess
│   ├── css
│   │   ├── fonts
│   │   └── img
│   ├── img
│   ├── index.php
│   ├── js
│   └── robots.txt
├── src
│   ├── bootstrap.php
│   ├── Config
│   ├── config.php
│   ├── Controllers
│   ├── Data
│   ├── dependencies.php
│   ├── Libs
│   ├── middlewares.php
│   ├── routes.php
│   └── Views
│       ├── elements
│       ├── errors
│       └── layouts
└── var
    ├── cache
    │   └── config
    └── log
```


## installer le framework (backend)


### server
Vous devez installer :
- Apache 2.x
- PHP 7.0
- sqlite3 **en ligne de commande**  
- accessoirement un client/interface graphique sqlite 3.
- GIT
- composer


#### Configurer PHP

La configuration de PHP utilisé en ligne de commande est stockée dans /etc/php/7.x/cli/php.ini. À ne pas confondre avec la configuration pour Apache qui nous intéresse et est stockée dans /etc/php/7.x/apache2/php.ini. Voici quelques suggestions de modifications :
```
max_execution_time = 30
max_input_time = 60
memory_limit = 128M
upload_max_filesize = 10M
expose_php = Off
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
display_errors = On
display_startup_errors = On
log_errors = On
log_errors_max_len = 1024
ignore_repeated_errors = Off
html_errors = On

default_charset = "UTF-8"
mbstring.language=UTF-8
mbstring.internal_encoding=UTF-8
mbstring.http_input=UTF-8
mbstring.http_output=UTF-8
mbstring.detect_order=auto

```

#### Composer

Aller sur le [site officiel](https://getcomposer.org/) et suivez scrupuleusement les instructions suivant votre OS pour installer composer en ligne de commande.

#### obtenir les fichiers/librairie provenant du vendor

Si vous avez installer composer correctement, ouvrez votre terminal et aller à la racine du projet. Tapez cette commande pour télécharger les librairies du projet (root n'est pas obligatoire) :
```
composer install
```

### vhost Unix / Unix-like

Sur Unix, éditer le fichier /etc/hosts en ajoutant une ligne avec le dns :

```
127.0.1.1	php-light.test
```

faites un ping au cas où sur ce dns afin de vérifier que vous récupérez bien des paquets. Ensuite, éditer un fichier dans /etc/apache2/sites-available. Nomez le comme le dns nouvellement créé avec une extension complémentaire .conf (confbox.test.conf). Placez y le code ci-dessous :

```
<VirtualHost *:80>
    #nom de domaine
	ServerName php-light.test
    #on accepte aussi le www
	ServerAlias www.php-light.test
    #logs d'erreur
	ErrorLog /var/www/php-light/var/log/error.log
    #logs de connexion
	CustomLog /var/www/php-light/var/log/access.log common
    #Définition de la racine des sources php
	DocumentRoot "/var/www/php-light/public/"
	<directory /var/www/php-light/public/>
		Options -Indexes +FollowSymLinks +MultiViews
		AllowOverride All
		Require all granted
	</Directory>
</VirtualHost>
```

Pour CustomLog, ErrorLog, DocumentRoot et directory, paramétrez les bons chemins suivant votre configuration.

Aussi, n'oubliez pas de recharger Apache afin qu'il prenne en compte votre configuration :

```
sudo a2ensite php-light.test.conf && sudo systemctl reload apache2
```

Je vous souhaite un bon développement !
