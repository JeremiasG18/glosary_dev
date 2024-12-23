<?php

use Jeremias\GlosaryDev\controller\Conceptos;

$concepts = new Conceptos;

$concepts = $concepts->mostrarConceptos($_GET['id_theme']);

?>

<div class="box_none">
    <button class="exit">X</button>
    <div class="box_img">
        <img class="imagen" src="./src/public/assets/uploads/file_6769925ae81ab7.25430490_Captura_de_pantalla_(779).png">
    </div>
</div>

<section id="concepts">
    <h1>Concepts</h1>
    <dl>
        <?php

            if ($concepts !== null) {

                foreach($concepts as $concept){ ?>
                <div class="concepts">
                    <dt><?php echo $concept['title']; ?></dt>
                    <dd>
                        <div class="description">
                            <?php echo $concept['description']; ?>
                        </div>
                        <div class="images">
                            <?php 
                                $img = json_decode($concept['img']);
                                if (count($img) > 0) {
                                    foreach($img as $imagen){
                            ?>
                                    <img class="img" src="./src<?php echo str_replace("..", "", $imagen) ?>">
                            <?php
                                    }
                                }
                            ?>
                        </div>
                        <a href="<?php echo $concept['url']; ?>" target="_blank">Mas acerca de <b><?php echo $concept['title']; ?></b></a>
                    </dd>
                </div>
        <?php 
                }
            }else{
                echo "No existen conceptos aún";
            }
         ?>
    </dl>
</section>