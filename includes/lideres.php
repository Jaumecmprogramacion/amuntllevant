
<?php
// Ruta del archivo JSON
$file_path = 'datos/card_data.json';

if (file_exists($file_path)) {
    $json_data = file_get_contents($file_path);
    $data = json_decode($json_data, true);

    if (is_array($data)) {
        echo '<style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    background-color: #f4f4f9;
                }

                .card-container {
                    margin-bottom: 30px;
                    padding: 20px;
                    border: 1px solid #ccc;
                    background-color: #fff;
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                    border-radius: 10px;
                    transition: transform 0.3s ease;
                    max-width: 90%;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: center;
                }

                .card-container:hover {
                    transform: scale(1.05);
                    box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
                }

                table {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    border-collapse: collapse;
                }

                table th, table td {
                    padding: 8px 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                table th {
                    background-color: #4CAF50;
                    color: white;
                }

                table tr:hover {
                    background-color: #f1f1f1;
                }

                .leader-info {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    margin-bottom: 15px;
                }

                .leader-info img {
                    height: 120px; /* Tamaño más grande */
                    width: auto;
                    max-width: 100%;
                    object-fit: contain; /* Ajuste sin recorte */
                }

                h2 {
                    font-size: 22px;
                    margin: 0;
                    color: #333;
                }
            </style>';

        foreach ($data as $card) {
            $card_info = $card['card_info'];
            $lines = explode("\n", $card_info);

            if (count($lines) > 5) {
                $category_name = htmlspecialchars($lines[1]);
                $leader_name = htmlspecialchars($lines[6]);

                // Generar nombre del archivo de imagen
                $image_filename = trim($leader_name);
                $image_filename = str_replace(' ', '_', $image_filename);
                $image_filename = str_replace('.', '', $image_filename);
                $image_filename = strtolower($image_filename) . ".jpg";

                // Ruta de la imagen
                $image_url = "images/plantilla/$image_filename";

                // Verificar si la imagen existe
                if (!file_exists($image_url)) {
                    $image_url = "images/plantilla/default.jpg"; // Imagen por defecto
                }

                // Imprimir tarjeta con imagen del líder
                echo "<div class='card-container'>";
                echo "<div class='leader-info'>";
                echo "<img src='$image_url' alt='$leader_name' />";
                echo "<h2>$category_name - $leader_name</h2>";
                echo "</div>";

                // Imprimir tabla
                echo '<table>';
                echo '<tr><th></th><th>Jugador</th><th>' . $category_name . '</th></tr>';

                for ($i = 5; $i < count($lines); $i += 3) {
                    if (isset($lines[$i]) && isset($lines[$i + 1]) && isset($lines[$i + 2])) {
                        $position = htmlspecialchars($lines[$i]);
                        $player = htmlspecialchars($lines[$i + 1]);
                        $value = htmlspecialchars($lines[$i + 2]);

                        echo '<tr>';
                        echo "<td>$position</td><td>$player</td><td>$value</td>";
                        echo '</tr>';
                    }
                }

                echo '</table>';
                echo "</div>";
            }
        }
    } else {
        echo "Los datos del archivo no son válidos.";
    }
} else {
    echo "El archivo no existe.";
}
?>
