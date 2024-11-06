<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class='container mt-5'>
        <h2>Inscrivez-vous</h2>
        <form action="inscriptionREQ.php" method="POST">
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger" role='alert'>
                    <?= $_GET['error'] ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="nom" class="form-label">
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
            </div>
        
            <div class="mb-3">
                <label for="mail" class="form-label">
                <input type="text" class="form-control" id="mail" name="mail" placeholder="votre email">
            </div>
        
            <div class="mb-3">
                <label for="mdp" class="form-label">
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="votre mot de passe">
            </div>
        
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        
        </form>
    </div>
</body>
</html>