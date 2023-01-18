<?php

use function PHPSTORM_META\sql_injection_subst;

$host = "localhost";
$user = "root";
$password = "";
$bd = "SystemO";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$user,$password);
    
}catch (Exception $ex) {
    echo $ex->getMessage();
    $conn = new mysqli($host, $user, $password);
    $sql = "CREATE DATABASE SystemO";

    if ($conn->query( $sql ) === true ) {
        echo "Base de datos creada";
        $sql_table = "CREATE TABLE `systemo`.`societies` (`ID` INT NOT NULL , `REASON` VARCHAR(225) NOT NULL , `ADDRES` VARCHAR(225) NOT NULL , `NAMES` VARCHAR(225) NOT NULL , `LAST_NAME` VARCHAR(225) NOT NULL , `EMAIL` VARCHAR(225) NOT NULL , `PHONE` INT NOT NULL , UNIQUE `ID` (`ID`)) ENGINE = InnoDB;";

        if ($conn->query( $sql_table ) === true ) {
            echo "Tabla creada";
        }else{
            die("Error al crear tabla: ". $conn->error);
        }

    }else{
        die("Error al crear base de datos: ". $conn->error);
    }
};
?>