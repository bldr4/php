<?php
require 'bd.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // récupérer + échappper les données (xss) +  supprimer les espaces
    $email = trim(htmlspecialchars($_POST['mail']));
    $mdp = trim($_POST['mdp']);
    $role= 'user';

//  vérifier si nos champs sont vides
    if(empty($email) || empty($mdp)){
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

// Rechercher l'utilisateur par l'email 
    $db = Database::connect();
    $stmt =$db->prepare("SELECT * FROM users WHERE mail = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe
    if($user){
        // vérifier le mot de passe
        if(password_verify($mdp, $user['mdp'])){
            // on stocke les infos de l'utilisateur dans la session (l'utilisateur est connecté)
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: index.php');
        }else{
            $error = "Mot de passe incorrect";
            header('Location: connexion.php?error='. urlencode($error));
            exit;
        }
    }else{
        $error = "Cet email n'existe pas";
        header('Location: connexion.php?error='. urlencode($error));
        exit;
    }

    $db = Database::disconnect();
}