<?php
require 'bd.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // récupérer + échappper les données (xss) +  supprimer les espaces
    $nom = trim(htmlspecialchars($_POST['nom']));
    $email = trim(htmlspecialchars($_POST['mail']));
    $mdp = trim($_POST['mdp']);
    $role= 'user';

//  vérifier si nos champs sont vides
    if(empty($nom) || empty($email) || empty($mdp)){
     $error = "Veuillez remplir tous les champs";
     header('Location: inscription.php?error='. urlencode($error));
     exit;
    }
// vérifier si l'email est valide
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Email invalide";
        header('Location: inscription.php?error='. urlencode($error));
        exit;
    }

// Vérifier si l'email est déjà utilisé 
    $db = Database::connect();
    $stmt =$db->prepare("SELECT id FROM users WHERE mail = :email");
    $stmt->execute([':email' => $email]);
    if($stmt->fetch()){
        $error = "Cet email est déjà utilisé";
        header('Location: inscription.php?error='. urlencode($error));
        exit;
    }
    // Crypter : Utilisé pour protéger les données qui pourront être décryptés avec une clé de cryptage (RSA, AES, 3DES, etc.)
    // Encoder: Utilisé pour rendre les données compatbiles avec différents systèmes, pas d'intention de sécurité (base64, utf-8, JSON, etc.)
    // Hachage: Utilisé pour rendre les données illisibles, pas de décryptage possible (MD5, SHA1, SHA256, bcrypt, etc.)

    // password_hash() : permet d'utiliser l'algo de hashage le plus performant du moment (bcrypt)
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO users(nom, mail, mdp, role) VALUES(:nom, :email, :mdp, :role)');
    $success = $stmt->execute([':nom' => $nom, ':email' => $email, ':mdp' => $mdpHash, ':role' => $role]);

    if($success){
        echo "Inscription réussie";
        header('Location: connexion.php');
    }else{
        header('Location: inscription.php');
    }
    $db = Database::disconnect();
}