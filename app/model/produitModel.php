<?php

require_once dirname(__DIR__)."/config/database.php";

function getProduits() : array {

    $pdo=connexionDB();

    $sql="SELECT libelle
        FROM produit;
    ";

    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
}