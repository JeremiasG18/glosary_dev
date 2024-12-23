<?php

use Jeremias\GlosaryDev\controller\Conceptos;

$concepts = new Conceptos;

$themes = $concepts->mostrarTemas();

?>

<section id="themes">
    <h1>Themes</h1>
    <div class="themes">
        <?php foreach($themes as $theme){ ?>

            <div class="theme">
                <a href="?view=concepts&id_theme=<?php echo $theme['id'] ?>"><?php echo $theme['description']; ?></a>
            </div>
        <?php } ?>
    </div>
</section>