<?php
// Ruta del archivo JSON (se mantiene la misma ruta de la carpeta 'datos')
$filePath = __DIR__ . "/../datos/matches.json"; // Apuntamos a 'datos' en el directorio superior

// Verificar si el archivo existe
if (!file_exists($filePath)) {
    die("Error: El archivo JSON no existe en la ruta: " . realpath($filePath));
}

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($filePath);
$matches = json_decode($jsonData, true);

// Verificar si el JSON es válido
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error: No se pudo decodificar el JSON.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidos del Levante UD</title>
    
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4"> Temporada <?= $matches['seasonID'] ?? 'Desconocida' ?></h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                   
                    <th>Local</th>
                    <th>Resultado</th>
                    <th>Visitante</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matches['playClubMatches'] as $match): ?>
                    <tr>
                        <td><?= !empty($match['fullMatchDate']) ? $match['fullMatchDate'] : 'Por definir' ?></td>

                        <!-- Verificar si la hora es 00:00, si es así poner "Por definir" -->
                        <td>
                            <?php 
                            $matchTime = !empty($match['matchTime']) ? substr($match['matchTime'], 0, 5) : 'Por definir'; // Extraemos los primeros 5 caracteres
                            echo $matchTime === '00:00' ? 'Por definir' : $matchTime; // Si es 00:00, mostrar 'Por definir'
                            ?>
                        </td>

                       
                        <td>
                            <img src="<?= !empty($match['homeClubImage']) ? $match['homeClubImage'] : 'default_image.png' ?>" alt="Home Logo" width="30">
                            <?= !empty($match['homeClubName']) ? $match['homeClubName'] : 'Por definir' ?>
                        </td>
                        <td class="text-center fw-bold"><?= !empty($match['result']) ? $match['result'] : 'Por definir' ?></td>
                        <td>
                            <img src="<?= !empty($match['awayClubImage']) ? $match['awayClubImage'] : 'default_image.png' ?>" alt="Away Logo" width="30">
                            <?= !empty($match['awayClubName']) ? $match['awayClubName'] : 'Por definir' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>