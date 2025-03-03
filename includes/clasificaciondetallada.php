

<?php
// Definir la ruta de los archivos JSON
$clasificacionFile = 'datos/dataclasi.json'; // Ruta del archivo JSON de clasificación
$iconosFile = 'datos/imgiconos.json'; // Ruta del archivo JSON de iconos

// Comprobar si ambos archivos JSON existen
if (file_exists($clasificacionFile) && file_exists($iconosFile)) {
    // Leer y decodificar el contenido de los archivos JSON
    $clasificacionData = json_decode(file_get_contents($clasificacionFile), true);
    $iconosData = json_decode(file_get_contents($iconosFile), true);

    // Verificar si los datos de ambos archivos se han cargado correctamente
    if ($clasificacionData && $iconosData && isset($clasificacionData['standings']) && isset($iconosData['team'])) {
        echo '<div id="clasificacionLevante">';
       
        echo '<table>';
        echo '<thead><tr><th>#</th><th></th><th>Equipo</th><th>PJ</th><th>Pts</th><th>GF</th><th>GC</th><th>DG</th></tr></thead>';
        echo '<tbody>';
        
        // Mostrar la clasificación completa
        foreach ($clasificacionData['standings'] as $team) {
            // Buscar el escudo del equipo en el archivo imgiconos.json
            $teamImage = '';
            foreach ($iconosData['team'] as $teamData) {
                if ($teamData['equipo'] == $team['team']) {
                    $teamImage = $teamData['imagen']; // Ruta del escudo
                    break;
                }
            }

            // Determinar la clase de color para la celda de la posición
            $positionClass = '';

            if ($team['position'] == 1 || $team['position'] == 2) {
                $positionClass = 'azul'; // Azul para las posiciones 1 y 2
            } elseif ($team['position'] >= 3 && $team['position'] <= 6) {
                $positionClass = 'rojo-claro'; // Rojo claro para las posiciones 3 a 6
            } elseif ($team['position'] >= 19 && $team['position'] <= 22) {
                $positionClass = 'rojo-oscuro'; // Rojo oscuro para las posiciones 19 a 22
            }

            echo '<tr>';
            // Aplicar la clase al número de la posición
            echo '<td class="' . $positionClass . '">' . $team['position'] . '</td>';
            // Mostrar el escudo en la nueva columna
            echo '<td>';
            if ($teamImage) {
                echo '<img src="' . $teamImage . '" alt="Escudo de ' . $team['team'] . '" style="width: 30px; height: 30px;">';
            }
            echo '</td>';
            echo '<td>' . $team['team'] . '</td>';
            echo '<td>' . $team['played'] . '</td>';
            echo '<td>' . $team['points'] . '</td>';
            echo '<td>' . explode(":", $team['goals'])[0] . '</td>'; // Goles a favor
            echo '<td>' . explode(":", $team['goals'])[1] . '</td>'; // Goles en contra
            echo '<td>' . $team['goalDifference'] . '</td>'; // Diferencia de goles
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

    } else {
        echo '<p>Error al cargar los datos del archivo JSON. Asegúrate de que la estructura de ambos archivos JSON sea correcta.</p>';
    }
} else {
    echo '<p>No se encuentran los archivos JSON necesarios.</p>';
}
?>
