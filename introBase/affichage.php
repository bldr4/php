<?php
session_start();

if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom']) || !isset($_SESSION['image'])){
    header('Location: index.php');
    exit();
}

include('header.php');

echo "<h2> Page d'affichage </h2>";
// Deux exemples de concaténation de variables
echo "<p> Prénom : {$_SESSION['prenom']} </p>";
echo "<p> Nom : " . $_SESSION['nom'] . "</p>";
echo "<img src='" . $_SESSION['image'] . "' alt='image de profil' width='100' height='100'>";

include('footer.php');

