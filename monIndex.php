<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Polytech Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<div class="wrapper">

    <!-- PARTIE PHP OU ON RECUPERE LE NOM DE L'ETUDIANT -->
    <?php
    $nom_etudiant = "Nom";
    $prenom_etudiant = "Prénom";
    $formation_etudiant = "ET4 - Info";
    ?>

    <!-- PARTIE DU HAUT -->
    <header class="main-header">
        <!-- Logo -->
        <a href="monIndex.php" class="logo"><b>myDashboard</b></a>           <!-- LOGO EN HAUT A GAUCHE -->
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <!-- BARRE DE NAVIGATION EN HAUT -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- COMPTE DE L'UTILISATEUR -->
                    <li class="dropdown user user-menu">
                        <!-- APERCU DE L'UTILISATEUR -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?php echo $prenom_etudiant . " " . $nom_etudiant  ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- IMAGE DE L'UTILISATEUR -->
                            <li class="user-header">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                <p>
                                    <small><?php echo $formation_etudiant?></small>
                                </p>
                            </li>
                            <!-- Menu Body : A VOIR SI ON UTILISE
                            <li class="user-body">
                            </li>
                            -->
                            <!-- MENU FOOTER -->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Mon profil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Déconnexion</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>



    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- BARRE DE RECHERCHE : A UTILISER PEUT ETRE PLUS TARD -->
            <!-- search form
            <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form>
            -->

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <!-- TITRE DE LA BARRE DE NAVIGATION (SUR LA GAUCHE) -->
                <li class="header">MAIN NAVIGATION</li>
                <!-- Onglet ma formation -->
                <li>
                    <a href="#">
                        <i class="fa fa-education"></i> <span>Ma formation</span>       <!-- Modifier icone -->
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <!-- Onglet taches -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>Tâches</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <!-- Liste de sous-onglets : taches attribuées et mes taches -->
                    <ul class="treeview-menu">
                        <li><a href="pages/tasks/mytasks.php"><i class="fa fa-circle-o"></i>Mes tâches</a></li>
                        <li><a href="pages/tasks/assign_task.php"><i class="fa fa-circle-o"></i>Attribuer une tache</a></li>
                    </ul>
                </li>
                <!-- Onglet notes -->
                <li>
                    <a href="pages/notes.php">
                        <i class="fa fa-stats"></i> <span>Mes notes</span>      <!-- Modifier icone -->
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <!-- Onglet Planning -->
                <li>
                    <a href="pages/calendar.html">
                        <i class="fa fa-calendar"></i> <span>Planning</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <!-- Onglet "mes notifications" -->
                <li>
                    <a href="pages/mailbox/mailbox.html">
                        <i class="fa fa-envelope"></i> <span>Mes notifications</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li>
                    <a href="pages/mailbox/mailbox.html">
                        <i class="fa fa-envelope"></i> <span>Contacter quelqu'un</span>     <!-- Modifier icone -->
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>

                <!-- Plusieurs onglets utiles pour regarder l'interface, à enlever quand on en aura plus besoin -->
                <li class="header">A SUPPRIMER</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>UI Elements (a enlever)</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                        <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                        <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                        <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                        <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                        <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Forms (a enlever)</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                        <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                        <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>Login, ... (a enlever)</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                        <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                        <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                        <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                        <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                        <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    </ul>
                </li>
                <li><a href="documentation/index.html"><i class="fa fa-book"></i> Informations sur le code (a enlever)</a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mon tableau de bord
            </h1>

            <!-- Permet de savoir "ou on est" => A ENLEVER? -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2015 </strong>  - Guillaume BLANCHARD, Cédric PORTANERI, Julien PREISNER, Yasser RABI   - All rights reserved.
    </footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js" type="text/javascript"></script>
</body>
</html>