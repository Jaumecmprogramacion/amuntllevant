<!DOCTYPE html>
<html lang="es" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Mantente al día con las últimas noticias, resultados y datos del Levante UD. Entérate de la plantilla, calendario y todo sobre el club granota.">
<meta name="keywords" content="Levante UD, fútbol, noticias Levante, plantilla Levante, resultados Levante, calendario Levante, Jaume Crespo, Levante UD última hora">
<meta name="author" content="Jaume Crespo">
<meta property="og:title" content="Noticias y Datos del Levante UD">
<meta property="og:description" content="Descubre todas las novedades sobre el Levante UD, con noticias actualizadas, resultados, calendario y mucho más sobre el club granota.">
<meta property="og:image" content="images/escudos/levante.png">
<meta property="og:url" content="images/escudos/levante.png">
<meta name="robots" content="index, follow">
<title>Noticias y Datos del Levante UD</title>



    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/levantelogo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="images/levantelogo.svg">
    <link rel="icon" type="image/png" sizes="16x16" href="images/levantelogo.svg">
    <link rel="manifest" href="site.webmanifest">

</head>


<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <header>
    <?php include 'includes/header.php'; ?>
    <!-- page wrap
    ================================================== -->
    <div id="page" class="s-pagewrap ss-home">


        <!-- # site header 
        ================================================== -->
      

           

          

        </header> <!-- end s-header -->


        <!-- # site-content
        ================================================== -->
        <section id="content" class="s-content">


            <!-- ventana principal -->
            <div class="hero">

                <div class="hero__slider swiper-container">
                    <!-- Flechas de navegación -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
             
                    
                    

                    <div class="swiper-wrapper">
                        <article class="hero__slide swiper-slide">
                            <div class="hero__entry-image" style="background-image: url('images/levanteportada1.jpg');"></div>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                    <div class="hero__entry-meta">
                                        <span class="cat-links">
                                        <div class="logo-container">
                                        <img src="images/levantelogo.svg" alt="Logo Levante" width="80" height="auto">
                                        </div>
                                            <a href="category.html">Llevant U.D.</a>
                                        </span>
                                    </div>
                                    <h2 class="hero__entry-title">
                                        <a >
                                            Todo sobre el universo granota
                                        </a>
                                    </h2>
                                    <p class="hero__entry-desc">
                                    Bienvenido a esta web granota para ver todo lo relacionado con el Levante UD. 
                                    Aquí encontrarás las últimas noticias, análisis, estadísticas y resultados del equipo. 
                                    Nuestro sitio te mantiene al día con la información más relevante sobre el club, sus jugadores y las competiciones. 
                                    No te pierdas nada de lo que sucede en el mundo granota. 
                                    </p>
                                   
                                </div>
                            </div>
                        </article>
                        
                        <article class="hero__slide swiper-slide">
                            <div class="hero__entry-image" style="background-image: url('images/campo01.jpg');"></div>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                <div class="logo-container">
                                        <img src="images/LaLiga_Hypermotion_2023_Horizontal_Logo.svg.png" alt="Logo Levante" width="220" height="auto">
                                        </div>
                                <?php include 'includes/clasificacion.php'; ?>
                                <a class="hero__more-link" href="clasificaciondet.php">Ver clasificación más detallada</a>

                                </div>
                            </div>
                        </article>
                        <article class="hero__slide swiper-slide">
                            <div class="hero__entry-image" style="background-image: url('images/-estadiociutatvalencia.jpg');"></div>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                <div class="logo-container">
                                        <img src="images/LaLiga_Hypermotion_2023_Horizontal_Logo.svg.png" alt="Logo Levante" width="220" height="auto">
                                        </div>
                                <?php include 'includes/lideres.php'; ?>
                               

                                </div>
                            </div>
                        </article>
                         <article class="hero__slide swiper-slide">
                            <div class="hero__entry-image" style="background-image: url('images/gente01.jpg');"></div>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                <div class="logo-container">
                                        <img src="images/LaLiga_Hypermotion_2023_Horizontal_Logo.svg.png" alt="Logo Levante" width="220" height="auto">
                                        </div>
                                
                                <?php include 'includes/proximo.php'; ?>

                                </div>
                            </div>
                            </div>
                        </article>
                       
                        
                        <article class="hero__slide swiper-slide">
                            <div class="hero__entry-image" style="background-image: url('images/analisis.jpg');"></div>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                <div class="logo-container">
                                        <img src="images/levantelogo.svg" alt="Logo Levante" width="200" height="auto">
                                        </div>
                                <?php include 'includes/verefemerides.php'; ?>
                                    <div class="hero__entry-meta">
                                    <div class="logo-container">
                                        <img src="images/levantelogo.svg" alt="Logo Levante" width="80" height="auto">
                                      
                                   
                                   
                                  
                                </div>
                            </div>
                        </article>
                        
                        
                    </div> <!-- swiper-wrapper -->

                    <div class="swiper-pagination"></div>
                    
    
                </div> <!-- end hero slider -->

                <a href="#bricks" class="hero__scroll-down smoothscroll">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                    </svg>
                    <span>Scroll</span>
                </a>

            </div> <!-- fin ventana principal-->


            <!--  masonry -->
            <div id="bricks" class="bricks">

                <div class="masonry">

                    <div class="bricks-wrapper" data-animate-block>
                    <article class="brick entry" data-animate-el>

<div class="entry__thumb">
    <a href="resultados.php" class="thumb-link">
        <img src="images/resultados.jpg" 
            srcset="images/resultados.jpg" alt="">
    </a>
</div> <!-- end entry__thumb -->

<div class="entry__text">
    <div class="entry__header">
        <div class="entry__meta">
            <span class="cat-links">
                <a href="#">Datos</a>
            </span>
            <span class="byline">
                
                <a href="resultados.php">Partidos y calendario</a>
            </span>
        </div>
        <h1 class="entry__title"><a href="resultados.php">Calendario/Resultados temporada</a></h1>
    </div>
    <div class="entry__excerpt">
        <p>
        Datos de los partidos jugados y por jugar
        </p>
    </div>
    <a class="entry__more-link" href="resultados.php">LEER MÁS</a>
</div> <!-- end entry__text -->


</article> <!-- end article -->
                    <article class="brick entry" data-animate-el>
                
        <div class="entry__thumb">
            <a href="plantilla.php" class="thumb-link">
                <img src="images/plantilla.jpg" 
                    srcset="images/plantilla.jpg" alt="">
            </a>
        </div> <!-- end entry__thumb -->
     
        <div class="entry__text">
            <div class="entry__header">
                <div class="entry__meta">
                    <span class="cat-links">
                        <a href="#">Datos</a>
                    </span>
                    <span class="post-date">
                        
                        <a href="plantilla.php">Plantilla</a>
                    </span>
                </div>
                <h1 class="entry__title"><a href="plantilla.php">Plantilla 2024-2025</a></h1>
            </div>
            <div class="entry__excerpt">
                <p>
                Todos los datos de la plantilla 2024/25.
            </div>
            
            <a class="entry__more-link" href="plantilla.php">LEER MÁS</a>
        </div> <!-- end entry__text -->
    
    </article> <!-- end article -->

        
    </article> <!-- end article -->
    <div class="bricks-wrapper" data-animate-block>
                    <article class="brick entry" data-animate-el>
        
        <div class="entry__thumb">
            <a href="plantilla.php" class="thumb-link">
                <img src="images/estadisticas.png" 
                    srcset="images/estadisticas.png" alt="">
            </a>
        </div> <!-- end entry__thumb -->
     
        <div class="entry__text">
            <div class="entry__header">
                <div class="entry__meta">
                    <span class="cat-links">
                        <a href="#">Datos</a>
                    </span>
                    <span class="post-date">
                        
                        <a href="lideres.php">Estadísticas</a>
                    </span>
                </div>
                <h1 class="entry__title"><a href="estadisticasplatilla.php">Estadísticas 2024-2025</a></h1>
            </div>
            <div class="entry__excerpt">
                <p>
                Todas las estadísticas del Levante 2024/25.
            </div>
            <a class="entry__more-link" href="estadisticasplatilla.php">LEER MÁS</a>
        </div> <!-- end entry__text -->
    
    </article> <!-- end article -->

        
    </article> <!-- end article -->

    <article class="brick entry" data-animate-el>
        

        <div class="entry__thumb">
            <a href="single-standard.html" class="thumb-link">
                <img src="images/clasificacion.jpg" 
                    srcset="images/clasificacion.jpg" alt="">
            </a>
        </div> <!-- end entry__thumb -->


        <div class="entry__text">
            <div class="entry__header">
                <div class="entry__meta">
                    <span class="cat-links">
                        <a href="#">Datos</a>
                    </span>
                    <span class="byline">
                        
                        <a href="#0">Clasificación</a>
                    </span>
                </div>
                <h1 class="entry__title"><a href="clasificaciondet.php">Clasificación Liga Hipermotion</a></h1>
            </div>
            <div class="entry__excerpt">
                <p>
                Clasificación detallada
                </p>
            </div>
            <a class="entry__more-link" href="clasificaciondet.php">LEER MÁS</a>
        </div> <!-- end entry__text -->
        
        
        
        
    </article> <!-- end article -->
   
                    <?php
                        include('includes/superdeporte.php');
                        include('includes/marca.php');
                        include('includes/provincias.php');
                        include('includes/levante.php');
                        ?>

                        <div class="grid-sizer"></div>
                        
                    
                        
                        


                        


        
                       


                       

                        
                    </div> <!-- end bricks-wrapper -->

                </div> <!-- end masonry-->


               
            </div> <!-- end bricks -->
</seccion>


            <footer>
    <?php include('includes/footer.php'); ?>
</footer>
        




        


    <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    

</body>

</html>