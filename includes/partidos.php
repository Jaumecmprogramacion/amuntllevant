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
    echo '<h3>Próximos partidos</h3>';
    // Función para obtener la imagen del equipo (ruta manual)
    function getTeamImage($teamName, $teamIcons) {
        $teamName = trim($teamName); // Eliminar posibles espacios adicionales
        if (array_key_exists($teamName, $teamIcons)) {
            return $teamIcons[$teamName]; // Devolver la ruta del icono correspondiente
        }
        return 'images/escudos/default.png'; // Imagen por defecto si no se encuentra el equipo
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
            $homeIcon = getTeamImage($homeTeam, $teamIcons);
            echo '<img src="' . $homeIcon . '" alt="Escudo de ' . $homeTeam . '" class="team-icon">'; 
            echo '<p>' . $homeTeam . '</p>'; // Mostrar nombre completo del equipo
            echo '</div>';
            echo '<div class="team">';
            // Obtener la imagen del equipo visitante
            $awayIcon = getTeamImage($awayTeam, $teamIcons);
            echo '<img src="' . $awayIcon . '" alt="Escudo de ' . $awayTeam . '" class="team-icon">';
            echo '<p>' . $awayTeam . '</p>'; // Mostrar nombre completo del equipo
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
    .hero__entry-text-inner {
        max-height: 80vh; /* Limitar la altura del contenedor */
        overflow-y: scroll; /* Habilitar el scroll vertical */
    }

    .teams {
        display: flex;
        justify-content: space-between;
    }

    .team {
        text-align: center;
    }

    .team img {
        width: 40px;
        height: auto;
        margin-bottom: 5px;
    }

    .post-inline {
        margin-bottom: 20px;
    }

    .post-inline-time {
        font-size: 14px;
    color: #030303;
    font-weight: bold;
    }
</style>
