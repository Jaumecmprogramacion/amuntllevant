<?php
// La URL de la API
$url = "https://magicloops.dev/api/loop/7ee27152-e9a0-4528-b396-c91c65f76d19/run";

// Los datos que deseas enviar en la solicitud
$data = array("input" => "I love Magic Loops!");

// Inicializa cURL
$ch = curl_init($url);

// Configura la solicitud cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json"
));

// Ejecuta la solicitud y obtiene la respuesta
$response = curl_exec($ch);

// Verifica si hubo errores en la solicitud
if ($response === false) {
    echo "Error en cURL: " . curl_error($ch);
    exit; // Detenemos el script si hay error
}

// Cierra la sesión cURL
curl_close($ch);

// Decodificar la respuesta JSON en un array de PHP
$response_data = json_decode($response, true);

// Verificamos si la respuesta es válida
if ($response_data === null) {
    echo "Error al decodificar el JSON.";
    exit;
}

// Ruta de la carpeta donde guardar el archivo
$directory = '../datos/';

// Comprobamos si la carpeta 'datos' existe, si no, la creamos
if (!is_dir($directory)) {
    mkdir($directory, 0777, true); // 0777 da permisos completos, true permite crear subcarpetas si es necesario
}

// Nombre del archivo JSON donde guardar los datos
$file_name = $directory . 'datos_equipo.json';

// Convertir el array PHP de vuelta a JSON
$json_to_save = json_encode($response_data, JSON_PRETTY_PRINT);

// Guardar el JSON en el archivo
if (file_put_contents($file_name, $json_to_save)) {
    echo "Los datos se han guardado correctamente en el archivo '$file_name'.";
} else {
    echo "Hubo un error al guardar los datos.";
}
?>
