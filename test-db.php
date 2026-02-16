<?php
$link = mysqli_connect('db.ardjea.dreamhosters.com', 'jean_ardaillou', '201657lachaiseVide1*', 'foyer_wp');

if (!$link) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}
echo 'Connexion réussie à la base de données !';
mysqli_close($link);
?>