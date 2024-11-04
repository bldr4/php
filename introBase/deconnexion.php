<?php
// Démarrer la session 
session_start();

// Détruire toutes les sessions
session_destroy();

// rediriger vers la page d'accueil
header('Location: index.php');
exit();