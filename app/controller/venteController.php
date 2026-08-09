<?php

require_once dirname(__DIR__)."/model/venteModel.php";
require_once dirname(__DIR__)."/model/produitModel.php";
require_once dirname(__DIR__)."/model/clientModel.php";

function listerVente() : void {

    $allVente = getAllVente();
    $produit=getProduits();
    $clients=getClient() ;
    $getModePay=getModePay();
    $numbVente=nombreVente();
    $totalDue=totalDUE();
    $totalRecue=totalRecue();

 

    require_once dirname(__DIR__)."/view/vente.html.php";
}