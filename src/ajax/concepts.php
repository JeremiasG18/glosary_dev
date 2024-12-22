<?php

require_once '../../vendor/autoload.php';

use Jeremias\GlosaryDev\controller\Conceptos;

if (isset($_POST['action'])) {
    
    if ($_POST['action'] === 'saveconcept') {
        
        $concept = new Conceptos();
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $img = isset($_FILES['imagen']) ? $_FILES['imagen'] : [];;
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $id_section = isset($_POST['section']) ? (int) $_POST['section'] : 0;
        $id_theme = isset($_POST['theme']) ? (int) $_POST['theme'] : 0;
        echo $concept->guardarConcepto($title, $description, $img, $url, $id_section, $id_theme);
        
    }

}

?>