<!-- Calendario-->

    <article class="post-future">
        <h4 class="post-future-title">
            <img src="images/calendar_calendar_march_237.png" alt="Icono" width="40" height="40"> Próximos partidos
        </h4>
        <div class="post-future-main">
            <style>
                /* Estilo para los botones */
                .calendar-buttons {
                    margin-bottom: 20px;
                }

                .calendar-buttons button {
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                    margin: 0 10px;
                    border: none;
                    border-radius: 5px;
                }

                .calendar-buttons button:hover {
                    background-color: #f0f0f0;
                }

                /* Estilo para el contenedor de los partidos, inicialmente oculto */
                .matches {
                    display: none; /* Los partidos están ocultos por defecto */
                }

                /* Estilo para el botón de ocultar calendario, inicialmente oculto */
                #hideButton {
                    display: none; /* Este botón está oculto inicialmente */
                }
            </style>

            <div class="calendar-buttons">
                <!-- Botones de mostrar/ocultar calendario -->
                <button class="button button-gray-outline" id="showButton" onclick="verCalendario()">Ver calendario</button>
                <button  class="button button-gray-outline" id="hideButton" onclick="ocultarCalendario()">Ocultar calendario</button>
            </div>

            <div id="calendario" class="matches">
                <!-- Aquí se cargarán los partidos -->
                <?php include('includes/calendario.php'); ?>
            </div>

            <script>
                // Función para mostrar los partidos y el botón de ocultar calendario
                function verCalendario() {
                    // Mostrar los partidos
                    document.getElementById('calendario').style.display = 'block'; 
                    
                    // Mostrar el botón de ocultar calendario
                    document.getElementById('hideButton').style.display = 'inline-block';

                    // Ocultar el botón de mostrar calendario
                    document.getElementById('showButton').style.display = 'none';
                }

                // Función para ocultar los partidos y el botón de ocultar calendario
                function ocultarCalendario() {
                    // Ocultar los partidos
                    document.getElementById('calendario').style.display = 'none';
                    
                    // Ocultar el botón de ocultar calendario
                    document.getElementById('hideButton').style.display = 'none';

                    // Mostrar nuevamente el botón de mostrar calendario
                    document.getElementById('showButton').style.display = 'inline-block';
                }
            </script>
        </div>
    </article>
</div>