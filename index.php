<?php

require_once './vendor/autoload.php';

use Jeremias\GlosaryDev\controller\Conceptos;

$lista_blanca = ["newconcept", "themes", "php"];

include './src/public/templates/header.php';
include './src/public/templates/navbar.php';

if (isset($_GET['view']) && in_array($_GET['view'], $lista_blanca)) {
    $view = $_GET['view'];
    include './src/views/' . $view . '.php';
}else{
    include './src/views/themes.php';
}

include './src/public/templates/footer.php';

?>