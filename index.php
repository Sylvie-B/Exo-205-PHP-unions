<?php

/**
 * Reproduisez les tables présentes dans le fichier image ( via workbench ou phpmyadmin )
 * Ajoutez des donées dans chaque table en vous assurant d'ajouter au moins 1 fois un utilisateur identique dans deux tables.
 * Utilisez UNION pour récupérer les usernames de chaque table, affichez le résultat à l'aide d'un print_r ou d'une boucle.
 * Utilisez UNION ALL pour afficher toutes les données y compris les doublons, affichez le résultat  à l'aide d'une boucle ou d'un print_r.
 * PS: Si vous utilisez un print_r, alors utilisez la balise <pre> pour un résultat plus propre.
 */

$server = 'localhost';
$database = 'exo205';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $exception) {
    echo "data base connexion error : " . $exception->getMessage();
    return null;
}

$display = $conn->prepare("
    SELECT username FROM user
    UNION
    SELECT username FROM admin
    UNION
    SELECT username FROM client
");

$display->execute();

echo "<pre>";
print_r($display->fetchAll());
echo "</pre>";

$dis2 = $conn->prepare("
    SELECT username FROM user
    UNION ALL 
    SELECT username FROM admin
    UNION ALL 
    SELECT username FROM client
");

$dis2->execute();

echo "<pre>";
print_r($dis2->fetchAll());
echo "</pre>";
