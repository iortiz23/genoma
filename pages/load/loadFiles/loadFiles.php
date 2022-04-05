<?php
var_dump($_REQUEST);
$archivo = $_FILES['inputFile'];
$newName = pathinfo($archivo["name"], PATHINFO_FILENAME) .'-'. uniqid() . '.' . pathinfo($archivo["name"], PATHINFO_EXTENSION);
echo $newName;
$resultado = move_uploaded_file($archivo["tmp_name"], $newName);
if ($resultado) {
    echo "Subido con éxito";
} else {
    echo "Error al subir archivo";
}