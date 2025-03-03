<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clasificación</title>

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
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
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
    
                                <h1 class="entry__title">
                                    Clasificación Liga Hipermotion
                                </h1>

                                <div class="entry__meta">
                                   
                                  
                                    
                                </div>
                            </header>

                            <?php include 'includes/clasificaciondetallada.php'; ?>

                            <div class="content-primary">

                                

                                            
                                    
    
                                    

                                </div> <!-- end entry-content -->

                                

                            </div> <!-- end content-primary -->

                        </article> <!-- end entry -->

                        <!-- comments -->
                        


                            <div class="comment-respond">

                                <!-- START respond -->
                               
                                <!-- END respond-->

                            </div> <!-- end comment-respond -->

                        </div> <!-- end comments-wrap -->

                    </div>
                </div> <!-- end entry-wrap -->
        </section> <!-- end s-content -->


       
        <footer>
    <?php include('includes/footer.php'); ?>
</footer>
        

    <!-- Java Script
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
</html>