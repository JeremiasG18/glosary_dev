<?php

declare(strict_types=1);

namespace Jeremias\GlosaryDev\controller;

use Jeremias\GlosaryDev\model\Main;

class Conceptos extends Main{

    public function guardarConcepto(string $title, string $description, array $img, string $url, int $id_section, int $id_theme) {

        if ($title == "" || $description == "" || $id_section == 0 || $id_theme == 0) {
            return json_encode([
                "text" => "Error: Required fields are empty, please fill in the fields"
            ]);
        }

        if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ¿?()]{1,100}$/", $title)) {
            return json_encode([
                "text" => "Error: You have not respected the regular expression in the title field: a-zA-ZñÑáéíóúÁÉÍÓÚ ¿?()"
            ]);
        }

        if (!preg_match("/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ¿?(),.-]{1,1000}$/", $description)) {
            return json_encode([
                "text" => "Error: You have not respected the regular expression in the description field: a-zA-ZñÑáéíóúÁÉÍÓÚ ¿?(),.-"
            ]);
        }

        $respuesta = "";
        $directorio = "../public/assets/uploads/";
        $tipo_archivo_permitidos = ['image/png', 'image/jpeg'];
        $tamaño_maximo = 5 * 1024 * 1024;
        $rutas = [];

        for ($i=0; $i <= (count($img['name'])) - 1; $i++) { 

            if ($img['error'][$i] != 0) {
                $respuesta = "Error al subir el archivo";
                break;
            }

            if (!in_array(mime_content_type($img['tmp_name'][$i]), $tipo_archivo_permitidos)) {
                $respuesta = "Error: El tipo de archivo no es el solicitado";
                break;
            }

            if ($img['size'][$i] > $tamaño_maximo) {
                $respuesta = "Error: El tamaño del archivo es muy grande";
                break;
            }

            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }

            $rutaFinal = $directorio . uniqid('file_', true) . '_' . str_replace(' ', '_', basename($img['name'][$i]));

            if (!move_uploaded_file($img['tmp_name'][$i], $rutaFinal)) {
                $respuesta = "Error: al guardar el archivo";
                break;
            }else{
                $respuesta = "Se subio el archivo exitosamente";
                $rutas[] = $rutaFinal;
            }
        }
        
        if ($respuesta != "Se subio el archivo exitosamente") {
            return json_encode([
                "text" => $respuesta
            ]);
        }

        $img = json_encode($rutas);

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return json_encode([
                "text" => "Error: The url is not valid"
            ]);
        }

        $respuesta = $this->seleccionarDatos("SELECT id FROM section WHERE id = $id_section")->fetch();

        if (count($respuesta) <= 0) {
            return json_encode([
                "text" => "Error: The section you selected does not exist"
            ]);
        }

        $respuesta = $this->seleccionarDatos("SELECT id FROM theme WHERE id = $id_theme")->fetch();

        if (count($respuesta) <= 0){
            return json_encode([
                "text" => "Error: The theme you selected does not exist"
            ]);
        }

        $datos = [
            [
                "campo_clave" => "title",
                "campo_valor" => $title,
                "campo_marcador" => ":title"
            ],
            [
                "campo_clave" => "description",
                "campo_valor" => $description,
                "campo_marcador" => ":description"
            ],
            [
                "campo_clave" => "img",
                "campo_valor" => $img,
                "campo_marcador" => ":img"
            ],
            [
                "campo_clave" => "url",
                "campo_valor" => $url,
                "campo_marcador" => ":url"
            ],
            [
                "campo_clave" => "id_section",
                "campo_valor" => $id_section,
                "campo_marcador" => ":id_section"
            ],
            [
                "campo_clave" => "id_theme",
                "campo_valor" => $id_theme,
                "campo_marcador" => ":id_theme"
            ]
        ];

        $respuesta = $this->guardarDatos("glosary", $datos);

        if ($respuesta) {
            return json_encode([
                "text" => "Success: The concept has been saved successfully",
                "url" => "http://localhost/glosary_dev/?view=concepts"
            ]);
        }else{
            return json_encode([
                "text" => "Error: The concept could not be saved, please try again"
            ]);
        }

    }

    public function mostrarConceptos(int $id) {
        
        $consulta = "SELECT * FROM glosary WHERE id_theme = $id";

        $respuesta = $this->seleccionarDatos($consulta)->fetchAll();

        if (count($respuesta) >= 1) {
            return $respuesta;
        }

    }

    public function mostrarSecciones(){
        
        $consulta = "SELECT * FROM section";

        return $this->seleccionarDatos($consulta)->fetchAll();

    }

    public function mostrarTemas() {

        $consulta = "SELECT * FROM theme";

        return $this->seleccionarDatos($consulta)->fetchAll();
    }

}

?>