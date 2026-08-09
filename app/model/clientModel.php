<?php

require_once dirname(__DIR__)."/config/database.php";


function getClient() : array {

    $pdo=connexionDB();

    $sql="SELECT concat(prenom ||' '|| nom , telephone) AS info_client
        FROM client;
    ";

    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
}