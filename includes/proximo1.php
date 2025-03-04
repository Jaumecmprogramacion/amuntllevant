

<?php
// Ruta del archivo JSON
$filePath = __DIR__ . "/../datos/matches.json"; 

// Verificar si el archivo existe
if (!file_exists($filePath)) {
    die("<p class='error'>Error: El archivo JSON no existe en la ruta especificada.</p>");
}

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($filePath);
$matches = json_decode($jsonData, true);

// Verificar si el JSON es válido
if (json_last_error() !== JSON_ERROR_NONE) {
    die("<p class='error'>Error: No se pudo decodificar el JSON.</p>");
}

// Obtener la fecha actual en formato timestamp
$currentTimestamp = time();

// Variable para almacenar el partido más cercano
$nextMatch = null;

// Buscar el partido más próximo
foreach ($matches['playClubMatches'] as $match) {
    if ($match['timestamp'] > $currentTimestamp) {
        if ($nextMatch === null || $match['timestamp'] < $nextMatch['timestamp']) {
            $nextMatch = $match;
        }
    }
}

// Función para cargar lesionados
function cargarLesionados($rutaJson) {
    if (file_exists($rutaJson)) {
        return file_get_contents($rutaJson);
    }
    return '';
}

$lesionados = cargarLesionados(__DIR__ . '/../datos/lesionados.json');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximo Partido del Levante UD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .lesionados-box {
            background-color: #fff3cd;
            padding: 15px;
            border-left: 5px solid #ff0000;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        /* Nueva clase para los iconos */
        .iconos-lesionados {
            display: flex;
            align-items: center;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .tarjeta-roja {
            width: 20px;
            height: 30px;
            background-color: red;
            margin-left: 8px;
            border-radius: 3px;
            display: inline-block;
        }

        .match-box {
            padding: 15px;
            border-radius: 10px;
        }
        .teams {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
        }
        .team {
            text-align: center;
        }
        .team img {
            width: 50px;
            height: auto;
            margin-bottom: 10px;
        }
        .match-info {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    
    <!-- Sección de Lesionados -->
    <div class="lesionados-box">
        <div class="iconos-lesionados">
            🩺 <span class="tarjeta-roja"></span>
        </div>
        <div class="contenido-lesionados">
            <?php if (!empty($lesionados)): ?>
                <p><?= nl2br(htmlspecialchars($lesionados)) ?></p>
            <?php else: ?>
                <p>No hay información sobre lesionados en este momento.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sección del Próximo Partido -->
    <div class="match-box">
        

        <?php if ($nextMatch): ?>
            <div class="match-info">
                <p><strong>Fecha:</strong> <?= $nextMatch['fullMatchDate'] ?? 'Por definir' ?></p>
                <p><strong>Hora:</strong> <?= $nextMatch['matchTime'] !== '00:00:00' ? substr($nextMatch['matchTime'], 0, 5) : 'Por definir' ?></p>
            </div>

            <div class="teams">
                <div class="team">
                    <img src="<?= $nextMatch['homeClubImage'] ?? 'default_image.png' ?>" alt="Local">
                    <p><?= $nextMatch['homeClubName'] ?? 'Por definir' ?></p>
                </div>

                <h3>VS</h3>

                <div class="team">
                    <img src="<?= $nextMatch['awayClubImage'] ?? 'default_image.png' ?>" alt="Visitante">
                    <p><?= $nextMatch['awayClubName'] ?? 'Por definir' ?></p>
                </div>
            </div>
        <?php else: ?>
            <p>No hay próximos partidos programados.</p>
        <?php endif; ?>
    </div>


<style>
    .hero__entry-text-inner {
        max-height: 80vh;
        overflow-y: auto;
    }

    .teams {
        display: flex;
        justify-content: space-between;
    }

    .team {
        text-align: center;
    }

    .team img {
        width: 50px;
        height: auto;
        margin-bottom: 10px;
    }

    .post-inline {
        margin-bottom: 25px;
        padding: 15px;
        background-color: #f4f4f4;
        border-radius: 5px;
    }

    .post-inline-time {
        font-size: 16px;
        color: #333;
        font-weight: bold;
    }
</style>

</body>
</html>
