<?php

use Jeremias\GlosaryDev\controller\Conceptos;

$concepts = new Conceptos;

$themes = $concepts->mostrarTemas();

?>

<section id="concepts">
    <h1>Themes</h1>
    <?php foreach($themes as $theme){ ?>

        <div class="concepts">
            <a href="?view=<?php echo $theme['url'] ?>&id_theme=<?php echo $theme['id'] ?>"><?php echo $theme['description']; ?></a>
        </div>
    <?php } ?>
</section>