<?php
// Mostrar todos los errores para depuración (solo para desarrollo)
error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Ruta al archivo JSON (ruta absoluta)
$filePath = $_SERVER['DOCUMENT_ROOT'] . '/TrabajosProyectos/levanteinfo/datos/datosplantilla.json';

// Verificar si el archivo existe
if (file_exists($filePath)) {
    // Cargar el contenido del archivo JSON
    $responseData = json_decode(file_get_contents($filePath), true);

    if ($responseData && isset($responseData['squad']) && count($responseData['squad']) > 0) {
        
        function obtenerRankingPosicion($position) {
            switch ($position) {
                case 'Portero': return 1;
                case 'Lateral derecho':
                case 'Lateral izquierdo': return 2;
                case 'Defensa central': return 3;
                case 'Centro del campo':
                case 'Centro defensivo': return 4;
                case 'Extremo izquierdo':
                case 'Extremo derecho': return 5;
                case 'Delantero centro': return 6;
                default: return 7;
            }
        }

        $jugadores = $responseData['squad'];
        $posiciones = [];

        foreach ($jugadores as $jugador) {
            $pos = '';
            if (isset($jugador['positions']) && is_array($jugador['positions'])) {
                foreach ($jugador['positions'] as $posInfo) {
                    if (isset($posInfo['name'])) {
                        $pos = $posInfo['name'];
                        break;
                    }
                }
            }

            $posiciones[] = [
                'posicion' => $pos,
                'ranking' => obtenerRankingPosicion($pos),
                'jugador' => $jugador
            ];
        }

        // Ordenar los jugadores por el ranking
        usort($posiciones, function($a, $b) {
            return $a['ranking'] - $b['ranking'];
        });
    } else {
        echo "<p>No se pudo obtener la información de los jugadores o no hay datos disponibles.</p>";
    }
} else {
    echo "<p>No se pudo encontrar el archivo de datos. Verifica que el archivo <strong>datosplantilla.json</strong> esté en la ubicación correcta.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de los Jugadores</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .player-card {
            display: flex;
            align-items: center;
            
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            
        }
        .player-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .column {
            flex-grow: 1;
        }
        .more-info {
            display: none;
        }
        .toggle-btn, .hide-btn {
            margin-top: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .hide-btn {
            background-color: #dc3545;
            display: none;
        }
    </style>
</head>
<body>

    <h1>Entrenador: Julian Calero</h1>

    <?php
    if (isset($posiciones)) {
        // Mostrar los jugadores ordenados por posición
        foreach ($posiciones as $item) {
            $jugador = $item['jugador'];
            $name = $jugador['name'];
            $age = $jugador['age'];
            $height = $jugador['height'];
            $foot = $jugador['foot'];
            $nationality = isset($jugador['nationalities']) && is_array($jugador['nationalities']) ? implode(', ', array_map(function($n) { return $n['name']; }, $jugador['nationalities'])) : 'Desconocida';
            $positions = $item['posicion'];
            $image = isset($jugador['image']) ? $jugador['image'] : 'default-image.jpg';
            $shirtNumber = $jugador['shirtNumber'];

            // Verificación y formato correcto de la fecha de contrato
            if (isset($jugador['contractUntil']) && !empty($jugador['contractUntil'])) {
                $timestamp = $jugador['contractUntil'];
                if ($timestamp > 9999999999) { // Si el timestamp es en milisegundos, lo convertimos
                    $timestamp = $timestamp / 1000;
                }
                $contractUntil = date("d/m/Y", $timestamp);
            } else {
                $contractUntil = "No disponible";
            }

            $marketValue = isset($jugador['marketValue']['value']) ? $jugador['marketValue']['value'] . ' ' . $jugador['marketValue']['currency'] : 'No disponible';
            ?>

            <div class="player-card">
                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                <div class="column">
                    <h1><?php echo $name; ?></h1>
                    <p>Posición: <?php echo $positions; ?></p>
                    <button class="toggle-btn" onclick="toggleDetails('<?php echo $jugador['id']; ?>')">Ver más</button>
                    <button class="hide-btn" id="hide-btn-<?php echo $jugador['id']; ?>" onclick="hideDetails('<?php echo $jugador['id']; ?>')">Ocultar</button>
                    <div id="details-<?php echo $jugador['id']; ?>" class="more-info">
                        <p>Edad: <?php echo $age; ?> años</p>
                        <p>Fecha de Nacimiento: <?php echo date("d/m/Y", $jugador['dateOfBirth']); ?></p>
                        <p>Nacionalidad: <?php echo $nationality; ?></p>
                        <p>Altura: <?php echo $height; ?> cm</p>
                        <p>Pierna: <?php echo $foot; ?></p>
                        <p>Número de camiseta: <?php echo $shirtNumber; ?></p>
                        <p>Contrato hasta: <?php echo $contractUntil; ?></p>
                        <p>Valor de mercado: <?php echo $marketValue; ?></p>
                    </div>
                </div>
            </div>

        <?php }
    } ?>

    <script>
        function toggleDetails(id) {
            var details = document.getElementById('details-' + id);
            var hideButton = document.getElementById('hide-btn-' + id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
                hideButton.style.display = "inline-block";  // Mostrar el botón "Ocultar"
            } else {
                details.style.display = "none";
                hideButton.style.display = "none";  // Ocultar el botón "Ocultar"
            }
        }

        function hideDetails(id) {
            var details = document.getElementById('details-' + id);
            var hideButton = document.getElementById('hide-btn-' + id);
            details.style.display = "none";
            hideButton.style.display = "none";  // Ocultar el botón "Ocultar" nuevamente
        }
    </script>

</body>
</html>
