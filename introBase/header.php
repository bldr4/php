<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    *, ::after, ::before {
    margin: 0;
    padding: 0;
        }
    .navbar{
        background-color: #333;
        color: white;
        padding: 10px;
        text-align: center;
        display:flex;
        justify-content: space-around;
    }
    .navbar a{
        color:white;
        text-decoration: none;
        padding:15px 20px;
    }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Accueil</a>
        <a href="apropos.php">A propos</a>
    <?php if(!isset($_SESSION)) : ?>
        <a href="inscription.php">Inscription</a>
    <?php  else : ?>
        <a href="deconnexion.php">Deconnexion</a>
    <?php endif; ?>
    </div>
