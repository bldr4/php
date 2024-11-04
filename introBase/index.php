<?php include('header.php'); 
session_start();

// permet d'envoyer le contenu d'une variable à la sortie (debug)
// var_dump($_SESSION['nom']);
// die();

//  Définir des variables en PHP
$prenom ="John";
$nom = "Doe";
?>


<!--  urlencode permet d'encoder une chaîne pour qu'elle soit comptabile avec l'url -->
<a href="apropos.php?prenom=<?php echo urlencode($prenom); ?>&nom=<?php echo urlencode($nom)  ?>">Cliquez-ici</a>

<?php include('footer.php') ?>