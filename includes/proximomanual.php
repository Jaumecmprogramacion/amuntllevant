<div class="hero__entry-text-inner">
    <?php
    // Definición de las rutas de los iconos de los equipos de manera manual
    $teamIcons = [
        'Levante UD' => 'images/escudos/levante.png',
        'Sporting de Gijón' => 'images/escudos/sporting.png',
        'CD Mirandés' => 'images/escudos/mirandes.png',
        'CD Eldense' => 'images/escudos/eldense.png',
        'FC Cartagena' => 'images/escudos/cartagena.png',
        'SD Huesca' => 'images/escudos/Huesca.png',
        'CD Castellón' => 'images/escudos/castellon.png',
        'UD Almería' => 'images/escudos/almeria.png',
        'R. Racing Clubn' => 'images/escudos/racing_ferrol.png', // Asegúrate de que esta ruta sea correcta
        'Córdoba CF' => 'images/escudos/cordoba.png',
        'Real Zaragoza' => 'images/escudos/zaragoza.png',
        'Real Oviedo' => 'images/escudos/realoviedo.png',
        'Elche CF' => 'images/escudos/Elche.png',
        'Albacete BP' => 'images/escudos/albacete.png',
        'Burgos CF' => 'images/escudos/burgos.png',
        'SD Eibar' => 'images/escudos/eibar.png',
        'Barça' => 'images/escudos/barca.png', // Asegúrate de que esta ruta sea correcta
    ];

    // Definición de los partidos
    $matches = [
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'Sporting de Gijón',
            'matchDate' => '2025-02-16 14:00:00'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'CD Mirandés',
            'matchDate' => '2025-02-23 18:30:00'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'CD Eldense',
            'matchDate' => '2025-03-02 20:00:00'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'FC Cartagena',
            'matchDate' => '2025-03-09 16:00:00'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'SD Huesca',
            'matchDate' => '2025-03-16 18:30:00'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'CD Castellón',
            'matchDate' => '2025-03-23'
        ],
        [
            'homeClubName' => 'UD Almería',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-03-30'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'R. Racing Clubn',
            'matchDate' => '2025-04-06'
        ],
        [
            'homeClubName' => 'Córdoba CF',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-04-13'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'Real Zaragoza',
            'matchDate' => '2025-04-20'
        ],
        [
            'homeClubName' => 'Real Oviedo',
            'awayClubName' => 'CD Tenerife',
            'matchDate' => '2025-05-05'
        ],
        [
            'homeClubName' => 'Elche CF',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-05-11'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'Albacete BP',
            'matchDate' => '2025-05-18'
        ],
        [
            'homeClubName' => 'Burgos CF',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-05-25'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'SD Eibar',
            'matchDate' => '2025-06-10'
        ],
        // Más partidos aquí...
    ];

    $currentDate = time(); // Obtener la fecha y hora actuales
    echo '<h3>Próximo partido</h3>';
    
    // Función para obtener la imagen del equipo (ruta manual)
    function getTeamImage($teamName, $teamIcons) {
        $teamName = trim($teamName); // Eliminar posibles espacios adicionales
        if (array_key_exists($teamName, $teamIcons)) {
            return $teamIcons[$teamName]; // Devolver la ruta del icono correspondiente
        }
        return 'images/escudos/default.png'; // Imagen por defecto si no se encuentra el equipo
    }

    $nextMatch = null;
    // Buscar el próximo partido
    foreach ($matches as $match) {
        $matchTimestamp = strtotime($match['matchDate']); // Convertir la fecha del partido en timestamp
        if ($matchTimestamp > $currentDate) {
            if ($nextMatch === null || $matchTimestamp < strtotime($nextMatch['matchDate'])) {
                $nextMatch = $match;
            }
        }
    }

    if ($nextMatch) {
        $homeTeam = $nextMatch['homeClubName'];
        $awayTeam = $nextMatch['awayClubName'];
        $matchDate = $nextMatch['matchDate'];
        $matchTimestamp = strtotime($matchDate); // Convertir la fecha del partido en timestamp

        $formattedDate = date('l, d/m/Y', $matchTimestamp);
        $formattedTime = date('H:i', $matchTimestamp);

        // Traducir el día de la semana al español
        $dayOfWeekSpanish = [
            'Sunday' => 'Domingo',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado'
        ];
        $formattedDate = str_replace(array_keys($dayOfWeekSpanish), array_values($dayOfWeekSpanish), $formattedDate);

        // Mostrar el próximo partido
        echo '<article class="post-inline">';
        echo '<div class="teams">';
        echo '<div class="team">';
        $homeIcon = getTeamImage($homeTeam, $teamIcons);
        echo '<img src="' . $homeIcon . '" alt="Escudo de ' . $homeTeam . '" class="team-icon">'; 
        echo '<p>' . $homeTeam . '</p>';
        echo '</div>';
        echo '<div class="team">';
        $awayIcon = getTeamImage($awayTeam, $teamIcons);
        echo '<img src="' . $awayIcon . '" alt="Escudo de ' . $awayTeam . '" class="team-icon">';
        echo '<p>' . $awayTeam . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<time class="post-inline-time" datetime="' . $matchDate . '">' . $formattedDate . ' a las ' . $formattedTime . '</time>';
        echo '</article>';
    } else {
        echo "<p>No hay partidos futuros programados.</p>";
    }

    // Cargar la información de los lesionados (string)
    function cargarLesionados($rutaJson) {
        if (file_exists($rutaJson)) {
            $lesionadosData = file_get_contents($rutaJson); // Leer el archivo como un string
            return $lesionadosData;
        }
        echo "<p>Error: El archivo 'lesionados.json' no se encuentra en la ruta especificada.</p>";
        return '';
    }

    $lesionados = cargarLesionados('datos/lesionados.json');
    
    if (!empty($lesionados)) {
        echo '<h4>Lesionados:</h4>';
        // Mostrar el contenido del string de los lesionados directamente
        echo "<p>{$lesionados}</p>";
    } else {
        echo "<p>No hay información sobre los lesionados en este momento.</p>";
    }
    ?>
</div>

<style>
    .hero__entry-text-inner {
        max-height: 80vh;
        overflow-y: scroll;
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
