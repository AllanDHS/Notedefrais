<?php

// J'ouvre ma session

session_start();


require_once '../config.php';


// j'appelle mes helpers
require_once '../helpers/database.php';
require_once '../helpers/form.php';


// j'appelle mes models
require_once '../models/Employes.php';
require_once '../models/Renseignement_frais.php';


include "../views/userdashboard.php";