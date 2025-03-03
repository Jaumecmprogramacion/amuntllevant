<?php

// URL de la API
$url = "https://magicloops.dev/api/loop/f641b843-259c-450e-8964-a7760aabd965/run";

// Datos a enviar en la solicitud
$data = [
    "input" => "I love Magic Loops!"
];

// Configuración de la solicitud cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Verificar si la solicitud fue exitosa
if ($httpCode == 200) {
    // Crear la carpeta "datos" si no existe (subiendo un nivel con "../")
    if (!is_dir("../datos")) {
        mkdir("../datos", 0777, true);
    }
    
    // Guardar la respuesta en un archivo JSON dentro de la carpeta "datos"
    file_put_contents("../datos/lesionados.json", $response);
    
    echo "Datos guardados exitosamente en ../datos/lesionados.json";
} else {
    echo "Error en la solicitud: Código HTTP $httpCode";
}

?>
