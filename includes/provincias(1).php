<article class="post-future">
  <h4 class="post-future-title">
  <img src="images/pv.png" alt="Icono" width="20" height="20"> Las Provincias
</h4>

    <div class="post-future-main">
      <?php
      $rss_feed_url = 'https://www.lasprovincias.es/rss/2.0/?section=levanteud';
      $rss = simplexml_load_file($rss_feed_url);
      
      if ($rss !== false) {
          $counter = 0;
          foreach ($rss->channel->item as $item) {
              if ($counter < 3) {
                  echo '<div class="post-future">';
                  echo '<a class="post-future-figure" href="' . $item->link . '" target="_blank">';
                  
                  // Intentamos obtener la imagen desde <media:content>
                  $namespaces = $rss->getNamespaces(true);
                  $media = $item->children($namespaces['media']);
                  $image_url = '';

                  // Primero, intentamos obtener la imagen desde <media:content>
                  if ($media->content) {
                      $image_url = (string) $media->content->attributes()->url;
                  }

                  // Si no encontramos una imagen en <media:content>, intentamos en <description>
                  if (empty($image_url) && isset($item->description)) {
                      // Usamos expresión regular para extraer el src de la imagen dentro de la descripción
                      preg_match('/<img[^>]+src="([^"]+)"/', $item->description, $matches);
                      if (isset($matches[1])) {
                          $image_url = $matches[1];
                      }
                  }

                  // Si encontramos una imagen, la mostramos
                  if (!empty($image_url)) {
                      echo '<img src="' . $image_url . '" alt="Imagen de la noticia" width="368" height="287"/>';
                  }

                  echo '</a>';
                  echo '<h4 class="post-future-title"><a href="' . $item->link . '" target="_blank">' . $item->title . '</a></h4>';
                  echo '<hr/>';
                  echo '<div class="post-future-text"><p>' . strip_tags($item->description) . '</p></div>';
                  echo '<div class="post-future-footer group-flex group-flex-xs">';
                  echo '<a class="button button-gray-outline" href="' . $item->link . '" target="_blank">Leer más</a>';
                  echo '</div>';
                  echo '</div>';
                  $counter++;
              }
          }
      } else {
          echo '<p>Hubo un problema al cargar el RSS.</p>';
      }
      ?>
    </div>
  </article>