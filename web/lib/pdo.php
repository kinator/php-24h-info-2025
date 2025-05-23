<?php
try {
    // Autoloader
    require_once(dirname(__FILE__) . '/../vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__) . '/../');
    $dotenv->load();

    // Récupération des informations présentes dans le fichier de conf .env
    $db_host = $_ENV['database__connection__host'];
    $db_port = 5432;
    $db_username = $_ENV['database__connection__user'];
    $db_password = $_ENV['database__connection__password'];

    if (
        empty($db_host)
        || empty($db_username)
        || empty($db_password)
    ) {
        $_SESSION['mesgs']['errors'][] = 'ERREUR Configuration: les informations n\'ont pas pu être chargées.';
    }

    // ouverture de la connexion
    $dsn = "pgsql:host=$db_host;port=$db_port";
    $db_options = array();

    try {
        return new PDO($dsn, $db_username, $db_password, $db_options);
    } catch (PDOException $e) {
        $db = null;
        $_SESSION['mesgs']['errors'][] = 'ERREUR Base de données: ' . $e->getMessage();
    }
} catch (Exception $e) {
    echo 'ERREUR: ' . $e->getMessage();
    return null;
}
