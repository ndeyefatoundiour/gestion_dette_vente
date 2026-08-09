<?php

$routes = [
    '/' => [
        'controller' => 'venteController',
        'action' => 'listerVente'
    ],
    '/lister/Vente' => [
         'controller' => 'venteController',
        'action' => 'listerVente'
    ],
    '/lister/Dette'=> [
        'controller'=>'detteController',
        'action'=>'listerDette'
    ]
];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$controller = $routes[$uri]['controller'];

$action = $routes[$uri]['action'];

if (file_exists( dirname(__DIR__). "/controller/$controller.php")) {

require_once dirname(__DIR__). "/controller/$controller.php" ;

    if (function_exists($action)) {

        $action();
    }
    
} else {

    http_response_code(404);
    echo "Not found";
}
