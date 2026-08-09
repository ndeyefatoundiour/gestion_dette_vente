<?php

require_once dirname(__DIR__)."/model/detteModel.php";

function listerDette() : void {

   $dettes=getDette();
   $totalRecouvrement=totalRecue();
   $titalDue=totalDUE();
   $nombreDette=nombreDette();
    
    require_once dirname(__DIR__)."/view/dette.html.php";

}