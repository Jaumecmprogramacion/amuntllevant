<!DOCTYPE html>
<html lang="es" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Noticias y datos del Levante ud">
    <meta name="keywords" content="Levante UD, fútbol, noticias, Levante, plantilla, resultados, Jaume Crespo granota, calendario levante ud, calendario levante u.d.calendario llevant ud">
    <meta name="author" content="Jaume Crespo">
    <meta property="og:title" content="Noticias Levante UD">
    <meta property="og:description" content="Una descripción más detallada de tu página para compartir en redes sociales.">
    <meta property="og:image" content="URL_DE_TU_IMAGEN">
    <meta property="og:url" content="URL_DE_TU_PÁGINA">
    <meta name="robots" content="index, follow">
    <title>Noticias Levante UD</title>



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
        <div id="content" class="s-content s-content--blog">

                <div class="row entry-wrap">
                    <div class="column lg-12">

                        <article class="entry format-standard">

                            <header class="entry__header">
    


                                
                            </header>

                            

                            

                            <?php include 'includes/mostrarpartidoshora.php'; ?>

                                

                                

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