<div class="hero__entry-text-inner">
    <?php
    // Leer el archivo JSON con las rutas de las imágenes de los equipos
    $json = file_get_contents('datos/imgiconos.json');
    if ($json === false) {
        echo 'Error al leer el archivo JSON.';
        exit;
    }
    $teams = json_decode($json, true)['team']; // Decodificar y acceder al array de equipos

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
            'homeClubName' => 'CD Eldense',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-03-02'
        ],
        [
            'homeClubName' => 'Levante UD',
            'awayClubName' => 'FC Cartagena',
            'matchDate' => '2025-03-09'
        ],
        [
            'homeClubName' => 'SD Huesca',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2025-03-16'
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
        // Partido pasado (para probar el filtro)
        [
            'homeClubName' => 'Barça',
            'awayClubName' => 'Levante UD',
            'matchDate' => '2024-12-25 18:00:00' // Partido pasado
        ]
    ];

    $currentDate = time(); // Obtener la fecha y hora actuales

    // Función para obtener la imagen del equipo
    function getTeamImage($teamName, $teams) {
        foreach ($teams as $team) {
            if (strtolower($team['equipo']) == strtolower($teamName)) {
                return $team['imagen'];
            }
        }
        // Imagen por defecto si no se encuentra el equipo
        return 'images/escudos/default.png'; // Cambia esta ruta a la ruta de la imagen por defecto
    }

    foreach ($matches as $match) {
        $homeTeam = $match['homeClubName'];
        $awayTeam = $match['awayClubName'];
        $matchDate = $match['matchDate'];
        $matchTimestamp = strtotime($matchDate); // Convertir la fecha del partido en timestamp

        // Verificar si el partido es futuro
        if ($matchTimestamp > $currentDate) {
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

            // Aquí generamos el HTML para cada partido
            echo '<article class="post-inline">';
            
            // Contenedor para los iconos y nombres de los equipos
            echo '<div class="teams">';
            echo '<div class="team">';
            // Obtener la imagen del equipo local
            $homeIcon = getTeamImage($homeTeam, $teams);
            echo '<img src="' . $homeIcon . '" alt="' . $homeTeam . '" class="team-icon">';
            echo '<p>' . $homeTeam . '</p>';
            echo '</div>';
            echo '<div class="team">';
            // Obtener la imagen del equipo visitante
            $awayIcon = getTeamImage($awayTeam, $teams);
            echo '<img src="' . $awayIcon . '" alt="' . $awayTeam . '" class="team-icon">';
            echo '<p>' . $awayTeam . '</p>';
            echo '</div>';
            echo '</div>';

            // Contenedor para la fecha y hora
            echo '<time class="post-inline-time" datetime="' . $matchDate . '">' . $formattedDate . ' a las ' . $formattedTime . '</time>';
            echo '</article>';
        }
    }
    ?>
</div>

<style>
    .team img {
        width: 50px;
        height: auto;
        margin-bottom: 5px;
        display: block;
        margin-left: auto;
        margin-right: auto; /* Centrar el icono */
    }

    .teams {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin: 10px 0;
    }

    .team p {
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .post-inline-time {
        font-size: 16px;
        color: #555;
        font-style: italic;
    }
</style>
