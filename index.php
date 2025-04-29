<?php 
session_start();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    
    <!--Designerd by: http://bootstrapthemes.co-->
    <head>
        <meta charset="utf-8">
        <title>Reasy</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/slick-theme.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/fonticons.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/bootsnav.css">


        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">

        


        <!-- Preloader -->
        <div id="loading">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div><!--End off Preloader -->


        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">
                <!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->

                <div class="container">    
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                    </div>        
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="#hello">

                            <img src="assets/images/reasylogo.png" class="logo logo-display m-top-10" alt="" style="width: 100px; height: auto;">
                            <img src="assets/images/reasylogo2.png" class="logo logo-scrolled" alt="" style="width: 100px; height: auto;">

                        </a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li><a href="#hello">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#pricing">Services</a></li>
                            <li><a href="#testimonial">Clients</a></li>
                            <li><a href="#contact">Contact</a></li>
                            
                            <?php if (isset($_SESSION['user'])): ?>
                                <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                <a href="./deconnexion.php" class="btn btn-primary m-top-20" style="border-radius: 50px;" >Logout</a>
                            <?php else: ?>
                                <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                <li><a href="connexion.php">Connexion</a></li>
                                <li><a href="inscreption.php">S'inscrire</a></li>
                            <?php endif; ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>  


                <!-- Start Side Menu -->
                <!-- <div class="side">
                    <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                    <div class="widget">
                        <h6 class="title">Custom Pages</h6>
                        <ul class="link">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Portfolio</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="widget">
                        <h6 class="title">Additional Links</h6>
                        <ul class="link">
                            <li><a href="#">Retina Homepage</a></li>
                            <li><a href="#">New Page Examples</a></li>
                            <li><a href="#">Parallax Sections</a></li>
                            <li><a href="#">Shortcode Central</a></li>
                            <li><a href="#">Ultimate Font Collection</a></li>
                        </ul>
                    </div>
                </div> -->
                <!-- End Side Menu -->

            </nav>


            <!--Home Sections-->

            <section id="hello" class="home bg-mega">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home">
                            <div class="home_text">
                                <h1 class="text-white">WE’RE <br /> YOUR SOLUTION !</h1>
                            </div>

                            <div class="home_btns m-top-40">
                            <?php if (isset($_SESSION['user'])): ?>
                                <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                <a href="#pricing" class="btn btn-primary m-top-20">VOIR NOTRE SERVICES</a>
                            <?php else: ?>
                                <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                <a href="./inscreption.php" class="btn btn-primary m-top-20">SIGN UP</a>
                                <a href="./connexion.php" class="btn btn-default m-top-20">SIGN IN</a>
                            <?php endif; ?>
                                
                            </div>

                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->


            <!--About Sections-->
            <section id="about" class="about roomy-100">
                <div class="container">
                    <div class="row">
                        <div class="main_about">
                            <div class="col-md-6">
                                <div class="about_content">
                                    <h2>ABOUT US</h2>
                                    <div class="separator_left"></div>

                                    <p>Bienvenue sur notre plateforme tout-en-un de réservation de voitures, vols et hôtels ! Nous mettons à votre disposition un large choix d’options de voyage à des prix raisonnables, avec des promotions dynamiques en permanence pour vous faire économiser encore plus. Que vous planifiez une escapade de dernière minute ou un voyage bien organisé, notre service rapide, fiable et facile à utiliser vous accompagne à chaque étape. Voyagez malin, voyagez avec nous !</p>


                                    <div class="home_btns m-top-40">
                                        <?php if (isset($_SESSION['user'])): ?>
                                            <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                            <a href="#pricing" class="btn btn-primary m-top-20">VOIR NOTRE SERVICES</a>
                                        <?php else: ?>
                                            <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                            <a href="./inscreption.php" class="btn btn-primary m-top-20">SIGN UP</a>
                                            <a href="./connexion.php" class="btn btn-default m-top-20" style="color: rgb(230, 230, 230); border-color: black; ">SIGN IN</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about_accordion wow fadeIn">
                                    <div id="faq_main_content" class="faq_main_content">
                                        <h6><i class="fa fa-angle-right"></i> UNIQUE DESIGN </h6>
                                        <div>
                                            <div class="content">
                                                <p>Notre plateforme se distingue par un design moderne, intuitif et épuré, pensé pour offrir une navigation fluide et agréable. Chaque détail a été conçu pour rendre la réservation rapide, simple et agréable...</p>


                                            </div>
                                        </div> <!-- End off accordion item-1 -->

                                        <h6 class="open"><i class="fa fa-angle-right"></i> EXPERIENCE TEAM</h6>
                                        <div class="open">
                                            <div class="content">
                                            <p>Derrière notre service se trouve une équipe passionnée et expérimentée dans le domaine du voyage et de la technologie. Nous mettons notre savoir-faire à votre service pour vous garantir une expérience de réservation fiable, efficace et sans stress. </p>

                                            </div>
                                        </div> <!-- End off accordion item-2 -->

                                        <h6> <i class="fa fa-angle-right"></i> GREAT SERVICE </h6>
                                        <div>
                                            <div class="content">
                                            <p>Nous plaçons la satisfaction client au cœur de nos priorités. Notre service est disponible pour répondre à vos besoins à tout moment, avec une attention particulière à la qualité, à la réactivité et à la transparence. </p>
                                            </div>
                                        </div> <!-- End off accordion item-3 -->

                                        <h6><i class="fa fa-angle-right"></i> FREE UPDATES </h6>
                                        <div>
                                            <div class="content">
                                            <p>Bénéficiez en permanence de mises à jour gratuites sur nos offres, nos outils et nos fonctionnalités. Nous évoluons avec vos besoins pour vous proposer une plateforme toujours plus performante et avantageuse.</p>
                                            </div>
                                        </div> <!-- End off accordion item-4 -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
                
            </section> <!--End off About section -->



                <?php 
                    require_once './include/DataBase.php';
                    $cat = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
                    $ids = [];

                    foreach($cat as $categorie){
                        if ($categorie->nom === 'Hotels') {
                            $ids['hotel'] = $categorie->id;
                        } elseif ($categorie->nom === 'Vols') {
                            $ids['vol'] = $categorie->id;
                        } elseif ($categorie->nom === 'Location de Voitures') {
                            $ids['voiture'] = $categorie->id;
                        }
                    }
                ?>

 <!--Pricing Section-->
 <section id="pricing" class="pricing lightbg">
    <div class="container">
        <div class="row">
            <div class="main_pricing roomy-100">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <div class="head_title text-center">
                        <h2>OUR SERVICES</h2>
                        <div class="separator_auto"></div>
                        <p>Nous proposons un service complet pour organiser vos voyages en toute simplicité. Que vous souhaitiez réserver un hôtel, un vol ou une voiture de location, notre plateforme regroupe tout ce dont vous avez besoin en un seul endroit. Facile à utiliser, rapide et sécurisée, elle s’adresse aussi bien aux voyageurs qu’aux professionnels du secteur. </p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="pricing_item sm-m-top-30">
                        <div class="pricing_head p-top-30 p-bottom-100 text-center">
                            <h3 class="text-uppercase"></h3>
                        </div>
                        <div class="pricing_price_border text-center">
                            <div class="pricing_price">
                                <br><h3 class="text-white" style="font-size: 25px;">VOL</h3>
                                <!-- <p class="text-white"></p> -->
                            </div>
                        </div>

                        <div class="pricing_body bg-white p-top-110 p-bottom-60">
                            <ul>
                                <li><i class="fa fa-check-circle text-primary"></i> Prix compétitifs</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Réservation rapide</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Nationaux/internationaux</li>
                            </ul>
                            <div class="pricing_btn text-center m-top-40">
                                <?php if (isset($_SESSION['user'])): ?>
                                    <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                    <a href="front/categorie.php?id=<?php echo $ids['vol']?>" class="btn btn-primary">VISITER</a>
                                <?php else: ?>
                                    <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                    <a href="connexion.php" class="btn btn-primary">SIGN IN</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- End off col-md-4 -->

                <div class="col-md-4 col-sm-12">
                    <div class="pricing_item sm-m-top-30">
                        <div class="pricing_head p-top-30 p-bottom-100 text-center">
                            <h3 class="text-uppercase"></h3>
                        </div>
                        <div class="pricing_price_border text-center">
                            <div class="pricing_price">
                                <br><h3 class="text-white" style="font-size: 25px;">HOTEL</h3>
                                <!-- <p class="text-white"></p> -->
                            </div>
                        </div>

                        <div class="pricing_body bg-white p-top-110 p-bottom-60">
                            <ul>
                                <li><i class="fa fa-check-circle text-primary"></i> Large choix</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Réservation sécurisée</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Détails complets</li>
                            </ul>
                            <div class="pricing_btn text-center m-top-40">
                                <?php if (isset($_SESSION['user'])): ?>
                                    <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                    <a href="front/categorie.php?id=<?php echo $ids['hotel']?>" class="btn btn-primary">VISITER</a>
                                <?php else: ?>
                                    <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                    <a href="connexion.php" class="btn btn-primary">SIGN IN</a>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                </div><!-- End off col-md-4 -->

                <div class="col-md-4 col-sm-12">
                    <div class="pricing_item sm-m-top-30">
                        <div class="pricing_head p-top-30 p-bottom-100 text-center">
                            <h3 class="text-uppercase"></h3>
                        </div>
                        <div class="pricing_price_border text-center">
                            <div class="pricing_price">
                                <br><h3 class="text-white" style="font-size: 25px;">VOITURE</h3>
                                <!-- <p class="text-white"></p> -->
                            </div>
                        </div>

                        <div class="pricing_body bg-white p-top-110 p-bottom-60">
                            <ul>
                                <li><i class="fa fa-check-circle text-primary"></i> Large gamme</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Location flexible</li>
                                <li><i class="fa fa-check-circle text-primary"></i> Partenaires fiables</li>
                            </ul>
                            <div class="pricing_btn text-center m-top-40">
                                <?php if (isset($_SESSION['user'])): ?>
                                    <!-- Affiche le bouton "logout" si l'utilisateur est connecté -->
                                    <a href="front/categorie.php?id=<?php echo $ids['voiture']?>" class="btn btn-primary">VISITER</a>
                                <?php else: ?>
                                    <!-- Affiche les boutons "Se connecter" et "S'inscrire" si l'utilisateur n'est pas connecté -->
                                    <a href="connexion.php" class="btn btn-primary">SIGN IN</a>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    </div>
                </div><!-- End off col-md-4 -->

            </div>
        </div><!--End off row-->
    </div><!--End off container -->
</section> <!--End off Pricing section -->




            <!--Testimonial Section-->
            <section id="testimonial" class="testimonial fix">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_testimonial roomy-100">
                            <div class="head_title text-center">
                                <h2 class="text-white">OUR TESTIMONIALS</h2>
                            </div>
                            <div class="testimonial_slid text-center">
                                <div class="testimonial_item">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <p class="text-white">J'ai réservé un hôtel à Fès en quelques clics seulement. Le site est clair, rapide, et j'ai pu voir les photos des chambres avant de réserver. J’ai même reçu un mail de confirmation instantanément ! Très pratique, je recommande</p>

                                        <div class="test_authour m-top-30">
                                            <h6 class="text-white m-bottom-20">ILIAS - THEMEFOREST USER</h6>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial_item">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <p class="text-white">Je cherchais un vol pas cher pour Paris, et votre plateforme m’a vraiment aidé. L’interface est fluide, les options sont bien classées et les filtres m’ont fait gagner un temps fou. Le processus de paiement est sécurisé et simple. </p>

                                        <div class="test_authour m-top-30">
                                            <h6 class="text-white m-bottom-20">OUSSAMA - THEMEFOREST USER</h6>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial_item">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <p class="text-white">J’ai loué une voiture à l’aéroport de Casablanca directement via le site. J’ai apprécié la transparence des prix et la possibilité de choisir le modèle avec des photos. Tout s’est bien passé à la récupération de la voiture.</p>

                                        <div class="test_authour m-top-30">
                                            <h6 class="text-white m-bottom-20">NOUSSIR - THEMEFOREST USER</h6>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial_item">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <p class="text-white">J’ai utilisé votre site pour réserver à la fois un vol et un hôtel pour un voyage à Barcelone. Tout était parfaitement synchronisé ! Les confirmations sont arrivées rapidement et j’ai pu tout gérer depuis un seul espace. C’est devenu mon outil de voyage préféré. </p>

                                        <div class="test_authour m-top-30">
                                            <h6 class="text-white m-bottom-20">ABDELHAKIM - THEMEFOREST USER</h6>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Testimonial section -->


            <!--Skill Sections-->
            <section id="skill" class="skill roomy-100">
                <div class="container">
                    <div class="row">
                        <div class="skill_bottom_content text-center">
                            <div class="col-md-3">
                                <div class="skill_bottom_item">
                                    <h2 class="statistic-counter">3688</h2>
                                    <div class="separator_small"></div>
                                    <h5><em>CLIENTS SATISFAITS</em></h5>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="skill_bottom_item">
                                    <h2 class="statistic-counter">5012</h2>
                                    <div class="separator_small"></div>
                                    <h5><em>CHAMBRES RÉSERVÉES</em></h5>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="skill_bottom_item">
                                    <h2 class="statistic-counter">4800</h2>
                                    <div class="separator_small"></div>
                                    <h5><em>VOLS RÉSERVÉS</em></h5>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="skill_bottom_item">
                                    <h2 class="statistic-counter">3234</h2>
                                    <div class="separator_small"></div>
                                    <h5><em>VOITURES RÉSERVÉES</em></h5>
                                </div>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Skill section -->




            <!--Contact Us Section-->
            <section id="contact" class="contact bg-mega fix">
                <div class="container">
                    <div class="row">
                        <div class="main_contact roomy-100 text-white">
                            <div class="col-md-4">
                                <div class="rage_widget">
                                    <div class="widget_head">
                                        <h3 class="text-white">Reasy</h3>
                                        <div class="separator_small"></div>
                                    </div>
                                        <p>notre plateforme tout-en-un de réservation de voitures, vols et hôtels ! Nous mettons à votre disposition un large choix d’options de voyage à des prix raisonnables, avec des promotions dynamiques en permanence pour vous faire économiser encore plus. </p>


                                    <div class="widget_socail m-top-30">
                                        <ul class="list-inline">
                                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href=""><i class="fa fa-vimeo"></i></a></li>
                                            <li><a href=""><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 sm-m-top-30">
                                <form class="" action="subcribe.php">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group"> 
                                                <input id="first_name" name="first_name" type="text" placeholder="Name" class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">  
                                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">  
                                                <textarea class="form-control" rows="6" placeholder="Message"></textarea>
                                            </div>
                                            <div class="form-group text-center">
                                                <a href="" class="btn btn-primary">SEND MESSAGE</a>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!--End off row -->
                </div><!--End off container -->
            </section><!--End off Contact Section-->


            <!-- scroll up-->
            <div class="scrollup">
                <a href="#"><i class="fa fa-chevron-up"></i></a>
            </div><!-- End off scroll up -->


            <!-- <footer id="footer" class="footer bg-black">
                <div class="container">
                    <div class="row">
                        <div class="main_footer text-center p-top-40 p-bottom-10">
                            <p class="wow fadeInRight" data-wow-duration="1s">
                                Made with 
                                <i class="fa fa-heart"></i>
                                by 
                                <a target="_blank" href="https://bootstrapthemes.co">Bootstrap Themes</a> 
                                2016. All Rights Reserved
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="main_footer text-center p-top-20 p-bottom-20">
                            <p class="wow fadeInRight" data-wow-duration="1s">
                                Distributed
                                <i class="fa fa-heart"></i>
                                by 
                                <a target="_blank" href="https://themewagon.com/">Themewagon</a> 
                                2016. All Rights Reserved
                            </p>
                        </div>
                    </div> -->


                </div>
            </footer>




        </div>

            <!-- JS includes -->

            <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
            <script src="assets/js/vendor/bootstrap.min.js"></script>

            <script src="assets/js/jquery.magnific-popup.js"></script>
            <script src="assets/js/jquery.easing.1.3.js"></script>
            <script src="assets/js/slick.min.js"></script>
            <script src="assets/js/jquery.collapse.js"></script>
            <script src="assets/js/bootsnav.js"></script>


            <!-- paradise slider js -->




            <script src="assets/js/plugins.js"></script>
            <script src="assets/js/main.js"></script>
            <?php include 'chatbot_component.php'; ?>

    </body>
</html>
