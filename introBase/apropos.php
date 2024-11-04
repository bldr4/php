<?php include('header.php');

// isset : Détermine si une variable est décalrée ET est différente de null

// htmlspecialchars : Permet de ne pas interpréter les caractères spéciaux  -> empêcher l'éxecution de script malvéillants ( faille XSS) 
$prenom = isset($_GET['prenom']) ? htmlspecialchars($_GET['prenom']) : 'Inconnu';


// empty : Détermine si une variable est vide

// strip_tags: supprime les caractères spéciaux
$nom = !empty($_GET['nom']) ? strip_tags($_GET['nom']) : 'Inconnu';

?>


<h2> Page à propos </h2>
<!--  Affiche de variable avec ET sans echo -->
<p>Prénom :<?php echo $prenom ?> </p>
<p>Nom : <?= $nom ?></p>

<?php include('footer.php') ?>