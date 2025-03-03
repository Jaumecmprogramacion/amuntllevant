<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://transfermarket.p.rapidapi.com/matches/list-by-club?id=3368&domain=es",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: transfermarket.p.rapidapi.com",
        "x-rapidapi-key: bbfe6e3f32msh08adf6704935149p1075f8jsn0fa22b3adf89"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    die("Error en cURL: " . $err);
} else {
    $folder = "../datos"; // Ruta de la carpeta "datos"
    $filePath = $folder . '/matches.json'; // Ruta del archivo JSON

    // Verificar si la carpeta existe, si no, crearla
    if (!is_dir($folder)) {
        if (!mkdir($folder, 0777, true)) {
            die("Error: No se pudo crear la carpeta 'datos'");
        }
    }

    // Verificar si la respuesta es un JSON válido
    $jsonData = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die("Error: La respuesta de la API no es un JSON válido.");
    }

    // Guardar el JSON con formato legible
    if (file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
        echo "Datos guardados correctamente en: " . realpath($filePath);
    } else {
        echo "Error: No se pudo escribir en el archivo JSON.";
    }
}
?>
