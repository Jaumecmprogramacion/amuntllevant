<?php

// URL de la API
$url = "https://magicloops.dev/api/loop/0ac35dc8-2601-4971-9374-e3937f429468/run";

// Carpeta donde se guardará el archivo
$folder = "../datos";
$filename = "dataclasi.json";
$filePath = "$folder/$filename";

// Crear la carpeta si no existe
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Obtener los datos de la API
$jsonData = file_get_contents($url);

// Verificar si la respuesta es válida
if ($jsonData === false) {
    die("Error al obtener los datos de la API");
}

// Guardar el JSON en el archivo
if (file_put_contents($filePath, $jsonData) !== false) {
    echo "Archivo guardado correctamente en $filePath";
} else {
    echo "Error al guardar el archivo";
}

?>
