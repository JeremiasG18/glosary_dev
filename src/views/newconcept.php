<?php

use Jeremias\GlosaryDev\controller\Conceptos;

$concepto = new Conceptos;
$themes = $concepto->mostrarTemas();

$sections = $concepto->mostrarSecciones();

?>

<section id="newconcepts">
    <h1>New Concept</h1>
    <form action="./src/ajax/concepts.php" method="post" class="form" enctype="multipart/form-data">
        <input type="hidden" name="action" value="saveconcept">
        <label for="title">Title:</label>
        <input class="input" type="text" name="title" placeholder="Enter a title..." id="title">
        <label for="description">Description:</label>
        <textarea class="input" name="description" id="description" placeholder="Enter a description..."></textarea>
        <label for="imagen">Image/s:</label>
        <input type="file" name="imagen[]" id="imagen" accept="image/jpeg, image/png" multiple>
        <label for="url">Page URL:</label>
        <input class="input" type="text" name="url" placeholder="Enter a url..." id="url">
        <label for="section">Section:</label>
        <select name="section" id="section">
            <option value="0" disabled selected>Select a section</option>
            <?php
                foreach ($sections as $section) {
            ?>
            <option value="<?php echo $section["id"] ?>"><?php echo $section["section"]; ?></option>
            <?php
                }
            ?>
        </select>
        <label for="theme">Theme:</label>
        <select name="theme" id="theme">
            <option value="0" disabled selected>Select an theme</option>
            <?php
                foreach ($themes as $theme) {
            ?>
            <option value="<?php echo $theme["id"] ;?>"><?php echo $theme["description"];?></option>
            <?php
                }
            ?>
        </select>
        <input type="submit" value="Save">
    </form>
</section>