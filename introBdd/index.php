<?php
require 'bd.php';
session_start();
// récupérer le param de l'url pour les sous categs 
$categId = isset($_GET['subCategId']) ? $_GET['subCategId'] : null;

// récupérer l'utilisateur connecté en utilisant une ternaire 
// $userCo = isset($_SESSION['user_nom']) ? $_SESSION['user_nom'] : null;
// Equivalent à la ternaire ci-dessus -> opérateur de coalescence null
$userCo =  $_SESSION['user_nom']  ?? null;
$db = Database::connect();

// récupérer les categs mère 
$query = "SELECT * FROM categories WHERE parent = 0";
$parentCateg = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les sous categs 
$query = "SELECT * FROM categories WHERE parent != 0";
$childCateg = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

// récupérer les produits correspondants à la sous categ
if(!empty($categId)){
    // ici on utilise une requête préparée pour éviter les injections SQL
    $query = "SELECT * FROM produits WHERE categorie_id = :categId";
    $stmt = $db->prepare($query);
    $stmt -> execute([':categId' => $categId ]);

}
else{
    // récupérer tous les produits 
    //  ici pas besoin de préparer la requête car on ne fait pas passer de param provenant de l'utilisateur
    $query = "SELECT * FROM produits";
    $stmt = $db->query($query);
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


Database::disconnect();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>


                <?php foreach($parentCateg as $categ){ ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= htmlspecialchars($categ['nom']) ?>
                        </a>
                        <ul class="dropdown-menu">
                        <?php 
                        foreach($childCateg as $subCateg){ 
                            if($subCateg['parent'] == $categ['id']) {
                        ?>
                            <li>
                                <a class="dropdown-item" href="index.php?subCategId=<?=$subCateg['id'] ?>"> <?= htmlspecialchars($subCateg['nom']) ?></a>
                            </li>
                        <?php
                            } 
                        } 
                        ?>
                        </ul>
                    </li>
                <?php } ?>
                </ul>
                <ul class='navbar-nav'>
                    <!-- Admin -->
                <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Back-office</a>
                    </li>

            <?php 
                } 
                if(isset($_SESSION['user_id']) && isset($_SESSION['user_nom'])){  
            ?>
                    <!-- User connecté -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <p>Bonjour <?= $userCo ?></p>
                                <a class="dropdown-item" href="#">Profil</a>
                                <a class="dropdown-item" href="#">Commandes</a>
                                <a class="dropdown-item" href="deconnexion.php">Déconnexion</a>
                            </li>
                        </ul>
                    </li>
            <?php
                }
                else
                { 
            ?>

                       <!-- user non connecté -->
                    <li class="nav-item">
                        <a class="nav-link" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
         <?php
                }
            ?>

                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php"> <i class="bi bi-cart"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
        <?php foreach($products as $product){ ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="img/<?= $product['img']?>"  class="card-img-top" alt="<?= htmlspecialchars($product['nom'])?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['nom'])?></h5>
                        <p class="card-text"><?= htmlspecialchars($product['description'])?></p>
                        <p class="card-text"><?= htmlspecialchars($product['prix'])?></p>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-primary">Voir les détails</a>
                            <a href="#" class="btn btn-success">Ajouter au panier</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>