<?php

use Jeremias\GlosaryDev\controller\Conceptos;

$concepts = new Conceptos;

$concepts = $concepts->mostrarConceptos($_GET['id_theme']);

?>

<section id="concepts">
    <h1>Concepts</h1>
    <dl>
        <?php foreach($concepts as $concept){ ?>
            <div class="concepts">
                <dt><?php echo $concept['title']; ?></dt>
                <dd>
                    <div class="description">
                        <?php echo $concept['description']; ?>
                    </div>
                    <img src="../uploads/Captura_de_pantalla_(773).png">
                    <?php 
                        $img = json_decode($concept['img']);
                        if (count($imagen) > 0) {
                            foreach($img as $imagen){
                            ?>
                        <?php
                            }
                        }
                        ?>
                    <a href="<?php echo $concept['url']; ?>" target="_blank">Mas acerca de <b><?php echo $concept['title']; ?></b></a>
                </dd>
            </div>
        <?php } ?>
    </dl>
</section>