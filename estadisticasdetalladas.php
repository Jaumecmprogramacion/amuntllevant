<?php
// Ruta a los archivos JSON
$estadisticas_file = 'datos/estadisticasdetalladas.json';
$plantilla_file = 'datos/datosplantilla.json';

// Verificar si los archivos existen
if (!file_exists($estadisticas_file) || !file_exists($plantilla_file)) {
    echo "Uno o ambos archivos JSON no se encuentran.";
    die();
}

// Cargar los archivos JSON
$estadisticas_data = json_decode(file_get_contents($estadisticas_file), true);
$plantilla_data = json_decode(file_get_contents($plantilla_file), true);

// Manejo de errores en la decodificación JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error al leer los archivos JSON: " . json_last_error_msg());
}

// Obtener la lista de imágenes en la carpeta images/plantilla
$image_folder = 'images/plantilla/';
$image_files = scandir($image_folder);
$image_files = array_filter($image_files, function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'jpg'; // Solo .jpg
});
$image_files = array_values($image_files); // Reindexar el array
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }

        /* Estilo para el modal */
        #player-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        #player-modal .modal-header {
            font-size: 24px;
            font-weight: bold;
        }

        #player-modal .modal-body {
            margin-top: 10px;
        }

        #player-modal .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 18px;
            cursor: pointer;
        }

        /* Fondo oscuro para el modal */
        #modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Estilo para las columnas en el modal */
        #player-modal .modal-body {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        #player-modal .modal-body div {
            flex: 1; /* Cada columna ocupa la mitad del espacio */
        }

        #player-modal .modal-body img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>



<table id="estadisticas" class="display">
    <thead>
        <tr>
            <th>FOTO</th>
            <th>NOMBRE</th>
            <th>DORSAL</th>
            <th>POSICIÓN</th>
            <th>MIN</th>
            <th>PJ</th>
            <th>TIT</th>
            <th>SUP</th>
            <th>SUST</th>
            <th>AM</th>
            <th>ROJ</th>
            <th>DOB</th>
            <th>GOLES</th>
            <th>PEN</th>
            <th>GPP</th>
            <th>GE</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($estadisticas_data as $entry): 
            // Obtener el nombre del jugador (de las estadísticas)
            $nombre = htmlspecialchars($entry['NOMBRE']);
            $dorsal = trim((string)$entry['DORSAL']);
            $player_image = "https://img.a.transfermarkt.technology/portrait/medium/57522-1662569651.png?lm=1";  // Imagen predeterminada

            // Variable para verificar si encontramos una imagen similar al nombre
            $player_found = false;
            $max_similarity = 0;
            $best_match_image = $player_image; // Imagen predeterminada en caso de no encontrar una imagen coincidente

            // Buscar el archivo de imagen más similar por nombre
            foreach ($image_files as $image_file) {
                $image_name_without_extension = pathinfo($image_file, PATHINFO_FILENAME);
                
                // Comparamos el nombre del jugador con el nombre del archivo de imagen para encontrar la más similar
                similar_text(strtolower($nombre), strtolower($image_name_without_extension), $similarity);

                // Verificar si la similitud es la mejor encontrada
                if ($similarity > $max_similarity) {
                    $max_similarity = $similarity;
                    $best_match_image = $image_folder . $image_file;
                }
            }

            // Si se encontró una imagen más similar, asignamos la imagen encontrada
            $player_image = $best_match_image;
        ?>
            <tr>
                <td><img src="<?= $player_image ?>" alt="Foto de <?= $nombre ?>"></td>
                <td>
                    <a href="#" class="ver-detalles" data-info='<?= json_encode(array_merge($entry, ['imagen' => $player_image])) ?>'>
                        <?= $nombre ?>
                    </a>
                </td>
                <td><?= $dorsal ?></td>
                <td><?= htmlspecialchars($entry['POSICIÓN']) ?></td>
                <td><?= htmlspecialchars($entry['MIN']) ?></td>
                <td><?= htmlspecialchars($entry['PJ']) ?></td>
                <td><?= htmlspecialchars($entry['TIT']) ?></td>
                <td><?= htmlspecialchars($entry['SUP']) ?></td>
                <td><?= htmlspecialchars($entry['SUST']) ?></td>
                <td><?= htmlspecialchars($entry['AM']) ?></td>
                <td><?= htmlspecialchars($entry['ROJ']) ?></td>
                <td><?= htmlspecialchars($entry['DOB']) ?></td>
                <td><?= htmlspecialchars($entry['GOLES']) ?></td>
                <td><?= htmlspecialchars($entry['PEN']) ?></td>
                <td><?= htmlspecialchars($entry['GPP']) ?></td>
                <td><?= htmlspecialchars($entry['GE']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal para mostrar los detalles del jugador -->
<div id="modal-overlay"></div>
<div id="player-modal">
    <span class="close-btn">&times;</span>
    <div class="modal-header">
        <h3 id="modalTitle"></h3>
    </div>
    <div class="modal-body">
        <!-- Contenedor para las dos columnas -->
        <div>
        <div style="text-align: center; margin-top: 20px;">
        <img id="modalImage" src="" alt="Imagen del jugador" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
    </div>
            
            <p><strong>Dorsal:</strong> <span id="modalDorsal"></span></p>
            <p><strong>Posición:</strong> <span id="modalPosition"></span></p>
            <p><strong>Minutos:</strong> <span id="modalMin"></span></p>
            <p><strong>Partidos Jugados:</strong> <span id="modalPJ"></span></p>
            <p><strong>Titular:</strong> <span id="modalTIT"></span></p>
        </div>
        <div>
            <p><strong>Suplente:</strong> <span id="modalSUP"></span></p>
            <p><strong>Sustituciones:</strong> <span id="modalSUST"></span></p>
            <p><strong>Amonestaciones:</strong> <span id="modalAM"></span></p>
            <p><strong>Rojas:</strong> <span id="modalROJ"></span></p>
            <p><strong>Doble amarilla:</strong> <span id="modalDOB"></span></p>
            <p><strong>Goles:</strong> <span id="modalGOLES"></span></p>
            <p><strong>Penalties recibidos:</strong> <span id="modalPEN"></span></p>
            <p><strong>Goles propia puerta:</strong> <span id="modalGPP"></span></p>
            <p><strong>Goles encajados jugando:</strong> <span id="modalGE"></span></p>
        </div>
    </div>
    
</div>

<script>
    $(document).ready(function() {
        // Configuración del DataTable
        $('#estadisticas').DataTable({
            paging: false,
            searching: true,
            ordering: true,
            info: true
        });

        // Mostrar el modal al hacer clic en un nombre de jugador
        $(".ver-detalles").on("click", function() {
            var playerData = $(this).data("info");

            // Asignamos los datos al modal
            $("#modalTitle").text(playerData.NOMBRE);
            $("#modalImage").attr("src", playerData.imagen);
            $("#modalName").text(playerData.NOMBRE);
            $("#modalDorsal").text(playerData.DORSAL);
            $("#modalPosition").text(playerData.POSICIÓN);
            $("#modalMin").text(playerData.MIN);
            $("#modalPJ").text(playerData.PJ);
            $("#modalTIT").text(playerData.TIT);
            $("#modalSUP").text(playerData.SUP);
            $("#modalSUST").text(playerData.SUST);
            $("#modalAM").text(playerData.AM);
            $("#modalROJ").text(playerData.ROJ);
            $("#modalDOB").text(playerData.DOB);
            $("#modalGOLES").text(playerData.GOLES);
            $("#modalPEN").text(playerData.PEN);
            $("#modalGPP").text(playerData.GPP);
            $("#modalGE").text(playerData.GE);

            // Mostrar el modal
            $("#modal-overlay, #player-modal").show();
        });

        // Cerrar el modal
        $(".close-btn, #modal-overlay").on("click", function() {
            $("#modal-overlay, #player-modal").hide();
        });
    });
</script>

</body>
</html>
