<?php include('header.php') ?>

<!-- Quand on traite une image sur un formulaire il faut rajouter l'attribut enctype sur le form  -->
<form action="inscriptionREQ.php" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom</label>
    <input type="text" id='nom' name='nom'><br>

    <label for="prenom">Prénom</label>
    <input type="text" id='prenom' name='prenom'><br>

    <label for="image">Image de profil</label>
    <input type="file" id='image' name='image'><br>

    <button type='submit'>Inscription </button>

</form>

<?php include('footer.php') ?>