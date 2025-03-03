<?php
// URL del feed RSS de Las Provincias
$rss_feed_url = 'https://www.lasprovincias.es/rss/2.0/?section=levanteud';

// Cargar el RSS
$rss = simplexml_load_file($rss_feed_url);

if ($rss !== false) {
    $counter = 0;
    foreach ($rss->channel->item as $item) {
        if ($counter < 3) { // Limitar a 3 noticias más recientes
            // Buscar la imagen dentro de media:content o media:thumbnail
            $image_url = '';
            $namespaces = $rss->getNamespaces(true);
            $media = $item->children($namespaces['media']);
            
            if ($media->content) {
                $image_url = (string) $media->content->attributes()->url;
            } elseif ($media->thumbnail) {
                $image_url = (string) $media->thumbnail->attributes()->url;
            } elseif (isset($item->enclosure)) {
                $image_url = (string) $item->enclosure['url'];
            }

            // Extrae el título, enlace y descripción
            $title = (string)$item->title;
            $link = (string)$item->link;
            $description = (string)$item->description;
            $pubDate = (string)$item->pubDate;
            
            // Formato de publicación (puedes modificar el formato de fecha si lo deseas)
            $formatted_date = date('d M Y', strtotime($pubDate));

            // Mostrar el artículo respetando la estructura HTML proporcionada
            echo '<article class="brick entry" data-animate-el>';
            
            echo '<div class="entry__thumb">';
            echo '<a href="' . $link . '" class="thumb-link">';
            // Mostrar la imagen solo si existe
            if (!empty($image_url)) {
                echo '<img src="' . $image_url . '" srcset="' . $image_url . ' 1x, ' . $image_url . ' 2x" alt="' . $title . '" loading="lazy">';
            } else {
                // Imagen de respaldo si no se encuentra ninguna imagen
                echo '<img src="images/default-image.jpg" alt="Imagen no disponible" loading="lazy">';
            }
            echo '</a>';
            echo '</div>'; // end entry__thumb

            echo '<div class="entry__text">';
            echo '<div class="entry__header">';
            echo '<div class="entry__meta">';
            echo '<span class="cat-links"><a href="#">Deportes</a></span>';
            echo '<span class="post-date">Publicado el: ' . $formatted_date . '</span>';
            echo '</div>'; // end entry__meta
            echo '<h1 class="entry__title"><a href="' . $link . '">' . $title . '</a></h1>';
            echo '</div>'; // end entry__header

            echo '<div class="entry__excerpt">';
            echo '<p>' . $description . '</p>';
            echo '</div>'; // end entry__excerpt

            echo '<a class="entry__more-link" href="' . $link . '">Leer más</a>';
            echo '</div>'; // end entry__text

            echo '</article>'; // end article

            $counter++;
        }
    }
} else {
    echo '<p>No se pudo cargar el RSS.</p>';
}
?>
