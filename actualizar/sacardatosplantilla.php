<?php
// Realizar la solicitud cURL para obtener los datos
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://transfermarket.p.rapidapi.com/clubs/get-squad?id=3368&saison_id=2024&domain=es",
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

// Verificar si hubo un error con la solicitud cURL
if ($err) {
    echo "Error de cURL #:" . $err;
} else {
    // Decodificar la respuesta JSON
    $responseData = json_decode($response, true);

    // Verificar si la respuesta contiene datos
    if ($responseData && isset($responseData['squad']) && count($responseData['squad']) > 0) {
        // Guardar los datos en un archivo JSON
        $folderPath = '../datos';
        $filePath = $folderPath . '/datosplantilla.json';

        // Verificar si la carpeta 'datos' existe, si no, crearla
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true); // Crear la carpeta si no existe
        }

        // Guardar los datos obtenidos en el archivo JSON
        file_put_contents($filePath, json_encode($responseData, JSON_PRETTY_PRINT));

        echo "Datos guardados en " . $filePath;
    } else {
        echo "<p>No se pudo obtener la información de los jugadores o no hay datos disponibles.</p>";
    }
}
?>
