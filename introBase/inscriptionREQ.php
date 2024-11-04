<?php
// Démarrer la session
session_start();

//  Vérifier si le formulaire a été soumis avec la méthode POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // échapper les entrées de l'utilisateur
    $_SESSION['nom'] = htmlspecialchars($_POST['nom']);
    $_SESSION['prenom']= htmlspecialchars($_POST['prenom']);

    $targetDir = "uploads/";
    // !!!! vous devez trouver un moyen plus sécurisé de stocker les images !!!!
    $targetFile = $targetDir . basename($_FILES['image']['name']);

    // move_uploaded_file() déplace un fichier téléchargé vers un nouvel emplacement
    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
        $_SESSION['image'] = $targetFile;
    }else{
        echo "Erreur lors de l'upload de l'image";
    }

    // Rediriger vers la page d'affichage
    header('Location: affichage.php');
    exit();

}