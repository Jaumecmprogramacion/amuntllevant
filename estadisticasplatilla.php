<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plantilla Llevant U.D</title>

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
    <link rel="icon" type="image/png" sizes="16x16" href="images/levantelogo.svg>
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">
<header>

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>



    <!-- page wrap
    ================================================== -->
   


        <?php include 'includes/header.php'; ?>
        

            <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
            

        </header> <!-- end s-header -->


        <!-- # site-content
        ================================================== -->
        <div id="content" class="s-content s-content--blog">

                <div class="row entry-wrap">
                    <div class="column lg-12">

                        <article class="entry format-standard">

                            <header class="entry__header">
    
                                <h1 class="entry__title">
                                   Estadísticas 2024/2025
                                </h1>


                                
                            </header>

                            

                            

                                                    <?php
// Usamos $_SERVER['DOCUMENT_ROOT'] para obtener la ruta absoluta
$path = $_SERVER['DOCUMENT_ROOT'] . '/TrabajosProyectos/levanteinfo/includes/estadisticasdetalladas.php';

// Verificamos si el archivo existe antes de incluirlo
if (file_exists($path)) {
    include $path;
} else {
    echo "<p>El archivo 'plantillalevante.php' no se encuentra en la ruta especificada: $path</p>";
}
?>

                                

                                

                            </div> <!-- end content-primary -->

                        </article> <!-- end entry -->

                      
                    </div>
                </div> <!-- end entry-wrap -->
        </section> <!-- end s-content -->


        <!-- # site-footer
        ================================================== -->
        <?php include('includes/footer.php');?>
        </footer><!-- end s-footer -->


    <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>