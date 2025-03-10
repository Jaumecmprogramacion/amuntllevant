<?php
// Ruta del archivo JSON
$filePath = __DIR__ . "/../datos/efemerides.json"; 


// Verificar si el archivo existe
if (!file_exists($filePath)) {
    die("Error: El archivo JSON no existe en la ruta: " . realpath($filePath));
}

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($filePath);

// Decodificar el JSON en un array
$efemerides = json_decode($jsonData, true);

// Verificar si el JSON es válido
if ($efemerides === null) {
    die("Error: No se pudo decodificar el JSON. " . json_last_error_msg());
}

// Array de los meses en inglés a español
$mesesEnInglesAEspanol = [
    "January" => "enero", 
    "February" => "febrero", 
    "March" => "marzo", 
    "April" => "abril", 
    "May" => "mayo", 
    "June" => "junio", 
    "July" => "julio", 
    "August" => "agosto", 
    "September" => "septiembre", 
    "October" => "octubre", 
    "November" => "noviembre", 
    "December" => "diciembre"
];

// Obtener el mes actual en inglés y convertirlo a español
$currentMonthInEnglish = date('F'); // 'F' devuelve el nombre completo del mes en inglés, como "March"
$currentMonth = $mesesEnInglesAEspanol[$currentMonthInEnglish]; // Convertir el mes a español

// Verificar si el mes actual existe en el archivo JSON
if (!isset($efemerides[$currentMonth])) {
    die("No se encontraron efemérides para el mes de " . ucfirst($currentMonth));
}

$monthlyEfemerides = $efemerides[$currentMonth];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efemérides del Levante UD - <?= ucfirst($currentMonth) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Efemérides del Levante UD - <?= ucfirst($currentMonth) ?></h1>

    <div class="list-group">
        <?php foreach ($monthlyEfemerides as $efemeride): ?>
            <div class="list-group-item">
                <strong><?= $efemeride['fecha'] ?></strong>: <?= $efemeride['evento'] ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
