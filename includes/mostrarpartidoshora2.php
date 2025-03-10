<?php
// Ruta del archivo JSON
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

// Filtrado de partidos basado en la opción seleccionada
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'todos'; // Valor por defecto 'todos'
$filteredMatches = [];

foreach ($matches['playClubMatches'] as $match) {
    $isHome = ($match['homeClubName'] ?? '') === 'Levante UD';
    $result = $match['result'] ?? '';
    $goalsHome = isset($match['resultObject']['goalsHome']) ? (int)$match['resultObject']['goalsHome'] : 0;
    $goalsAway = isset($match['resultObject']['goalsAway']) ? (int)$match['resultObject']['goalsAway'] : 0;

    // Filtrado por casa, fuera, ganados, empatados, perdidos, etc.
    if ($filter === 'casa' && $isHome) {
        $filteredMatches[] = $match;
    } elseif ($filter === 'fuera' && !$isHome) {
        $filteredMatches[] = $match;
    } elseif ($filter === 'ganados' && !empty($result) && $result !== '-:-' && (($isHome && $goalsHome > $goalsAway) || (!$isHome && $goalsAway > $goalsHome))) {
        $filteredMatches[] = $match;
    } elseif ($filter === 'empats' && !empty($result) && $result !== '-:-' && $goalsHome == $goalsAway) {
        $filteredMatches[] = $match;
    } elseif ($filter === 'perdidos' && !empty($result) && $result !== '-:-' && (($isHome && $goalsHome < $goalsAway) || (!$isHome && $goalsAway < $goalsHome))) {
        $filteredMatches[] = $match;
    } elseif ($filter === 'todos') {
        $filteredMatches[] = $match;
    } elseif ($filter === 'jugados' && !empty($result) && $result !== '-:-') {
        $filteredMatches[] = $match;
    } elseif ($filter === 'por_jugar' && $result === '-:-') {
        $filteredMatches[] = $match;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partidos del Levante UD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4"> Temporada <?= $matches['seasonID'] ?? 'Desconocida' ?></h1>
    
    <!-- Filtros -->
    <div class="text-center mb-4">
        <a href="?filter=todos" class="btn btn-info">Todos</a> <!-- Botón Todos ahora es el primero -->
        <a href="?filter=casa" class="btn btn-primary">Casa</a>
        <a href="?filter=fuera" class="btn btn-secondary">Fuera</a>
        <a href="?filter=ganados" class="btn btn-success">Ganados</a>
        <a href="?filter=empats" class="btn btn-warning">Empatados</a>
        <a href="?filter=perdidos" class="btn btn-danger">Perdidos</a>
        <a href="?filter=jugados" class="btn btn-dark">Jugados</a>
        <a href="?filter=por_jugar" class="btn btn-light">Por Jugar</a>
    </div>

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
                <?php foreach ($filteredMatches as $match): ?>
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
