<?php
// URL de la API donde obtendremos los iconos
$apiUrl = 'https://magicloops.dev/api/loop/0415acbb-8086-4481-966c-593093508e59/run';

// Datos que se enviarán en el cuerpo de la solicitud POST
$data = [
    'input' => 'I love Magic Loops!'
];

// Iniciar una sesión cURL
$ch = curl_init($apiUrl);

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Obtener la respuesta como string
curl_setopt($ch, CURLOPT_POST, true); // Indicar que es una solicitud POST
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Los datos que se enviarán
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json' // Tipo de contenido
]);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Comprobar si ocurrió algún error
if ($response === false) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// Cerrar la sesión cURL
curl_close($ch);

// Decodificar la respuesta JSON
$responseData = json_decode($response, true);

// Verificar si la respuesta contiene los datos esperados (por ejemplo, los iconos)
if (isset($responseData['icons'])) {
    // Crear un array para almacenar los iconos
    $iconos = [];

    // Recorrer los iconos y almacenarlos en el array
    foreach ($responseData['icons'] as $icon) {
        // Asegúrate de que cada elemento 'icon' tenga los datos necesarios, por ejemplo 'name' y 'imageUrl'
        if (isset($icon['name']) && isset($icon['imageUrl'])) {
            $iconos[] = [
                'name' => $icon['name'], // Nombre del equipo
                'imageUrl' => $icon['imageUrl'] // URL de la imagen
            ];
        }
    }

    // Crear un array con la última actualización y los iconos
    $dataToSave = [
        'lastUpdate' => date('Y-m-d H:i:s'),
        'icons' => $iconos
    ];

    // Crear el contenido JSON con los iconos
    $jsonData = json_encode($dataToSave, JSON_PRETTY_PRINT);

    // Ruta al archivo donde se guardará el JSON
    $filePath = '../datos/imgiconos.json';

    // Crear el archivo y escribir los datos JSON
    if (file_put_contents($filePath, $jsonData)) {
        echo "Los iconos se han guardado correctamente en el archivo: $filePath";
    } else {
        echo "Hubo un error al guardar los iconos en el archivo.";
    }
} else {
    echo "No se encontraron iconos en la respuesta de la API.";
}
?>
