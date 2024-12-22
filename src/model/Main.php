<?php

namespace Jeremias\GlosaryDev\model;

use PDO;

abstract class Main{

    private string $host = "";
    private string $pass = "";
    private string $user = "";
    private string $dbname = "";

    public function __construct() {
        $this->host = "localhost";
        $this->pass = "";
        $this->user = "root";
        $this->dbname = "glosarydev";
    }

    protected function conexion(): PDO{   
        try{
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};", $this->user, $this->pass);
            return $pdo;

        }catch(\Throwable $th){
            echo $th;
        }
    }

    protected function guardarDatos(string $tabla, array $campos){

        $consulta = "INSERT INTO $tabla (";

        foreach ($campos as $key => $value) {
            if($key === 0){
                $consulta .= $value["campo_clave"];
                continue;
            }
            $consulta .= ", " . $value["campo_clave"];
        }

        $consulta .= ") VALUES (";

        foreach ($campos as $key => $value) {
            if ($key === 0) {
                $consulta .= $value["campo_marcador"];
                continue;
            }
            $consulta .= ", " . $value["campo_marcador"];
        }

        $consulta .= ");";

        $datos = [];
        foreach ($campos as $key => $value) {
            $datos[$value["campo_marcador"]] = $value["campo_valor"];
        }

        $consulta = $this->conexion()->prepare($consulta);

        $resultado = $consulta->execute($datos);

        return $resultado;
    }

    protected function seleccionarDatos($consulta){

        $resultado = $this->conexion()->query($consulta);

        return $resultado;

    }

}

?>