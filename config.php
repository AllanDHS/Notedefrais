<?php


// Définition des constantes de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'frais');
define('DB_USER', 'root');
define('DB_PASS', 'root');




// Définition des Variables Regex
define('REGEX_NAME', '/^[a-zA-ZÀ-ÿ\' -]+$/');
define('REGEX_PHONE', '/^[0-9]{10}$/');
define('REGEX_NUMBER', '/^[0-9]+$/');
define('REGEX_DATE', '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/');


// Définition des parametres d'upload de fichiers
define('UPLOAD_MAX_SIZE', 8*1000*1000);
define('UPLOAD_EXTENSIONS', ['jpg', 'jpeg', 'png', 'pdf','webp']);
